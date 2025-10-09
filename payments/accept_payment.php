<div class="container pb-4">
    <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header rounded-0 border-0" style="background-color: transparent;">
            <h5 class="mb-0 fw-semibold">Accept Payment</h5>
        </div>
        <div class="card-body">

            <form class="needs-validation" novalidate>
                <!-- Student Selection -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">GR No.</label>
                        <input type="text" class="form-control" placeholder="Enter GR No." required>
                        <div class="invalid-feedback">GR No is required.</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Student Name</label>
                        <input type="text" class="form-control" value="<?php $studentName ?>" disabled>
                    </div>
                    <!-- <div class="col-md-4">
                        <label class="form-label">Section</label>
                        <select class="form-select" id="sectionSelect">
                            <option selected disabled>Select Section</option>
                            <option>Primary</option>
                            <option>Secondary</option>
                        </select>
                    </div> -->
                    <div class="col-md-2">
                        <label class="form-label">Class</label>
                        <input type="text" class="form-control" value="<?php $studentClass ?>" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Division</label>
                        <input type="text" class="form-control" value="<?php $studentDivision ?>" disabled>
                    </div>
                </div>

                <!-- Fee Info -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Select Month</label>
                        <select class="form-select" required>
                            <option disabled selected>Select Month</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <!-- Add more months -->
                            <div class="invalid-feedback">Month selection is required.</div>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fee</label>
                        <input type="text" class="form-control" value="<?php $studentFee ?>" disabled>
                    </div>
                    <!-- <div class="col-md-4">
                        <label class="form-label">Payment Date</label>
                        <input type="datetime-local" class="form-control" name="current_datetime" value="<?= date('Y-m-d\TH:i'); ?>">
                    </div> -->
                    <div class="col-md-4">
                        <label class="form-label">Amount Paid</label>
                        <input type="number" class="form-control" placeholder="Enter amount" required>
                        <div class="invalid-feedback">Amount is required.</div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" required>
                            <option selected disabled>Select Method</option>
                            <option>Cash</option>
                            <option>UPI</option>
                            <option>Net Banking</option>
                            <option>Card</option>
                            <option>Cheque</option>
                        </select>
                        <div class="invalid-feedback">Payment Method is required.</div>
                        
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Transaction ID / Reference (optional)</label>
                        <input type="text" class="form-control" placeholder="e.g. TXN12345">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Remarks (optional)</label>
                        <textarea class="form-control" rows="1" placeholder="Enter any remarks..."></textarea>
                    </div>
                </div>

                <!-- Remarks -->

                <!-- Submit Button -->
                <div class="text-end">
                    <button href="#" type="submit" class="btn btn-success px-4 smart-link">Collect Payment</button>
                </div>
            </form>

        </div>
    </div>
</div>