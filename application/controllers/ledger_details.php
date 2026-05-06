<?php
include_once('header.inc.php');

// ================= BASIC =================
$userId = isset($_GET['ledgerId']) ? (int)$_GET['ledgerId'] : 0;
$business_id = $_SESSION['business_id'] ?? 0;

if ($userId <= 0) {
	echo "<p style='color:red;'>Invalid Ledger ID</p>";
	exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ================= DATE FORMAT FUNCTION =================
function formatDate($date) {
	if (empty($date)) return '';

	// If already Y-m-d
	if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
		return $date;
	}

	// Try d/m/Y
	$d = DateTime::createFromFormat('d/m/Y', $date);
	if ($d) return $d->format('Y-m-d');

	// Fallback
	$ts = strtotime($date);
	return $ts ? date('Y-m-d', $ts) : '';
}

// ================= FILTERS =================
$fromDate = formatDate($_GET['from_date'] ?? date('d/m/Y', strtotime('-1 month')));
$toDate   = formatDate($_GET['to_date'] ?? date('d/m/Y'));
$search   = trim($_GET['search'] ?? '');

// ================= GET USER =================
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
$sql = "
SELECT id, txn_date, voucher_no, description,
       dr_amount, cr_amount,
       from_account_id, to_account_id
FROM account_transactions
WHERE (from_account_id = :uid OR to_account_id = :uid)
AND business_id = :bid
";

$params = [
	':uid' => $userId,
	':bid' => $business_id
];

// Date filters (optimized)
if (!empty($fromDate)) {
	$sql .= " AND txn_date >= :from";
	$params[':from'] = $fromDate;
}

if (!empty($toDate)) {
	$sql .= " AND txn_date <= :to";
	$params[':to'] = $toDate;
}

// Search filter
if (!empty($search)) {
	$sql .= " AND (voucher_no LIKE :s OR description LIKE :s)";
	$params[':s'] = "%$search%";
}

$sql .= " ORDER BY txn_date ASC, id ASC";

// Execute
$stmt = $db->prepare($sql);
$stmt->execute($params);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ❌ No data
if (empty($transactions)) {
	echo "<p>No transactions found</p>";
	exit;
}

// ================= SUMMARY =================
$totalDebit = 0;
$totalCredit = 0;

foreach ($transactions as $t) {
	if ((int)$t['to_account_id'] === $userId) {
		$totalDebit += (float)$t['dr_amount'];
	}
	if ((int)$t['from_account_id'] === $userId) {
		$totalCredit += (float)$t['cr_amount'];
	}
}
?>

<main class="app-content">

    <div class="app-title">
        <h3>Ledger: <?= $ledgerName ?></h3>
    </div>

    <section class="invoice" id="voucherContent">
        <div class="row invoice-info">
            <div class="col-md-12 col-sm-12 col-lg-12">

                <div class="tile">
                    <div class="tile-body">

                        <!-- ✅ FILTER -->
                        <form method="GET" class="mb-3" autocomplete="off">
                            <input type="hidden" name="ledgerId" value="<?= $userId ?>">

                            <div class="row g-2 align-items-end">

                                <!-- From Date -->
                                <div class="col-md-3 col-6">
                                    <label class="form-label small">From Date</label>
                                    <input type="text" name="from_date" class="form-control date"
                                        value="<?= date('d/m/Y', strtotime('-1 month')); ?>" placeholder="Start date">
                                </div>

                                <!-- To Date -->
                                <div class="col-md-3 col-6">
                                    <label class="form-label small">To Date</label>
                                    <input type="text" name="to_date" class="form-control date"
                                        value="<?= date('d/m/Y'); ?>" placeholder="End date">
                                </div>

                                <!-- Search -->
                                <div class="col-md-3 col-6">
                                    <label class="form-label small">Search</label>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Voucher / Description" value="<?= htmlspecialchars($search) ?>">
                                </div>

                                <!-- Buttons -->
                                <div class="col-md-3 col-6">
                                    <div class="d-flex gap-2">

                                        <button class="btn btn-info btn-sm flex-fill mr-2">
                                            <i class="fa fa-filter"></i> Filter
                                        </button>

                                        <a href="?ledgerId=<?= $userId ?>" class="btn btn-sm btn-secondary flex-fill">
                                            <i class="fa fa-refresh"></i> Reset
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </form>

                        <!-- ✅ SUMMARY CARDS -->
                        <div class="row text-center mb-3">

                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-2">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6>Debit</h6>
                                        <h5 class="text-danger">₹<?= number_format($totalDebit, 2) ?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-2">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6>Credit</h6>
                                        <h5 class="text-success">₹<?= number_format($totalCredit, 2) ?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 mb-2">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6>Balance</h6>
                                        <h5
                                            class="<?= ($totalCredit - $totalDebit) >= 0 ? 'text-success' : 'text-danger' ?>">
                                            ₹<?= number_format($totalCredit - $totalDebit, 2) ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- ✅ TABLE -->
                        <div class="table-responsive">
                            <table class="table table-bordered modern-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th class="text-end">Dr</th>
                                        <th class="text-end">Cr</th>
                                        <th class="text-end">Bal</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php

									$openingBalance = 0; // 🔥 you can fetch from DB later
									$balance = $openingBalance;

									// ✅ Opening Balance Row
									echo "
<tr style='background:#f8f9fa;font-weight:bold;'>
    <td colspan='4'>Opening Balance</td>
    <td class='text-end'>" . number_format($balance, 2) . "</td>
</tr>
";

									// ✅ Loop Transactions
									foreach ($transactions as $txn) {

										$date = !empty($txn['txn_date'])
											? date('d/m/Y', strtotime($txn['txn_date']))
											: '';

										$dr = (float)($txn['dr_amount'] ?? 0);
										$cr = (float)($txn['cr_amount'] ?? 0);

										$debit = '';
										$credit = '';

										// Debit
										if ((int)$txn['to_account_id'] == $userId) {
											$debit = number_format($dr, 2);
											$balance -= $dr;
										}

										// Credit
										if ((int)$txn['from_account_id'] == $userId) {
											$credit = number_format($cr, 2);
											$balance += $cr;
										}

										// Balance with Dr/Cr
										$balDisplay = number_format(abs($balance), 2) . ($balance >= 0 ? ' Cr' : ' Dr');

										echo "
    <tr>
        <td data-label='Date'>$date</td>

        <td data-label='Details'>
            <strong>{$txn['voucher_no']}</strong><br>
            <small>{$txn['description']}</small>
        </td>

        <td data-label='Debit' class='text-end text-danger'>$debit</td>
        <td data-label='Credit' class='text-end text-success'>$credit</td>
        <td data-label='Balance' class='text-end'><b>{$balDisplay}</b></td>
    </tr>
    ";
									}

									// ✅ Closing Balance Row
									$closingDisplay = number_format(abs($balance), 2) . ($balance >= 0 ? ' Cr' : ' Dr');
									echo "<tr style='background:#e9ecef;font-weight:bold;'>
    <td colspan='4' class='text-right'>
        <a href='export_ledger_excel.php?ledgerId=" . $userId . "' class='btn btn-success btn-sm'><i class='fa fa-file-excel-o' aria-hidden='true'></i> Download Excel</a>
        <a href='export_ledger_pdf.php?ledgerId=" . $userId . "' class='btn btn-danger btn-sm'> <i class='fa fa-file-pdf-o' aria-hidden='true'></i> Download Pdf</a>
        Closing Balance
    </td>
    <td class='text-end'>{$closingDisplay}</td>
</tr>";

									?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>
<style>
.modern-table td {
    vertical-align: middle;
}

/* MOBILE RESPONSIVE LEDGER */
@media (max-width: 768px) {

    .modern-table thead {
        display: none;
    }

    .modern-table tr {
        display: block;
        margin-bottom: 10px;
        background: #fff;
        padding: 12px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .modern-table td {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 14px;
    }

    .modern-table td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #555;
    }
}
</style>

<?php include_once('footer.inc.php'); ?>