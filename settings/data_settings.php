<?php
$users = $conn->query("SELECT * FROM login_admins");
?>
<?php
// if ($_SESSION['role'] == 'Admin') {
?>

<div class="container pb-4">
    <div class="card border-0 rounded-0" style="background-color: white;">
        <div class="card-header d-flex justify-content-between align-items-center rounded-0 border-0"
            style="background-color: transparent;">
            <h5 class="mb-0 fw-semibold">Data Settings</h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-green active" id="sections-tab" data-bs-toggle="tab"
                        data-bs-target="#sections" type="button" role="tab">Academics</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link text-green" id="classes-tab" data-bs-toggle="tab" data-bs-target="#classes"
                        type="button" role="tab">Classes / Division</button>
                </li> -->
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link text-green" id="divisions-tab" data-bs-toggle="tab"
                        data-bs-target="#divisions" type="button" role="tab">Divisions</button>
                </li> -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-green" id="users-tab" data-bs-toggle="tab" data-bs-target="#users"
                        type="button" role="tab">Portal Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-green" id="feesMaster-tab" data-bs-toggle="tab"
                        data-bs-target="#feesMaster" type="button" role="tab">Fees Master</button>
                </li>
            </ul>

            <div class="tab-content" id="settingsTabContent">
                <!-- SECTIONS TAB -->
                <div class="tab-pane fade show active" id="sections" role="tabpanel">
                    <div class="row g-2 justify-content-between">
                        <!-- Sections column -->
                        <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Sections</h5>
                                <button type="submit" class="btn btn-success"
                                    onclick="openModal('add_section_modal')">Add Section</button>
                                <!-- <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addSectionModal">Add Section</button> -->
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-hover overflow-auto" id="getSectionTable">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Section Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sectionList">
                                        <?php
                                        // $sections = $conn->query("SELECT * FROM sections");
                                        // if ($sections->num_rows > 0) {
                                        //     $counter = 1; // Start the counter
                                        //     while ($section = $sections->fetch_assoc()) {
                                        //         echo "<tr>
                                        //     <td>{$counter}</td>
                                        //     <td>{$section['section_name']}</td>
                                        //     <td>
                                        //         <!--<button class='btn btn-sm btn-warning me-1'>Edit</button>-->
                                        //         <button class='btn btn-sm btn-danger' data-id='" . ($section['id']) . "' id='deleteSectionBtn' data-bs-toggle='modal' data-bs-target='#deleteSectionModal'>Delete</button>
                                        //     </td>
                                        // </tr>";
                                        //         $counter++;
                                        //     }
                                        // } else {
                                        //     echo "<tr><td colspan='3' class='text-center'>No Sections Available</td></tr>";
                                        // }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- class column -->
                        <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Classes</h5>
                                <button type="submit" class="btn btn-success" onclick="openModal('add_class_modal')">Add
                                    Class</button>
                                <!-- <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addClassModal">Add Class</button> -->
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-hover overflow-auto"
                                    style="max-height: 250px;">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <!-- <th>Class Number</th> -->
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="classList">
                                        <?php
                                        $classes = $conn->query("SELECT * FROM classes ORDER BY class_number ASC");

                                        if ($classes->num_rows > 0) {
                                            $counter = 1; // Start the counter
                                        
                                            while ($class = $classes->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>{$counter}</td>
                                                        <!-- <td>{$class['class_number']}</td> -->
                                                        <td>{$class['class_name']}</td>
                                                        <td>{$class['section_name']}</td>
                                                        <td>
                                                            <!-- <button class='btn btn-sm btn-warning me-1'>Edit</button> -->
                                                            <button class='btn btn-sm btn-danger m-1' data-id='" . ($class['id']) . "' id='deleteClassBtn' data-bs-toggle='modal' data-bs-target='#deleteClassModal'>Delete</button>
                                                        </td>
                                                    </tr>";
                                                $counter++; // Increment after each row
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No Classes Available</td></tr>";
                                        }

                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- division column -->
                        <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Divisions</h5>
                                <button type="submit" class="btn btn-success"
                                    onclick="openModal('add_division_modal')">Add Division</button>
                                <!-- <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addDivisionModal" onclick="openModal('add_division_modal')">Add Division</button> -->
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;"
                                id="divisionTable">
                                <table class="table table-bordered table-hover overflow-auto"
                                    style="max-height: 250px;">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Division</th>
                                            <th>Class</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="divisionList">
                                        <?php
                                        // $divisions = $conn->query("SELECT * FROM divisions");
                                        // if ($divisions->num_rows > 0) {
                                        //     $counter = 1; // Start the counter
                                        
                                        //     while ($division = $divisions->fetch_assoc()) {
                                        //         echo "<tr>
                                        //         <td>{$counter}</td>
                                        //         <td>{$division['division_name']}</td>
                                        //         <td>{$division['class_number']}</td>
                                        //         <td>
                                        //             <button class='btn btn-sm btn-danger m-1' data-id='" . ($division['id']) . "' id='deleteDivisionBtn' data-bs-toggle='modal' data-bs-target='#deleteDivisionModal'>Delete</button>
                                        //         </td>
                                        //     </tr>";
                                        //         $counter++; // Increment after each row
                                        //     }
                                        // } else {
                                        //     echo "<tr><td colspan='4' class='text-center'>No Divisions Available</td></tr>";
                                        // }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CLASSES TAB -->
                <!-- <div class="tab-pane" id="classes" role="tabpanel">
                    <div class="row g-2 justify-content-between"> -->
                <!-- Sections column -->
                <!-- <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Sections</h5>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addSectionModal">Add Section</button>
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-hover overflow-auto" id="getSectionTable">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Section Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sectionList">
                                        <?php
                                        // $sections = $conn->query("SELECT * FROM sections");
                                        // if ($sections->num_rows > 0) {
                                        //     $counter = 1; // Start the counter
                                        //     while ($section = $sections->fetch_assoc()) {
                                        //         echo "<tr>
                                        //     <td>{$counter}</td>
                                        //     <td>{$section['section_name']}</td>
                                        //     <td>
                                        //         <!--<button class='btn btn-sm btn-warning me-1'>Edit</button>-->
                                        //         <button class='btn btn-sm btn-danger' data-id='" . ($section['id']) . "' id='deleteSectionBtn' data-bs-toggle='modal' data-bs-target='#deleteSectionModal'>Delete</button>
                                        //     </td>
                                        // </tr>";
                                        //         $counter++;
                                        //     }
                                        // } else {
                                        //     echo "<tr><td colspan='3' class='text-center'>No Sections Available</td></tr>";
                                        // }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                <!-- class column -->
                <!-- <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Classes</h5>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addClassModal">Add Class</button>
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-bordered table-hover overflow-auto"
                                    style="max-height: 250px;">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Class Number</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="classList">
                                        <?php
                                        // $classes = $conn->query("SELECT * FROM classes ORDER BY class_number ASC");
                                        
                                        // if ($classes->num_rows > 0) {
                                        //     $counter = 1; // Start the counter
                                        
                                        //     while ($class = $classes->fetch_assoc()) {
                                        //         echo "<tr>
                                        //                 <td>{$counter}</td>
                                        //                 <!-- <td>{$class['class_number']}</td> -->
                                        //                 <td>{$class['class_name']}</td>
                                        //                 <td>{$class['section_name']}</td>
                                        //                 <td>
                                        //                     <!-- <button class='btn btn-sm btn-warning me-1'>Edit</button> -->
                                        //                     <button class='btn btn-sm btn-danger m-1' data-id='" . ($class['id']) . "' id='deleteClassBtn' data-bs-toggle='modal' data-bs-target='#deleteClassModal'>Delete</button>
                                        //                 </td>
                                        //             </tr>";
                                        //         $counter++; // Increment after each row
                                        //     }
                                        // } else {
                                        //     echo "<tr><td colspan='5' class='text-center'>No Classes Available</td></tr>";
                                        // }
                                        
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div> -->
                <!-- division column -->
                <!-- <div class="col-md-5 m-2 d-flex flex-column" style="min-width: 25%; max-width: 30%;">
                            <div class="m-2 d-flex justify-content-between align-items-center text-dark">
                                <h5 class="fw-semibold">Divisions</h5>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addDivisionModal">Add Division</button>
                            </div>

                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;"
                                id="divisionTable">
                                <table class="table table-bordered table-hover overflow-auto"
                                    style="max-height: 250px;">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Division</th>
                                            <th>Class</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="divisionList">
                                        <?php
                                        $divisions = $conn->query("SELECT * FROM divisions");
                                        if ($divisions->num_rows > 0) {
                                            $counter = 1; // Start the counter
                                        
                                            while ($division = $divisions->fetch_assoc()) {
                                                echo "<tr>
                                                <td>{$counter}</td>
                                                <td>{$division['division_name']}</td>
                                                <td>{$division['class_name']}</td>
                                                <td>
                                                    
                                                    <button class='btn btn-sm btn-danger m-1' data-id='" . ($division['id']) . "' id='deleteDivisionBtn' data-bs-toggle='modal' data-bs-target='#deleteDivisionModal'>Delete</button>
                                                </td>
                                            </tr>";
                                                $counter++; // Increment after each row
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class='text-center'>No Divisions Available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div> -->
                <!-- </div>
                </div> -->

                <!-- USERS TAB -->
                <div class="tab-pane fade" id="users" role="tabpanel">
                    <div class="row text-center">
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light border-2">
                                <div class="card-body" id="totalAdminCard">
                                    <h6 class="text-muted">Total Admins</h6>
                                    <h2><?php
                                    $totalUsers = $conn->query("SELECT COUNT(*) as count FROM login_admins WHERE role = 'Admin' AND status = 'active'");
                                    if ($totalUsers) {
                                        $row = $totalUsers->fetch_assoc();
                                        $_SESSION['total_admins'] = $row['count'];
                                    }
                                    echo $_SESSION['total_admins'] ?? '0'; ?></h2> <!-- Dynamic count -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light border-success border-2">
                                <div class="card-body" id="totalStaffCard">
                                    <h6 class="text-muted">Total Staff</h6>
                                    <h2><?php echo $_SESSION['total_users'] ?? '0'; ?></h2> <!-- Dynamic count -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="modal-content">
                            <div class="modal-header rounded-0 border-0 d-flex justify-content-between"
                                style="background-color: transparent;">
                                <h5 class="modal-title" id="manageUsersModalLabel">Manage Portal Users</h5>
                                <div class="modal-footer">
                                    <a href="index.php?page=settings/add_users" class="smart-link btn btn-success m-1"
                                        id="addUserBtn">Add User</a>
                                </div>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover" style="max-height: 250px;">
                                    <thead class="table-success sticky-top z-2">
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userList">
                                        <?php
                                        if ($users->num_rows > 0) {
                                            $counter = 1; // Start the counter
                                            while ($user = $users->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>{$counter}</td>
                                                    <td>{$user['username']}</td>
                                                    <td>{$user['role']}</td>
                                                    <td><span class='badge bg-" . ($user['status'] === 'active' ? "success" : "danger") . "'>" . ($user['status'] === 'active' ? "active" : "deactive") . "</span></td>
                                                    <td>
                                                        <button class='btn btn-sm btn-" . ($user['status'] === 'active' ? "warning" : "success") . " m-1' data-bs-toggle='modal' data-bs-target='#confirmStatusModal' data-id='" . $user['id'] . "'id='changeStatusBtn'>" . ($user['status'] === 'active' ? "deactive" : "active") . "</button>
                                                        <button class='btn btn-sm btn-danger m-1' data-bs-toggle='modal' data-bs-target='#deleteUserModal' data-id='" . ($user['id']) . "' id='deleteUserBtn'>Delete</button>
                                                    </td>
                                                </tr>";
                                                $counter++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No Users Available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FEES MASTER -->
                <div class="tab-pane fade" id="feesMaster" role="tabpanel">
                    <div class="card border-0 rounded-0" style="background-color: white;">
                        <div class="card-header border-0 rounded-0 d-flex justify-content-between align-items-center"
                            style="background-color: transparent;">
                            <h5 class="mb-0 text-green">Fees Master</h5>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addFeeModal" id="addNewFeeBtn">+ Add New Fee</button>
                        </div>
                        <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-bordered table-striped table-hover overflow-auto"
                                style="max-height: 250px;">
                                <thead class="table-success sticky-top z-2">
                                    <tr>
                                        <th>#</th>
                                        <th>Fee Type</th>
                                        <th>Amount (₹)</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Frequency</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($feeMasterData)) { ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No Fee Data Available</td>
                                        </tr>
                                    <?php } else { ?>
                                        <!-- Placeholder rows -->
                                        <?php $i = 1; ?>

                                        <!-- Placeholder rows -->
                                        <?php foreach ($feeMasterData as $fee): ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($fee['fee_type'] ?? '') ?></td>
                                                <td>₹<?= htmlspecialchars($fee['amount'] ?? 0) ?></td>
                                                <td><?= htmlspecialchars($fee['class'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($fee['section'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($fee['frequency'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($fee['due_date'] ?? 'N/A') ?>
                                                    <?php if ($fee['frequency'] == 'Monthly')
                                                        echo "Monthly";
                                                    if ($fee['frequency'] == 'Yearly')
                                                        echo "Yearly"; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" style="margin: 2px;"
                                                        data-bs-target="#deleteFeeModal" data-bs-toggle="modal"
                                                        data-id="<?= $fee['id'] ?>" id="deleteFeeBtn">Delete</button>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                    <!-- Add PHP loop here to display real data -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal for Editing Fee -->
                    <?php include 'modals/edit_fee_modal.php'; ?>
                </div>
            </div>
        </div>

        <div id="modal-container"></div>
        <!-- add section model -->
        <?php
        // include 'modals/add_section_modal.php'; 
        // // delete section model 
        // include 'modals/delete_section_model.php'; 
        // //  add class modal 
        // include 'modals/add_class_modal.php'; 
        // //  edit division modal 
        // include 'modals/delete_class_modal.php'; 
        // //  add division modal 
        // include 'modals/add_division_modal.php';
        // // delete division modal
        // include 'modals/delete_division_modal.php';
        // // delete user confirmation
        // include 'modals/delete_user_modal.php';
        // // confirm status change modal
        // include 'modals/confirm_status_modal.php';
        // // Modal for Adding New Fee
        // include 'modals/add_fee_modal.php';
        // // Modal for Deleting Fee
        // include 'modals/delete_fee_modal.php'; 
        ?>

    </div>
    <script>
        let selectedUserId = null;
        let selectedButton = null;

        function openModal(modalFile) {
            console.log("Open modal function called with file:", modalFile);
            fetch(`modals/${modalFile}.php`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-container').innerHTML = html;
                    const modalElement = document.querySelector('#modal-container .modal');
                    if (modalElement) {
                        const modalInstance = new bootstrap.Modal(modalElement);
                        modalInstance.show();
                    } else {
                        console.error("No modal found in the fetched content.");
                    }
                    if (modalFile === 'add_division_modal') {
                        loadClassOptions();
                    } else if (modalFile === 'add_class_modal') {
                        loadSectionOptions();
                    }
                })
                .catch(error => console.error('Error loading modal:', error));
        }
        // function to get class options in dropdown
        function loadClassOptions() {
            fetch('get_data/get_class.php')
                .then(response => response.json())
                .then(data => {
                    // console.log("Classes:",data);
                    const select = document.getElementById('addDivisionClassOptions');
                    select.innerHTML = '<option value="" disabled selected>Select Class</option>'; // reset

                    data.forEach(cls => {
                        let option = document.createElement('option');
                        option.value = cls.class_number;
                        option.textContent = cls.class_name;
                        select.appendChild(option);
                    });
                })
            // .catch(error => console.error('Error loading classes:', error));
        }

        // function to get section option in dropdown
        function loadSectionOptions() {
            fetch('get_data/get_section.php')
                .then(response => response.json())
                .then(data => {
                    console.log("Sections:", data);
                    const select = document.getElementById('addClassSectionDropdown');
                    select.innerHTML = '<option value="" disabled selected>Select Section</option>'; // reset

                    data.forEach(cls => {
                        let option = document.createElement('option');
                        option.value = cls.section_name;
                        option.textContent = cls.section_name;
                        select.appendChild(option);
                    });
                })
            // .catch(error => console.error('Error loading sections:', error));
        }

        // function to get section table
        function loadSectionTable() {
            fetch('get_data/get_section.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const table = document.getElementById('sectionList');
                    table.innerHTML = ``; // reset

                    data.forEach((scs, index) => {
                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${scs.section_name}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" data-id="${scs.section_id}" data-bs-toggle="modal" data-bs-target="#deleteSectionModal" id="deleteSectionBtn${scs.section_id}"> <i class="bi bi-trash"></i></button>
                            </td>
                        `;
                        table.appendChild(row);
                    });
                })
        }

        // function to get class table
        function loadClassTable() {
            fetch('get_data/get_class.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const table = document.getElementById('classList');
                    table.innerHTML = ``; // reset

                    data.forEach((cls, index) => {
                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${cls.class_name}</td>
                            <td>${cls.section_name}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" data-id="${cls.class_id}" data-bs-toggle="modal" data-bs-target="#deleteClassModal" id="deleteClassBtn${cls.class_id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        `;
                        table.appendChild(row);
                    });
                })
        }

        // function to get division table
        function loadDivisionTable() {
            fetch('get_data/get_division.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const table = document.getElementById('divisionList');
                    table.innerHTML = ``; // reset

                    data.forEach((div, index) => {
                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${div.division_name}</td>
                            <td>${div.class_name}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" data-id="${div.division_id}" data-bs-toggle="modal" data-bs-target="#deleteDivisionModal" id="deleteDivisionBtn${div.division_id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        `;
                        table.appendChild(row);
                    });
                })
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Grab the ID when the modal opens
            // loadClassOptions();
            // loadSectionOptions();
            loadSectionTable();
            loadClassTable();
            loadDivisionTable();

            // Function to close the modal
            function closeModal(modalId) {
                const modalElement = document.getElementById(modalId);
                if (!modalElement) return;

                const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                modalInstance.hide();

                // cleanup
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
            }

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    selectedUserId = trigger.getAttribute('data-id');
                    const targetModal = trigger.getAttribute('data-bs-target');

                    switch (targetModal) {
                        case '#deleteSectionModal':
                            document.getElementById('confirmDeleteSectionBtn').setAttribute('data-id', selectedUserId);
                            break;

                        case '#deleteUserModal':
                            document.getElementById('confirmDeleteBtn').setAttribute('data-id', selectedUserId);
                            break;

                        case '#confirmStatusModal':
                            document.getElementById('confirmChangeBtn').setAttribute('data-id', selectedUserId);
                            break;

                        case '#deleteClassModal':
                            document.getElementById('confirmDeleteClassBtn').setAttribute('data-id', selectedUserId);
                            break;

                        case '#deleteDivisionModal':
                            document.getElementById('confirmDeleteDivisionBtn').setAttribute('data-id', selectedUserId);
                            break;

                        case '#deleteFeeModal':
                            document.getElementById('confirmDeleteFeeBtn').setAttribute('data-id', selectedUserId);
                            console.log("Confirm delete button updated with ID:", selectedUserId);
                            break;

                        default:
                            break;
                    }
                });
            });

            function getSelectedUserId() {
                document.querySelectorAll('[data-bs-toggle="modal"]').forEach(trigger => {
                    trigger.addEventListener('click', () => {
                        selectedUserId = trigger.getAttribute('data-id');
                        const targetModal = trigger.getAttribute('data-bs-target');

                        switch (targetModal) {
                            // case '#deleteSectionModal':
                            //     document.getElementById('confirmDeleteSectionBtn').setAttribute('data-id', selectedUserId);
                            //     break;

                            // case '#deleteUserModal':
                            //     document.getElementById('confirmDeleteBtn').setAttribute('data-id', selectedUserId);
                            //     break;

                            // case '#confirmStatusModal':
                            //     document.getElementById('confirmChangeBtn').setAttribute('data-id', selectedUserId);
                            //     break;

                            case '#deleteClassModal':
                                document.getElementById('confirmDeleteClassBtn').setAttribute('data-id', selectedUserId);
                                console.log("Confirm delete button updated with ID:", selectedUserId);
                                break;

                            case '#deleteDivisionModal':
                                document.getElementById('confirmDeleteDivisionBtn').setAttribute('data-id', selectedUserId);
                                console.log("Confirm delete button updated with ID:", selectedUserId);
                                break;

                            case '#deleteFeeModal':
                                document.getElementById('confirmDeleteFeeBtn').setAttribute('data-id', selectedUserId);
                                console.log("Confirm delete button updated with ID:", selectedUserId);
                                break;

                            default:
                                break;
                        }
                    });
                });
            }

            const form = document.getElementById("addFeeForm");
            // Function to handle form submit
            function handleAddFeeSubmit(e) {
                e.preventDefault();

                // console.log(selectedUserId);
                const formData = new FormData(form);

                fetch("settings/add_fee.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            selectedUserId = null; // Reset selectedUserId after successful addition
                            console.log(selectedUserId);
                            console.log("Server Response:", data);

                            // Modal close
                            alert(data.message);
                            closeModal("addFeeModal");

                            // add row to table dynamically
                            const tbody = document.querySelector("#feesMaster table tbody");
                            const newRow = document.createElement("tr");
                            const frequencyText = data.frequency === 'Monthly' ? 'Monthly' : data.frequency === 'Yearly' ? 'Yearly' : '';
                            newRow.innerHTML = `
                                <td>${tbody.children.length + 1}</td>
                                <td>${data.fee_type}</td>
                                <td>₹${data.amount}</td>
                                <td>${data.class}</td>
                                <td>${data.section}</td>
                                <td>${data.frequency}</td>
                                <td>${data.due_date || 'N/A'} ${frequencyText} </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" style="margin: 2px;" data-bs-target="#deleteFeeModal" data-bs-toggle="modal" data-id="${data.id}" id="deleteFeeBtn">Delete</button>
                                </td>
                            `;
                            tbody.appendChild(newRow);
                            form.reset();
                            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.add());
                            // console.log("Modal backdrop added");
                            getSelectedUserId();
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            // close the form
                            history.replaceState(null, null, location.href);
                        } else {
                            alert(data.message);
                            form.reset();
                            closeModal("addFeeModal");
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            // console.error("Server Response:", data);
                            history.replaceState(null, null, location.href);
                        }
                    })
                    .catch(error => {
                        console.error("An error occurred: " + error);
                        document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                    });
            }

            const addClassForm = document.getElementById("addClassForm");
            // function to add class
            function handleAddClassSubmit(e) {
                e.preventDefault();

                const formData = new FormData(addClassForm);
                const addDivisionClassOptions = document.getElementById("addDivisionClassOptions");
                console.log(addDivisionClassOptions);

                fetch("settings/add_class.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('confirmDeleteClassBtn').removeAttribute('data-id');
                            selectedUserId = null; // Reset selectedUserId after successful addition
                            // console.log("Server Response:", data);

                            // Modal close
                            closeModal("addClassModal");
                            alert(data.message);

                            // add row to table dynamically
                            // const tbody = document.querySelector("#classes table tbody");
                            // const newRow = document.createElement("tr");
                            // newRow.innerHTML = `
                            //     <td>${tbody.children.length + 1}</td>
                            //     <td>${data.class_name}</td>
                            //     <td>${data.section_name}</td>
                            //     <td>
                            //         <button class='btn btn-sm btn-danger m-1' data-id='${data.class_id}' id='deleteClassBtn' data-bs-toggle='modal' data-bs-target='#deleteClassModal'>Delete</button>
                            //     </td>
                            // `;
                            // tbody.appendChild(newRow);
                            addClassForm.reset();
                            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.add());
                            console.log("Modal backdrop added");
                            getSelectedUserId();
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            loadSectionOptions();
                            loadClassTable();
                            // close the form
                            history.replaceState(null, null, location.href);
                        }
                        else {
                            alert(data.message);
                            addClassForm.reset();
                            closeModal("addClassModal");
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            // console.error("Server Response:", data);
                            history.replaceState(null, null, location.href);
                        }
                    })
                    .catch(error => {
                        console.error("An error occurred: " + error);
                        document.getElementById('confirmDeleteClassBtn').removeAttribute('data-id');
                    })
            }

            const addDivisionForm = document.getElementById("addDivisionForm");
            // function to add division
            function handleAddDivisionSubmit(e) {
                e.preventDefault();

                const formData = new FormData(addDivisionForm);


                fetch("settings/add_division.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById("confirmDeleteDivisionBtn").removeAttribute('data-id');
                            selectedUserId = null;
                            closeModal("addDivisionModal");
                            alert(data.message);
                            loadClassOptions();

                            // add new row in table
                            const tbody = document.querySelector("#classes #divisionTable table tbody");
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = `
                            <tr>
                                <td>${tbody.children.length + 1}</td>
                                <td>${data.division_name}</td>
                                <td>${data.class_name}</td>
                                <td>
                                    <button class='btn btn-sm btn-danger m-1' data-id='${data.division_id}' id='deleteDivisionBtn' data-bs-toggle='modal' data-bs-target='#deleteDivisionModal'>Delete</button>
                                </td>
                            </tr>
                            `;
                            tbody.appendChild(newRow);
                            addDivisionForm.reset();
                            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.add());
                            // console.log("Modal backdrop added");
                            getSelectedUserId();
                            document.getElementById('confirmDeleteFeeBtn').removeAttribute('data-id');
                            history.replaceState(null, null, location.href);
                        } else {
                            alert(data.message);
                            addDivisionForm.reset();
                            closeModal("addDivisionModal");
                            document.getElementById('confirmDeleteDivisionBtn').removeAttribute('data-id');
                            // console.error("Server Response:", data);
                            history.replaceState(null, null, location.href);
                        }
                    })
                    .catch(error => {
                        console.error("An error occurred: " + error);
                        document.getElementById('confirmDeleteDivisionBtn').removeAttribute('data-id');
                    })
            }

            // function to add section
            const addSectionForm = document.getElementById("addSectionForm");
            function handleAddSectionSubmit(e) {
                e.preventDefault();

                const formData = new FormData(addSectionForm);
                fetch("settings/add_section.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeModal("addSectionModal");
                            alert(data.message);

                            // add row to table dynamically
                            const tbody = document.querySelector("#sections table tbody");
                            const newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td>${tbody.children.length + 1}</td>
                                <td>${data.section_name}</td>
                                <td>
                                    <button class='btn btn-sm btn-danger m-1' data-id='${data.section_id}' id='deleteSectionBtn' data-bs-toggle='modal' data-bs-target='#deleteSectionModal'>Delete</button>
                                </td>
                            `;
                            tbody.appendChild(newRow);
                            addSectionForm.reset();
                            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.add());
                            // console.log("Modal backdrop added");
                            getSelectedUserId();
                            loadSectionOptions();
                            // close the form
                            history.replaceState(null, null, location.href);
                        } else {
                            alert(data.message);
                            addSectionForm.reset();
                            closeModal("addSectionModal");
                            // console.error("Server Response:", data);
                            history.replaceState(null, null, location.href);
                        }
                    })
            }


            // ✅ Sirf ek hi baar listener lagao
            if (addSectionForm) {
                addSectionForm.addEventListener("submit", handleAddSectionSubmit);
            }
            if (form) {
                form.addEventListener("submit", handleAddFeeSubmit);
            }
            if (addClassForm) {
                addClassForm.addEventListener("submit", handleAddClassSubmit);
            }
            if (addDivisionForm) {
                addDivisionForm.addEventListener('submit', handleAddDivisionSubmit);
            }

            switch (true) {
                // Handle User deletion
                case !!document.getElementById('confirmDeleteBtn'):
                    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
                        selectedUserId = document.getElementById('confirmDeleteBtn').getAttribute('data-id');
                        const row = document.querySelector(`#deleteUserBtn[data-id="${selectedUserId}"]`);
                        const totalStaffCard = document.querySelector('#totalStaffCard h2');
                        const totalAdminCard = document.querySelector('#totalAdminCard h2');
                        // console.log("Total Staff Card:", totalStaffCard);

                        fetch('settings/delete_user.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: selectedUserId
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message)
                                    const currentRow = row.closest('tr');
                                    let role = row.closest('tr').querySelector('td:(nth-child(3)').textContent.trim();
                                    let next = currentRow.nextElementSibling;
                                    if (currentRow) {
                                        currentRow.remove();
                                    }

                                    if (totalAdminCard) {
                                        let currentCount = parseInt(totalAdminCard.textContent.trim(), 10);
                                        if (!isNaN(currentCount) && currentCount > 0 && role === 'Admin') {
                                            totalAdminCard.textContent = data.adminCount;
                                        }
                                    }

                                    if (totalStaffCard) {
                                        let currentCount = parseInt(totalStaffCard.textContent.trim(), 10);
                                        if (!isNaN(currentCount) && currentCount > 0) {
                                            totalStaffCard.textContent = currentCount - 1;
                                        }
                                    }

                                    while (next) {
                                        let firstCol = next.querySelector('td:nth-child(1)');

                                        if (firstCol) {
                                            let value = parseInt(firstCol.textContent.trim(), 10);
                                            if (!isNaN(value)) {
                                                firstCol.textContent = value - 1;
                                            }
                                        }

                                        next = next.nextElementSibling;
                                    }
                                    history.replaceState(null, null, location.href);
                                } else {
                                    alert(data.message);
                                    history.replaceState(null, null, location.href);
                                }
                            })
                            .catch(error => {
                                console.log("Error deleting user.");
                            });

                        // Reset after action
                        selectedUserId = null;
                        closeModal('deleteUserModal');
                    });
                    break;

                // Handle status change
                case !!document.getElementById('confirmChangeBtn'):
                    document.getElementById('confirmChangeBtn').addEventListener('click', () => {
                        const row = document.querySelector(`#changeStatusBtn[data-id="${selectedUserId}"]`);

                        fetch('settings/update_status.php', {
                            method: 'POST',
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id: selectedUserId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);

                                    const userRow = row.closest('tr');
                                    const statusCell = userRow.querySelector('td:nth-child(4) span');
                                    const selectedButton = userRow.querySelector('td:nth-child(5) #changeStatusBtn');

                                    if (data.new_status === 'active') {
                                        statusCell.classList.remove('bg-danger');
                                        statusCell.classList.add('bg-success');
                                        statusCell.textContent = 'active';

                                        selectedButton.classList.remove('btn-success');
                                        selectedButton.classList.add('btn-warning');
                                        selectedButton.textContent = 'deactive';
                                    } else {
                                        statusCell.classList.remove('bg-success');
                                        statusCell.classList.add('bg-danger');
                                        statusCell.textContent = 'deactive';

                                        selectedButton.classList.remove('btn-warning');
                                        selectedButton.classList.add('btn-success');
                                        selectedButton.textContent = 'active';
                                    }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(err => console.log("Request failed: " + err));

                        // reset
                        selectedUserId = null;
                        selectedButton = null;

                        closeModal('confirmStatusModal');
                    });
                    break;

                // Handle division deletion
                case !!document.getElementById('confirmDeleteDivisionBtn'):
                    document.getElementById('confirmDeleteDivisionBtn').addEventListener('click', () => {
                        const row = document.querySelector(`#deleteDivisionBtn[data-id="${selectedUserId}"]`);
                        fetch('settings/delete_division.php', {
                            method: 'POST',
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id: selectedUserId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log(data);
                                    alert(data.message);
                                    // const userRow = row.closest('tr');
                                    // let next = userRow.nextElementSibling;
                                    // userRow.remove();
                                    // while (next) {
                                    //     let firstCol = next.querySelector('td:nth-child(1)');

                                    //     if (firstCol) {
                                    //         let value = parseInt(firstCol.textContent.trim(), 10);
                                    //         if (!isNaN(value)) {
                                    //             firstCol.textContent = value - 1;
                                    //         }
                                    //     }

                                    //     next = next.nextElementSibling;
                                    // }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(err => console.log("Request failed: " + err));
                        selectedUserId = null;
                        closeModal('deleteDivisionModal');
                    });
                    break;

                // Handle class deletion
                case !!document.getElementById('confirmDeleteClassBtn'):
                    document.getElementById('confirmDeleteClassBtn').addEventListener('click', () => {
                        const row = document.querySelector(`#deleteClassBtn[data-id="${selectedUserId}"]`);
                        fetch('settings/delete_class.php', {
                            method: 'POST',
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id: selectedUserId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // console.log(data);
                                    alert(data.message);
                                    const userRow = row.closest('tr');
                                    let next = userRow.nextElementSibling;
                                    userRow.remove();
                                    while (next) {
                                        let firstCol = next.querySelector('td:nth-child(1)');

                                        if (firstCol) {
                                            let value = parseInt(firstCol.textContent.trim(), 10);
                                            if (!isNaN(value)) {
                                                firstCol.textContent = value - 1;
                                            }
                                        }

                                        next = next.nextElementSibling;
                                    }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(err => console.log("Request failed: " + err));
                        selectedUserId = null;
                        closeModal('deleteClassModal');
                    });
                    break;

                // Handle section deletion
                case !!document.getElementById('confirmDeleteSectionBtn'):
                    document.getElementById('confirmDeleteSectionBtn').addEventListener('click', () => {
                        const row = document.querySelector(`#deleteSectionBtn[data-id="${selectedUserId}"]`);

                        fetch('settings/delete_section.php', {
                            method: 'POST',
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id: selectedUserId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log(data);
                                    alert(data.message);
                                    const userRow = row.closest('tr');
                                    let next = userRow.nextElementSibling;
                                    userRow.remove();
                                    while (next) {
                                        let firstCol = next.querySelector('td:nth-child(1)');

                                        if (firstCol) {
                                            let value = parseInt(firstCol.textContent.trim(), 10);
                                            if (!isNaN(value)) {
                                                firstCol.textContent = value - 1;
                                            }
                                        }

                                        next = next.nextElementSibling;
                                    }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(err => console.log("Request failed: " + err));
                        selectedUserId = null;
                        closeModal('deleteSectionModal');
                    });
                    break;

                // Handle fee deletion
                case !!document.getElementById('confirmDeleteFeeBtn'):
                    document.getElementById('confirmDeleteFeeBtn').addEventListener('click', () => {
                        const row = document.querySelector(`#deleteFeeBtn[data-id="${selectedUserId}"]`);
                        fetch('settings/delete_fee.php', {
                            method: 'POST',
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id: selectedUserId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    const userRow = row.closest('tr');
                                    let next = userRow.nextElementSibling;
                                    userRow.remove();
                                    while (next) {
                                        let firstCol = next.querySelector('td:nth-child(1)');

                                        if (firstCol) {
                                            let value = parseInt(firstCol.textContent.trim(), 10);
                                            if (!isNaN(value)) {
                                                firstCol.textContent = value - 1;
                                            }
                                        }
                                        next = next.nextElementSibling;
                                    }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(err => console.log("Request failed: " + err));
                        selectedUserId = null;
                        closeModal('deleteFeeModal');
                    });
                    break;

                default:
                    break;
            }
        });
        // function afterClassAdded() {
        //     loadClasses(); // ye dobara call hoga aur naya data aa jayega
        // }
    </script>
</div>