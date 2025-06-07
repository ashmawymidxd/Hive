
<!-- Edit Inventory Modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory Item</h5>
                <button type="button" class="btn-close btn-danger" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editInventoryForm">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                        <div class="invalid-feedback" id="edit_nameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Meat">Meat</option>
                            <option value="Vegetables">Vegetables</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Cleaning Supplies">Cleaning Supplies</option>
                            <option value="Office Supplies">Office Supplies</option>
                        </select>
                        <div class="invalid-feedback" id="edit_categoryError"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="edit_quantity" name="quantity" min="0" required>
                            <div class="invalid-feedback" id="edit_quantityError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="edit_unit" name="unit" required>
                            <div class="invalid-feedback" id="edit_unitError"></div>
                        </div>
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



