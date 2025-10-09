<?php
// include "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['full_name'];
  $roll = $_POST['roll_no'];
  $class = $_POST['class'];
  $section = $_POST['section'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];

  $query = "UPDATE students SET 
            full_name = '$name',
            roll_no = '$roll',
            class = '$class',
            section = '$section',
            gender = '$gender',
            phone = '$phone'
            WHERE id = $id";

  if (mysqli_query($conn, $query)) {
    header("Location: ../index.php?page=students/all_students&msg=updated");
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
