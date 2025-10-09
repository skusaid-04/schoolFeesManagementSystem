<?php
session_start();
require_once '../php/config.php';

$query = "
    SELECT d.*, c.class_name
    FROM divisions d
    LEFT JOIN classes c ON d.class_number = c.class_number
    ORDER BY d.class_number ASC, d.division_name ASC
";

$result = $conn->query($query);
$divisionsList = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($divisionsList);