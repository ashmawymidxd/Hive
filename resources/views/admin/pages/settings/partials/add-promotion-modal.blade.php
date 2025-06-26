<!-- Delete Confirmation Modal -->
<div class="modal fade" id="AddPromotionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Promotion</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.promotions.store') }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name">Promotion Name</label>
                            <input type="text" name="name" id="name" class="form-control p-2 bg-light"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="discount">Discount Amount (%)</label>
                            <input type="number" name="discount" id="discount" class="form-control p-2 bg-light"
                                min="0" max="100" step="0.01" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-12">
                            <label>Promotion Period</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control p-2 bg-light" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control p-2 bg-light" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label>Applicable Room Types</label>
                            <div class="mt-2">
                                @foreach (['All Room Types', 'Standard Room', 'Deluxe Room', 'Suite', 'Executive Suite', 'Penthouse'] as $roomType)
                                    <label>
                                        <input type="checkbox" name="room_types[]" value="{{ $roomType }}">
                                        {{ $roomType }}
                                    </label><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="promo_code">Promotion Code</label>
                            <input type="text" name="promo_code" id="promo_code" class="form-control p-2 bg-light"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control p-2 bg-light" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="description">Description & Terms</label>
                            <textarea name="description" id="description" class="form-control p-2 bg-light" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="d-flex align-items-center justify-content-end gap-4">
                            <button class="btn btn-primary shadow-0" type="submit">Save
                                Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
