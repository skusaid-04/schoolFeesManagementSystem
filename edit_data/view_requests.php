<?php
// Example: Pending requests fetched from DB
$pending_requests = [
    ["id" => 1, "student" => "Ahmed Khan", "old_amount" => 1500, "new_amount" => 1400, "reason" => "Extra discount", "requested_by" => "Accountant 1"],
    ["id" => 2, "student" => "Fatima Ali", "old_amount" => 2000, "new_amount" => 2100, "reason" => "Late fee added", "requested_by" => "Accountant 2"]
];
?>

<div class="container mt-5">
    <div class="card border-0">
        <div class="card-header border-0 bg-transparent">
            <h5 class="mb-0 fw-bold">View Requests</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Receipt ID</th>
                        <th>Student Name</th>
                        <th>Amount Paid</th>
                        <th>Payment Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Admin Remarks</th>
                        <th>Request Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- example data to display -->
                    <tr>
                        <td>1</td>
                        <td>R123</td>
                        <td>John Doe</td>
                        <td>₹1000</td>
                        <td>01-Jan-2023</td>
                        <td>Need correction</td>
                        <td>
                            <span class="badge bg-warning text-dark">Pending</span>
                        </td>
                        <td>Admin review needed</td>
                        <td>01-Feb-2023</td>
                    </tr>
                    <!-- <?php if ($result->num_rows > 0):
                        $i = 1;
                        while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>abcd</td>
                    <td>abcd</td>
                    <td>₹1234</td>
                    <td>abcd</td>
                    <td>abcd</td>
                    <td>
                        <?php if ($row['status'] == 'pending'): ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php elseif ($row['status'] == 'approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td>abcd</td>
                    <td>abcd</td>
                </tr>
            <?php endwhile; else: ?> -->
                        <tr>
                            <td colspan="9" class="text-center text-muted">No requests found</td>
                        </tr>
                        <!-- <?php endif; ?> -->
                </tbody>
            </table>
        </div>
    </div>
</div>