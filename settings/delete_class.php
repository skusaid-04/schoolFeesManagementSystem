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
$class = $conn->query("SELECT * FROM classes WHERE id = '$id'")->fetch_assoc();
$countDivision = $conn->query("SELECT COUNT(*) as countDivisions FROM divisions WHERE class_name = '$class[class_name]'")->fetch_assoc()['countDivisions'];

if ($countDivision > 0) {
    echo json_encode(['success' => false, 'message' => 'Cannot delete '.$class['class_name'].' with divisions.', 'class' => $class, 'countDivision' => $countDivision]);
    exit();
}

if ($class){
    $conn->query("DELETE FROM classes WHERE id = '$id'");
    echo json_encode(['success' => true, 'message' => $class['class_name'] . ' deleted successfully.', 'class' => $class, 'countDivision' => $countDivision]);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Class not found.']);
    exit();
}