@extends('admin/layouts/master')

@section('title')
    Admin Profile
@endsection

@push('css')
@endpush

@section('content')
    <section>
        <h3 class="font-bold text-dark">Admin Profile</h3>
        <p class="text-secondary">Manage your administrator account settings and preferences</p>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-lg-6 col-md-12 mt-2">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-0 border p-3">
                        <h4 class="text-dark">Profile Information</h4>

                        @if ($errors->profile->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->profile->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex align-item-center justify-content-start gap-3">
                            <div class="position-relative">
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                    style="width: 70px;height: 70px;overflow:hidden;">
                                    @if ($admin->image_path)
                                        <img src="{{ asset('assets/admin/img/admin/' . $admin->image_path) }}"
                                            alt="Profile Image" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i class="fa fa-user text-white fa-xl"></i>
                                    @endif
                                </div>
                                <input type="file" name="image" id="image" class="d-none" accept="image/*">
                                <label for="image"
                                    class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1 d-flex align-items-center justify-content-center"
                                    style="width:30px;height:30px;cursor:pointer;">
                                    <i class="fa fa-camera fa-xs"></i>
                                </label>
                            </div>
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <h3 class="font-bold text-dark">{{ $admin->name }}</h3>
                                    <small class="badge bg-primary rounded-5">Administrator</small>
                                </div>
                                <p class="text-secondary">{{ $admin->email }}</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="name"
                                class="form-control p-2 bg-light @error('name', 'profile') is-invalid @enderror"
                                value="{{ old('name', $admin->name) }}">
                            @error('name', 'profile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="email">Email Address</label>
                            <input type="email" name="email"
                                class="form-control p-2 bg-light @error('email', 'profile') is-invalid @enderror"
                                value="{{ old('email', $admin->email) }}">
                            @error('email', 'profile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone"
                                class="form-control p-2 bg-light @error('phone', 'profile') is-invalid @enderror"
                                value="{{ old('phone', $admin->phone) }}">
                            @error('phone', 'profile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100 shadow-0 p-2">
                                Save Profile Changes
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-6 col-md-12 mt-2">
                <form action="{{ route('admin.security.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-0 border p-3">
                        <h4 class="text-dark">Security Settings</h4>

                        @if ($errors->security->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->security->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password"
                                class="form-control p-2 bg-light @error('current_password', 'security') is-invalid @enderror">
                            @error('current_password', 'security')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password"
                                class="form-control p-2 bg-light @error('new_password', 'security') is-invalid @enderror">
                            @error('new_password', 'security')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password"
                                class="form-control p-2 bg-light @error('confirm_password', 'security') is-invalid @enderror">
                            @error('confirm_password', 'security')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn btn-primary w-100 shadow-0 p-2">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <form action="{{ route('admin.preferences.update') }}" method="POST" id="preferencesForm">
            @csrf
            @method('PUT')
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-0 border p-3">
                        <h4 class="text-dark">Account Preferences</h4>

                        @if ($errors->preferences->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->preferences->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-3">
                            <label for="timezone">Timezone</label>
                            <select name="timezone"
                                class="form-control p-2 bg-light @error('timezone', 'preferences') is-invalid @enderror">
                                @foreach (timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}"
                                        {{ old('timezone', $admin->timezone) == $timezone ? 'selected' : '' }}>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone', 'preferences')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="language">Language</label>
                            <select name="language"
                                class="form-control p-2 bg-light @error('language', 'preferences') is-invalid @enderror">
                                <option value="en" {{ old('language', $admin->language) == 'en' ? 'selected' : '' }}>
                                    English</option>
                                <option value="fr" {{ old('language', $admin->language) == 'fr' ? 'selected' : '' }}>
                                    French</option>
                                <option value="es" {{ old('language', $admin->language) == 'es' ? 'selected' : '' }}>
                                    Spanish</option>
                                <option value="ar" {{ old('language', $admin->language) == 'ar' ? 'selected' : '' }}>
                                    Arabic</option>
                            </select>
                            @error('language', 'preferences')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4 d-flex align-item-center justify-content-end">
                            <button type="submit" class="btn btn-primary shadow-0 p-2">Save Preferences</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


@endsection

@push('js')
    <script>
        // Separate form for security updates
        const securityForm = document.createElement('form');
        securityForm.id = 'securityForm';
        securityForm.method = 'POST';
        securityForm.action = '{{ route('admin.security.update') }}';
        securityForm.innerHTML = `
        @csrf
        @method('PUT')
        <input type="hidden" name="current_password">
        <input type="hidden" name="new_password">
        <input type="hidden" name="confirm_password">
    `;
        document.body.appendChild(securityForm);

        // Update hidden inputs before security form submission
        const submitButton = document.querySelector('#securityForm button[type="submit"]');
        if (submitButton) {
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('#securityForm input[name="current_password"]').value =
                    document.querySelector('input[name="current_password"]').value;
                document.querySelector('#securityForm input[name="new_password"]').value =
                    document.querySelector('input[name="new_password"]').value;
                document.querySelector('#securityForm input[name="confirm_password"]').value =
                    document.querySelector('input[name="confirm_password"]').value;
                document.querySelector('#securityForm').submit();
            });
        }
    </script>
@endpush
