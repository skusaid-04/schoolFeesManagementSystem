<?php
session_start();
require_once '../php/config.php'; // Ensure you have the correct path to your database connection file
header('Content-Type: application/json');
file_put_contents('debug.txt', 'Reached delete_user.php');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'No user ID provided.']);
    exit();
}

$userData = $conn->query("SELECT username, role FROM login_admins WHERE id = '$id'")->fetch_assoc();
$adminCount = $conn->query("SELECT COUNT(*) as count FROM login_admins WHERE role = 'admin'")->fetch_assoc()['count'];

//print admin count
if ($adminCount === null) {
    echo json_encode(['success' => false, 'message' => 'Error fetching admin count.']);
    exit();
}

// Prevent deleting the last admin user
if ($userData['role'] === 'Admin' && $adminCount <= 1) {
    echo json_encode(['success' => false, 'message' => 'Cannot delete the last admin user.']);
    exit();
}

// Prevent an admin from deleting himself
if ($userData['username'] === $_SESSION['username']) {
    echo json_encode(['success' => false, 'message' => 'You cannot delete your own account.']);
    exit();
}

// Actually delete the user
$deleted = $conn->query("DELETE FROM login_admins WHERE id = '$id'");
if ($userData['role'] === 'Admin' && $deleted) {
    $adminCount--;
}
echo json_encode(['success' => $deleted ? true : false, 'message' => $deleted ? 'User deleted successfully.' : 'Error deleting user at database.', 'adminCount' => $adminCount]);
exit();
