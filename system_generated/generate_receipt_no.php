<?php
function generateReceiptNo($conn){
    $currentYear = date("Y");
    $query = "SELECT COUNT(*) as count FROM fees_table";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'] + 1; // Increment count for new receipt
        return "RCP-$currentYear-$count";
    } else {
        return "RCP-$currentYear-1"; // Default if no records found
    }
}
$receipt_no = generateReceiptNo($conn);