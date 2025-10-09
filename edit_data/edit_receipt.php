<div class="container mt-4">
    <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header border-0 rounded-0" style="background-color: transparent;">
            <h5 class="mb-0 fw-bold">Edit Receipt</h5>
        </div>
        <div class="card-body">
            <form method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" value="<?php #echo htmlspecialchars($receipt['student_name']); ?>" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Class</label>
                    <input type="text" class="form-control" value="<?php #echo htmlspecialchars($receipt['class']); ?>" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" class="form-control" value="<?php #echo htmlspecialchars($receipt['payment_date']); ?>" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Paid</label>
                    <input type="number" name="amount_paid" class="form-control" value="<?php #echo htmlspecialchars($receipt['amount_paid']); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Mode</label>
                    <select name="payment_mode" class="form-select" required>
                        <option value="Cash" <?php #echo $receipt['payment_mode'] == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                        <option value="Online" <?php #echo $receipt['payment_mode'] == 'Online' ? 'selected' : ''; ?>>Online</option>
                        <option value="Cheque" <?php #echo $receipt['payment_mode'] == 'Cheque' ? 'selected' : ''; ?>>Cheque</option>
                    </select>
                </div>

                <!-- <div class="col-md-6 mb-3">
                    <label class="form-label">Notes</label>
                    <input name="notes" class="form-control"><?php #htmlspecialchars($receipt['notes']) ?></input>
                </div> -->

                <div class="col-md-6 mb-3">
                    <label class="form-label">Reason</label>
                    <input type="text" name="edit_reason" class="form-control" required>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success mx-1">Update Receipt</button>
                <a href="view_payments.php" class="btn btn-secondary mx-1">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>

Add this features here:
Direct edit allow mat karo, instead:

Edit request ko approval system se pass karo (e.g., admin approval).

Har edit ka audit log rakho:

Old value

New value

Edited by (username)

Edit date & time

Reason for edit

PDF receipts me ek line likho: "Edited on [Date] by [User]"

Agar accountant ko access dena hi hai, to amount direct editable na ho — sirf remarks, payment mode, date change allowed ho.

Amount change hamesha admin level pe approve ho.
