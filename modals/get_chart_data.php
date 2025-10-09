<?php
session_start();
require_once '../php/config.php';
header('Content-Type: application/json');

function getPaymentByPaymentMode($conn)
{
    $sql = "SELECT payment_mode, SUM(amount_paid) as total 
            FROM fees_table 
            GROUP BY payment_mode";

    $result = mysqli_query($conn, $sql);

    $data = [
        'Cash'   => 0,
        'Online' => 0,
        'Cheque' => 0
    ];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $mode = $row['payment_mode'];
            if (isset($data[$mode])) {
                $data[$mode] = (int) $row['total'];
            }
        }
    }

    return $data;
}

function getPaymentByMonth($conn)
{
    $sql = "SELECT MONTH(payment_date) as month, SUM(amount_paid) as total 
            FROM fees_table 
            GROUP BY MONTH(payment_date)";

    $result = mysqli_query($conn, $sql);

    $data = [
        'June' => 0, 'July' => 0, 'August' => 0, 'September' => 0,
        'October' => 0, 'November' => 0, 'December' => 0, 'January' => 0,
        'February' => 0, 'March' => 0, 'April' => 0, 'May' => 0
    ];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $monthNum  = $row['month'];
            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
            $data[$monthName] = (float) $row['total'];
        }
    }

    return $data;
}

// ✅ Get both datasets
$paymentModes = getPaymentByPaymentMode($conn);
$monthData    = getPaymentByMonth($conn);

// Save to session if needed
$_SESSION['cash_fees']   = $paymentModes['Cash'];
$_SESSION['online_fees'] = $paymentModes['Online'];
$_SESSION['cheque_fees'] = $paymentModes['Cheque'];
$_SESSION['month_data']  = $monthData;

// ✅ Close connection once
mysqli_close($conn);

// ✅ Return one JSON object containing both
echo json_encode([
    'paymentModes' => $paymentModes,
    'months'       => $monthData
]);
