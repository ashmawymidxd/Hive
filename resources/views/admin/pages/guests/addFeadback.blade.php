<div class="card shadow-2 p-4">
    <h4 class="mb-4">Share Your Feedback</h4>
    
    <form action="{{ route('guest.feedback.store') }}" method="POST">
        @csrf
        
        <input type="hidden" name="reservation_id" value="{{ $reservation->id ?? '' }}">
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Feedback Type</label>
                <select class="form-select" name="type" required>
                    <option value="feedback">General Feedback</option>
                    <option value="complaint">Complaint</option>
                    <option value="suggestion">Suggestion</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select class="form-select" name="category">
                    <option value="">Select category</option>
                    <option value="cleanliness">Cleanliness</option>
                    <option value="service">Service</option>
                    <option value="amenities">Amenities</option>
                    <option value="food">Food Quality</option>
                    <option value="staff">Staff Behavior</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Your Rating (1-5)</label>
            <div class="rating-input">
                @for($i = 1; $i <= 5; $i++)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                    <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                @endfor
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Your Message</label>
            <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>

<style>
.rating-input {
    display: flex;
    direction: rtl; /* Right to left */
}
.rating-input input {
    display: none;
}
.rating-input label {
    color: #ddd;
    font-size: 24px;
    padding: 0 5px;
    cursor: pointer;
}
.rating-input input:checked ~ label,
.rating-input label:hover,
.rating-input label:hover ~ label {
    color: #ffc107;
}
</style>