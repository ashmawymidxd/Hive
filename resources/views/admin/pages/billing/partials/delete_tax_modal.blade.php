<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTaxModal" tabindex="-1" aria-labelledby="deleteTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaxModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this tax record? This action cannot be undone.</p>
                <p id="taxToDelete"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                <form id="deleteTaxForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
