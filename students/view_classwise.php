<div class="container pb-4">
  <div class="card border-0 rounded-0" style="background-color: white;">
    <div class="card-header d-flex justify-content-between align-items-center rounded-0 border-0" style="background-color: transparent;">
      <h5 class="mb-0 fw-semibold">View Students - Classwise</h5>
      <div class="btn-group">
        <button class="btn btn-sm btn-outline-light" onclick="exportCSV()">Export CSV</button>
        <button class="btn btn-sm btn-outline-light" onclick="exportPDF()">Export PDF</button>
      </div>
    </div>

    <div class="card-body">
      <form class="row g-3 mb-4">
        <div class="col-md-4">
          <label class="form-label">Select Class</label>
          <select class="form-select" required>
            <option selected disabled value="">Choose Class</option>
            <option>1</option>
            <option>2</option>
            <option>10</option>
            <option>12</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Select Divison</label>
          <select class="form-select">
            <option selected disabled value="">Choose Division</option>
            <option>A</option>
            <option>B</option>
            <option>C</option>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-success w-100">Search</button>
        </div>
      </form>

      <!-- Result Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center" id="studentTable">
          <thead class="table-success">
            <tr>
              <th>GR No</th>
              <th>Roll No</th>
              <th>Full Name</th>
              <th>Class</th>
              <th>Division</th>
              <th>DOB</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Dummy Data -->
            <tr>
              <td>STU10001</td>
              <td>1001</td>
              <td>Ali Khan</td>
              <td>10</td>
              <td>A</td>
              <td>2008-04-15</td>
              <td>Male</td>
              <td>0312-1234567</td>
              <td>
                <a href="index.php?page=students/view_classwise/view_student" class="smart-link btn btn-sm btn-info">View</a>
                <a href="index.php?page=students/view_classwise/edit_student" class="smart-link btn btn-sm btn-warning">Edit</a>
              </td>
            </tr>
            <tr>
              <td>STU10002</td>
              <td>1002</td>
              <td>Sara Iqbal</td>
              <td>10</td>
              <td>A</td>
              <td>2008-08-21</td>
              <td>Female</td>
              <td>0321-9876543</td>
              <td>
                <a href="index.php?page=students/view_classwise/view_student" class="smart-link btn btn-sm btn-info">View</a>
                <a href="index.php?page=students/view_classwise/view_student/edit_student" class="smart-link btn btn-sm btn-warning">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <nav aria-label="Student pagination">
        <ul class="pagination justify-content-center mt-3">
          <li class="page-item disabled"><a class ="smart-link page-link">«</a></li>
          <li class="page-item active"><a class ="smart-link page-link">1</a></li>
          <li class="page-item"><a class ="smart-link page-link">2</a></li>
          <li class="page-item"><a class ="smart-link page-link">3</a></li>
          <li class="page-item"><a class ="smart-link page-link">»</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- JavaScript for CSV and PDF Export -->
<script>
  function exportCSV() {
    let table = document.getElementById("studentTable");
    let rows = Array.from(table.rows);
    let csv = rows.map(row => 
      Array.from(row.cells).map(cell => `"${cell.innerText}"`).join(",")
    ).join("\n");

    let blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
    let url = URL.createObjectURL(blob);
    let a = document.createElement("a");
    a.href = url;
    a.download = "classwise_students.csv";
    a.click();
  }

  function exportPDF() {
    alert("PDF export requires backend or JS library like jsPDF.\n(Not implemented in this frontend-only version.)");
  }
</script>

<style>
  .bg-deep-purple-dark {
    background-color: #512da8 !important;
  }
</style>
