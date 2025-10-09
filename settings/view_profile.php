<!-- view_profile.php -->
<div class="container pb-4">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card border-0 rounded-0" style="background-color: white;">
                <div class="card-header rounded-0 border-0 d-flex justify-content-between align-items-center" style="background-color: transparent;">
                    <h5 class="mb-0 fw-semibold">Profile Details</h5>
                    <a href="index.php?page=settings/view_profile/profile" class="smart-link btn btn-success">Edit Profile</a>
                </div>
                <div class="text-end">
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="form-label">Full Name</strong>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($profileName); ?></p>
                        </div>
                        <div class="col-md-4">
                            <strong class="form-label">Username</strong>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        </div>
                        <div class="col-md-4">
                            <strong class="form-label">Default Section</strong>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($_SESSION['default_section']); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="form-label">Email Address</strong>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>
                            </p>
                        </div>

                        <div class="col-md-4">
                            <strong class="form-label">Mobile Number</strong>
                            <p class="form-control-plaintext">
                                <?php echo htmlspecialchars($_SESSION['mobile_no'] ?? ''); ?></p>
                        </div>

                        <div class="col-md-4">
                            <strong class="form-label">User Role</strong>
                            <p class="form-control-plaintext">
                                <?php echo htmlspecialchars($_SESSION['role'] ?? 'admin'); ?></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>