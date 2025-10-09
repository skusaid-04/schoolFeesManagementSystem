<div class="modal fade" id="addFeeModal" tabindex="-1" aria-labelledby="addFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" id="addFeeForm">
            <div class="modal-header rounded-0 border-0" style="background-color: transparent;">
                <h5 class="modal-title" id="addFeeModalLabel">Add New Fee</h5>
                <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button> -->
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="feeType" class="form-label">Fee Type</label>
                        <input type="text" class="form-control" id="feeType" name="fee_type" required>
                    </div>
                    <div class="col-md-6">
                        <label for="amount" class="form-label">Amount (₹)</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="classSelect" class="form-label">Class</label>
                        <select class="form-select" id="classSelect" name="class" required>
                            <option value="" disabled selected>Select Class</option>
                            <?php echo getClassOptions($conn) ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="frequency" class="form-label">Frequency</label>
                        <select class="form-select" id="frequency" name="frequency" required>
                            <option value="">Select Frequency</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Half-Yearly">Half-Yearly</option>
                            <option value="Yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dueDate" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="dueDate" name="due_date" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="add_fee" id="addFeeBtn">Save Fee</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>