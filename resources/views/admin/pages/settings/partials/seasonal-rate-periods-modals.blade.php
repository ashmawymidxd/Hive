<!-- Add Modal -->
<div class="modal fade" id="addSeasonalRatePeriodModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Seasonal Rate Period</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSeasonalRatePeriodForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Season Name</label>
                        <input type="text" class="form-control" id="add_name" name="name" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="add_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="add_start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="add_end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="add_end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="add_rate_adjustment_type" class="form-label">Rate Adjustment Type</label>
                        <select class="form-select" id="add_rate_adjustment_type" name="rate_adjustment_type" required>
                            <option value="base_rate">Base Rate</option>
                            <option value="percentage">Percentage Increase/Decrease</option>
                            <option value="fixed">Fixed Amount Adjustment</option>
                        </select>
                    </div>
                    <div class="mb-3" id="add_rateAdjustmentValueContainer">
                        <label for="add_rate_adjustment_value" class="form-label">Adjustment Value</label>
                        <input type="number" step="0.01" class="form-control" id="add_rate_adjustment_value" name="rate_adjustment_value">
                        <small class="text-muted">For percentage, enter value like 10 for 10%. For fixed, enter the amount.</small>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="add_is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="add_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Period</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSeasonalRatePeriodModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Seasonal Rate Period</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSeasonalRatePeriodForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_periodId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Season Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_rate_adjustment_type" class="form-label">Rate Adjustment Type</label>
                        <select class="form-select" id="edit_rate_adjustment_type" name="rate_adjustment_type" required>
                            <option value="base_rate">Base Rate</option>
                            <option value="percentage">Percentage Increase/Decrease</option>
                            <option value="fixed">Fixed Amount Adjustment</option>
                        </select>
                    </div>
                    <div class="mb-3" id="edit_rateAdjustmentValueContainer">
                        <label for="edit_rate_adjustment_value" class="form-label">Adjustment Value</label>
                        <input type="number" step="0.01" class="form-control" id="edit_rate_adjustment_value" name="rate_adjustment_value">
                        <small class="text-muted">For percentage, enter value like 10 for 10%. For fixed, enter the amount.</small>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active" value="1">
                        <label class="form-check-label" for="edit_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Period</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteSeasonalRatePeriodModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this seasonal rate period?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
