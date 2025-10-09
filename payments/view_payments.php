<div class="container pb-4">
    <div class="card border-0 rounded-0">
        <div class="card-header rounded-0 border-0" style="background-color: transparent;">
            <h5 class="mb-0 fw-semibold">View History</h4>
        </div>

        <form method="get" class="row g-3 m-2">
            <div class="col-md-8">
                <input list="students" id="student_search" name="student_name" class="form-control"
                    placeholder="Enter Name or GR No." required>
                    <div class="bg-light">
                <datalist  id="students">
                    <li><option value="Ravi Kumar - Class 8B (ID:12345)"></li>
                    <li><option value="Sarah Ali - Class 7A (ID:12346)"></li>
                    <li><option value="Ayaan Khan - Class 6C (ID:12347)"></li>
                        <!-- Populate dynamically -->
                </datalist></div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <a href="index.php?page=payments/view_payments" type="submit" class="smart-link btn btn-success w-100">View</a>
            </div>
        </form>


        <div class="card-body">
            <!-- Student Info -->
            <div class="row mb-4">
                <div class="col-md-2">
                    <strong>GR No.:</strong> 1234
                </div>
                <div class="col-md-4">
                    <strong>Student Name:</strong> Ravi Kumar
                </div>
                <div class="col-md-2">
                    <strong>Class:</strong> Class 8 - B
                </div>
                <div class="col-md-2">
                    <strong>Roll No:</strong> 12345
                </div>
            </div>

            <!-- Payment Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Due Amount</th>
                            <th>Paid Amount</th>
                            <th>Payment Mode</th>
                            <th>Payment Date</th>
                            <th>Receiver</th>
                            <th>Receipt No.</th>
                            <th>Status</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>January 2025</td>
                            <td>₹1500</td>
                            <td>₹1500</td>
                            <td>Cash</td>
                            <td>2025-01-05</td>
                            <td>Rafiq</td>
                            <td>234</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-primary smart-link">View</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>February 2025</td>
                            <td>₹1500</td>
                            <td>₹0</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><span class="badge bg-danger">Unpaid</span></td>
                            <td><button class="btn btn-sm btn-outline-secondary disabled">N/A</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>March 2025</td>
                            <td>₹1500</td>
                            <td>₹1500</td>
                            <td>Online</td>
                            <td>2025-03-10</td>
                            <td>Rafiq</td>
                            <td>234</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-primary smart-link">View</a></td>
                        </tr>
                        <!-- Add more months here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>