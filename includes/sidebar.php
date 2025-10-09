<?php
$currentPage = isset($_GET['page']) ? $_GET['page'] : '';
?>

<style>
    a.nav-link.ps-3.smart-link,
    a.dropdown-item.ps-4.smart-link {
        cursor: pointer
    }
</style>

<div class="min-vh-100 position-fixed text-white vh-100 py-3 col-lg-2" id="sidebar">
    <div class="logo-section mb-3 h-25">
        <img src="<?php echo htmlspecialchars($getSystemInfo['logo']); ?>" alt="School Logo"
            class="logo mx-auto d-block h-100 mb-2" loading="lazy">
    </div>
    <hr class="opacity-50 m-2">
    <div class="offcanvas-body h-75" style="overflow-y: scroll !important; scrollbar-width: none;">
        <div class="nav-bar">
            <ul class="navbar-nav justify-content-end flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link ps-3 smart-link <?php echo ($currentPage == 'dashboard' || empty($currentPage)) ? 'active' : ''; ?>"
                        aria-current="page" href="index.php?page=dashboard">
                        <span class="icon"><i class="fa-solid fa-house me-2"></i></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown" id="studentsDropdown">
                    <a class="nav-link dropdown-toggle ps-3 smart-link <?php echo (strpos($currentPage, 'students/') === 0) ? 'active' : ''; ?>"
                        href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="<?php echo (strpos($currentPage, 'students/') === 0) ? 'true' : 'false'; ?>">
                        <span class="icon"><i class="fa-solid fa-user-graduate me-2"></i></span>
                        Students
                    </a>
                    <ul class="dropdown-menu bg-green-dark border-0 rounded-0 <?php echo (strpos($currentPage, 'students/') === 0) ? 'show' : ''; ?>"
                        id="studentsDropdownMenu">
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'students/all_students') ? 'active' : ''; ?>"
                                href="index.php?page=students/all_students">All Students</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'students/add_student') ? 'active' : ''; ?>"
                                href="index.php?page=students/add_student">Add Students</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'students/view_classwise') ? 'active' : ''; ?>"
                                href="index.php?page=students/view_classwise">View Classwise</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ps-3 smart-link <?php echo (strpos($currentPage, 'payments/') === 0) ? 'active' : ''; ?>"
                        href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="<?php echo (strpos($currentPage, 'payments/') === 0) ? 'true' : 'false'; ?>">
                        <span class="icon"><i class="fa-solid fa-credit-card me-2"></i></span>
                        Payment
                    </a>
                    <ul
                        class="dropdown-menu bg-green-dark border-0 rounded-0 <?php echo (strpos($currentPage, 'payments/') === 0) ? 'show' : ''; ?>">
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'payments/accept_payment') ? 'active' : ''; ?>"
                                aria-expanded="<?php echo (strpos($currentPage, 'payments/accept_payment/') === 0) ? 'true' : 'false'; ?>"
                                href="index.php?page=payments/accept_payment">Accept Fees</a>
                        </li>
                        <?php if ($_SESSION['role'] === 'Admin') { ?>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'payments/edit_data/admin_approval') ? 'active' : ''; ?>"
                                aria-expanded="<?php echo (strpos($currentPage, 'payments/view_payments/') === 0) ? 'true' : 'false'; ?>"
                                href="index.php?page=payments/edit_data/admin_approval">Edit Requests</a>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'payments/edit_data/view_requests') ? 'active' : ''; ?>"
                                aria-expanded="<?php echo (strpos($currentPage, 'payments/view_requests/') === 0) ? 'true' : 'false'; ?>"
                                href="index.php?page=payments/edit_data/view_requests">Requests</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'payments/payment_history') ? 'active' : ''; ?>"
                                aria-expanded="<?php echo (strpos($currentPage, 'payments/payment_history/') === 0) ? 'true' : 'false'; ?>"
                                href="index.php?page=payments/payment_history">Payment History</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'payments/generate_report') ? 'active' : ''; ?>"
                                aria-expanded="<?php echo (strpos($currentPage, 'payments/generate_report/') === 0) ? 'true' : 'false'; ?>"
                                href="index.php?page=payments/generate_report">Fees Report</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ps-3 smart-link <?php echo (strpos($currentPage, 'settings/') === 0) ? 'active' : ''; ?>"
                        href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="<?php echo (strpos($currentPage, 'settings/') === 0) ? 'true' : 'false'; ?>">
                        <span class="icon"><i class="fa-solid fa-user-graduate me-2"></i></span>
                        Settings
                    </a>
                    <ul
                        class="dropdown-menu bg-green-dark border-0 rounded-0 <?php echo (strpos($currentPage, 'settings/') === 0) ? 'show' : ''; ?>">
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'settings/view_profile') ? 'active' : ''; ?>"
                                href="index.php?page=settings/view_profile">Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'settings/add_users') ? 'active' : ''; ?>"
                                href="index.php?page=settings/add_users">Add Users</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'settings/data_settings') ? 'active' : ''; ?>"
                                href="index.php?page=settings/data_settings">Data Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item ps-4 smart-link <?php echo ($currentPage == 'settings/system_info') ? 'active' : ''; ?>"
                                href="index.php?page=settings/system_info">System info</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Function to toggle submenu visibility
    // function togglesubMenu(id) {
    //     const submenu = document.getElementById(id);
    //     if (submenu) { }
    // }

    function setActiveSubmenu(link) {
        // Remove active class from all links
        document.querySelectorAll('.submenu a').forEach(a => {
            a.classList.remove('active-submenu');
        });
        document.querySelectorAll('.menu').forEach(m => {
            m.classList.remove('active');
        });

        // Add active class to clicked link
        link.classList.add('active-submenu');

        // Add active class to parent menu
        const parentMenu = link.closest('.dropdown').querySelector('.menu');
        if (parentMenu) {
            parentMenu.classList.add('active');
        }

        // Store active submenu
        localStorage.setItem('active_submenu', link.href);
    }

    window.addEventListener("DOMContentLoaded", () => {
        // Restore active states
        const activeSubmenuHref = localStorage.getItem('active_submenu');
        if (activeSubmenuHref) {
            const activeLink = document.querySelector(`a[href="${activeSubmenuHref}"]`);
            if (activeLink) {
                setActiveSubmenu(activeLink);
                // Show parent submenu
                const parentSubmenu = activeLink.closest('.submenu');
                if (parentSubmenu) {
                    parentSubmenu.classList.add('show');
                }
            }
        }

        // Handle direct URL navigation
        const currentPage = window.location.href;
        const currentLink = document.querySelector(`a[href="${currentPage}"]`);
        if (currentLink && !activeSubmenuHref) {
            if (currentLink.closest('.submenu')) {
                setActiveSubmenu(currentLink);
            } else {
                currentLink.classList.add('active');
            }
        }
    });
</script>