<?php
// error_reporting(-1);
session_start();
require_once('dbconfig.php');

if (isset($_POST['action']) && $_POST['action'] == "insert") {



	if (!isset($_POST['submit'])) {
		header("Location: bank-deposits.php");
		exit;
	}

	try {


		/* ================= VALIDATION ================= */
		if (empty($_POST['amount']) || $_POST['amount'] <= 0) {
			throw new Exception("Invalid amount");
		}

		/* ================= DATE ================= */
		$dateObj = DateTime::createFromFormat("d/m/Y", $_POST['date']);
		if (!$dateObj) {
			throw new Exception("Invalid date format");
		}
		$txn_date = $dateObj->format('Y-m-d');

		/* ================= FILE UPLOAD ================= */
		$final_file = null;

		if (!empty($_FILES['file']['name'])) {
			$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
			$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

			if (!in_array($ext, $allowed)) {
				throw new Exception("Invalid file type");
			}

			if ($_FILES['file']['size'] > 2 * 1024 * 1024) {
				throw new Exception("File size exceeds 2MB");
			}

			$final_file = uniqid() . "." . $ext;
			move_uploaded_file($_FILES['file']['tmp_name'], "upload/file/" . $final_file);
		}

		/* ================= TRANSACTION START ================= */
		/* ================= TRANSACTION START ================= */
		$db->beginTransaction();

		$voucher_no = "DEP-" . date('Ymd') . "-" . rand(1000, 9999);

		$amount = (float) $_POST['amount'];
		$business_id = $_SESSION['business_id'];
		$bank_id = (int) $_POST['to_account_id'];
		$payer_id = (int) $_POST['from_account_id'];
		$description = $_POST['description'] ?? '';
		$category = $_POST['category_id'] ?? null;
		$payment_method = $_POST['payment_method'] ?? null;
		$reference = $_POST['reference'] ?? null;

		/* Prepare once */
		$insert = $db->prepare("
    INSERT INTO account_transactions
    (business_id,voucher_no, txn_type, from_account_id, to_account_id,
     txn_date, description, dr_amount, cr_amount,
     category, payment_method, reference, attachment, created_at)
    VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

		/* ========== 1️⃣ Debit Bank ========== */
		$insert->execute([
			$business_id,
			$voucher_no,
			'deposit',
			0,              // from_account_id
			$bank_id,          // to_account_id
			$txn_date,
			$description,
			$amount,           // DR
			0,                 // CR
			$category,
			$payment_method,
			$reference,
			$final_file
		]);

		/* ========== 2️⃣ Credit Payer ========== */
		$insert->execute([
			$business_id,
			$voucher_no,
			'deposit',
			$payer_id,         // from_account_id
			0,              // to_account_id
			$txn_date,
			$description,
			0,                 // DR
			$amount,           // CR
			$category,
			$payment_method,
			$reference,
			$final_file
		]);

		$db->commit();
		$_SESSION['toast'] = [
			'type' => 'success',
			'message' => 'Deposit added successfully!'
		];
	} catch (Exception $e) {

		if ($db->inTransaction()) {
			$db->rollBack();
		}

		$_SESSION['toast'] = [
			'type' => 'error',
			'message' => $e->getMessage()
		];
	}

	header("Location: bank-deposits.php");
	exit;
} elseif (isset($_POST['action']) && $_POST['action'] == "update") {
	if (!isset($_POST['submit'])) {
		header("Location: bank-deposits.php");
		exit;
	}

	try {


		/* ================= VALIDATION ================= */
		if (empty($_POST['amount']) || $_POST['amount'] <= 0) {
			throw new Exception("Invalid amount");
		}

		/* ================= DATE ================= */
		$dateObj = DateTime::createFromFormat("d/m/Y", $_POST['date']);
		if (!$dateObj) {
			throw new Exception("Invalid date format");
		}
		$txn_date = $dateObj->format('Y-m-d');

		/* ================= FILE UPLOAD ================= */
		$final_file = null;

		if (!empty($_FILES['file']['name'])) {
			$allowed = ['pdf', 'jpg', 'jpeg', 'png'];
			$ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

			if (!in_array($ext, $allowed)) {
				throw new Exception("Invalid file type");
			}

			if ($_FILES['file']['size'] > 2 * 1024 * 1024) {
				throw new Exception("File size exceeds 2MB");
			}

			$final_file = uniqid() . "." . $ext;
			move_uploaded_file($_FILES['file']['tmp_name'], "upload/file/" . $final_file);
		}

		/* ================= TRANSACTION START ================= */
		/* ================= TRANSACTION START ================= */
		$db->beginTransaction();

		$voucher_no = $_POST['voucher_no'];
		/* =========================
           DELETE OLD ENTRY
        ========================== */
		$delete = $db->prepare("
            DELETE FROM account_transactions
            WHERE voucher_no = ? AND business_id = ?
        ");
		$delete->execute([$voucher_no, $business_id]);

		$amount = (float) $_POST['amount'];
		$business_id = $_SESSION['business_id'];
		$bank_id = (int) $_POST['to_account_id'];
		$payer_id = (int) $_POST['from_account_id'];
		$description = $_POST['description'] ?? '';
		$category = $_POST['category_id'] ?? null;
		$payment_method = $_POST['payment_method'] ?? null;
		$reference = $_POST['reference'] ?? null;

		/* Prepare once */
		$insert = $db->prepare("
    INSERT INTO account_transactions
    (business_id,voucher_no, txn_type, from_account_id, to_account_id,
     txn_date, description, dr_amount, cr_amount,
     category, payment_method, reference, attachment, created_at)
    VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

		/* ========== 1️⃣ Debit Bank ========== */
		$insert->execute([
			$business_id,
			$voucher_no,
			'deposit',
			0,              // from_account_id
			$bank_id,          // to_account_id
			$txn_date,
			$description,
			$amount,           // DR
			0,                 // CR
			$category,
			$payment_method,
			$reference,
			$final_file
		]);

		/* ========== 2️⃣ Credit Payer ========== */
		$insert->execute([
			$business_id,
			$voucher_no,
			'deposit',
			$payer_id,         // from_account_id
			0,              // to_account_id
			$txn_date,
			$description,
			0,                 // DR
			$amount,           // CR
			$category,
			$payment_method,
			$reference,
			$final_file
		]);

		$db->commit();
		$_SESSION['toast'] = [
			'type' => 'success',
			'message' => 'Deposit details updated successfully!'
		];
	} catch (Exception $e) {

		if ($db->inTransaction()) {
			$db->rollBack();
		}

		$_SESSION['toast'] = [
			'type' => 'error',
			'message' => $e->getMessage()
		];
	}

	header("Location: bank-deposits.php");
	exit;
} elseif (isset($_GET['delete_id']) && isset($_GET['action'])) {

	$id = (int) $_GET['delete_id'];

	$db->beginTransaction();

	/* ===== Get Voucher & Attachment ===== */
	$stmt = $db->prepare("
        SELECT voucher_no, attachment
        FROM account_transactions
        WHERE id = :id AND txn_type='deposit'
        LIMIT 1
    ");
	$stmt->execute([':id' => $id]);
	$txn = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($txn) {

		/* ===== Delete Attachment ===== */
		if (!empty($txn['attachment'])) {
			$filePath = "upload/file/" . $txn['attachment'];
			if (file_exists($filePath)) {
				unlink($filePath);
			}
		}

		/* ===== Delete BOTH Ledger Rows ===== */
		$deleteStmt = $db->prepare("
            DELETE FROM account_transactions
            WHERE voucher_no = :voucher_no
        ");
		$deleteStmt->execute([
			':voucher_no' => $txn['voucher_no']
		]);

		$db->commit();
		// $_SESSION['deletemsg'] = "Deposit deleted successfully.";
		$_SESSION['toast'] = [
			'type' => 'success',
			'message' =>  'Deposit deleted successfully.'
		];
	} else {
		$db->rollBack();
	}

	header("Location: bank-deposits.php");
	exit;
}
require_once 'dbconfig.php';

// header('Content-Type: application/json');

/* ================= SESSION VALIDATION ================= */
if (empty($_SESSION['user_id']) || empty($_SESSION['business_id'])) {
	echo json_encode(["error" => "Session expired"]);
	exit;
}

$business_id = (int) $_SESSION['business_id'];

/* ================= COLUMN MAPPING ================= */
$columns = [
	0 => 'account_transactions.id',
	1 => 'account_transactions.txn_date',
	2 => 'user_master.bank_name',
	3 => 'user_master.account_no',
	4 => 'account_transactions.description',
	5 => 'account_transactions.dr_amount',
	5 => 'account_transactions.voucher_no',
	6 => 'user_master.id'
];

/* ================= BASE QUERY ================= */
$baseQuery = "
    FROM account_transactions
    LEFT JOIN user_master
        ON account_transactions.to_account_id = user_master.id
    WHERE account_transactions.business_id = :business_id
      AND account_transactions.txn_type = 'deposit'
      AND account_transactions.dr_amount > 0
";

$params = [':business_id' => $business_id];

/* ================= TOTAL RECORDS ================= */
$totalStmt = $db->prepare("SELECT COUNT(*) $baseQuery");
$totalStmt->execute($params);
$recordsTotal = (int) $totalStmt->fetchColumn();

/* ================= SEARCH ================= */
if (!empty($_POST["search"]["value"])) {

	$baseQuery .= "
        AND (
            user_master.bank_name LIKE :search
            OR user_master.account_no LIKE :search
            OR account_transactions.description LIKE :search
        )
    ";

	$params[':search'] = '%' . trim($_POST["search"]["value"]) . '%';
}

/* ================= FILTERED COUNT ================= */
$filteredStmt = $db->prepare("SELECT COUNT(*) $baseQuery");
$filteredStmt->execute($params);
$recordsFiltered = (int) $filteredStmt->fetchColumn();

/* ================= ORDER ================= */
$orderColumnIndex = $_POST['order'][0]['column'] ?? 0;
$orderDir = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';

$orderColumn = $columns[$orderColumnIndex] ?? 'account_transactions.id';

/* ================= PAGINATION ================= */
$limit = "";
if (isset($_POST["length"]) && $_POST["length"] != -1) {
	$limit = " LIMIT :start, :length ";
}

/* ================= FINAL QUERY ================= */
$query = "
    SELECT
        account_transactions.id,
        account_transactions.voucher_no,
        account_transactions.txn_date,
        account_transactions.description,
        account_transactions.dr_amount,
        user_master.bank_name,
        user_master.account_no,
		user_master.id AS user_id
    $baseQuery
    ORDER BY $orderColumn $orderDir
    $limit
";

$stmt = $db->prepare($query);

foreach ($params as $key => $value) {
	$stmt->bindValue($key, $value);
}

if ($limit) {
	$stmt->bindValue(':start', (int)($_POST['start'] ?? 0), PDO::PARAM_INT);
	$stmt->bindValue(':length', (int)$_POST['length'], PDO::PARAM_INT);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ================= FORMAT OUTPUT ================= */
$data = [];
$sr = (int)($_POST['start'] ?? 0) + 1;

foreach ($result as $row) {

	$dateObj = DateTime::createFromFormat("Y-m-d", $row["txn_date"]);
	$formattedDate = $dateObj ? $dateObj->format('d/m/Y') : '';

	$voucherNo  = htmlspecialchars($row['voucher_no'] ?? '');
	$bankName   = htmlspecialchars($row['bank_name'] ?? '-');
	$desc       = htmlspecialchars($row['description'] ?? '');
	$voucherURL = 'voucher_details?voucher_type=deposit&voucher=' . urlencode($row['voucher_no']);

	$amount = number_format((float)($row["dr_amount"] ?? 0), 2);

	 $ledgerLink = 'ledger_details?ledgerId=' . urlencode($row['user_id']);

	$data[] = [
		$sr++,
		$formattedDate,

		'<a href="' . $ledgerLink . '">' . $bankName . '</a>',

		'<a href="' . $voucherURL . '">' . $voucherNo . '</a>',

		'<a href="' . $voucherURL . '">' . $desc . '</a>',

		'<span class="amount"><i class="fa fa-rupee"></i> ' . $amount . '</span>',

		'
        <a class="btn btn-sm btn-primary text-white edit_btn"
           data-toggle="modal"
           data-target="#editModal"
           data-voucher_no="' . $voucherNo . '">
           <i class="fa fa-pencil"></i>
        </a>

        <a class="btn btn-sm btn-danger delete-btn text-white"
           data-id="' . (int)$row['id'] . '">
           <i class="fa fa-trash"></i>
        </a>
        '
	];
}

/* ================= RETURN JSON ================= */
echo json_encode([
	"draw" => intval($_POST["draw"] ?? 1),
	"recordsTotal" => $recordsTotal,
	"recordsFiltered" => $recordsFiltered,
	"data" => $data
]);

?>