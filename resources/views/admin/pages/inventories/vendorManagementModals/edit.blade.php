
<!-- Edit Vendor Modal -->
<div class="modal fade" id="editVendorModal" tabindex="-1" aria-labelledby="editVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVendorModalLabel">Edit Vendor</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editVendorForm">
                <input type="hidden" id="edit_vendor_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_vendor_name" class="form-label">Vendor Name</label>
                        <input type="text" class="form-control" id="edit_vendor_name" name="name" required>
                        <div class="invalid-feedback" id="edit_nameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_vendor_category" class="form-label">Category</label>
                        <select class="form-select" id="edit_vendor_category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Appliances">Appliances</option>
                            <option value="Food & Beverage">Food & Beverage</option>
                            <option value="Cleaning Supplies">Cleaning Supplies</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="invalid-feedback" id="edit_categoryError"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_items_supplied" class="form-label">Items Supplied</label>
                            <input type="number" class="form-control" id="edit_items_supplied" name="items_supplied" min="0" required>
                            <div class="invalid-feedback" id="edit_items_suppliedError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_last_order" class="form-label">Last Order Date</label>
                            <input type="date" class="form-control" id="edit_last_order" name="last_order" required>
                            <div class="invalid-feedback" id="edit_last_orderError"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_contact_info" class="form-label">Contact Info</label>
                        <textarea class="form-control" id="edit_contact_info" name="contact_info" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Vendor</button>
                </div>
            </form>
        </div>
    </div>
</div>
