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
            <div class="alert alert-success alert-dismissible fade show border-start border-success border-3 w-25 m-3 z-50"
                style="position: fixed;bottom:10px;right:10px;z-index:1000;" data-aos="flip-up" data-aos-delay="100">
                <div class="d-flex align-items-center">
                    <i class="fa fa-check-circle me-2 fa-2x"></i>
                    <h3 class="alert-heading">Success!</h3>
                </div>
                <p class="mb-0">{{ session('success') }}</p>
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-lg-6 col-md-12 mt-2" data-aos="fade-up" data-aos-delay="100">
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
                                    <h3 class="font-bold text-dark">{{ $admin->fullName }}</h3>
                                    <small class="badge bg-primary rounded-5">{{ $admin->role->name }}</small>
                                </div>
                                <p class="text-secondary">{{ $admin->email }}</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name"
                                class="form-control p-2 bg-light @error('first_name', 'profile') is-invalid @enderror"
                                value="{{ old('first_name', $admin->first_name) }}">
                            @error('first_name', 'profile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name"
                                class="form-control p-2 bg-light @error('last_name', 'profile') is-invalid @enderror"
                                value="{{ old('last_name', $admin->last_name) }}">
                            @error('last_name', 'profile')
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
                            <button type="submit" class="btn btn-primary w-100 shadow-0 p-3">
                                Save Profile Changes
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-6 col-md-12 mt-2" data-aos="fade-up" data-aos-delay="200">
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
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-100 shadow-0 p-3">
                                Update Password
                            </button>
                        </div>
                    </div>
                    <div class="card shadow-0 border p-3 mt-3">
                        <small class="dropdown-item-text text-muted">
                            Last login:
                            {{ auth('admin')->user()->last_login_at ? auth('admin')->user()->last_login_at : 'Never' }}
                        </small>
                        <a class="dropdown-item mt-1" href="">
                            <i class="fas fa-play me-2"></i> Start Timer
                        </a>
                        <a class="dropdown-item mt-1" href="">
                            <i class="fas fa-stop me-2"></i> Stop Timer
                        </a>

                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="300">
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
                                    <option value="en"
                                        {{ old('language', $admin->language) == 'en' ? 'selected' : '' }}>
                                        English</option>
                                    <option value="fr"
                                        {{ old('language', $admin->language) == 'fr' ? 'selected' : '' }}>
                                        French</option>
                                    <option value="es"
                                        {{ old('language', $admin->language) == 'es' ? 'selected' : '' }}>
                                        Spanish</option>
                                    <option value="ar"
                                        {{ old('language', $admin->language) == 'ar' ? 'selected' : '' }}>
                                        Arabic</option>
                                </select>
                                @error('language', 'preferences')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-4 d-flex align-item-center justify-content-end">
                                <button type="submit" class="btn btn-primary shadow-0 p-3">Save Preferences</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card p-3 border shadow-sm mt-4" data-aos="fade-up" data-aos-duration="600">
                <h6 class="mb-3">Your Current Permissions</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach (json_decode(auth('admin')->user()->role->permissions ?? '[]') as $permission)
                        <span class="badge badge-primary rounded-pill px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> {{ $permission }}
                        </span>
                    @endforeach

                    @if (empty(json_decode(auth('admin')->user()->role->permissions ?? '[]')))
                        <div class="text-muted">No permissions assigned</div>
                    @endif
                </div>
            </div>
        </div>
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

    <script>
        AOS.init()
    </script>
@endpush
