<?php 
session_start();
require_once '../php/config.php';

ob_clean();
flush();

// Backup folder
$backupDir = __DIR__ . "/../backup/"; 

// Agar folder exist nahi hai to create karo
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

// Backup file ka naam (date ke sath unique file banega)
$backupFileName = "db_backup_" . date("Y-m-d_H-i-s") . ".sql";
$backupFile = $backupDir . $backupFileName;

// mysqldump command (MySQL bin directory path sahi hona chahiye)
$command = "\"C:\\xampp\\mysql\\bin\\mysqldump\" --user=$user --password=$pass $dbname > \"$backupFile\"";

// Execute command
system($command, $result);

// Agar backup successful hai
if ($result === 0 && file_exists($backupFile)) {
    // JSON response bhejo (file path frontend ke liye)
    // header('Content-Type: application/json');
    echo json_encode([
        "status" => "success",
        "file"   => "backup/" . $backupFileName   // relative path jo frontend se access ho sake
    ]);
    exit;
} else {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        "status" => "error",
        "message" => "Backup failed. Please check database credentials or mysqldump path."
    ]);
    exit;
}
