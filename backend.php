<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Show all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// clear chache
ini_set('opcache.enable', '0'); // Disable OPcache

// Include database config
require_once 'php/config.php';

$date = $_GET['date'] ?? null;

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
  header("Location: auth/login.php");
  exit();
}

// Display the school logo
$schoolLogo = isset($_SESSION["logo"]) && !empty($_SESSION["logo"]) ? $_SESSION["logo"] : "./assets/school.png";


// Optional: Assign username for display
$username = $_SESSION['username'];

// Fetch user details from the session or database 

// fetching students and fees collection data
$students = $conn->query("SELECT * FROM students")->fetch_all(MYSQLI_ASSOC); // Fetch all students from the database
$feesCollction = $conn->query("SELECT * FROM fees_table")->fetch_all(MYSQLI_ASSOC); // Fetch all fees collection data

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['section'])) {
  $_SESSION['active_section'] = $_POST['section'];
}
$activeSection = $_SESSION['active_section'] ?? $_SESSION['default_section']; // Default section if not set
$escapedSection = mysqli_real_escape_string($conn, $activeSection);

//fetching total students from the database
$totalStudentsQuery = "SELECT COUNT(*) AS total_students FROM students WHERE section = '$escapedSection'";
$result = mysqli_query($conn, $totalStudentsQuery);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['students'] = $row['total_students'] ?? '0';
} else {
  $_SESSION['students'] = '0'; // fallback if query fails
}


// Fetching total fees collected this month
$feesQuery = "SELECT SUM(amount_paid) AS total_fees FROM fees_table WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
$feesQueryResult = mysqli_query($conn, $feesQuery);

if ($feesQueryResult) {
  $row = mysqli_fetch_assoc($feesQueryResult);
  $totalFees = $row['total_fees'] ?? 0;

  // Optional: convert total fees to string
  $_SESSION['fees'] = intval($totalFees);
} else {
  $_SESSION['fees'] = '0'; // Default if query fails
}


$dailyCollectionQuery = "SELECT SUM(amount_paid) AS daily_collection FROM fees_table WHERE payment_date = CURDATE()";
$dailyCollectionResult = mysqli_query($conn, $dailyCollectionQuery);
if ($dailyCollectionResult) {
  $row = mysqli_fetch_assoc($dailyCollectionResult);
  $_SESSION['daily_collection'] = $row['daily_collection'] ?? '0';
} else {
  $_SESSION['daily_collection'] = '0'; // Default if query fails
}

// Fetching total users (admins) from the database
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM login_admins";
$totalUsersResult = mysqli_query($conn, $totalUsersQuery);
if ($totalUsersResult) {
  $row = mysqli_fetch_assoc($totalUsersResult);
  $_SESSION['total_users'] = $row['total_users'] ?? '0';
} else {
  $_SESSION['total_users'] = '0'; // Default if query fails
}

$custom_routes = [
  'students/all_students/view_student' => 'students/view_student',
  'students/all_students/view_student/edit_student' => 'students/edit_student',
  'students/all_students/view_student/view_receipt' => 'get_data/view_receipt',
  'students/all_students/view_student/edit_receipt' => 'edit_data/edit_receipt',

  'students/view_classwise/view_student' => 'students/view_student',
  'students/view_classwise/edit_student' => 'students/edit_student',
  'payments/payment_history/view_receipt' => 'get_data/view_receipt',
  'payments/edit_data/admin_approval' => 'edit_data/admin_approval',
  'payments/edit_data/view_requests' => 'edit_data/view_requests',

  'settings/view_profile/profile' => 'settings/profile'
];
$allowed_pages = [
  '404',
  'dashboard',
  'students/view_student',
  'students/edit_student',
  'students/all_students',
  'students/all_students/view_student',
  'students/all_students/view_student/edit_student',
  'students/all_students/view_student/view_receipt',
  'students/all_students/view_student/edit_receipt',
  'students/add_student',
  'students/view_classwise',
  'students/view_classwise/view_student',
  'students/view_classwise/edit_student',
  'modals/get_chart_data',
  'payments/accept_payment',
  'payments/edit_data/admin_approval',
  'payments/edit_data/view_requests',
  'payments/view_payments/fee_receipt',
  'payments/payment_history/view_receipt',
  'payments/generate_report',
  'payments/payment_history',
  'payments/fees_master',
  'payments/fee_receipt',


  'settings/add_users',
  'settings/data_settings',
  'settings/system_info',
  'settings/system_settings',
  'settings/profile',
  'settings/view_profile',
  'settings/view_profile/profile',
  'settings/delete_user',
  'settings/generate_report',
  'settings/backup',

  'get_data/view_receipt',
  'payments/view_payments/view_receipt',
  'get_data/payment_details',
  'edit_data/edit_fees',
  'edit_data/edit_receipt',
  'edit_data/admin_approval',
  'edit_data/view_requests',
  'settings/update_status',
  'modals/add_fee_modal'
];
// $page = isset($_GET['page']) && in_array(
//   $_GET['page'],
//   $allowed_pages
// ) ? $_GET['page'] : 'dashboard';

$page = (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) ? ($custom_routes[$_GET['page']] ?? $_GET['page']) : 'dashboard';

// Fetch sections from the database for the section switcher
function getSectionOptions($conn, $activeSection = 'Primary')
{
  $options = '';
  $sections_result = $conn->query("SELECT * FROM sections");

  if ($sections_result && $sections_result->num_rows > 0) {
    while ($section = $sections_result->fetch_assoc()) {
      $sectionName = $section['section_name'] ?? 'Primary';
      $selected = ($activeSection === $sectionName) ? 'selected' : '';
      $options .= "<option value='" . htmlspecialchars($sectionName) . "' $selected>" . htmlspecialchars($sectionName) . "</option>\n";
      // if()
    }
  } else {
    $options = "<option value='Primary' selected>Primary</option>\n";
  }

  return $options;
}

// fetch section options for the section dropdown
function getSectionOptionsForDropdown($conn)
{
  $options = '';
  $sections_result = $conn->query("SELECT * FROM sections");

  if ($sections_result && $sections_result->num_rows > 0) {
    while ($section = $sections_result->fetch_assoc()) {
      $sectionName = $section['section_name'] ?? 'Primary';
      // $selected = ($activeSection === $sectionName) ? 'selected' : '';
      $options .= "<option value='" . htmlspecialchars($sectionName) . "'>" . htmlspecialchars($sectionName) . "</option>\n";
    }
  } else {
    $options = "<option value='Primary' selected>Primary</option>\n";
  }
  return $options;
}

// echo "<script>console.log('Active Section: " . $escapedSection . "');</script>";

// fetch class options for the class dropdown
function getClassOptions($conn, $escapedSection = null)
{
  // get active section (fall back to session/default or 'Primary')
  $activeSection = $escapedSection ?? ($_SESSION['active_section'] ?? $_SESSION['default_section'] ?? 'Primary');
  $options = '';
  $activeSectionEscaped = mysqli_real_escape_string($conn, $activeSection);
  $classes_result = $conn->query("SELECT * FROM classes WHERE section_name = '$activeSectionEscaped'");

  if ($classes_result && $classes_result->num_rows > 0) {
    while ($class = $classes_result->fetch_assoc()) {
      $className = $class['class_name'] ?? 'Class 1';
      // $selected = ($activeSection === $className) ? 'selected' : '';
      $options .= "<option value='" . htmlspecialchars($className, ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($className, ENT_QUOTES, 'UTF-8') . "</option>\n";
    }
  } else {
    $options = "<option value='Class 1' selected>Class 1</option>\n";
  }
  return $options;
}



// Function to get payment history
function getPaymentHistory($conn, $date)
{
  $query = "SELECT * FROM fees_table";
  if (!empty($date)) {
    $query .= " WHERE DATE(payment_date) = '" . mysqli_real_escape_string($conn, $date) . "'";
  }
  $result = $conn->query($query);
  // format the payment date and time to 'd-M-Y h:i A'
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $row['payment_date'] = date('d-M-Y h:i A', strtotime($row['payment_date']));
      $paymentHistory[] = $row;
    }
    return $paymentHistory;
  }
  return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// funtion to get fees data from fee master
function getFeeMasterData($conn, $escapedSection)
{
  $query = "SELECT * FROM fees_master";
  $result = $conn->query($query);
  if ($result && $result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  return [];
}

include 'system_generated/generate_receipt_no.php';

include 'get_data/get_student_data.php';

// include 'modals/get_chart_data.php';




$paymentHistory = getPaymentHistory($conn, $date);
// echo "<script>console.log(" . json_encode($paymentHistory) . ");</script>";
$feeMasterData = getFeeMasterData($conn, $escapedSection);
echo "<script>console.log(" . json_encode($feeMasterData) . ");</script>";
$classOptions = getClassOptions($conn);
// echo "<script>console.log(" . json_encode($classOptions) . ");</script>";
