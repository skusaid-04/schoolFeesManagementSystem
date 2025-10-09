<div class="container pb-4">
    <div class="card border-0 rounded-0">
        <div class="card-header border-0 rounded-0">
            <h5 class="mb-0 fw-semibold">Generate Fee Report</h5>
        </div>
        <div class="card-body">

            <!-- Filter Form -->
            <form method="GET" id="reportFilterForm" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">Select Month</label>
                    <input type="month" name="month" class="form-control" required>
                </div>

                <!-- generate by class or section -->

                <div class="col-md-3">
                    <label class="form-label">Select method</label>
                    <select name="method" class="form-select">
                        <option value="class" selected>By Class</option>
                        <option value="section">By Section</option>
                        <option value="student">By Student</option>
                        <option value="all">All Students</option>
                    </select>
                </div>

                <!-- <div class="col-md-3">
                    <label class="form-label">Select Section</label>
                    <select name="section_id" class="form-select">
                        <option value="">All Sections</option>
                        <option value="1">Primary</option>
                        <option value="2">Secondary</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Select Class</label>
                    <select name="class_id" class="form-select">
                        <option value="">All Classes</option>
                        <option value="1">Nursery</option>
                        <option value="2">KG</option>
                        <option value="3">1st</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Search Student</label>
                    <input type="text" name="student" class="form-control" placeholder="Name or GR No">
                </div> -->

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">View Report</button>
                </div>
            </form>

            <!-- Buttons -->
            <div class="d-flex gap-3 mb-4">
                <form method="POST" action="download_report.php" target="_blank">
                    <input type="hidden" name="format" value="pdf">
                    <input type="hidden" name="filters" id="pdfFilters">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                    </button>
                </form>

                <form method="POST" action="download_report.php" target="_blank">
                    <input type="hidden" name="format" value="excel">
                    <input type="hidden" name="filters" id="excelFilters">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel-fill"></i> Download Excel
                    </button>
                </form>
            </div>

            <!-- Report Table Placeholder -->
            <div id="reportResult">
                <p class="text-muted">Please select filters and click "View Report" to see data.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>GR No</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Month</th>
                                <th>Paid Amount (₹)</th>
                                <th>Due Amount (₹)</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>GR001</td>
                                <td>Ahmed Khan</td>
                                <td>5th</td>
                                <td>August 2025</td>
                                <td>1200</td>
                                <td>0</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>2025-08-03</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>GR002</td>
                                <td>Sara Sheikh</td>
                                <td>5th</td>
                                <td>August 2025</td>
                                <td>0</td>
                                <td>1200</td>
                                <td><span class="badge bg-danger">Unpaid</span></td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>GR003</td>
                                <td>Faisal Khan</td>
                                <td>4th</td>
                                <td>August 2025</td>
                                <td>600</td>
                                <td>600</td>
                                <td><span class="badge bg-warning text-dark">Partial</span></td>
                                <td>2025-08-02</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    const reportForm = document.getElementById('reportFilterForm');
    const pdfFilters = document.getElementById('pdfFilters');
    const excelFilters = document.getElementById('excelFilters');

    reportForm.addEventListener('submit', function () {
        const formData = new FormData(reportForm);
        const filterObj = {};
        for (const [key, value] of formData.entries()) {
            filterObj[key] = value;
        }
        const filters = JSON.stringify(filterObj);
        pdfFilters.value = filters;
        excelFilters.value = filters;
    });
</script>