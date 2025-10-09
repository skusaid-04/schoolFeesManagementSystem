<?php
$students = "SELECT * FROM `students`"; // Default section
// $activeSection = isset($_SESSION['active_section']) ? $_SESSION['active_section'] : ''; // Default to 'Primary' if not set
// $escapedSection = mysqli_real_escape_string($conn, $activeSection);

function getStudentData($conn, $students) {
    $result = mysqli_query($conn, $students);
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return []; // agar query fail ho jaye
}

// Make sure $conn is defined and connected before this line
$getStudentData = getStudentData($conn, $students);

// echo "<script>console.log('getStudentData: " . json_encode($getStudentData) . "');</script>";

function getAllStudents($conn, $students, $escapedSection) {
    $allStudentQuery = "$students WHERE section = '$escapedSection'"; // Default section, can be changed based on user input or other logic
    return getStudentData($conn, $allStudentQuery);
}

// Example: set $escapedSection to a valid section value, e.g., from user input or default
// $escapedSection = mysqli_real_escape_string($conn, $activeSection); // Replace 'A' with actual section if needed
$getAllStudentData = getAllStudents($conn, $students, $escapedSection);
// echo "<script>console.log('getAllStudentData: " . json_encode($getAllStudentData) . "');</script>";

$id = isset($_GET['id']) ? (int) $_GET['id'] : null; // Ensure $id is set and cast to int for security
function getStudentDataById($conn, $id) {
    if ($id) {
        $id = mysqli_real_escape_string($conn, $id);
        $query = "SELECT * FROM `students` WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            return $result->fetch_assoc();
        }
    }
    return null; // agar query fail ho jaye
}

$student = getStudentDataById($conn, $id);

$studentGrNo = isset($student['gr_no']) ? $student['gr_no'] : null; // Ensure $studentGrNo is set
function getFeesDataByStudentId($conn, $studentGrNo) {
    if ($studentGrNo) {
        $studentGrNo = mysqli_real_escape_string($conn, $studentGrNo);
        $query = "SELECT * FROM `fees_table` WHERE gr_no = '$studentGrNo'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
    return []; // agar query fail ho jaye
}
$feesData = getFeesDataByStudentId($conn, $studentGrNo);

$receiptNo = $_GET['receiptno'] ?? null;
function getFeesDataByReceiptNo($conn, $receiptNo, $studentGrNo) {
    if ($receiptNo) {
        $receiptNo = mysqli_real_escape_string($conn, $receiptNo);
        $query = "SELECT * FROM `fees_table`, `students` WHERE fees_table.receipt_no = '$receiptNo' AND students.gr_no = fees_table.gr_no";
        $result = mysqli_query($conn, $query);
        if ($result&& mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
    return null; // agar query fail ho jaye
}

$feesDataByReceiptNo = getFeesDataByReceiptNo($conn, $receiptNo, $studentGrNo);