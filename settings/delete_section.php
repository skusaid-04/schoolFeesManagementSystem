<?php
session_start();
require_once '../php/config.php'; // Include database connection
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
// echo $id;
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'User ID provided.', 'id' => $id]);
    exit();
}
$section = $conn->query("SELECT * FROM sections WHERE id = '$id'")->fetch_assoc();
$classCount = $conn->query("SELECT COUNT(*) AS class_count FROM classes WHERE section_name = '$section[section_name]'")->fetch_assoc()['class_count'];

if ($classCount > 0) {
    echo json_encode(['success' => false, 'message' => 'Cannot delete section with classes.']);
    exit();
}

if ($section) {
    // $section = $section->fetch_assoc();
    // $conn->query("DELETE FROM sections WHERE id = '$id'");
    echo json_encode(['success' => true, 'message' => 'User deleted successfully.', 'id' => $id, 'section'=>$section, 'classcount'=>$classCount]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}