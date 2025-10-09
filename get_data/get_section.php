<?php
session_start();
require_once '../php/config.php';

$section = $conn->query("SELECT * FROM sections ORDER BY section_number ASC");
$sections = [];

while ($row = $section->fetch_assoc()) {
    $sections[] = $row;
}

echo json_encode($sections);