<div class="container pb-4">
    <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header border-0 border-bottom" style="background-color: transparent;">
            <ul class="nav nav-tabs card-header-tabs" id="studentTabs" role="tablist">
                <li class="nav-item col-md-6">
                    <button class="nav-link active text-green w-100" id="manual-tab" data-bs-toggle="tab"
                        data-bs-target="#manual" type="button" role="tab">Add Manually</button>
                </li>
                <li class="nav-item col-md-6">
                    <button class="nav-link text-green w-100" id="bulk-tab" data-bs-toggle="tab" data-bs-target="#bulk"
                        type="button" role="tab">Bulk Upload</button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content">
            <!-- Manual Add Tab -->
            <div class="tab-pane fade show active" id="manual" role="tabpanel">
                <form class="needs-validation" id="manual-form" novalidate>
                    <div class="manual-rows" id="manual-rows">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter full name" required>
                            <div class="invalid-feedback">Full name is required.</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">GR Number</label>
                                <input type="text" class="form-control" id="grNo" placeholder="Enter GR No." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Roll Number</label>
                                <input type="number" class="form-control" id="rollNo" placeholder="Enter Roll No."
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Class</label>
                                <select class="form-select" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option>Class 1</option>
                                    <option>Class 2</option>
                                    <option>Class 3</option>
                                    <option>Class 4</option>
                                    <option>Class 5</option>
                                    <option>Class 6</option>
                                    <option>Class 7</option>
                                    <option>Class 8</option>
                                    <option>Class 9</option>
                                    <option>Class 10</option>
                                </select>
                                <div class="invalid-feedback">Class is required.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Division</label>
                                <input type="text" class="form-control" placeholder="e.g. A">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" required>
                                <div class="invalid-feedback">DOB is required.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select class="form-select" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <!-- <option>Other</option> -->
                                </select>
                                <div class="invalid-feedback">Please select gender.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2" placeholder="Enter address"></textarea>
                        </div>
                    </div>
                    <div class="form-actions d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary add-another-button">+ Add another</button>
                        <button type="submit" class="btn btn-success add-student-button">Add student</button>
                        <a href="index.php?page=students/all_students" class="smart-link btn btn-danger">Back</a>
                    </div>
                </form>
            </div>

            <!-- Bulk Upload Tab -->
            <div class="tab-pane fade" id="bulk" role="tabpanel">
                <p class="text-muted fw-normal">Only .xlsx files accepted. Make sure to follow the format.</p>
                <div class="d-flex gap-3 mb-3">
                    <!-- <a class ="smart-link"href="/sample/student_format.xlsx" download class="btn btn-outline-primary">
                        Download Format
                    </a> -->
                    <button class="btn btn-outline-primary" onclick="downloadFormat()">
                        Download Format
                    </button>

                    <form class="d-flex gap-2 align-items-center" enctype="multipart/form-data">
                        <input type="file" class="form-control" accept=".xlsx" required>
                        <button type="submit" class="btn btn-success">Upload Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS: Roll number generator & validation -->
<script>
    // Dummy auto-generate roll number (you can link this to database max+1 logic)
    document.addEventListener("DOMContentLoaded", function () {
        // const rollInput = document.getElementById("rollNo");
        // if (rollInput) {
        //     rollInput.value = Math.floor(Math.random() * 1000);
        // }
        // const grInput = document.getElementById("grNo");
        // if (grInput) {
        //     grInput.value =  Math.floor(Math.random() * 100000);
        // }

        // Bootstrap validation
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

        // function addAnotherStudent() {
        //     const formRow = document.getElementById("manual-rows").cloneNode(true);
        //     formRow.querySelectorAll("input, select, textarea").forEach(input => {
        //         input.value = ""; // Clear values for new row
        //         input.classList.remove("is-valid", "is-invalid"); // Reset validation classes
        //     });
        //     const form = document.getElementById("manual-form");
        //     form.appendChild(formRow);
        // }
        document.querySelector(".add-another-button").addEventListener("click", () => {
            const formRow = document.getElementById("manual-rows").cloneNode(true);
            const form = document.getElementById("manual-form");
            const hr = document.createElement("hr");
            // add class in hr
            hr.classList.add("opacity-50");
            form.insertBefore(hr, form.querySelector(".form-actions"));
            form.insertBefore(formRow, form.querySelector(".form-actions"));
            formRow.querySelectorAll("input, select, textarea").forEach(input => {
                input.value = ""; // Clear values for new row
                input.classList.remove("is-valid", "is-invalid"); // Reset validation classes
            });
            // remove clone formRow on switching tabs
            const tabButtons = document.querySelectorAll('.nav-link');
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    formRow.remove();
                    hr.remove();
                });
            });
        });
    });
    function downloadFormat() {
        const link = document.createElement('a');
        link.href = 'sample/student_format.xlsx'; // Adjust path if needed
        link.download = 'student_format.xlsx';    // Optional: rename during download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

</script>

<!-- Optional Styling -->
<style>
    .nav-item .active {
        color: black !important;
    }
</style>