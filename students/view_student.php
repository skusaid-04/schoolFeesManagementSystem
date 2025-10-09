<?php
// $student = getStudentDataById($conn, $id);
?>

<div class="container pb-4">
  <div class="card border-0" style="background-color: white;">
    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: transparent;">
      <a href="index.php?page=students/all_students" class="smart-link btn btn-warning border border-warning">Back to List</a>
      <p class="mb-0 fw-semibold">Student Profile - <span
          class="fw-normal fst-italic"><?php echo "{$student['surname']} {$student['first_name']} {$student['father_name']} - {$student['gr_no']}"; ?></span>
      </p>
      <a href="index.php?page=students/all_students/view_student/edit_student&id=<?php echo $student['id']; ?>"
        class="smart-link btn btn-success">Edit Profile</a>
    </div>

    <div class="card-body">
      <div class="row g-4">
        <!-- Profile Image -->
        <div class="col-md-2 text-center">
          <img src="assets/default_profile.png" alt="Profile Photo" class="img-fluid rounded-circle border border-2"
            style="width: 150px; height: 150px;">
          <h6 class="mt-3"><?php echo $student['gr_no']; ?></h6>
        </div>

        <!-- Info -->
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Full Name</label>
              <div><?php echo "{$student['surname']} {$student['first_name']} {$student['father_name']}"; ?></div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Father's Name</label>
              <div><?php echo "{$student['surname']} {$student['father_name']}"; ?></div>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Class</label>
              <div><?php echo $student['class']; ?></div>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Division</label>
              <div><?php echo $student['division']; ?></div>
            </div>
            <!-- <div class="col-md-4 mb-3">
              <label class="form-label fw-bold">GR Number</label>
              <div><?php echo $student['gr_no']; ?></div>
            </div> -->
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Roll Number</label>
              <div><?php echo $student['roll_no']; ?></div>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label fw-bold">Gender</label>
              <div><?php echo $student['gender']; ?></div>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label fw-bold">Contact Number</label>
              <div><?php echo $student['contact_no']; ?></div>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label fw-bold">Management Quota</label>
              <div><?php echo $student['management_quota']; ?></div>
            </div>
            <?php
            // Show discount if management quota is 'Yes'
            if (isset($student['management_quota']) && $student['management_quota'] == 'Yes') {
              echo '<div class="col-md-4 mb-3">
                      <label class="form-label fw-bold">Discount</label>
                      <div>' . $student['discount_percentage'] . '%</div>
                    </div>';
            }
            ?>
            <div class="col-md-4 mb-3">
              <label class="form-label fw-bold">Total fees paid</label>
              <div>₹<?php echo $student['total_fees_paid']; ?></div>
            </div>

            <div class="col-md-12 mb-3">
              <label class="form-label fw-bold">Fees record</label>
              <div class="mb-3 overflow-auto" style="max-height: 300px;">
                <table class="table  table-striped">
                  <thead class="table-success">
                    <tr class="table-success">
                      <th>Receipt No</th>
                      <th>Month/Fee type</th>
                      <th>Fees Paid</th>
                      <th>Date</th>
                      <th>Payment mode</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $feesData = getFeesDataByStudentId($conn, $studentGrNo);
                    if (empty($feesData)) {
                      echo '<tr><td colspan="5" class="text-center">No fees data available</td></tr>';
                    } else {
                      foreach ($feesData as $fee) {
                        // format payment date and time
                        $fee['payment_date'] = date('d-M-Y', strtotime($fee['payment_date'])) . ' ' . date('h:i A', strtotime($fee['payment_date']));
                        echo "<tr>
                              <td>{$fee['receipt_no']}</td>
                              <td>{$fee['month_of_payment']}</td>
                              <td>₹{$fee['amount_paid']}</td>
                              <td>{$fee['payment_date']}</td>
                              <td>{$fee['payment_mode']}</td>
                              <td>
                                <a href='index.php?page=students/all_students/view_student/edit_receipt&id={$fee['receipt_no']}' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='index.php?page=payments/delete_fee&id={$fee['receipt_no']}' class='btn btn-sm btn-danger'>Delete</a>
                                <a href='index.php?page=students/all_students/view_student/view_receipt&receiptno={$fee['receipt_no']}' class='btn btn-sm btn-success'>View</a>
                              </td>
                            </tr>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Styling -->
<style>
  .bg-deep-purple-dark {
    background-color: #512da8 !important;
  }
</style>