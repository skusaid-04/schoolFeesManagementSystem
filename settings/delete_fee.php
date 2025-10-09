<?php
session_start();
require_once '../php/config.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data['id'] ?? null);

if ($id) {
    $conn->query("DELETE FROM fees_master WHERE id = '$id'");
    echo json_encode(['success' => true, 'message' => 'Fee deleted successfully.', 'fee_id' => $id]);
} else {
    echo json_encode(['success' => false, 'message' => 'No fee ID provided.']);
}