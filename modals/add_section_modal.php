<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="settings/add_section.php" method="POST" id="addSectionForm">
            <div class="modal-content">
                <div class="modal-header rounded-0 border-0" style="background-color: transparent;">
                    <h5 class="modal-title" id="addSectionModalLabel">Add New Section</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="section_number">Section Number</label>
                            <input type="number" class="form-control" id="section_number" name="section_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="section_name">Section Name</label>
                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="addSectionBtn">Add Section</button>
                </div>
            </div>
        </form>
    </div>
</div>