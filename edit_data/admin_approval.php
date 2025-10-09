<?php
// Example: Pending requests fetched from DB
$pending_requests = [
    ["id"=>1, "student"=>"Ahmed Khan", "old_amount"=>1500, "new_amount"=>1400, "reason"=>"Extra discount", "requested_by"=>"Accountant 1"],
    ["id"=>2, "student"=>"Fatima Ali", "old_amount"=>2000, "new_amount"=>2100, "reason"=>"Late fee added", "requested_by"=>"Accountant 2"]
];
?>

<div class="container mt-5">
    <div class="card border-0">
        <div class="card-header border-0 bg-transparent">
            <h4 class="mb-0">Receipt Edit Requests</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Old Amount</th>
                        <th>New Amount</th>
                        <th>Reason</th>
                        <th>Requested By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($pending_requests as $req): ?>
                    <tr>
                        <td><?= $req['id'] ?></td>
                        <td><?= $req['student'] ?></td>
                        <td><?= $req['old_amount'] ?></td>
                        <td><?= $req['new_amount'] ?></td>
                        <td><?= $req['reason'] ?></td>
                        <td><?= $req['requested_by'] ?></td>
                        <td>
                            <button class="btn btn-success btn-sm">Approve</button>
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>