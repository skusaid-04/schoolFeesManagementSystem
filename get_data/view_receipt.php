<?php
$feesDataByReceiptNo['fees_details'] = getFeesDataByReceiptNo($conn, $receiptNo, $studentGrNo);

// change format of date to d-M-Y
if (!empty($feesDataByReceiptNo['fees_details']['payment_date'])) {
    $feesDataByReceiptNo['payment_date'] = date("d-M-Y", strtotime($feesDataByReceiptNo['fees_details']['payment_date']));
}

echo "<script>console.log('feesDataByReceiptNo: " . json_encode($feesDataByReceiptNo['fees_details']) . "');</script>";

// echo "<script>console.log('feesDataByReceiptNo: " . json_encode($feesDataByReceiptNo) . "');</script>";
?>

<style>
    @media print {
        body * {
            visibility: hidden !important;
        }

        #receiptContent,
        #receiptContent * {
            visibility: visible !important;
        }

        #receiptContent {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }
    }

    .receipt-box {
        border: 1px solid #ccc;
        padding: 25px;
        border-radius: 8px;
        background: #fff;
    }

    .receipt-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .receipt-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .border-none {
        border: transparent !important;
    }

    .logo {
        /* max-height: 70px; */
        margin-bottom: 10px;
    }
</style>
<div class="container pb-5">
    <div id="receiptContent" class="receipt-box border-0 mx-auto bg-white">
        <div class="receipt-header">
            <img src="<?php echo $getSystemInfo['logo']; ?>" class="logo" alt="School Logo" style="max-height: 70px;">
            <div class="receipt-title"><?php echo $getSystemInfo['school_name']; ?></div>
            <small><?php echo $getSystemInfo['address']; ?> | Phone: <?php echo $getSystemInfo['phone']; ?> | Email:
                <?php echo $getSystemInfo['email']; ?></small>
            <hr>
            <h5 class="mt-3">Payment Receipt</h5>
        </div>

        <div class="row mb-4">
            <div class="row mb-2">
                <div class="col-md-6"><strong>Receipt No:</strong> <?php echo $feesDataByReceiptNo[0]['receipt_no'] ?><br>
                </div>
                <div class="col-md-6 text-md-end"><strong>Date:</strong>
                    <?php echo $feesDataByReceiptNo[0]['payment_date']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3"><strong>Student Name:</strong> <?php echo $feesDataByReceiptNo[0]['student_name']; ?>
                </div>
                <div class="col-md-3 text-md-center"><strong>GR No.:</strong>
                    <?php echo $feesDataByReceiptNo[0]['gr_no']; ?></div>
                <div class="col-md-3 text-md-center"><strong>Roll No.:</strong>
                    <?php echo $feesDataByReceiptNo[0]['roll_no']; ?></div>
                <div class="col-md-3 text-md-end"><strong>Class & Division:</strong>
                    <?php echo $feesDataByReceiptNo[0]['class'] . ' - ' . $feesDataByReceiptNo[0]['division']; ?></div>
            </div>
            <div class="row">
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr class="border-none">
                    <th>Description</th>
                    <th>Month</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($feesDataByReceiptNo['fees_details'])) {
                    echo "<tr class='border-none'><td colspan='3' class='text-center'>No fees data found for this receipt.</td></tr>";
                } else {
                    foreach ($feesDataByReceiptNo['fees_details'] as $fee) {
                        echo "<tr class='border-none'>
                            <td>" . htmlspecialchars($fee['description']) . "</td>
                            <td>" . htmlspecialchars($fee['month_of_payment']) . "</td>
                            <td>₹" . number_format($fee['amount_paid'], 2) . "</td>
                        </tr>";
                    }
                    echo "<tr class='border-none'>
                        <th colspan='2' class='text-end'>Total Paid</th>
                        <th>₹" . number_format(array_sum(array_column($feesDataByReceiptNo['fees_details'], 'amount_paid')), 2) . "</th>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <div class="row mt-4">
            <div class="col-md-6">
                <strong>Payment Mode:</strong> <?php echo $feesDataByReceiptNo[0]['payment_mode']; ?><br>
                <strong>Collected By:</strong> Admin
            </div>
            <div class="col-md-6 text-md-end">
                <!-- <img src="uploads/stamp.png" alt="Stamp" style="max-height: 60px;"> -->
                <p class="mt-4">Signature & Stamp</p>
            </div>
        </div>
        <div class="receipt-footer text-center mt-4">
            <p>Thank you for your payment!</p>
        </div>

    </div>
    <div class="text-center mt-5 no-print">
        <button onclick="printReceipt()" class="btn btn-primary">Print Receipt</button>
        <a href="view_payment.php" class="smart-link btn btn-secondary ms-2">Back to Payments</a>
    </div>
</div>
<script>
    function printReceipt() {
        const receiptDiv = document.getElementById('receiptContent');

        const newWindow = window.open('', 'width=800px, height=900px');
        newWindow.document.write(`
            <html>
            <head>
                <title>Print Receipt</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                body {
                    padding: 20px;
                    font-family: 'Arial', sans-serif;
                }
                .receipt-box {
                    padding: 25px;
                    // background: #fff;
                }
                .receipt-header {
                    text-align: center;
                    margin-bottom: 25px;
                }
                .receipt-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                }
                .logo {
                    max-height: 70px;
                    margin-bottom: 10px;
                }
                .mb-4 {
                    margin-bottom: 1.5rem !important;
                }
                .row {
                    --bs-gutter-x: 1.5rem;
                    --bs-gutter-y: 0;
                    display: flex;
                    flex-wrap: wrap;
                    margin-top: calc(-1 * var(--bs-gutter-y));
                    margin-right: calc(-.5 * var(--bs-gutter-x));
                    margin-left: calc(-.5 * var(--bs-gutter-x));
                }

                .col-md-6 {
                    flex: 0 0 auto;
                    width: 50%;
                }
                .col-md-3 {
                    flex: 0 0 auto;
                    width: 25%;
                }
                
                strong {
                    font-weight: bolder;
                }

                .text-md-end {
                    text-align: right !important;
                }

                table {
                    caption-side: bottom;
                    border-collapse: collapse;
                }

                .table {
                    --bs-table-color-type: initial;
                    --bs-table-bg-type: initial;
                    --bs-table-color-state: initial;
                    --bs-table-bg-state: initial;
                    --bs-table-color: var(--bs-emphasis-color);
                    --bs-table-bg: var(--bs-body-bg);
                    --bs-table-border-color: var(--bs-border-color);
                    --bs-table-accent-bg: transparent;
                    --bs-table-striped-color: var(--bs-emphasis-color);
                    --bs-table-striped-bg: rgba(var(--bs-emphasis-color-rgb), 0.05);
                    --bs-table-active-color: var(--bs-emphasis-color);
                    --bs-table-active-bg: rgba(var(--bs-emphasis-color-rgb), 0.1);
                    --bs-table-hover-color: var(--bs-emphasis-color);
                    --bs-table-hover-bg: rgba(var(--bs-emphasis-color-rgb), 0.075);
                    width: 100%;
                    margin-bottom: 1rem;
                    vertical-align: top;
                    border-color: var(--bs-table-border-color);
                }

                </style>
            </head>
            <body>
                ${receiptDiv.outerHTML}
            </body>
            </html>
        `);

        newWindow.document.close();
        newWindow.focus();

        setTimeout(() => {
            newWindow.print();
            newWindow.close();
        }, 500);
    }
</script>