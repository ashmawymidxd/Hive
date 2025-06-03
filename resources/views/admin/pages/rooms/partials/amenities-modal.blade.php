<div class="modal fade" id="amenitiesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Amenities</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="amenityForm">
                    @csrf
                    <input type="hidden" id="amenityId" name="id">
                    <div class="mb-3">
                        <label for="amenityName" class="form-label">Amenity Name</label>
                        <input type="text" class="form-control" id="amenityName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="amenityIcon" class="form-label">Icon (optional)</label>
                        <input type="text" class="form-control" id="amenityIcon" name="icon" placeholder="e.g. fa-wifi">
                        <small class="text-muted">Use Font Awesome icon classes (e.g. fa-wifi)</small>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Amenity</button>
                    </div>
                </form>

                <hr>

                <h6>Existing Amenities</h6>
                <div class="table-responsive">
                    <table class="table table-sm" id="amenitiesTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
