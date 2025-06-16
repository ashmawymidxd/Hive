<!-- Manage Categories Modal -->
<div class="modal fade" id="manageCategoriesModal" tabindex="-1" aria-labelledby="manageCategoriesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageCategoriesModalLabel">Manage Expense Categories</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.expenses.storeCategory') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Category name" required>
                        <input type="text" name="description" class="form-control"
                            placeholder="Description (optional)">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>

                <div class="list-group">
                    @foreach ($categories as $category)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $category->name }}</strong>
                                @if ($category->description)
                                    <small class="d-block text-muted">{{ $category->description }}</small>
                                @endif
                            </div>
                            <form action="{{ route('admin.expenses.destroyCategory', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this category?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
