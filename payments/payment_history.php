

<div class="container pb-4">
  <div class="card rounded-0 border-0" style="background-color: white;">
    <div class="card-header d-flex justify-content-between align-items-center rounded-0 border-0" style="background-color: transparent;">
      <h5 class="mb-0 fw-semibold">Payments history</h5>
      <button class="btn btn-success btn-sm">Export CSV</button>
    </div>
    <div class="card-body">

      <form class="row gy-2 gx-3 mb-3">
        <div class="col-md-3">
          <label class="form-label">Section</label>
          <select class="form-select">
            <?php echo getSectionOptionsForDropdown($conn); ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Class</label>
          <select class="form-select">
            <?php echo getClassOptions($conn); ?>
            <!-- <option selected>All</option>
            <option>Class 1</option>
            <option>Class 2</option> -->
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">From Date</label>
          <input type="date" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">To Date</label>
          <input type="date" class="form-control">
        </div>
      </form>

      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search by student name or receipt no...">
        <button class="btn btn-outline-success" type="button">Search</button>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
          <thead class="table-success">
            <tr>
              <th>#</th>
              <th>Receipt No</th>
              <th>Student Name</th>
              <!-- <th>Class</th> -->
              <th>Month</th>
              <th>Amount</th>
              <th>Payment Date</th>
              <th>Method</th>
              <!-- <th>Status</th> -->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $paymentHistory ? '' : '<tr><td colspan="10" class="text-center">No payments found</td></tr>'; ?>
            <?php foreach ($paymentHistory as $payment): ?>
              <tr>
                <td><?php echo htmlspecialchars($payment['id']); ?></td>
                <td><?php echo htmlspecialchars($payment['receipt_no']); ?></td>
                <td><?php echo htmlspecialchars($payment['student_name']); ?></td>
                <!-- <td><?php echo htmlspecialchars($payment['class']); ?></td> -->
                <td><?php echo htmlspecialchars($payment['month_of_payment']); ?></td>
                <td><?php echo htmlspecialchars($payment['amount_paid']); ?></td>
                <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                <td><?php echo htmlspecialchars($payment['payment_mode']); ?></td>
                <!-- <td><span class="badge bg-success"><?php echo htmlspecialchars($payment['status']); ?></span></td> -->
                <td>
                  <a href="index.php?page=payments/payment_history/view_receipt&receiptno=<?php echo urlencode($payment['receipt_no']); ?>" class="btn btn-sm btn-outline-primary smart-link">View</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <!-- Example rows for demonstration -->
            <!-- <tr>
              <td>1</td>
              <td>R-1001</td>
              <td>Ayaan Khan</td>
              <td>Class 1 - A</td>
              <td>May 2025</td>
              <td>₹1500</td>
              <td>2025-05-12</td>
              <td>Cash</td>
              <td><span class="badge bg-success">Paid</span></td>
              <td>
                <a href="index.php?page=payments/fee_receipt" class="btn btn-sm btn-outline-primary smart-link">View</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>R-1002</td>
              <td>Sarah Ali</td>
              <td>Class 2 - B</td>
              <td>May 2025</td>
              <td>₹1800</td>
              <td>2025-05-15</td>
              <td>Online</td>
              <td><span class="badge bg-success">Paid</span></td>
              <td>
                <a href="index.php?page=payments/fee_receipt" class="smart-link btn btn-sm btn-outline-primary">View</a>
              </td>
            </tr> -->
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>