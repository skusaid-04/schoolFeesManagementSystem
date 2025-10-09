<div class="modal fade" id="addDivisionModal" tabindex="-1" aria-labelledby="addDivisionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="addDivisionForm">

            <!-- Modal Header -->
            <div class="modal-header border-0 rounded-0 bg-transparent">
                <h5 class="modal-title" id="addDivisionModalLabel">Add New Division</h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Enter Division Name" name="division_name" required>
                </div>

                <!-- Class Dropdown -->
                <div class="mb-3">
                    <select class="form-select" name="class_name" required id="addDivisionClassOptions">
                        
                        <?php
                            // $classes = $conn->query("SELECT * FROM classes ORDER BY class_number ASC");
                            // if ($classes->num_rows > 0) {
                            //     echo '<option value="" disabled selected>Select Class</option>';
                            //     while ($class = $classes->fetch_assoc()) {
                            //         echo "<option value='{$class['class_name']}'>{$class['class_name']}</option>";
                            //         $counter++;
                            //     }
                            // } else {
                            //     echo '<option value="" disabled>No Classes Available</option>';
                            // }
                            ?>
                    </select>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="addDivisionBtn">Add Division</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

        </form>
    </div>
</div>