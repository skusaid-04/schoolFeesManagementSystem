<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="addClassForm">

            <!-- Modal Header -->
            <div class="modal-header border-0 rounded-0 bg-transparent">
                <h5 class="modal-title" id="addClassModalLabel">Add New Class</h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Enter Class Number" name="class_number" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Enter Class Name" name="class_name" required>
                </div>

                <!-- Section Dropdown -->
                <div class="mb-3">
                    <select class="form-select" name="section_name" id="addClassSectionDropdown" required>
                        <?php
                        // $sections = $conn->query("SELECT * FROM sections");
                        // if ($sections->num_rows > 0) {
                        //     echo '<option value="" disabled selected>Select Section</option>';
                        //     while ($section = $sections->fetch_assoc()) {
                        //         echo "<option value='{$section['section_name']}'>{$section['section_name']}</option>";
                        //     }
                        // } else {
                        //     echo '<option value="" disabled>No Sections Available</option>';
                        // }
                        ?>
                    </select>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="add_class" id="addClassBtn">Add Class</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

        </form>
    </div>
</div>

<script></script>
