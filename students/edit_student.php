<?php
// include "../db_connect.php";

// $success = isset($_GET['success']) && $_GET['success'] == '1';

// if (isset($_GET['id'])) {
//   $id = $_GET['id'];
//   $query = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
//   $student = mysqli_fetch_assoc($query);

//   if (!$student) {
//     echo "<div class='alert alert-danger'>Student not found.</div>";
//     exit;
//   }
// } else {
//   echo "<div class='alert alert-warning'>No student ID provided.</div>";
//   exit;
// }
?>

<div class="container mb-4">
    <!-- Optional success alert (fake) -->
    <div class="alert alert-success alert-dismissible fade d-none" role="alert">
        Student details updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card border-0 rounded-0" style="background-color: white;">
                <div class="card-header d-flex justify-content-between border-0" style="background-color: transparent;">
                    <h5 class="mb-0 fw-semibold">Edit Student - John Doe</h5>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete</button>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="John Doe" required>
                            <div class="invalid-feedback">Full name is required.</div>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Roll No</label>
                            <input type="text" class="form-control" value="1023" required>
                            <div class="invalid-feedback">Roll number is required.</div>
                        </div> -->

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">GR Number</label>
                                <input type="number" class="form-control" id="grNo" placeholder="Enter GR No."
                                    value="1023" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Roll Number</label>
                                <input type="number" class="form-control" id="rollNo" placeholder="Enter Roll No."
                                    value="1023" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Class</label>
                                <select class="form-select" required>
                                    <option disabled value="">Choose...</option>
                                    <option>Class 1</option>
                                    <option>Class 2</option>
                                    <option>Class 3</option>
                                    <option>Class 4</option>
                                    <option>Class 5</option>
                                    <option>Class 6</option>
                                    <option>Class 7</option>
                                    <option>Class 8</option>
                                    <option>Class 9</option>
                                    <option selected>Class 10</option>
                                </select>
                                <div class="invalid-feedback">Class is required.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Division</label>
                                <input type="text" class="form-control" value="A" required>
                                <div class="invalid-feedback">Section is required.</div>
                            </div>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" required>
                                <option disabled value="">Choose...</option>
                                <option selected>Male</option>
                                <option>Female</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="9876543210">
                        </div> -->

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" required>
                                <div class="invalid-feedback">DOB is required.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select class="form-select" required>
                                    <option disabled value="">Choose...</option>
                                    <option selected>Male</option>
                                    <option>Female</option>
                                    <!-- <option>Other</option> -->
                                </select>
                                <div class="invalid-feedback">Please select gender.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phone</label>
                                <input type="number" class="form-control" placeholder="Enter phone number"
                                    value="9876543210" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php?page=students/all_students" onclick="showMessage(event)"
                                class="smart-link btn btn-success">Update</a>

                            <a href="index.php?page=students/all_students" class="smart-link btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <form>
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete student <strong>John Doe</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Validation Script -->
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', e => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
    function showMessage(event) {
        event.preventDefault(); // Prevent default link behavior
        // Show success message
        const alert = document.querySelector('.alert');
        alert.classList.remove('d-none');
        alert.classList.add('show');
        // Hide the alert after 3 seconds
        setTimeout(() => {
            alert.classList.add('d-none');
        }, 3000);
    }
</script>