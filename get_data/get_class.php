<?php
session_start();
require_once '../php/config.php';

$class = $conn->query("SELECT * FROM classes ORDER BY class_number ASC");
$classes = [];

while ($row = $class->fetch_assoc()) {
    $classes[] = $row;
}

echo json_encode($classes);