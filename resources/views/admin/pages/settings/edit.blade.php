@extends('admin/layouts/master')

@section('title')
    Edit
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-0 border p-3">
            <h4 class="text-dark">Edit Promotion</h4>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="name">Promotion Name</label>
                        <input type="text" name="name" id="name" class="form-control p-2 bg-light" value="{{ $promotion->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="discount">Discount Amount (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control p-2 bg-light" min="0" max="100" step="0.01" value="{{ $promotion->discount }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-12">
                        <label>Promotion Period</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control p-2 bg-light" value="{{ $promotion->start_date->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control p-2 bg-light" value="{{ $promotion->end_date->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label>Applicable Room Types</label>
                        <div class="mt-2">
                            @foreach(['All Room Types', 'Standard Room', 'Deluxe Room', 'Suite', 'Executive Suite', 'Penthouse'] as $roomType)
                            <label>
                                <input type="checkbox" name="room_types[]" value="{{ $roomType }}"
                                    {{ in_array($roomType, $promotion->room_types) ? 'checked' : '' }}>
                                {{ $roomType }}
                            </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="promo_code">Promotion Code</label>
                        <input type="text" name="promo_code" id="promo_code" class="form-control p-2 bg-light" value="{{ $promotion->promo_code }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control p-2 bg-light" required>
                            <option value="active" {{ $promotion->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $promotion->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="description">Description & Terms</label>
                        <textarea name="description" id="description" class="form-control p-2 bg-light" rows="3">{{ $promotion->description }}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="d-flex align-items-center justify-content-end gap-4">
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary shadow-0">Cancel</a>
                        <button class="btn btn-primary shadow-0" type="submit">Update Promotion</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
