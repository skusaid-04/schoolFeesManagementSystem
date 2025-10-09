<?php
// Dummy values - Replace with fetched DB values in real use
$fee_id = $_GET['id'] ?? 1;
$fee_type = "Tuition Fee";
$amount = 1200;
$class_id = 1;
$section_id = 1;
$frequency = "Monthly";
$due_date = "2025-07-10";
?>

<div class="container pb-4">
    <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header border-0 rounded-0" style="background-color: transparent;">
            <h5 class="mb-0 fw-semibold">Edit Fee Details</h5>
        </div>
        <form action="update_fee.php" method="POST">
            <div class="card-body">
                <!-- Hidden Fee ID -->
                <input type="hidden" name="fee_id" value="<?= $fee_id ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fee Type</label>
                        <input type="text" class="form-control" name="fee_type"
                            value="<?= htmlspecialchars($fee_type) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Amount (₹)</label>
                        <input type="number" class="form-control" name="amount" value="<?= htmlspecialchars($amount) ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Class</label>
                        <select class="form-select" name="class_id" required>
                            <option value="">Select Class</option>
                            <option value="1" <?= $class_id == 1 ? 'selected' : '' ?>>Class 1</option>
                            <option value="2" <?= $class_id == 2 ? 'selected' : '' ?>>Class 2</option>
                            <!-- Add dynamic class options -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Section</label>
                        <select class="form-select" name="section_id" required>
                            <option value="">Select Section</option>
                            <option value="1" <?= $section_id == 1 ? 'selected' : '' ?>>Primary</option>
                            <option value="2" <?= $section_id == 2 ? 'selected' : '' ?>>Secondary</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Frequency</label>
                        <select class="form-select" name="frequency" required>
                            <option value="Monthly" <?= $frequency == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="Quarterly" <?= $frequency == 'Quarterly' ? 'selected' : '' ?>>Quarterly</option>
                            <option value="Yearly" <?= $frequency == 'Yearly' ? 'selected' : '' ?>>Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="due_date" value="<?= $due_date ?>" required>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="fees_master.php" class="smart-link btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update Fee</button>
            </div>
        </form>
    </div>
</div>