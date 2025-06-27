@extends('admin/layouts/master')

@section('title')
    Settings | {{ config('app.name') }}
@endsection

@push('css')
    <style>
        /* Modern file upload styling */
        .upload-container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .file-upload-label {
            display: block;
            padding: 2rem;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            border-color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.05);
        }

        .file-upload-label i {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 0.5rem;
        }

        .file-upload-label h5 {
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .file-upload-label p {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        #fileInput {
            display: none;
        }
    </style>
@endpush

@section('content')
    <section>
        <h3 class="font-bold text-dark">Settings & Configuration</h3>
        <p class="text-secondary">Manage hotel information, room configurations, and system settings</p>
    </section>
    <section>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs border-bottom" id="hotelManagementTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-mdb-toggle="tab" data-mdb-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="true">Hotel Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="room-types-tab" data-mdb-toggle="tab" data-mdb-target="#room-types"
                    type="button" role="tab" aria-controls="room-types" aria-selected="false">Room Types &
                    Pricing</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="season-rates-tab" data-mdb-toggle="tab" data-mdb-target="#season-rates"
                    type="button" role="tab" aria-controls="season-rates" aria-selected="false">Season Rates &
                    Promotions</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="preferences-tab" data-mdb-toggle="tab" data-mdb-target="#preferences"
                    type="button" role="tab" aria-controls="preferences" aria-selected="false">System
                    Preferences</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="accounts-tab" data-mdb-toggle="tab" data-mdb-target="#accounts" type="button"
                    role="tab" aria-controls="accounts" aria-selected="false">User Accounts</button> --}}
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {{-- success closed message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-start border-success border-3"
                        role="alert">
                        <strong>Success!</strong>
                        <span class="text-muted"> {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- error message --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Please fix the following issues:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="text-dark font-bold">Hotel Profile</h4>
                        <button class="btn btn-primary shadow-0">Save Changes</button>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Basic Information</h4>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="hotel_name">Hotel Name</label>
                                        <input type="text" name="hotel_name" id="hotel_name"
                                            class="p-2 bg-light form-control @error('hotel_name') is-invalid @enderror"
                                            value="{{ old('hotel_name', $settings->hotel_name ?? '') }}" required>
                                        @error('hotel_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="legal_business_name">Legal Business Name</label>
                                        <input type="text" name="legal_business_name" id="legal_business_name"
                                            class="p-2 bg-light form-control @error('legal_business_name') is-invalid @enderror"
                                            value="{{ old('legal_business_name', $settings->legal_business_name ?? '') }}"
                                            required>
                                        @error('legal_business_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="hotel_description">Hotel Description</label>
                                        <textarea name="hotel_description" class="form-control bg-light @error('hotel_description') is-invalid @enderror"
                                            id="hotel_description" required>{{ old('hotel_description', $settings->hotel_description ?? '') }}</textarea>
                                        @error('hotel_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 mt-1">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" name="phone_number" id="phone_number"
                                            class="p-2 bg-light form-control @error('phone_number') is-invalid @enderror"
                                            value="{{ old('phone_number', $settings->phone_number ?? '') }}" required>
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="p-2 bg-light form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $settings->email ?? '') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="website">Website</label>
                                        <input type="url" name="website" id="website"
                                            class="p-2 bg-light form-control @error('website') is-invalid @enderror"
                                            value="{{ old('website', $settings->website ?? '') }}">
                                        @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Location & Address</h4>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="address_line_1">Address Line 1</label>
                                        <input type="text" name="address_line_1" id="address_line_1"
                                            class="p-2 bg-light form-control @error('address_line_1') is-invalid @enderror"
                                            value="{{ old('address_line_1', $settings->address_line_1 ?? '') }}" required>
                                        @error('address_line_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address_line_2">Address Line 2</label>
                                        <input type="text" name="address_line_2" id="address_line_2"
                                            class="p-2 bg-light form-control @error('address_line_2') is-invalid @enderror"
                                            value="{{ old('address_line_2', $settings->address_line_2 ?? '') }}">
                                        @error('address_line_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city"
                                            class="p-2 bg-light form-control @error('city') is-invalid @enderror"
                                            value="{{ old('city', $settings->city ?? '') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="state_province">State/Province</label>
                                        <input type="text" name="state_province" id="state_province"
                                            class="p-2 bg-light form-control @error('state_province') is-invalid @enderror"
                                            value="{{ old('state_province', $settings->state_province ?? '') }}" required>
                                        @error('state_province')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="zip_postal_code">ZIP/Postal Code</label>
                                        <input type="text" name="zip_postal_code" id="zip_postal_code"
                                            class="p-2 bg-light form-control @error('zip_postal_code') is-invalid @enderror"
                                            value="{{ old('zip_postal_code', $settings->zip_postal_code ?? '') }}"
                                            required>
                                        @error('zip_postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="country">Country</label>
                                        <select name="country" id="country"
                                            class="p-2 bg-light form-control @error('country') is-invalid @enderror"
                                            required>
                                            <option value="">Select Country</option>
                                            @foreach (config('countries') as $code => $name)
                                                <option value="{{ $code }}"
                                                    {{ old('country', $settings->country ?? '') == $code ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude"
                                            class="p-2 bg-light form-control @error('latitude') is-invalid @enderror"
                                            value="{{ old('latitude', $settings->latitude ?? '') }}">
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude"
                                            class="p-2 bg-light form-control @error('longitude') is-invalid @enderror"
                                            value="{{ old('longitude', $settings->longitude ?? '') }}">
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Property Details</h4>

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="star_rating">Star Rating</label>
                                        <select name="star_rating" id="star_rating"
                                            class="p-2 bg-light form-control @error('star_rating') is-invalid @enderror">
                                            <option value="">Select Rating</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('star_rating', $settings->star_rating ?? '') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('star_rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="total_rooms">Total Rooms</label>
                                        <input type="number" name="total_rooms" id="total_rooms"
                                            class="p-2 bg-light form-control @error('total_rooms') is-invalid @enderror"
                                            value="{{ old('total_rooms', $settings->total_rooms ?? '') }}"
                                            min="0">
                                        @error('total_rooms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="total_floors">Total Floors</label>
                                        <input type="number" name="total_floors" id="total_floors"
                                            class="p-2 bg-light form-control @error('total_floors') is-invalid @enderror"
                                            value="{{ old('total_floors', $settings->total_floors ?? '') }}"
                                            min="0">
                                        @error('total_floors')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-1">
                                        <label for="year_built">Year Built</label>
                                        <input type="number" name="year_built" id="year_built"
                                            class="p-2 bg-light form-control @error('year_built') is-invalid @enderror"
                                            value="{{ old('year_built', $settings->year_built ?? '') }}" min="1800"
                                            max="{{ date('Y') + 1 }}">
                                        @error('year_built')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="property_amenities">Property Amenities</label>
                                        <textarea name="property_amenities" id="property_amenities"
                                            class="form-control bg-light @error('property_amenities') is-invalid @enderror" rows="5">{{ old('property_amenities', $settings->property_amenities ?? '') }}</textarea>
                                        <small class="text-muted">Separate amenities with commas or new lines</small>
                                        @error('property_amenities')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="hotel_policies">Hotel Policies</label>
                                        <textarea name="hotel_policies" id="hotel_policies"
                                            class="form-control bg-light @error('hotel_policies') is-invalid @enderror" rows="5">{{ old('hotel_policies', $settings->hotel_policies ?? '') }}</textarea>
                                        @error('hotel_policies')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Tax & Financial Information</h4>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="tax_id">Tax ID/EIN</label>
                                        <input type="text" name="tax_id" id="tax_id"
                                            class="p-2 bg-light form-control @error('tax_id') is-invalid @enderror"
                                            value="{{ old('tax_id', $settings->tax_id ?? '') }}">
                                        @error('tax_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="default_currency">Default Currency</label>
                                        <select name="default_currency" id="default_currency"
                                            class="p-2 bg-light form-control @error('default_currency') is-invalid @enderror"
                                            required>
                                            @foreach (config('currencies') as $code => $name)
                                                <option value="{{ $code }}"
                                                    {{ old('default_currency', $settings->default_currency ?? 'USD') == $code ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('default_currency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4 mt-1">
                                        <label for="vat_tax_rate">VAT/Tax Rate (%)</label>
                                        <div class="input-group">
                                            <input type="number" name="vat_tax_rate" id="vat_tax_rate"
                                                class="p-2 bg-light form-control @error('vat_tax_rate') is-invalid @enderror"
                                                value="{{ old('vat_tax_rate', $settings->vat_tax_rate ?? '') }}"
                                                min="0" max="100" step="0.01">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        @error('vat_tax_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="occupancy_tax_rate">Occupancy Tax Rate (%)</label>
                                        <div class="input-group">
                                            <input type="number" name="occupancy_tax_rate" id="occupancy_tax_rate"
                                                class="p-2 bg-light form-control @error('occupancy_tax_rate') is-invalid @enderror"
                                                value="{{ old('occupancy_tax_rate', $settings->occupancy_tax_rate ?? '') }}"
                                                min="0" max="100" step="0.01">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        @error('occupancy_tax_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="service_charge_rate">Service Charge Rate (%)</label>
                                        <div class="input-group">
                                            <input type="number" name="service_charge_rate" id="service_charge_rate"
                                                class="p-2 bg-light form-control @error('service_charge_rate') is-invalid @enderror"
                                                value="{{ old('service_charge_rate', $settings->service_charge_rate ?? '') }}"
                                                min="0" max="100" step="0.01">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        @error('service_charge_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-0 border p-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if ($settings && $settings->logo_path)
                                            <div class="current-logo mb-4">
                                                <img src="{{ asset($settings->logo_path) }}" alt="Hotel Logo"
                                                    class="img-thumbnail w-100 object-fit-cover"
                                                    style="max-height: 150px;">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" class="form-check-input" id="remove_logo"
                                                        name="remove_logo">
                                                    <small class="form-check-label text-danger" for="remove_logo">Remove
                                                        current
                                                        logo</small>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                    </div>

                                    <div class="col-md-10">
                                        <div class="upload-container">
                                            <label for="hotel_logo" class="file-upload-label">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <h5>Upload Hotel Icon</h5>
                                                <p>Drag & drop logo here or click to browse</p>
                                                <small class="text-muted">Supports JPG, PNG up to 5MB</small>
                                            </label>
                                            <input type="file" id="hotel_logo" name="hotel_logo" accept="image/*"
                                                class="d-none">
                                        </div>
                                    </div>

                                </div>
                                @error('hotel_logo')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="room-types" role="tabpanel" aria-labelledby="room-types-tab">
                <h4 class="text-dark font-bold">Pricing</h4>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border">
                            <div class="card-header">
                                <h4 class="mb-0">Current Pricing Rules</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Weekend Rate Adjustment</h6>
                                            <p class="h5">{{ $Pricingsettings['weekend_rate'] ?? 'Not set' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Extended Stay Discount</h6>
                                            <p class="h5">
                                                {{ $Pricingsettings['extended_stay_discount'] ?? 'Not set' }}%</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Group Booking Discount</h6>
                                            <p class="h5">
                                                {{ $Pricingsettings['group_booking_discount'] ?? 'Not set' }}%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Early Bird Discount</h6>
                                            <p class="h5">{{ $Pricingsettings['early_bird_discount'] ?? 'Not set' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Loyalty Program Discount</h6>
                                            <p class="h5">
                                                {{ $Pricingsettings['loyalty_program_discount'] ?? 'Not set' }}%
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="setting-item p-3 border rounded mb-3">
                                            <h6 class="text-muted">Last Minute Surcharge</h6>
                                            <p class="h5">
                                                {{ $Pricingsettings['last_minute_surcharge'] ?? 'Not set' }}%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <form action="{{ route('admin.settings.pricing-rules.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Pricing Rules</h4>
                                <div class="row mt-3">
                                    <div class="col-md-4 mt-1">
                                        <label for="weekend_rate">Weekend Rate Adjustment</label>
                                        <input type="text" name="weekend_rate" id="weekend_rate"
                                            value="{{ old('weekend_rate', $settings['weekend_rate'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="extended_stay_discount">Extended Stay Discount</label>
                                        <input type="number" name="extended_stay_discount" id="extended_stay_discount"
                                            value="{{ old('extended_stay_discount', $settings['extended_stay_discount'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="group_booking_discount">Group Booking Discount</label>
                                        <input type="number" name="group_booking_discount" id="group_booking_discount"
                                            value="{{ old('group_booking_discount', $settings['group_booking_discount'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 mt-1">
                                        <label for="early_bird_discount">Early Bird Discount</label>
                                        <input type="text" name="early_bird_discount" id="early_bird_discount"
                                            value="{{ old('early_bird_discount', $settings['early_bird_discount'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="loyalty_program_discount">Loyalty Program Discount</label>
                                        <input type="number" name="loyalty_program_discount"
                                            id="loyalty_program_discount"
                                            value="{{ old('loyalty_program_discount', $settings['loyalty_program_discount'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <label for="last_minute_surcharge">Last Minute Surcharge</label>
                                        <input type="number" name="last_minute_surcharge" id="last_minute_surcharge"
                                            value="{{ old('last_minute_surcharge', $settings['last_minute_surcharge'] ?? '') }}"
                                            class="p-2 bg-light form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="d-flex align-items-center justify-content-end gap-4">
                                        <button class="btn btn-primary shadow-0" type="submit">Update Pricing
                                            Rules</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="season-rates" role="tabpanel" aria-labelledby="season-rates-tab">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-bold">Season Rates & Promotions</h4>
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-light border shadow-0" data-mdb-toggle="modal"
                            data-mdb-target="#addSeasonalRatePeriodModal">
                            <i class="fa fa-plus"></i> Add Season
                        </button>
                        <button class="btn btn-primary shadow-0" id="AddPromotionBtn">Add Promotion</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border p-3">
                            <h4 class="text-dark">Seasonal Rate Periods</h4>
                            <div class="table-responsive">
                                <table class="table w-100" id="SeasonalRatePeriodsTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Season</th>
                                            <th>Date Rate</th>
                                            <th>Rate Adjustment</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($periods as $period)
                                            <tr class="hover-primary" data-id="{{ $period->id }}">
                                                <td>{{ $period->name }}</td>
                                                <td>{{ $period->start_date->format('Y-m-d') }} to
                                                    {{ $period->end_date->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($period->rate_adjustment_type === 'base_rate')
                                                        Base Rate
                                                    @else
                                                        {{ $period->rate_adjustment_type === 'percentage' ? $period->rate_adjustment_value . '%' : '$' . $period->rate_adjustment_value }}
                                                        {{ $period->rate_adjustment_value >= 0 ? 'Increase' : 'Decrease' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $period->is_active ? 'success' : 'danger' }}">
                                                        {{ $period->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-light border btn-sm shadow-0 edit-btn-period"
                                                        data-id="{{ $period->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-light border btn-sm shadow-0 delete-period"
                                                        data-id="{{ $period->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border p-3">
                            <h4 class="text-dark">Current Promotions</h4>
                            <div class="table-responsive">
                                <table class="table w-100" id="PromotionsTables">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Validity</th>
                                            <th>Room Types</th>
                                            <th>Promo Code</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotions as $promotion)
                                            <tr class="hover-primary">
                                                <td>{{ $promotion->name }}</td>
                                                <td>{{ $promotion->discount }}%</td>
                                                <td>{{ $promotion->start_date->format('Y-m-d') }} to
                                                    {{ $promotion->end_date->format('Y-m-d') }}</td>
                                                <td>{{ implode(', ', $promotion->room_types) }}</td>
                                                <td><span class="badge bg-secondary">{{ $promotion->promo_code }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $promotion->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($promotion->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.promotions.edit', $promotion->id) }}"
                                                        class="btn btn-light border shadow-0 btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.promotions.destroy', $promotion->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-light border shadow-0 btn-sm"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-bold">System Preferences</h4>
                    <button class="btn btn-primary shadow-0">Save All Settings</button>
                </div>
                <ul class="nav nav-tabs border-bottom" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-mdb-toggle="tab"
                            data-mdb-target="#general" type="button" role="tab" aria-controls="general"
                            aria-selected="true">
                            General
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="booking-tab" data-mdb-toggle="tab" data-mdb-target="#booking"
                            type="button" role="tab" aria-controls="booking" aria-selected="false">
                            Booking
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notifications-tab" data-mdb-toggle="tab"
                            data-mdb-target="#notifications" type="button" role="tab" aria-controls="notifications"
                            aria-selected="false">
                            Notifications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-mdb-toggle="tab" data-mdb-target="#security"
                            type="button" role="tab" aria-controls="security" aria-selected="false">
                            Security
                        </button>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="settingsTabsContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Regional Settings</h4>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="">Default Language</label>
                                            <input type=" text" class="form-control p-2 bg-light">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Timezone</label>
                                            <input type=" text" class="form-control p-2 bg-light">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Date Format</label>
                                            <input type=" text" class="form-control p-2 bg-light">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="">Currency Format</label>
                                            <input type=" text" class="form-control p-2 bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Measurement System</label>
                                            <input type=" text" class="form-control p-2 bg-light">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">User Interface</h4>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label for="">UI Theme</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Default Rows Per Page</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Compact Mode</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Auto-refresh Dashboard</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Enable Animations</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Booking Settings</h4>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label for="">Default Check-in Time</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Default Check-out Time</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Minimum Advance Booking</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label for="">Maximum Advance Booking</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Default Minimum Stay</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Default Cancellation Policy</label>
                                            <input type="text" class="form-control bg-light p-2">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Allow Overbooking</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Auto-confirm Online Bookings</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Require Credit Card for Reservation</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Block Blacklisted Guests</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Email Notifications</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Sender Email Address</label>
                                            <input type="text" class="p-2 form-control bg-light">
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>New Booking Confirmation</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Booking Cancellation</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Booking Modification</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Check-in Reminder (24h before)</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Post-stay Thank You</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">System Alerts</h4>

                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Low Inventory Alerts</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Maintenance Issues</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Guest Complaints</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>VIP Guest Arrival</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Overdue Payments</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mt-1">
                                            <label for="">Alert Email Recipients</label>
                                            <input type="text" class="form-control p-2 bg-light" name=""
                                                id="">
                                        </div>
                                        <div class="col-md-6 mt-1">
                                            <label for="">Alert Frequency Limit</label>
                                            <input type="text" class="form-control p-2 bg-light" name=""
                                                id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Security Settings</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Password Policy</label>
                                            <input type="text" class="form-control p-2 bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Password Expiry</label>
                                            <input type="text" class="form-control p-2 bg-light">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Session Timeout</label>
                                            <input type="text" class="form-control p-2 bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Max Failed Login Attempts</label>
                                            <input type="text" class="form-control p-2 bg-light">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Require Two-Factor Authentication</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>IP Address Restrictions</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status">
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Enhanced PCI Compliance Mode</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <strong>Detailed Audit Logs</strong>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" checked>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <strong>Data Retention Policy</strong>
                                        <div class="p-3 bg-light">
                                            <p class="text-secondary">Guest data is retained for 7 years after last
                                                stay. Credit card information is encrypted and purged after 18
                                                months of inactivity. All access to sensitive data is logged.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="text-dark font-bold">User Account Management</h4>
                    <button class="btn btn-primary shadow-0">Add New User</button>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border p-3">
                            <h4 class="text-dark">User Accounts</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>User</th>
                                            <th>Role</th>
                                            <th>Department</th>
                                            <th>Last Login</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- John Doe -->
                                        <tr>
                                            <td><strong>John Doe</strong> <br>
                                                <small>john.doe@hotelhive.com</small>
                                            </td>
                                            <td>Hotel Manager</td>
                                            <td>Management</td>
                                            <td>Today, 10:45 AM</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit</button>
                                                <button class="btn  btn-outline-secondary">Reset
                                                    Password</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jane Smith</strong>
                                                <br>
                                                <span>jane.smith@hotelhive.com</span>
                                            </td>
                                            <td>Front Desk Manager</td>
                                            <td>Front Office</td>
                                            <td>Today, 9:15 AM</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit</button>
                                                <button class="btn  btn-outline-secondary">Reset
                                                    Password</button>
                                            </td>
                                        </tr>

                                        <!-- Michael Johnson -->
                                        <tr>
                                            <td><strong>Michael Johnson</strong> <br>
                                                <small>michael.johnson@hotelhive.com</small>
                                            </td>
                                            <td>Housekeeping Supervisor</td>
                                            <td>Housekeeping</td>
                                            <td>Yesterday, 4:30 PM</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit</button>
                                                <button class="btn  btn-outline-secondary">Reset
                                                    Password</button>
                                            </td>
                                        </tr>

                                        <!-- Lisa Brown -->
                                        <tr>
                                            <td><strong>Lisa
                                                    Brown</strong><br><small>lisa.brown@hotelhive.com</small></td>
                                            <td>Financial Controller</td>
                                            <td>Finance</td>
                                            <td>Oct 21, 2023</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit</button>
                                                <button class="btn  btn-outline-secondary">Reset
                                                    Password</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Robert
                                                    Wilson</strong><br><small>robert.wilson@hotelhive.com</small>
                                            </td>
                                            <td>IT Administrator</td>
                                            <td>IT</td>
                                            <td>Oct 20, 2023</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit</button>
                                                <button class="btn  btn-outline-secondary">Reset
                                                    Password</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border p-3">
                            <h4 class="text-dark">User Roles</h4>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Role Name</th>
                                            <th>Active Users</th>
                                            <th>Permissions</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- System Administrator -->
                                        <tr>
                                            <td><strong>System Administrator</strong></td>
                                            <td>1</td>
                                            <td>Full system access</td>
                                            <td>Can manage all aspects of the system including user accounts and
                                                system settings.</td>
                                            <td>
                                                <button class="btn btn-outline-primary">Edit Role</button>
                                            </td>
                                        </tr>

                                        <!-- Hotel Manager -->
                                        <tr>
                                            <td><strong>Hotel Manager</strong></td>
                                            <td>2</td>
                                            <td>Hotel management access</td>
                                            <td>Can access all hotel management functions but not system
                                                configuration.</td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit Role</button>
                                            </td>
                                        </tr>

                                        <!-- Front Desk Agent -->
                                        <tr>
                                            <td><strong>Front Desk Agent</strong></td>
                                            <td>5</td>
                                            <td>Reservations, check-in/out</td>
                                            <td>Can manage reservations, check guests in and out, and handle guest
                                                inquiries.</td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit Role</button>
                                            </td>
                                        </tr>

                                        <!-- Housekeeping Staff -->
                                        <tr>
                                            <td><strong>Housekeeping Staff</strong></td>
                                            <td>8</td>
                                            <td>Room status updates</td>
                                            <td>Can update room cleaning status and view room assignments.</td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit Role</button>
                                            </td>
                                        </tr>

                                        <!-- Financial Staff -->
                                        <tr>
                                            <td><strong>Financial Staff</strong></td>
                                            <td>3</td>
                                            <td>Financial reports, billing</td>
                                            <td>Can access financial reports, process payments, and manage billing.
                                            </td>
                                            <td>
                                                <button class="btn  btn-outline-primary">Edit Role</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card shadow-0 border p-3">
                            <h4 class="text-dark">Add/Edit User</h4>
                            <div class="row mt-3">
                                <div class="col-md-6 mt-1">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control p-2 bg-light">
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control p-2 bg-light">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 mt-1">
                                    <label for="">Role</label>
                                    <input type="text" class="form-control p-2 bg-light">
                                </div>
                                <div class="col-md-4 mt-1">
                                    <label for="">Department</label>
                                    <input type="text" class="form-control p-2 bg-light">
                                </div>
                                <div class="col-md-4 mt-1">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control p-2 bg-light">
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-md-10 mt-1">
                                    <label for="">Generate Password</label>
                                    <input type="text" class="form-control p-2 bg-light">
                                </div>
                                <div class="col-md-2 mt-1 d-flex align-items-end">
                                    <button type="button" class="form-control p-2 bg-light">Generate</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <small class="text-secondary">A secure password will be generated and emailed to the
                                    user.</small>
                            </div>
                            <div class="row mt-3">
                                <div class="d-flex align-items-center justify-content-end gap-4">
                                    <button class="btn btn-outline-secondary shadow-0" type="button">Cancel</button>
                                    <button class="btn btn-primary shadow-0" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.pages.settings.partials.seasonal-rate-periods-modals')
    @include('admin.pages.settings.partials.add-promotion-modal')
@endsection

@push('js')
    <script>
        new DataTable("#SeasonalRatePeriodsTable");
        new DataTable("#PromotionsTables");
    </script>

    <script>
        $("#AddPromotionBtn").click(function() {
            $("#AddPromotionModal").modal('show');
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Toggle rate adjustment value field based on type (Add Modal)
            $('#add_rate_adjustment_type').change(function() {
                if ($(this).val() === 'base_rate') {
                    $('#add_rateAdjustmentValueContainer').hide();
                    $('#add_rate_adjustment_value').val('').removeAttr('required');
                } else {
                    $('#add_rateAdjustmentValueContainer').show();
                    $('#add_rate_adjustment_value').attr('required', 'required');
                }
            }).trigger('change');

            // Toggle rate adjustment value field based on type (Edit Modal)
            $('#edit_rate_adjustment_type').change(function() {
                if ($(this).val() === 'base_rate') {
                    $('#edit_rateAdjustmentValueContainer').hide();
                    $('#edit_rate_adjustment_value').val('').removeAttr('required');
                } else {
                    $('#edit_rateAdjustmentValueContainer').show();
                    $('#edit_rate_adjustment_value').attr('required', 'required');
                }
            });

            // Add form submission
            $('#addSeasonalRatePeriodForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/admin/seasonal-rate-periods',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addSeasonalRatePeriodModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });

            // Edit button click
            $(document).on('click', '.edit-btn-period', function() {
                let periodId = $(this).data('id');

                $.get('/admin/seasonal-rate-periods/' + periodId, function(data) {
                    $('#edit_periodId').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_start_date').val(data.start_date);
                    $('#edit_end_date').val(data.end_date);
                    $('#edit_rate_adjustment_type').val(data.rate_adjustment_type).trigger(
                        'change');
                    $('#edit_rate_adjustment_value').val(data.rate_adjustment_value);
                    $('#edit_is_active').prop('checked', data.is_active);

                    $('#editSeasonalRatePeriodModal').modal('show');
                }).fail(function(xhr) {
                    alert('Failed to load period data');
                    console.error(xhr.responseText);
                });
            });

            // Edit form submission
            $('#editSeasonalRatePeriodForm').submit(function(e) {
                e.preventDefault();
                let periodId = $('#edit_periodId').val();

                $.ajax({
                    url: '/admin/seasonal-rate-periods/' + periodId,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editSeasonalRatePeriodModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });

            // Delete button click
            let deletePeriodId;
            $(document).on('click', '.delete-period', function() {
                deletePeriodId = $(this).data('id');
                $('#deleteSeasonalRatePeriodModal').modal('show');
            });

            // Confirm delete
            $('#confirmDelete').click(function() {
                $.ajax({
                    url: '/admin/seasonal-rate-periods/' + deletePeriodId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteSeasonalRatePeriodModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Failed to delete period');
                        console.error(xhr.responseText);
                    }
                });
            });

            // Reset add form when modal is shown
            $('#addSeasonalRatePeriodModal').on('show.bs.modal', function() {
                $('#addSeasonalRatePeriodForm')[0].reset();
                $('#add_rate_adjustment_type').trigger('change');
            });
        });
    </script>
@endpush
