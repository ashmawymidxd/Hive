<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStaffModal" tabindex="-1" role="dialog" aria-labelledby="deleteStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStaffModalLabel">Confirm Deletion</h5>
               <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                     aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                    <h5>Are you sure you want to delete <strong id="deleteStaffName" class="text-danger"></strong>?</h5>
                    <p>This action will permanently remove all staff records and cannot be undone.</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> Note: Staff with assigned shifts or tasks cannot be deleted.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cancel
                </button>
                <form id="deleteStaffForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt mr-1"></i> Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
