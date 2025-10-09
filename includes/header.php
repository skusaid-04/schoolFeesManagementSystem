<?php
// session_start();
// require_once "php/config.php"; // adjust this as needed

$profileName = $_SESSION['profile_name'] ?? 'User';
$firstLetter = strtoupper(substr($profileName, 0, 1));
$profileImage = $_SESSION['profile_image'] ?? '';
$defaultSection = $_SESSION['default_section'] ?? 'Primary';

// If section is selected via form, store it in session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['section'])) {
    $_SESSION['active_section'] = $_POST['section'];
    // header("Location: " . $_SERVER['PHP_SELF']); // Avoid resubmission warning
    // exit;
}

// Use session or default
// $activeSection = $_SESSION['active_section'] ?? $defaultSection;

// echo $activeSection; // Debugging line to check active section
?>



<div class="header-left">
    <form id="sectionSwitcher" method="POST" class="d-flex align-items-center gap-2">
        <label for="section" class="form-label mb-0">Section:</label>
        <select name="section" id="section" class="form-select" onchange="this.form.submit()">
            <?php echo getSectionOptions($conn, $activeSection); ?>
        </select>
    </form>
</div>


<div class="header-right d-flex align-items-center">
    <div class="profile d-flex align-items-center me-4" style="cursor: pointer;">
        <!-- Example split danger button -->
        <div class="btn-group align-items-center" style="user-select: none;">
            <?php if (!empty($profileImage)) { ?>
                <img src="<?php echo $profileImage; ?>" alt="Profile Picture" class="profile-img">
            <?php } else { ?>
                <div class="profile-placeholder d-flex text-center justify-content-center align-items-center text-white fw-bold me-2 rounded-circle text-uppercase"
                    style="background-color: <?php
                    function getRandomColor(): string
                    {
                        $colors = ['#1b5e20', '#ff5722', '#3f51b5', '#e91e63', '#ff9800', '#009688', '#673ab7'];
                        return $colors[array_rand($colors)];
                    }
                    $randomColor = getRandomColor();
                    echo $randomColor;
                    ?>; width: 40px; height: 40px; font-size: 20px;">
                    <?php
                    echo $firstLetter;
                    ?>

                </div>
            <?php } ?>
            <div class="profile-info d-flex flex-column">
                <span class="profile-name fw-semibold text-black"><?php
                // Use a session variable to store the profile name
                $profileName = isset($_SESSION['profile_name']) && !empty($_SESSION['profile_name']) ? $_SESSION['profile_name'] : 'User';
                echo $profileName;
                ?></span>
                <div class="position fs-6 text-secondary"><?php
                echo $_SESSION['role'] ?? 'admin';
                ?></div>
            </div>
            <!-- <button type="button" class="btn btn-danger">Danger</button> -->
            <button type="button" class="btn bg-white dropdown-toggle dropdown-toggle-split border-0"
                data-bs-toggle="dropdown" aria-expanded="false">
            </button>
            <ul class="dropdown-menu">
                <li><a class ="smart-link dropdown-item" href="index.php?page=settings/view_profile">Profile</a></li>
                <li><a class ="smart-link dropdown-item" href="index.php?page=settings/data_settings">Data Setting</a></li>
                <li><a class ="smart-link dropdown-item" href="index.php?page=settings/system_settings">Syetem Setting</a></li>
            </ul>
        </div>
    </div>
    <!-- Change the sign-out button to a link that calls signout.php -->
    <a href="./auth/logout.php"
        class="sign-out-btn btn btn-success text-white text-decoration-none text-center fw-normal smart-link "
        style="background-color: #1b5e20; padding: 8px 15px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer; display: inline-block;">Sign
        Out</a>
</div>