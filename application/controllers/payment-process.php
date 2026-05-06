<?php

session_start();
require_once('dbconfig.php');

if (isset($_POST['action']) && $_POST['action'] === "insert") {

    if (!isset($_POST['submit'])) {
        header("Location: payment.php");
        exit;
    }

    try {

        /* ================= USER ROLE ================= */

        if (!$_SESSION['user_id']) {
            throw new Exception("Invalid session.");
        }


        /* ================= VALIDATION ================= */

        $amount = (float) ($_POST['amount'] ?? 0);
        if ($amount <= 0) {
            throw new Exception("Invalid amount.");
        }

        $from_account_id = (int) ($_POST['from_account_id'] ?? 0);
        $to_account_id   = (int) ($_POST['to_account_id'] ?? 0);

        if (!$from_account_id || !$to_account_id) {
            throw new Exception("Invalid account selection.");
        }

        if ($from_account_id === $to_account_id) {
            throw new Exception("Pay From and Pay To cannot be the same.");
        }

        /* ================= DATE ================= */

        $dateObj = DateTime::createFromFormat("d/m/Y", $_POST['date']);

        if (!$dateObj) {
            throw new Exception("Invalid date format.");
        }

        $txn_date = $dateObj->format('Y-m-d');

        /* ================= OTHER INPUTS ================= */

        $description    = trim($_POST['description'] ?? '');
        $category       = $_POST['category_id'] ?? null;
        $payment_method = $_POST['payment_method'] ?? null;
        $reference      = trim($_POST['reference'] ?? '');

        $business_id = $_SESSION['business_id'];

        /* ================= FILE UPLOAD ================= */

        $final_file = null;

        if (!empty($_FILES['file']['name'])) {

            $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                throw new Exception("Invalid file type.");
            }

            if ($_FILES['file']['size'] > 2 * 1024 * 1024) {
                throw new Exception("File size exceeds 2MB.");
            }

            $upload_dir = __DIR__ . "/upload/file/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $final_file = uniqid('pay_', true) . "." . $ext;

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $final_file)) {
                throw new Exception("File upload failed.");
            }
        }

        /* ================= TRANSACTION START ================= */

        $db->beginTransaction();

        $voucher_no = "PAY-" . date('Ymd') . "-" . mt_rand(1000, 9999);

        // We assume:
        // from_account_id   = bank / cash account (money going OUT from here)
        // to_account_id     = expense / supplier / party (money going TO here)

        $insert = $db->prepare("
    INSERT INTO account_transactions
    (
        business_id, voucher_no, txn_type, from_account_id, to_account_id,
        txn_date, description, dr_amount, cr_amount, category,
        payment_method, reference, attachment, created_at
    )
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");

        /* Row 1 : Debit Expense / Supplier */
        $insert->execute([
            $business_id,
            $voucher_no,
            'payment',
            0,                     // from
            $to_account_id,        // expense / supplier
            $txn_date,
            $description,
            $amount,               // DR
            0,
            $category,
            $payment_method,
            $reference,
            $final_file
        ]);

        /* Row 2 : Credit Bank / Cash */
        $insert->execute([
            $business_id,
            $voucher_no,
            'payment',
            $from_account_id,      // bank / cash
            0,
            $txn_date,
            $description,
            0,
            $amount,               // CR
            $category,
            $payment_method,
            $reference,
            $final_file
        ]);
        $db->commit();


        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Payment added successfully.'
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

    header("Location: payment");
    exit;
} elseif (isset($_POST['action']) && $_POST['action'] == "update") {

    if (isset($_POST['submit'])) {

        try {

            /* =========================
           START TRANSACTION
        ========================== */
            $db->beginTransaction();

            /* =========================
           SANITIZE INPUTS
        ========================== */
            $business_id = $_SESSION['business_id'];
            // $expense_id      = isset($_POST['to_account_id']) ? (int)$_POST['to_account_id'] : 0;
            $voucher_no      = trim($_POST['voucher_no']);
            $description     = trim($_POST['description']);
            $reference       = trim($_POST['reference']);

            $amount          = (float)$_POST['amount'];
            $category        = (int)$_POST['category'];
            $payment_method  = (int)$_POST['payment_method'];

            $bank_account_id = (int)($_POST['from_account_id'] ?? 0);
            $pay_to = (int)($_POST['to_account_id'] ?? 0);

            if ($amount <= 0) {
                throw new Exception("Invalid amount");
            }

            if (!$bank_account_id) {
                throw new Exception("Account selection required");
            }

            /* =========================
           DATE FORMAT
        ========================== */
            $txn_date = null;

            if (!empty($_POST['date'])) {
                $date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
                if (!$date) {
                    throw new Exception("Invalid date format");
                }
                $txn_date = $date->format('Y-m-d');
            }

            /* =========================
           DELETE OLD ENTRY
        ========================== */
            $delete = $db->prepare("
            DELETE FROM account_transactions
            WHERE voucher_no = ? AND business_id = ?
        ");
            $delete->execute([$voucher_no, $business_id]);

            /* =========================
           FILE UPLOAD
        ========================== */
            $final_file = null;

            if (!empty($_FILES['file']['name'])) {

                $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
                $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

                if (!in_array($ext, $allowed)) {
                    throw new Exception("Invalid file type");
                }

                $final_file = uniqid('exp_', true) . '.' . $ext;

                $upload_dir = __DIR__ . "/upload/file/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $final_file)) {
                    throw new Exception("File upload failed");
                }
            }

            /* =========================
           PREPARE INSERT
        ========================== */
            $insert = $db->prepare("
            INSERT INTO account_transactions (
                business_id,
                voucher_no,
                from_account_id,
                to_account_id,
                txn_date,
                description,
                dr_amount,
                cr_amount,
                category,
                payment_method,
                reference,
                attachment,
                txn_type,
                created_at
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,'payment',NOW())
        ");

            /* =========================
           ROW 1 → DEBIT EXPENSE
        ========================== */
            $insert->execute([
                $business_id,
                $voucher_no,
                0,
                $pay_to,
                $txn_date,
                $description,
                $amount,
                0,
                $category,
                $payment_method,
                $reference,
                $final_file
            ]);

            /* =========================
           ROW 2 → CREDIT BANK
        ========================== */
            $insert->execute([
                $business_id,
                $voucher_no,
                $bank_account_id,
                0,
                $txn_date,
                $description,
                0,
                $amount,
                $category,
                $payment_method,
                $reference,
                $final_file
            ]);

            /* =========================
           COMMIT
        ========================== */
            $db->commit();

            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Payment details  updated successfully!'
            ];

            header("Location: payment");
            exit;
        } catch (Exception $e) {

            if ($db->inTransaction()) {
                $db->rollBack();
            }

            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => $e->getMessage()
            ];

            header("Location: payment");
            exit;
        }
    }
} elseif (isset($_GET['delete_id']) && isset($_GET['action'])) {

    $id = (int) $_GET['delete_id'];

    $db->beginTransaction();

    /* ===== Get Voucher & Attachment ===== */
    $stmt = $db->prepare("
        SELECT voucher_no, attachment
        FROM account_transactions
        WHERE id = :id AND txn_type='payment'
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

    header("Location:payment");
    exit;
} else {

    require_once 'dbconfig.php';
    // session_start();

    header('Content-Type: application/json');

    /* ================= SESSION VALIDATION ================= */

    if (empty($_SESSION['user_id']) || empty($_SESSION['business_id'])) {
        echo json_encode(["error" => "Session expired"]);
        exit;
    }

    $business_id = (int) $_SESSION['business_id'];

    /* ================= DATATABLE REQUEST ================= */

    $start  = isset($_POST['start']) ? (int) $_POST['start'] : 0;
    $length = isset($_POST['length']) ? (int) $_POST['length'] : 50;
    $draw   = isset($_POST['draw']) ? (int) $_POST['draw'] : 1;

    $searchValue = trim($_POST['search']['value'] ?? '');

    /* ================= COLUMN MAPPING ================= */

    $columns = [
        0 => 'account_transactions.id',
        1 => 'account_transactions.txn_date',
        2 => 'account_transactions.voucher_no',
        3 => 'payee.first_name',
        4 => 'account_transactions.description',
        5 => 'account_transactions.dr_amount',
        6 => 'payee.id'
    ];

    /* ================= BASE QUERY ================= */

    $baseQuery = "
FROM account_transactions
LEFT JOIN user_master AS bank
    ON account_transactions.from_account_id = bank.id
LEFT JOIN user_master AS payee
    ON account_transactions.to_account_id = payee.id
WHERE account_transactions.business_id = :business_id
AND account_transactions.txn_type = 'payment'
AND account_transactions.dr_amount > 0
";

    $params = [':business_id' => $business_id];

    /* ================= SEARCH ================= */

    if (!empty($searchValue)) {

        $baseQuery .= "
    AND (
        payee.first_name LIKE :search
        OR payee.last_name LIKE :search
        OR bank.bank_name LIKE :search
        OR account_transactions.voucher_no LIKE :search
        OR account_transactions.description LIKE :search
    )";

        $params[':search'] = "%{$searchValue}%";
    }

    /* ================= FILTERED COUNT ================= */

    $totalStmt = $db->prepare("SELECT COUNT(*) $baseQuery");
    $totalStmt->execute($params);
    $recordsFiltered = (int) $totalStmt->fetchColumn();

    /* ================= TOTAL COUNT ================= */

    $totalStmt2 = $db->prepare("
    SELECT COUNT(*)
    FROM account_transactions
    WHERE business_id = :business_id
    AND txn_type = 'payment'
    AND dr_amount > 0
");

    $totalStmt2->execute([':business_id' => $business_id]);
    $recordsTotal = (int) $totalStmt2->fetchColumn();

    /* ================= ORDER ================= */

    $orderColumnIndex = $_POST['order'][0]['column'] ?? 1;
    $orderDir = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';

    $orderColumn = $columns[$orderColumnIndex] ?? 'account_transactions.txn_date';

    /* ================= FINAL QUERY ================= */

    $query = "
SELECT
    account_transactions.id,
    account_transactions.voucher_no,
    account_transactions.txn_date,
    account_transactions.description,
    account_transactions.dr_amount,
    payee.first_name,
    payee.last_name,
    payee.id,
    bank.bank_name
$baseQuery
ORDER BY $orderColumn $orderDir
LIMIT :start, :length
";

    $stmt = $db->prepare($query);

    /* ================= BIND VALUES ================= */

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':length', $length, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* ================= FORMAT OUTPUT ================= */

    $data = [];
    $sr = $start + 1;

    foreach ($result as $row) {

        $date = !empty($row['txn_date'])
            ? date('d/m/Y', strtotime($row['txn_date']))
            : '';

        $voucherNo = htmlspecialchars($row['voucher_no'] ?? '');
        $description = htmlspecialchars($row['description'] ?? '');

        $payeeName = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
        $payeeName = htmlspecialchars($payeeName ?: '—');

        $voucherLink = 'voucher_details?voucher=' . urlencode($row['voucher_no']);
        $ledgerLink = 'ledger_details?ledgerId=' . urlencode($row['id']);

        $amount = number_format((float)($row['dr_amount'] ?? 0), 2);

        $data[] = [
            $sr++,
            $date,

            '<a href="' . $ledgerLink . '" title="View Ledger Details">' . $payeeName . '</a>',

            '<a href="' . $voucherLink . '" title="View Voucher Details">' . $voucherNo . '</a>',

            '<a href="' . $voucherLink . '" title="View Voucher Details">' . $description . '</a>',

            '<span class="amount"><i class="fa fa-rupee"></i> ' . $amount . '</span>',

            '
        <a class="btn btn-sm btn-primary text-white edit_payment"
           data-toggle="modal"
           data-target="#editModal"
           data-voucher_no="' . htmlspecialchars($row['voucher_no']) . '">
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
        "draw" => $draw,
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    ]);
}