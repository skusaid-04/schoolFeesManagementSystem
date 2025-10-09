<div class="modal fade" id="editFeeModal" tabindex="-1" aria-labelledby="editFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header rounded-0 border-0" style="background-color: transparent;">
                <h5 class="modal-title" id="editFeeModalLabel">Edit Fee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Hidden Fee ID -->
                <input type="hidden" name="fee_id" value="<?= $fee_id ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fee Type</label>
                        <input type="text" class="form-control" name="fee_type" value="Tution Fee" required>
                        <!-- <input type="text" class="form-control" name="fee_type"
                            value="<?= htmlspecialchars($fee_type) ?>" required> -->
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Amount (₹)</label>
                        <input type="number" class="form-control" name="amount" value=""
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Class</label>
                        <select class="form-select" name="class_id" required>
                            <option value="">Select Class</option>
                            <option value="1">Class 1</option>
                            <!-- <option value="2" <?= $class_id == 2 ? 'selected' : '' ?>>Class 2</option> -->
                            <!-- Add dynamic class options -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Section</label>
                        <select class="form-select" name="section_id" required>
                            <option value="">Select Section</option>
                            <option value="1">Primary</option>
                            <option value="2">Secondary</option>
                            <!-- <option value="2" <?= $section_id == 2 ? 'selected' : '' ?>>Secondary</option> -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Frequency</label>
                        <select class="form-select" name="frequency" required>
                            <option value="Monthly" <?= $frequency == 'Monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="Quarterly" <?= $frequency == 'Quarterly' ? 'selected' : '' ?>>Quarterly
                            </option>
                            <option value="Yearly" <?= $frequency == 'Yearly' ? 'selected' : '' ?>>Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="due_date" value="" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update Fee</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>