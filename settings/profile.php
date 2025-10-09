<!-- profile.php -->
<style>
  .bg-deep-purple-dark {
    background-color: #512da8 !important;
  }
</style>


<div class="container pb-4">
  <div class="row justify-content-center">
    <div class="col-md">
      <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header rounded-0 border-0" style="background-color: transparent;">
          <h5 class="mb-0 fw-semibold">My Profile</h5>
        </div>
        <div class="card-body">
          <form method="post" action="update_profile.php">
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $profileName; ?>"
                  required>
              </div>
              <div class="col-md-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="profileUsername" name="username" class="form-control"
                  value="<?php echo $_SESSION['username']; ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="section" class="form-label mb-0">Default section:</label>
                <select name="section" id="setSection" class="form-select" onchange="this.form.submit()">
                  <?php echo getSectionOptions($conn, $activeSection); ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control"
                  value="<?php echo $_SESSION['email'] ?? ''; ?>" required>
              </div>

              <div class="col-md-4">
                <label for="phone" class="form-label">Mobile Number</label>
                <input type="text" id="phone" name="phone" class="form-control"
                  value="<?php echo $_SESSION['mobile_no'] ?? ''; ?>">
              </div>

              <div class="col-md-4">
                <label for="role" class="form-label">User Role</label>
                <input type="text" id="profileuserRole" name="user-role" class="form-control"
                  value="<?php echo $_SESSION['role'] ?? 'admin'; ?>" readonly>
              </div>
            </div>


            <hr>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep
                    current)</small></label>
                <input type="password" id="newPassword" name="password" class="form-control" placeholder="********">
              </div>

              <div class="col-md-6">
                <label for="password" class="form-label">Confirm New Password</label>
                <input type="password" id="newConfirmPassword" name="confirm-password" class="form-control"
                  placeholder="********">
              </div>
            </div>
            <div class="d-flex justify-content-end ">
              <a href="index.php?page=settings/view_profile" type="submit" class="smart-link btn btn-danger me-2">Cancel</a>
              <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#profileFeeModal">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>