<?php
session_start();
require_once '../php/config.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sectionName = htmlspecialchars(trim($_POST['section_name']));
    $sectionNumber = htmlspecialchars(trim($_POST['section_number']));

    $sectionCheck = $conn->query("SELECT * FROM sections WHERE section_name = '$sectionName'")->fetch_assoc();
    $classCount = $conn->query("SELECT section_name FROM classes WHERE section_name = '$sectionName'")->fetch_assoc();

    if ($sectionCheck !== null) {
        echo json_encode(["success" => false, "message" => "Section already exists."]);
        exit;
    }

    if ($classCount !== null){
        echo json_encode(["success" => false, "message" => "Connot delete $sectionName as it contain classes."]);
        exit;
    }

    $sql = "INSERT INTO sections (section_name, section_number) VALUE(?,?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $sectionName, $sectionNumber);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "$sectionName added successfully", "section_number" => $sectionNumber, "section_name" => $sectionName, "section_id" => $stmt->insert_id]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to add section."]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Execution failed.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Prepare failed']);
    }
    exit;
}