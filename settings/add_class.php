<?php
session_start();
require_once '../php/config.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $className = htmlspecialchars(trim($_POST['class_name']));
    $sectionName = htmlspecialchars(trim($_POST['section_name']));
    $classNumber = htmlspecialchars(trim($_POST['class_number']));
    
    $classCheck = $conn->query("SELECT * FROM classes WHERE section_name = '$sectionName' AND class_name = '$className'")->fetch_assoc();
    $divisionCount = $conn->query("SELECT class_number FROM divisions WHERE class_number = '$classNumber'")->fetch_assoc();

    if ($classCheck !== null) {
        echo json_encode(["success" => false, "message" => "Class already exists."]);
        exit;
    }

    if ($divisionCount !== null){
        echo json_encode(["success" => false, "message" => "Connot delete $className as it contain divisions."]);
        exit;
    }

    $sql = "INSERT INTO classes (section_name, class_name, class_number) VALUE(?,?,?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $sectionName, $className, $classNumber);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "$className added successfully", "class_name" => $className, "section_name" => $sectionName, "class_id" => $stmt->insert_id]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to add class"]);
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