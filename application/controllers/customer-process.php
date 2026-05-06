<?php
require_once('dbconfig.php');
require_once 'class/CustomerService.php';

$service = new CustomerService($db);

/* =========================
   HANDLE AJAX ACTIONS
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

	try {

		// Basic validation
		if (empty($_POST['role'])) {
			throw new Exception('Role is required.');
		}

		$role = (int) $_POST['role'];

		// Clean role mapping
		$roles = [
			2 => 'Staff',
			4 => 'Customer',
			5 => 'Vendor'
		];

		if (!isset($roles[$role])) {
			throw new Exception('Invalid role selected.');
		}

		$role_name = $roles[$role];

		// Sanitize input
		$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

		if ($_POST['action'] === 'insert') {

			$service->create($data);

			$_SESSION['toast'] = [
				'type' => 'success',
				'message' => "$role_name saved successfully"
			];

			if ($role == 2) {
				$redirect = 'staff';
			} elseif ($role == 4) {
				$redirect = 'customer';
			} elseif ($role == 5) {
				$redirect = 'vendor';
			} else {
				$redirect = 'dashboard'; // fallback
			}

			header("Location: $redirect");
			exit;
		}

		if ($_POST['action'] === 'edit') {

			if (empty($_POST['customer_id'])) {
				throw new Exception('Invalid ID.');
			}

			$id = (int) $_POST['customer_id'];

			$service->update($id, $data);

			$_SESSION['toast'] = [
				'type' => 'success',
				'message' => "$role_name updated successfully"
			];
		}
	} catch (Exception $e) {

		$_SESSION['toast'] = [
			'type' => 'error',
			'message' => $e->getMessage()
		];
	}

	if ($role == 2) {
		$redirect = 'staff';
	} elseif ($role == 4) {
		$redirect = 'customer';
	} elseif ($role == 5) {
		$redirect = 'vendor';
	} else {
		$redirect = 'dashboard'; // fallback
	}

	header("Location: $redirect");
	exit;
}
if (isset($_GET['delete_id'], $_GET['role_id'])) {

	try {

		$deleteId = (int) $_GET['delete_id'];
		$roleId   = (int) $_GET['role_id'];

		$service->delete($deleteId, $roleId);

		$_SESSION['toast'] = ['type' => 'success', 'message' => 'User deleted successfully'];
	} catch (Exception $e) {

		$_SESSION['toast'] = [
			'type' => 'error',
			'message' => $e->getMessage()
		];
	}
	if ($roleId == 2) {
		$redirect = 'staff';
	} elseif ($roleId == 4) {
		$redirect = 'customer';
	} elseif ($roleId == 5) {
		$redirect = 'vendor';
	} else {
		$redirect = 'dashboard'; // fallback
	}

	header("Location: $redirect");
	exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['draw']) && isset($_POST['role'])) {

	/* =========================
   HELPER FUNCTION
  ========================= */
	$role = $_POST['role'];
	function get_total_all_records($db, $businessId, $role) {
		$stmt = $db->prepare("
        SELECT COUNT(*)
        FROM user_master
        INNER JOIN user_role_allot
            ON user_master.id = user_role_allot.user_id
        WHERE user_role_allot.business_id = :business_id
        AND user_role_allot.role_id = :role
    ");

		$stmt->execute([
			':business_id' => $businessId,
			':role'     => $role,
		]);

		return $stmt->fetchColumn();
	}
	/* =========================
   DATATABLE FETCH
========================= */

	$businessId = (int)$_SESSION['business_id'];

	$query = "
    SELECT user_master.*,
           user_role_allot.business_id,
           user_role_allot.role_id,
           user_role_allot.status
    FROM user_master
    LEFT JOIN user_role_allot
        ON user_master.id = user_role_allot.user_id
    WHERE user_role_allot.business_id = :business_id
	AND user_role_allot.role_id = :role
";

	$params = [':business_id' => $businessId, ':role' => $role];

	/* ===== SEARCH ===== */
	$search = $_POST["search"]["value"] ?? '';

	if (!empty($search)) {

		$query .= " AND (
        user_master.first_name LIKE :search OR
        user_master.last_name  LIKE :search OR
        user_master.email      LIKE :search OR
        user_master.mobile_no  LIKE :search OR
        user_master.gst_number LIKE :search
    )";

		$params[':search'] = "%$search%";
	}

	/* ===== ORDERING ===== */
	$columns = [
		1 => "user_master.first_name",
		3 => "user_master.email",
		4 => "user_master.mobile_no",
		5 => "user_master.gst_number"
	];

	if (!empty($_POST["order"])) {

		$colIndex = (int)$_POST['order'][0]['column'];
		$dir = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

		if (isset($columns[$colIndex])) {
			$query .= " ORDER BY {$columns[$colIndex]} $dir";
		}
	} else {
		$query .= " ORDER BY user_master.id DESC";
	}

	/* ===== PAGINATION ===== */
	$start  = isset($_POST['start'])  ? (int)$_POST['start']  : 0;
	$length = isset($_POST['length']) ? (int)$_POST['length'] : 10;

	if ($length != -1) {
		$query .= " LIMIT :start, :length";
		$params[':start']  = $start;
		$params[':length'] = $length;
	}

	/* ===== EXECUTE ===== */
	$stmt = $db->prepare($query);

	foreach ($params as $key => $val) {
		$stmt->bindValue(
			$key,
			$val,
			is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR
		);
	}

	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	/* =========================
   FILTERED COUNT
========================= */
	$countQuery = "
    SELECT COUNT(*)
    FROM user_master
    LEFT JOIN user_role_allot
        ON user_master.id = user_role_allot.user_id
    WHERE user_role_allot.business_id = :business_id
	AND user_role_allot.role_id =:role
";

	$countParams = [':business_id' => $businessId, ':role' => $role,];

	if (!empty($search)) {
		$countQuery .= " AND (
        user_master.first_name LIKE :search OR
        user_master.last_name  LIKE :search OR
        user_master.email      LIKE :search OR
        user_master.mobile_no  LIKE :search OR
        user_master.gst_number LIKE :search
    )";

		$countParams[':search'] = "%$search%";
	}

	$countStmt = $db->prepare($countQuery);

	foreach ($countParams as $key => $val) {
		$countStmt->bindValue(
			$key,
			$val,
			is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR
		);
	}

	$countStmt->execute();
	$recordsFiltered = $countStmt->fetchColumn();

	/* =========================
   FORMAT DATA
========================= */
	$data = [];
	$sr = $start + 1;

	$roleMap = [
		1 => 'Admin',
		2 => 'Staff',
		4 => 'Customer',
		5 => 'Vendor'
	];

	foreach ($result as $row) {

		$roleId = (int)$row['role_id'];
		$roleLabel = $roleMap[$roleId] ?? 'Unknown';
	    $ledgerLink = 'ledger_details?ledgerId=' . urlencode($row['id']);

		$statusLabel = $row['status'] == 1
			? '<span class="badge badge-success">Active</span>'
			: '<span class="badge badge-danger">Inactive</span>';

		$data[] = [
			$sr++,
			 '<a href="' . $ledgerLink . '" title="View Ledger Details">'.htmlspecialchars($row["first_name"] . ' ' . $row["last_name"]).'</a>',
			'<a href="' . $ledgerLink . '" title="View Ledger Details">'.htmlspecialchars($row["company_name"]).'</a>',
			'<a href="' . $ledgerLink . '" title="View Ledger Details">'.htmlspecialchars($row["email"]).'</a>',
			'<a href="' . $ledgerLink . '" title="View Ledger Details">'.($row["mobile_no"]).'</a>',
			($row["gst_number"]),
			'',
			'<span class="fw-bold">' . $roleLabel . '</span>',
			$statusLabel,
			'
        <a class="btn btn-sm btn-primary"
           href="edit-customer?id=' . (int)$row["id"] . '&role_id=' . $row['role_id'] . '&role=' . $roleLabel . '">
           <i class="fa fa-pencil"></i>
        </a>
        <button type="button"
                class="btn btn-sm btn-danger delete-btn"
                data-id="' . (int)$row['id'] . '"
                data-role_id="' . $roleId . '">
            <i class="fa fa-trash"></i>
        </button>'
		];
	}

	/* =========================
   RETURN JSON
     ========================= */
	echo json_encode([
		"draw"            => intval($_POST["draw"] ?? 0),
		"recordsTotal"    => get_total_all_records($db, $businessId, $role),
		"recordsFiltered" => $recordsFiltered,
		"data"            => $data
	]);
}