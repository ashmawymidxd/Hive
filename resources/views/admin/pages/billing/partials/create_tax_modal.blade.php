<!-- Create Tax Modal -->
<div class="modal fade" id="createTaxModal" tabindex="-1" aria-labelledby="createTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaxModalLabel">Add New Tax Record</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createTaxForm" action="{{ route('admin.taxes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Sales Tax">Sales Tax</option>
                            <option value="VAT">VAT</option>
                            <option value="Income Tax">Income Tax</option>
                            <option value="Property Tax">Property Tax</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Filed">Filed</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>