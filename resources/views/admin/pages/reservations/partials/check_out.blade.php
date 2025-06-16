<div class="modal fade" id="invoiceCheckOutModal" tabindex="-1" aria-labelledby="invoiceCheckOutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="invoiceCheckOutModalLabel">Generate New Invoice</h5>
                <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('admin.reservations.check-out', $reservation->id) }}" method="POST"
                    class="d-inline">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guest_id">Guest *</label>
                                <input type="hidden" name="guest_id" value="{{ $reservation->guest->id }}">
                                @error('guest_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="room_id">Room *</label>
                                <input type="hidden" name="room_id" value="{{ $reservation->room->id }}">
                                @error('room_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount">Amount *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" name="amount" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ $reservation->amount }}" required>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="issue_date">Issue Date *</label>
                                <input type="date" name="issue_date" id="issue_date"
                                    class="form-control @error('issue_date') is-invalid @enderror"
                                    value="{{ old('issue_date', date('Y-m-d')) }}" required>
                                @error('issue_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="due_date">Due Date *</label>
                                <input type="date" name="due_date" id="due_date"
                                    class="form-control @error('due_date') is-invalid @enderror" value=""
                                    required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary shadow-0">Create Invoice</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
