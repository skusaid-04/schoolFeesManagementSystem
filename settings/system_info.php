<?php

?>

<div class="container pb-5">
    <div class="card border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">System Information</h5>
            <?php if ($_SESSION['role'] === 'Admin') { ?>
                <a href="index.php?page=settings/system_settings" class="smart-link btn btn-success">Edit Settings</a>
            <?php } ?>
        </div>
        <div class="card-body">


            <dl class="row">
                <dt class="col-sm-4">System Name</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['system_name']; ?></dd>

                <dt class="col-sm-4">School Name</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['school_name']; ?></dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['email']; ?></dd>

                <dt class="col-sm-4">Phone</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['phone']; ?></dd>

                <dt class="col-sm-4">Address</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['address']; ?></dd>

                <dt class="col-sm-4">Academic Year</dt>
                <dd class="col-sm-8"><?php echo $getSystemInfo['academic_year']; ?></dd>

                <dt class="col-sm-4">Logo</dt>
                <dd class="col-sm-8">
                    <img src="<?php echo htmlspecialchars($getSystemInfo['logo']); ?>" alt="Logo"
                        style="height: 100px;">
                </dd>

            </dl>
            <?php if ($_SESSION['role'] === 'Admin') { ?>
                <div class="row g-3 align-items-end justify-content-start">

                    <div class="col-md-4">
                        <button class="btn btn-success w-100" id="downloadBackupBtn"
                            onclick="downloadBackup()">Download
                            Latest Backup</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100" id="generateFeeReportBtn"
                            onclick="generateFeeReport()">Generate Fee Report</button>
                    </div>
                </div>
            <?php } ?>

            <!-- <div class="text-end mt-4">
            </div> -->

        </div>
    </div>
</div>
<script>
    function generateFeeReport() {
        // Implement the logic to generate the fee report
        // redirect to the report generation page or trigger a download
        window.location.href = 'index.php?page=settings/generate_report';
        // alert("Generating Fee Report...");
    }

    function downloadBackup() {
        fetch('settings/backup.php')
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    console.log("Backup created:", data);

                    // Download trigger
                    const a = document.createElement('a');
                    a.href = data.file; // backend ne relative path diya hai
                    a.download = data.file.split('/').pop();
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(err => console.error("Fetch error:", err));
    }

</script>
<?php
// download backup file from localhost server
?>
</body>

</html>