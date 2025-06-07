<div class="modal fade" id="editReorderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Reorder Point</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editReorderForm">
                <input type="hidden" id="reorder_item_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reorder_point" class="form-label">Reorder Point</label>
                        <input type="number" class="form-control" id="reorder_point" name="reorder_point"
                            min="1" required>
                        <div class="invalid-feedback" id="reorder_pointError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
