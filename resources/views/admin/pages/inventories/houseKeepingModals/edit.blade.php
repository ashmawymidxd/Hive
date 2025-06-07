<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Housekeeping Item</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editItemForm">
                <input type="hidden" id="edit_h_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_h_name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="edit_h_name" name="name" required>
                        <div class="invalid-feedback" id="edit_h_nameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_h_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_h_category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Linens">Linens</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Amenities">Amenities</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Toiletries">Toiletries</option>
                        </select>
                        <div class="invalid-feedback" id="edit_h_categoryError"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_h_quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="edit_h_quantity" name="quantity" min="0" required>
                            <div class="invalid-feedback" id="edit_h_quantityError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_h_unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="edit_h_unit" name="unit" required>
                            <div class="invalid-feedback" id="edit_h_unitError"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_h_notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="edit_h_notes" name="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
