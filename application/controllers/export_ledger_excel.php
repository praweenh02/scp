<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

session_start();
require_once 'dbconfig.php';

// ================= BASIC =================
$business_id = $_SESSION['business_id'] ?? 0;
$userId = isset($_GET['ledgerId']) ? (int)$_GET['ledgerId'] : 0;


if ($userId <= 0) {
    die("Invalid Ledger ID");
}
$userStmt = $db->prepare("
    SELECT user_master.first_name, user_master.last_name, user_master.bank_name, user_master.account_no, user_role_allot.role_id
    FROM user_master
    LEFT JOIN user_role_allot
        ON user_master.id = user_role_allot.user_id
    WHERE user_master.id = :uid
    AND user_role_allot.business_id = :bid
");

$userStmt->execute([
	':uid' => $userId,
	':bid' => $business_id
]);

$user = $userStmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
	echo "<p>User not found</p>";
	exit;
}
if($user['role_id'] == 3)
	{
$ledgerName = htmlspecialchars(trim($user['bank_name'] . '  - ' . $user['account_no']));
	}else{
		$ledgerName = htmlspecialchars(trim($user['first_name'] . ' ' . $user['last_name']));

	}
// ================= DATE FORMAT =================
function formatDate($date) {
    if (empty($date)) return '';

    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) return $date;

    $d = DateTime::createFromFormat('d/m/Y', $date);
    if ($d) return $d->format('Y-m-d');

    $ts = strtotime($date);
    return $ts ? date('Y-m-d', $ts) : '';
}

// ================= FILTERS =================
$fromDate = formatDate($_GET['from_date'] ?? '');
$toDate   = formatDate($_GET['to_date'] ?? '');
$search   = trim($_GET['search'] ?? '');

// ================= QUERY =================
$sql = "
SELECT id, txn_date, voucher_no, description,
       dr_amount, cr_amount,
       from_account_id, to_account_id
FROM account_transactions
WHERE (from_account_id = :uid1 OR to_account_id = :uid2)
AND business_id = :bid
";

$params = [
    ':uid1' => $userId,
    ':uid2' => $userId,
    ':bid'  => $business_id
];

// Filters
if (!empty($fromDate)) {
    $sql .= " AND txn_date >= :from";
    $params[':from'] = $fromDate;
}
if (!empty($toDate)) {
    $sql .= " AND txn_date <= :to";
    $params[':to'] = $toDate;
}
if (!empty($search)) {
    $sql .= " AND (voucher_no LIKE :s OR description LIKE :s)";
    $params[':s'] = "%$search%";
}

$sql .= " ORDER BY txn_date ASC, id ASC";

// Execute
$stmt = $db->prepare($sql);
$stmt->execute($params);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ================= EXCEL =================
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Title
$sheet->setCellValue('A1', $ledgerName.'-Ledger Report');
$sheet->mergeCells('A1:E1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Header
$sheet->setCellValue('A3', 'Date');
$sheet->setCellValue('B3', 'Details');
$sheet->setCellValue('C3', 'Dr');
$sheet->setCellValue('D3', 'Cr');
$sheet->setCellValue('E3', 'Balance');

// 🔥 Dark Header Style
$sheet->getStyle('A3:E3')->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
        'size' => 12
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical'   => Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '343A40']
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// Auto width
foreach(range('A','E') as $col){
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ================= DATA =================
$row = 4;
$balance = 0;

// Opening Balance
$sheet->setCellValue("B$row", 'Opening Balance');
$sheet->setCellValue("E$row", $balance);

$sheet->getStyle("A$row:E$row")->applyFromArray([
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'E9ECEF']
    ]
]);

$row++;

// Transactions
foreach ($transactions as $txn) {

    $date = !empty($txn['txn_date']) ? date('d/m/Y', strtotime($txn['txn_date'])) : '';

    $dr = (float)($txn['dr_amount'] ?? 0);
    $cr = (float)($txn['cr_amount'] ?? 0);

    $debit = '';
    $credit = '';

    if ((int)$txn['to_account_id'] == $userId) {
        $debit = $dr;
        $balance -= $dr;
    }

    if ((int)$txn['from_account_id'] == $userId) {
        $credit = $cr;
        $balance += $cr;
    }

    $sheet->setCellValue("A$row", $date);
    $sheet->setCellValue("B$row", $txn['voucher_no'] . " - " . $txn['description']);
    $sheet->setCellValue("C$row", $debit);
    $sheet->setCellValue("D$row", $credit);
    $sheet->setCellValue("E$row", $balance);

    // Zebra rows
    if ($row % 2 == 0) {
        $sheet->getStyle("A$row:E$row")->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('F8F9FA');
    }

    // Borders
    $sheet->getStyle("A$row:E$row")->getBorders()->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    // Debit Red
    if (!empty($debit)) {
        $sheet->getStyle("C$row")->getFont()->getColor()->setRGB('DC3545');
    }

    // Credit Green
    if (!empty($credit)) {
        $sheet->getStyle("D$row")->getFont()->getColor()->setRGB('28A745');
    }

    // Balance color
    if ($balance >= 0) {
        $sheet->getStyle("E$row")->getFont()->getColor()->setRGB('28A745');
    } else {
        $sheet->getStyle("E$row")->getFont()->getColor()->setRGB('DC3545');
    }

    $row++;
}

// Closing Balance
$sheet->setCellValue("B$row", 'Closing Balance');
$balDisplay = number_format(abs($balance), 2) . ($balance >= 0 ? ' Cr' : ' Dr');
$sheet->setCellValue("E$row", $balDisplay);

$sheet->getStyle("A$row:E$row")->applyFromArray([
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'DEE2E6']
    ]
]);

// Currency format
$sheet->getStyle("C4:E$row")
    ->getNumberFormat()
    ->setFormatCode('#,##0.00');

// ================= DOWNLOAD =================
$filename = $ledgerName."_ledger__reports_" . date('Ymd_His') . ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;