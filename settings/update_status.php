<?php
session_start();
require_once '../php/config.php'; // Ensure you have the correct path to your database connection file
// count total admins
header('Content-Type: application/json');
// file_put_contents('debug_update.txt', 'Reached update_status.php');

$data = json_decode(file_get_contents("php://input"), true);
$id = intval($data['id']?? null);


if (!$id) {
    echo json_encode(['success' => false, 'message' => 'No user ID provided.']);
    exit();
}

$userData = $conn->query("SELECT username, role, status FROM login_admins WHERE id = '$id'")->fetch_assoc();
$adminCount = $conn->query("SELECT COUNT(*) as count FROM login_admins WHERE role = 'Admin' AND status = 'active'")->fetch_assoc()['count'];
$status = $userData['status'];
$newStatus = ($status === 'active') ? 'deactive' : 'active';
//print admin count
if ($adminCount === null) {
    echo json_encode(['success' => false, 'message' => 'Error fetching admin count.']);
    exit();
}

// Prevent an admin from deactivating himself
if ($userData['username'] === $_SESSION['username'] && $status === 'active'&& $newStatus === 'deactive') {
    echo json_encode(['success' => false, 'message' => 'You cannot deactivate your own account.']);
    exit();
}

// Prevent deactivating the last admin user
if ($userData['role'] === 'Admin' && $adminCount <= 1 && $userData['status'] === 'active' && $newStatus === 'deactive') {
    echo json_encode(['success' => false, 'message' => 'Cannot deactivate the last admin user.']);
    exit();
}

// echo "<script>console.log('User ID: $id, Status: $newStatus');</script>";

// Actually deactivate the user
$deactivated = $conn->query("UPDATE login_admins SET status = '$newStatus' WHERE id = '$id'");
if ($newStatus === 'active') {
    echo json_encode(['success' => true, 'message' => 'User activated successfully.', 'new_status' => $newStatus]);
} else {
    echo json_encode(['success' => true, 'message' => 'User deactivated successfully.', 'new_status' => $newStatus]);
}
// echo "<script>console.log('AJAX response: " . json_encode(['success' => $deactivated ? true : false, 'message' => $deactivated ? '' : 'Error deactivating user at database.']) . "');</script>";
exit();

