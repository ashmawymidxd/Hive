  @if ($invoice->status == 'pending')
      <div class="modal fade" id="markAsPaidModal" tabindex="-1" aria-labelledby="markAsPaidModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-warning text-white">
                      <h5 class="modal-title" id="markAsPaidModalLabel">Confirm Payment</h5>
                      <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal"
                          aria-label="Close"></button>
                  </div>
                  <form action="{{ route('admin.invoices.mark-as-paid', $invoice) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="paymentMethod" class="form-label">Payment Method</label>
                              <select class="form-select" id="paymentMethod" name="payment_method" required>
                                  <option value="">Select payment method</option>
                                  <option value="cash">Cash</option>
                                  <option value="credit_card">Credit Card</option>
                                  <option value="bank_transfer">Bank Transfer</option>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="transactionId" class="form-label">Transaction ID (if applicable)</label>
                              <input type="text" class="form-control" id="transactionId" name="transaction_id">
                          </div>
                          <div class="mb-3">
                              <label for="paymentDate" class="form-label">Payment Date</label>
                              <input type="datetime-local" class="form-control" id="paymentDate" name="payment_date"
                                  value="{{ now()->format('Y-m-d\TH:i') }}" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-warning shadow-0">Confirm Payment</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  @endif
