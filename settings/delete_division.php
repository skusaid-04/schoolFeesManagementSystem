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

$division = $conn->query("SELECT * FROM divisions WHERE id = '$id'")->fetch_assoc();
$numberOfDivisions = $conn->query("SELECT COUNT(*) as countDivisions FROM divisions WHERE class_name = '$division[class_name]'")->fetch_assoc()['countDivisions'];
$studentCount = $conn->query("SELECT COUNT(*) as countStudents FROM students WHERE class = '$division[class_name]' AND division = '$division[division_name]'")->fetch_assoc()['countStudents'];

if ($studentCount > 0) {
    echo json_encode(['success' => false, 'message' => 'Cannot delete division with students.']);
    exit();
}

// if($numberOfDivisions > 0){
//     $conn->query("DELETE FROM divisions WHERE id = '$id'");
//     echo json_encode(['success' => true, 'message' => 'Division deleted successfully.', 'division' => $division, 'studentCount' => $studentCount, 'numberOfDivisions' => $numberOfDivisions]);
//     exit();
// } else {
//     echo json_encode(['success' => false, 'message' => 'Cannot delete last division.']);
//     exit();
// }

if ($division) {
    $conn->query("DELETE FROM divisions WHERE id = '$id'");
    echo json_encode(['success' => true, 'message' => 'Division deleted successfully.', 'division' => $division, 'studentCount' => $studentCount, 'numberOfDivisions' => $numberOfDivisions]);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Division not found.']);
    exit();
}

