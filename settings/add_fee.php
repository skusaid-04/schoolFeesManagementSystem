<?php
session_start();
require_once '../php/config.php';
header("Content-Type: application/json");


// Dummy example: validation + response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fee_type  = htmlspecialchars(trim($data['fee_type']));
    $amount    = floatval($data['amount']);
    $class     = htmlspecialchars(trim($data['class']));
    $frequency = htmlspecialchars(trim($data['frequency']));
    $due_date  = date('d', strtotime(htmlspecialchars(trim($data['due_date']))));
    $section = $conn->query("SELECT section_name FROM classes WHERE class_name = '$class'")->fetch_assoc()['section_name'] ?? null;

    if ($fee_type === '' || $amount <= 0 || $class === '' || $section === null || !in_array($frequency, ['Monthly', 'Quarterly', 'Yearly'], true) || !preg_match('/^\d{2}$/', $due_date)) {
        echo json_encode(["success" => false, "message" => "Invalid input data"]);
        exit;
    }

    $feeCheck = $conn->query("SELECT * FROM fees_master WHERE fee_type = '$fee_type' AND class = '$class' AND section = '$section' AND frequency = '$frequency'");
    if ($feeCheck && $feeCheck->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Fee already exists for this $class"]);
        exit;
    }

    // yahan DB insert karna hoga (try-catch recommended)
    $sql = "INSERT INTO fees_master (fee_type, amount, class, section, frequency, due_date) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        // bind parameters: s (string), i (integer), d (double), s, s, f
        $stmt->bind_param("sdssss", $fee_type, $amount, $class, $section, $frequency, $due_date);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "Fee added successfully","id" => $conn->insert_id, "fee_type" => $fee_type, "amount" => $amount, "class" => $class, "section" => $section, "frequency" => $frequency, "due_date" => $due_date]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add fee.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Execute failed: ']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ']);
    }
    // $success = true; // maan lo insert hogaya

    // if ($success) {
    //     echo json_encode([
    //         "success" => true,
    //         "message" => "Fee added successfully"
    //     ]);
    // } else {
    //     echo json_encode([
    //         "success" => false,
    //         "message" => "Database insert failed"
    //     ]);
    // }
    exit;
}
// echo json_encode(["success" => false, "message" => "Invalid request"]);
