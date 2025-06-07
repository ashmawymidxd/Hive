<!-- Add Vendor Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVendorModalLabel">Add New Vendor</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addVendorForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="vendor_name" class="form-label">Vendor Name</label>
                        <input type="text" class="form-control" id="vendor_name" name="name" required>
                        <div class="invalid-feedback" id="nameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="vendor_category" class="form-label">Category</label>
                        <select class="form-select" id="vendor_category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Appliances">Appliances</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Stationery">Stationery</option>
                            <option value="Other">Other</option>
                            
                        </select>
                        <div class="invalid-feedback" id="categoryError"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="items_supplied" class="form-label">Items Supplied</label>
                            <input type="number" class="form-control" id="items_supplied" name="items_supplied"
                                min="0" required>
                            <div class="invalid-feedback" id="items_suppliedError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_order" class="form-label">Last Order Date</label>
                            <input type="date" class="form-control" id="last_order" name="last_order" required>
                            <div class="invalid-feedback" id="last_orderError"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <textarea class="form-control" id="contact_info" name="contact_info" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Vendor</button>
                </div>
            </form>
        </div>
    </div>
</div>
