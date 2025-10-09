<?php
session_start();
require_once '../php/config.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $divisionName = (string) "B";
    // $className = "Class 1";
    $divisionName = htmlspecialchars(trim($_POST['division_name']));
    $className = htmlspecialchars(trim($_POST['class_name']));

    $divisionCheck = $conn->query("SELECT * FROM divisions WHERE class_name = '$className' AND division_name = '$divisionName'")->fetch_assoc();
    $studentCount = $conn->query("SELECT class, division FROM students WHERE class = '$className' AND division = '$divisionName'")->fetch_assoc();

    if(empty($divisionName) || empty($className)){
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        exit;
    }
    if ($divisionCheck !== null) {
        echo json_encode(["success" => false, "message" => "$divisionName already exists  in table"]);
        exit;
    }

    if ($studentCount !== null) {
        echo json_encode(["success" => false, "message" => "Cannot delete $division of $className as it contain students."]);
        exit;
    }

    $sql = "INSERT INTO divisions (class_name, division_name) VALUE (?,?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ss', $className, $divisionName);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "$divisionName added successfully.", "class_name" => "$className", "division_name" => "$divisionName", "division_id" => (string)$stmt->insert_id]);
            } else {
                echo json_encode(["success" => false, "message" => "$divisionName failed to add class."]);
            }
            // exit;
        } else {
            echo json_encode(["success" => false, "message" => "Execution failed."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Prepare failed."]);
    }
    exit;
}