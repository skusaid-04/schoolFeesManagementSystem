<!-- all_students.php -->
<?php
// include 'get_data/get_student_data.php';
?>

<div class="container pb-4">
  <div class="card border-0 rounded-0" style="background-color: white;">
    <div class="card-header d-flex justify-content-between align-items-centerrounded-0 border-0" style="background-color: transparent;">
      <h5 class="mb-0 fw-semibold">All Students</h4>
      <a href="index.php?page=students/add_student" class="smart-link btn btn-success btn-sm">Add New Student</a>
    </div>

    <div class="card-body">
      <!-- Search -->
      <div class="row mb-3">
        <div class="col-md-6">
          <input type="text" id="searchInput" class="form-control" placeholder="Search by name, class, or roll no.">
        </div>
      </div>

      <!-- Student Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="studentsTable">
          <thead class="table-success">
            <tr>
              <th>#</th>
              <th>GR No</th>
              <th>Roll No</th>
              <th>Full Name</th>
              <th>Class</th>
              <th>Division</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Example data, replace with DB query
            // $getAllStudentData = []; // Fetch from database
            if (empty($getAllStudentData)) {
              echo '<tr><td colspan="9" class="text-center">No students found</td></tr>';
            }
            // $getAllStudentData['name'] = $getAllStudentData['surname'] + $getAllStudentData['first_name'] + $getAllStudentData['father_name'];
            $i = 1;
            foreach ($getAllStudentData as $student) {
              echo "<tr>
                <td>{$i}</td>
                <td>{$student['gr_no']}</td>
                <td>{$student['roll_no']}</td>
                <td> {$student['surname']} {$student['first_name']} {$student['father_name']}</td>
                <td>{$student['class']}</td>
                <td>{$student['division']}</td>
                <td>{$student['gender']}</td>
                <td>{$student['contact_no']}</td>
                <td>
                  <a onclick='anchorButton()' href='index.php?page=students/all_students/view_student&id={$student['id']}' class='smart-link btn btn-sm btn-info'>View</a>
                  <a onclick='anchorButton()' href='#' class='btn btn-sm btn-danger smart-link'>Delete</a>
                </td>
              </tr>";
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>
