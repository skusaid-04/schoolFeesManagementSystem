<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
  // Not admin → redirect to dashboard
  die("<script>
    window.location.href = 'index.php?page=dashboard';
    </script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Process form submission to update settings
  // Validate and sanitize input data here

  // Example: Update system name and email
  $system_name = htmlspecialchars(trim($_POST['system_name'] ?? ''));
  $school_name = htmlspecialchars(trim($_POST['school_name'] ?? ''));
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
  $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
  $address = htmlspecialchars(trim($_POST['address'] ?? ''), ENT_QUOTES, 'UTF-8');
  $end_year = date('Y', strtotime($_POST['end_month']));
  $start_year = date('Y', strtotime($_POST['start_month']));
  $start_month = date('F', strtotime($_POST['start_month']));
  $end_month = date('F', strtotime($_POST['end_month']));
  // $start_month = htmlspecialchars(trim(strtotime('F' . ($_POST['start_month'] ?? ''))));
  // $end_month = htmlspecialchars(trim(strtotime('F' . ($_POST['end_month'] ?? ''))));
  $logo = $_FILES['logo'] ?? null;
  $academic_year = "$start_year-$end_year";
  $academic_month = "$start_month-$end_month";


  function logenerateImageName($originalName)
  {
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    $newName = uniqid('img_', true) . '.' . $extension;
    return $newName;
  }



  $oldLogo = $conn->query("SELECT logo FROM system_info WHERE id=1")->fetch_assoc()['logo'];
  // Delete old logo if a new one is uploaded from uploads/logo folder
  if ($logo_path !== '' && $oldLogo && file_exists($oldLogo)) {
    // Delete the old logo file
    unlink($oldLogo);
  }

  $oldInfo = $conn->query("SELECT * FROM system_info WHERE id=1")->fetch_assoc();
  if (($oldInfo['logo'] && file_exists($oldInfo['logo']) && $logo_path === '') || $school_name === '' || $email === false || $phone === '' || $address === '' || $start_year === '' || $end_year === '' || $start_month === '' || $end_month === '') {
    $logo_path = $oldInfo['logo'];
    $school_name = $oldInfo['school_name'];
    $email = $oldInfo['email'];
    $phone = $oldInfo['phone_no'];
    $address = $oldInfo['address'];
    $academic_year = $oldInfo['academic_year'];
    // $end_year = $oldInfo['academic_year'];
    $academic_month = $oldInfo['academic_month'];
    // $end_month = $oldInfo['academic_month'];
  }

  // Perform database update operations here
  $logo_path = '';
  if ($logo && $logo['error'] === UPLOAD_ERR_OK) {
    if ($logo['size'] > 2 * 1024 * 1024)
      die('Too large');
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($logo['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
      die('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
    }


    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($logo['tmp_name']);
    $validMimes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($mime, $validMimes))
      die('Invalid MIME');

    $logo_name = logenerateImageName($logo['name']);
    $logo_path = "uploads/logo/$logo_name";
    if (!is_dir('uploads/logo')) {
      mkdir('uploads/logo', 0777, true);
    }
    if (move_uploaded_file($logo['tmp_name'], $logo_path)) {
      $logo_path = htmlspecialchars($logo_path, ENT_QUOTES, 'UTF-8');
    }
  }

  // Example SQL (use prepared statements in real code):
  $sql = "UPDATE system_info SET school_name=?, email=?, phone_no=?, address=?, academic_year=?, logo=?, academic_month=? WHERE id=1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssss", $school_name, $email, $phone, $address, $academic_year, $logo_path, $academic_month);
  $stmt->execute();


  // Return success or error message
  echo "<script>alert('Settings updated successfully');
    console.log('$system_name, $school_name, $email, $phone, $address, $start_year-$end_year', '$logo_path', '$start_month-$end_month');
    </script>";
  // redirect or reload the page after processing
  echo "<script>window.location.href = 'index.php?page=settings/system_settings';</script>";
  exit;
}
?>
<style>
  .tooltip-container {
    position: relative;
    display: inline-block;
  }

  .tooltip-container .tooltip-text {
    visibility: hidden;
    width: 190px;
    background-color: #00000069;
    color: #fff;
    text-align: center;
    padding: 5px;
    border-radius: 6px;
    position: absolute;
    z-index: 1;
    bottom: -80%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
    font-size: smaller;
  }

  .tooltip-container:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
  }

  .tooltip-container:hover .tooltip-text {
    animation: hideTooltip 1s forwards;
    /* tooltip stays 3s then hides */
  }

  @keyframes hideTooltip {
    0% {
      visibility: visible;
    }

    /* 80% { opacity: 1; } */
    100% {
      visibility: hidden;
    }
  }
</style>
<div class="container pb-4">
  <div class="card border-0 rounded-0" style="background-color: white;">
    <form method="POST" enctype="multipart/form-data" id="settingsForm">
      <div class="card-header rounded-0 border-0" style="background-color: transparent;">
        <h5 class="mb-0 fw-semibold">System Settings</h5>
      </div>
      <div class="card-body">

        <!-- Basic System Information -->
        <div class="mb-4">
          <h6 class="section-title mb-3">Basic Information</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">System Name</label>
              <input type="text" name="system_name" class="form-control" placeholder="e.g. Fee Manager Portal">
            </div>
            <div class="col-md-6">
              <label class="form-label">School Name</label>
              <input type="text" name="school_name" class="form-control" placeholder="e.g. Green Valley School">
            </div>
            <div class="col-md-4">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="admin@school.com">
            </div>
            <div class="col-md-4">
              <label class="form-label">Phone</label>
              <input type="tel" name="phone" class="form-control" placeholder="+91 9876543210">
            </div>
            <div class="col-md-4 tooltip-container" id="logoDiv">
              <label class="form-label">Upload Logo</label>
              <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png,.gif" id="logoInput"><span
                class="tooltip-text">Please upload transparent background image</span>
            </div>
            <div class="col-md-12">
              <label class="form-label">Address</label>
              <textarea class="form-control" rows="2" name="address" placeholder="School Address..."></textarea>
            </div>
          </div>
        </div>

        <hr>

        <!-- Academic Year Settings -->
        <div class="mb-4">
          <h6 class="section-title mb-3">Academic Year Settings</h6>
          <div class="row g-3">
            <!-- <div class="col-md-6"> -->
            <!-- <label class="form-label">Current Academic Year</label> -->

            <!-- <div class="row"> -->
            <!-- <div class="col-md-3">
              <label for="start_year" class="form-label">Start Year</label>
              <input type="text" class="form-control" id="yearPicker" name="start_year" placeholder="YYYY">
            </div>
            <div class="col-md-3">
              <label for="end_year" class="form-label">End Year</label>
              <input type="text" class="form-control" id="yearPicker" name="end_year" placeholder="YYYY">
            </div> -->
            <!-- </div> -->

            <!-- </div> -->
            <div class="col-md-3">
              <label class="form-label">Start of the year</label>
              <input type="month" name="start_month" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">End</label>
              <input type="month" name="end_month" class="form-control">
            </div>
          </div>
        </div>

        <hr>

        <!-- Security Settings -->
        <!-- <div class="mb-4">
          <h6 class="section-title mb-3">Security Settings</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Max Login Attempts</label>
              <input type="number" class="form-control" value="3" min="1">
            </div>
            <div class="col-md-6">
              <div class="form-check form-switch mt-4 pt-1">
                <input class="form-check-input" type="checkbox" id="showAdminLogins" checked>
                <label class="form-check-label" for="showAdminLogins">Show Admin Logins</label>
              </div>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="trackChanges" checked>
                <label class="form-check-label" for="trackChanges">Track Admin Changes</label>
              </div>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="googleSheetSync">
                <label class="form-check-label" for="googleSheetSync">Enable Google Sheet Sync</label>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <hr> -->
        <!-- Appearance & Behavior -->
        <!-- <div class="mb-4">
          <h6 class="section-title mb-3">Appearance & Behavior</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Default Section</label>
              <select class="form-select">
                <option>Primary</option>
                <option>Secondary</option>
                <option>Higher Secondary</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-check form-switch mt-4 pt-1">
                <input class="form-check-input" type="checkbox" id="enableDoubleClick">
                <label class="form-check-label" for="enableDoubleClick">Enable Double Click to Change Section</label>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <hr> -->
        <!-- Database Backup / Restore -->
        <div class="mb-4">
          <h6 class="section-title mb-3">Database Backup & Restore</h6>
          <div class="row g-3 align-items-end">
            <div class="col-md-4">
              <button class="btn btn-outline-success w-100">Backup Now</button>
            </div>
            <!-- <div class="col-md-4">
            <a href="backup/db_backup.sql" download class="smart-link btn btn-outline-primary w-100">Download Latest
              Backup</a>
          </div> -->
            <div class="col-md-4">
              <input type="file" class="form-control" accept=".sql">
              <!-- <small class="text-muted">Upload .sql to restore</small> -->
            </div>
          </div>
        </div>

        <!-- Save Button -->
        <div class="text-end mt-4">
          <button class="btn btn-success" id="saveSettingsBtn">Save All Settings</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.getElementById('logoInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
      const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
      if (!validTypes.includes(file.type)) {
        alert('Please select a valid image file (JPEG, PNG, GIF, JPG).');
        event.target.value = ''; // Clear the input
      }
      const maxFileSize = 2 * 1024 * 1024;
      if (file.size > maxFileSize) {
        alert('File size exceeds 2MB. Please select a smaller file.');
        event.target.value = ''; // Clear the input
      }
    }
  });

  const startMonth = document.getElementById('start_month');
  const endMonth = document.getElementById('end_month');

  startMonth.addEventListener('change', function () {
    // End month ka minimum value hamesha start month ke barabar ya uske baad ho
    endMonth.min = startMonth.value;

    // Agar pehle se selected value chhoti hai to reset kar do
    if (endMonth.value < startMonth.value) {
      endMonth.value = "";
    }
  })

  // $('#yearPicker').datepicker({
  //     format: "yyyy",         // show only year format
  //     viewMode: "years",      // start view is years
  //     minViewMode: "years",   // only year selection
  //     autoclose: true         // close picker on selection
  // });
</script>