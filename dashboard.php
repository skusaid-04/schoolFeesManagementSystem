<?php
// include 'modals/get_chart_data.php';
?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .card {
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .card-title {
    font-weight: bold;
  }

  .stats-card i {
    font-size: 2rem;
  }

  .card-custom {
    border-radius: 0rem !important;
    box-shadow: none !important;
    border: 0;
  }
</style>

<div class="container" style="">
  <!-- 🔢 Stats Row -->
  <div class="row g-4">
    <div class="col-md-3">
      <div class="card stats-card text-white bg-primary">
        <div class="card-body text-center">
          <h3 id="totalStudents"> <?php
          echo $_SESSION['students'];
          ?></h3>
          <p class="card-title h-2">Total Students</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card stats-card text-white bg-success">
        <div class="card-body text-center">
          <h3 id="feesCollected"> ₹<?php echo $_SESSION['fees']; ?></h3>
          <p class="card-title h-2">Fees Collected</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card stats-card text-white bg-danger">
        <div class="card-body text-center">
          <h3 id="pendingDues"> ₹<?php echo $_SESSION['daily_collection']; ?></h3>
          <p class="card-title h-2">Daily Collection</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card stats-card text-white bg-secondary">
        <div class="card-body text-center">
          <h3 id="monthlySummary"><?php echo $_SESSION['total_users'] ?? '0'; ?></h3>
          <p class="card-title h-2">Total Users</p>
        </div>
      </div>
    </div>
  </div>

  <!-- 📈 Charts -->
  <div class="row mt-5 justify-content-evenly">
    <div class="col-md-7">
      <!-- Monthly Fee Collection Card -->
      <div class="card p-3 bg-deep-purple card-custom">
        <h5 class="mb-3">Monthly Fee Collection</h5>
        <canvas id="barChart"></canvas>
      </div>
    </div>


    <!-- Right Side: Fee Distribution -->
    <div class="col-md-4">
      <div class="card p-3 bg-deep-purple-dark card-custom">
        <h5 class="mb-3"> Fee Distribution</h5>
        <canvas id="pieChart"></canvas>
      </div>
    </div>

  </div>
  <!-- History Card -->
  <div class="row ps-3">
    <div class="col-md-6">
      <div class="card p-3 bg-light card-custom">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="mb-3">Recent Payments</h5>
          <a href="index.php?page=payments/payment_history"
            class="mb-3 btn bt-success text-success text-decoration-none text-center fw-normal smart-link cursor-pointer">
            View
            all</a>
        </div>
        <table class="table table-none table-hover">
          <thead>
            <tr>
              <th>Receipt no.</th>
              <th>GR no.</th>
              <!-- <th>Date</th> -->
              <th>Student</th>
              <th>Amount</th>
              <th>Mode</th>
              <!-- <th>accepted by</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // Filter by logged-in user
            $userPayments = array_filter($paymentHistory, function ($row) {
              return trim($row['accepted_by']) === trim($_SESSION['username']);
            });

            // Sort by payment date (most recent first)
            usort($userPayments, function ($a, $b) {
              return strtotime($b['payment_date']) - strtotime($a['payment_date']);
            });

            // Take top 5 recent
            $recentPayments = array_slice($userPayments, 0, 5);
            ?>

            <?php if (empty($recentPayments)): ?>
              <tr>
                <td colspan="6" class="text-center">No recent payments found.</td>
              </tr>
            <?php endif; ?>

            <?php foreach ($recentPayments as $row): ?>
              <tr>
                <td><?= htmlspecialchars($row['receipt_no']) ?></td>
                <td><?= htmlspecialchars($row['gr_no']) ?></td>
                <td><?= htmlspecialchars($row['student_name']) ?></td>
                <td>₹<?= number_format($row['amount_paid']) ?></td>
                <td><?= htmlspecialchars($row['payment_mode']) ?></td>
                <!-- <td><?= htmlspecialchars($row['accepted_by']) ?></td> -->
              </tr>
            <?php endforeach; ?>

            <!-- Add more rows here -->
          </tbody>
        </table>
      </div>
    </div>
    <?php if ($_SESSION['role'] === 'Admin') { ?>
      <div class="col-md-6">
        <div class="card p-3 bg-light card-custom">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-3">Pending Approval</h5>
            <a href="index.php?page=edit_data/admin_approval"
              class="mb-3 btn bt-success text-success text-decoration-none text-center fw-normal smart-link cursor-pointer">
              View
              all</a>
          </div>
          <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
            <table class="table table-none table-hover">
              <thead>
                <tr>
                  <th>Receipt no.</th>
                  <th>GR no.</th>
                  <!-- <th>Date</th> -->
                  <th>Student</th>
                  <th>Amount</th>
                  <th>Mode</th>
                  <!-- <th>accepted by</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                // Filter by logged-in user
                $userPayments = array_filter($paymentHistory, function ($row) {
                  return trim($_SESSION['role'] === 'Admin');
                });

                // Sort by payment date (most recent first)
                usort($userPayments, function ($a, $b) {
                  return strtotime($b['payment_date']) - strtotime($a['payment_date']);
                });

                // Take top 5 recent
                $recentPayments = array_slice($userPayments, 0, 5);
                ?>

                <?php if (empty($recentPayments)): ?>
                  <tr>
                    <td colspan="6" class="text-center">No recent payments found.</td>
                  </tr>
                <?php endif; ?>

                <?php foreach ($recentPayments as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['receipt_no']) ?></td>
                    <td><?= htmlspecialchars($row['gr_no']) ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td>₹<?= number_format($row['amount_paid']) ?></td>
                    <td><?= htmlspecialchars($row['payment_mode']) ?></td>
                    <!-- <td><?= htmlspecialchars($row['accepted_by']) ?></td> -->
                  </tr>
                <?php endforeach; ?>

                <!-- Add more rows here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="col-md-6">
        <div class="card p-3 bg-light card-custom">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-3">Pending request</h5>
            <a href="index.php?page=edit_data/edit_requests"
              class="mb-3 btn bt-success text-success text-decoration-none text-center fw-normal smart-link cursor-pointer">
              View
              all</a>
          </div>
          <table class="table table-none table-hover">
            <thead>
              <tr>
                <th>Receipt no.</th>
                <th>GR no.</th>
                <!-- <th>Date</th> -->
                <th>Student</th>
                <th>Amount</th>
                <th>Mode</th>
                <!-- <th>accepted by</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              // Filter by logged-in user
              $userPayments = array_filter($paymentHistory, function ($row) {
                return trim($row['accepted_by']) === trim($_SESSION['username']);
              });

              // Sort by payment date (most recent first)
              usort($userPayments, function ($a, $b) {
                return strtotime($b['payment_date']) - strtotime($a['payment_date']);
              });

              // Take top 5 recent
              $recentPayments = array_slice($userPayments, 0, 5);
              ?>

              <?php if (empty($recentPayments)): ?>
                <tr>
                  <td colspan="6" class="text-center">No recent payments found.</td>
                </tr>
              <?php endif; ?>

              <?php foreach ($recentPayments as $row): ?>
                <tr>
                  <td><?= htmlspecialchars($row['receipt_no']) ?></td>
                  <td><?= htmlspecialchars($row['gr_no']) ?></td>
                  <td><?= htmlspecialchars($row['student_name']) ?></td>
                  <td>₹<?= number_format($row['amount_paid']) ?></td>
                  <td><?= htmlspecialchars($row['payment_mode']) ?></td>
                  <!-- <td><?= htmlspecialchars($row['accepted_by']) ?></td> -->
                </tr>
              <?php endforeach; ?>

              <!-- Add more rows here -->
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>

  </div>

  <div class="mt-5 text-center">
    <a href="index.php?page=students/add_student" class="smart-link btn btn-outline-success m-2">Add Student</a>
    <a href="index.php?page=settings/data_settings" class="smart-link btn btn-outline-success m-2">Add
      Sections/Class/Division</a>
    <a href="index.php?page=payments/accept_payment" class="smart-link btn btn-outline-success m-2">Collect Fee</a>
    <a href="index.php?page=settings/generate_report" class="smart-link btn btn-outline-secondary m-2">Generate
      Reports</a>
  </div>
</div>

<script>

  // 📈 Pie Chart
  fetch('modals/get_chart_data.php')
    .then(response => response.json())
    .then(data => {
      const ctxPie = document.getElementById('pieChart').getContext('2d');
      new Chart(ctxPie, {
        type: 'pie',
        data: {
          labels: ['Cash', 'Online', 'Cheque'],
          datasets: [{
            label: 'Fee Status',
            data: [data.paymentModes.Cash || 0, data.paymentModes.Online || 0, data.paymentModes.Cheque || 0],
            backgroundColor: ['#198754', '#dc3545', '#dbd832']
          }]
        },
        options: {
          responsive: true
        }
      });

    })
    .catch(err => {
      console.error("Error loading chart data:", err);
    });

  // 📊 Bar Chart
  fetch('modals/get_chart_data.php')
    .then(response => response.json())
    .then(data => {
      const ctxBar = document.getElementById('barChart').getContext('2d');
      new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: ['June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'],
          datasets: [{
            label: 'Fee Collected (₹)',
            data: [data.months.June || 0, data.months.July || 0, data.months.August || 0, data.months.September || 0, data.months.October || 0, data.months.November || 0, data.months.December || 0, data.months.January || 0, data.months.February || 0, data.months.March || 0, data.months.April || 0, data.months.May || 0],
            backgroundColor: '#198754'
          }]
        },
        options: {
          responsive: true,

          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

    })
    .catch(err => {
      console.error("Error loading chart data:", err);
    });

</script>