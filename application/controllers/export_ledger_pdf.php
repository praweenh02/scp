<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

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

// ================= QUERY =================
$stmt = $db->prepare("
SELECT id, txn_date, voucher_no, description,
       dr_amount, cr_amount,
       from_account_id, to_account_id
FROM account_transactions
WHERE (from_account_id = :uid1 OR to_account_id = :uid2)
AND business_id = :bid
ORDER BY txn_date ASC, id ASC
");

$stmt->execute([
    ':uid1' => $userId,
    ':uid2' => $userId,
    ':bid'  => $business_id
]);

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ================= HTML DESIGN =================
$balance = 0;

$html = "
<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
}

h2 {
    text-align: center;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background-color: #343A40;
    color: #fff;
    padding: 8px;
    text-align: center;
}

td {
    padding: 6px;
    border: 1px solid #ccc;
}

tr:nth-child(even) {
    background-color: #f8f9fa;
}

.opening {
    background-color: #e9ecef;
    font-weight: bold;
}

.closing {
    background-color: #dee2e6;
    font-weight: bold;
}

.debit {
    color: #dc3545;
    text-align: right;
}

.credit {
    color: #28a745;
    text-align: right;
}

.balance-pos {
    color: #28a745;
    text-align: right;
    font-weight: bold;
}

.balance-neg {
    color: #dc3545;
    text-align: right;
    font-weight: bold;
}

.right {
    text-align: right;
}
</style>

<h2> ".$ledgerName." -Ledger Report</h2>

<table>
<tr>
    <th>Date</th>
    <th>Details</th>
    <th>Dr</th>
    <th>Cr</th>
    <th>Balance</th>
</tr>
";

// Opening Balance
$html .= "
<tr class='opening'>
    <td colspan='4'>Opening Balance</td>
    <td class='right'>0.00</td>
</tr>
";

// Transactions
foreach ($transactions as $txn) {

    $date = !empty($txn['txn_date']) ? date('d/m/Y', strtotime($txn['txn_date'])) : '';

    $dr = (float)($txn['dr_amount'] ?? 0);
    $cr = (float)($txn['cr_amount'] ?? 0);

    $debit = '';
    $credit = '';

    if ((int)$txn['to_account_id'] == $userId) {
        $debit = number_format($dr, 2);
        $balance -= $dr;
    }

    if ((int)$txn['from_account_id'] == $userId) {
        $credit = number_format($cr, 2);
        $balance += $cr;
    }

    $balDisplay = number_format(abs($balance), 2) . ($balance >= 0 ? ' Cr' : ' Dr');
    $balClass = $balance >= 0 ? 'balance-pos' : 'balance-neg';

    $html .= "
    <tr>
        <td>$date</td>
        <td>{$txn['voucher_no']}<br><small>{$txn['description']}</small></td>
        <td class='debit'>$debit</td>
        <td class='credit'>$credit</td>
        <td class='$balClass'>$balDisplay</td>
    </tr>
    ";
}

// Closing Balance
$closing = number_format(abs($balance), 2) . ($balance >= 0 ? ' Cr' : ' Dr');

$html .= "
<tr class='closing'>
    <td colspan='4'>Closing Balance</td>
    <td>$closing</td>
</tr>
";

$html .= "</table>";

// ================= PDF =================
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream($ledgerName."_ledger_reports_" . date('Ymd_His') . ".pdf", ["Attachment" => true]);
exit;