<!-- add_users.php -->

<div class="container pb-4">
  <div class="row justify-content-center">
    <div class="col-md">
      <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header rounded-0 border-0" style="background-color: transparent;">
          <h5 class="mb-0 fw-semibold">Add New User</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="save_user.php">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Name" required>
              </div>

              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="profileUsername" name="username" placeholder="Enter username"
                  required>
              </div>
            </div>
            <div class="row mb-3">


              <div class="col-md-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address"
                  required>
              </div>

              <div class="col-md-4">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone number">
              </div>

              <div class="col-md-4">
                <label for="role" class="form-label">User Role</label>
                <select class="form-select" id="role" name="role" required>
                  <option value="">-- Select Role --</option>
                  <option value="admin">Admin</option>
                  <option value="staff">Staff</option>
                </select>
              </div>
            </div>

            <hr>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="password" class="form-label">Password </label>
                <!-- <label for="password" class="form-label">Password <small><i>(leave blank if no need)</i></small></label> -->
                <input type="password" class="form-control" id="newPassword" name="password" placeholder="*********">
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="password" placeholder="*********">
              </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="submit" class="btn btn-success">Add User</button>
              <a href="index.php?page=settings/add_users" class="smart-link btn btn-danger">Reset</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>