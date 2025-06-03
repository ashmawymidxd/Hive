@extends('admin/layouts/master')

@section('title')
    Show Room
@endsection

@push('css')
    <style>
        /* Modern card styling */
        .room-detail-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .room-detail-card .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
        }

        .room-detail-card .card-body {
            padding: 1.5rem;
        }

        /* Detail item styling */
        .detail-item {
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #212529;
        }

        /* Amenities styling */
        .amenity-badge {
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 0.35rem 0.65rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
            font-size: 0.8rem;
        }

        /* Image gallery styling */
        .image-gallery-container {
            margin-top: 2rem;
        }

        .image-card {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .image-card .card-img-top {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .image-card .card-body {
            padding: 0.75rem;
            background-color: #f8f9fa;
            flex-grow: 1;
        }

        .image-meta {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .image-meta span {
            display: block;
            margin-bottom: 0.2rem;
        }

        .image-meta i {
            width: 16px;
            text-align: center;
            margin-right: 4px;
        }

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

        /* Preview container */
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .preview-item {
            position: relative;
            width: 150px;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
            padding: 0.5rem;
        }

        .preview-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 0.5rem;
        }

        .preview-meta {
            font-size: 0.7rem;
            color: #6c757d;
        }

        .preview-meta span {
            display: block;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        /* Status badge */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-available {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .status-occupied {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .status-maintenance {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card room-detail-card shadow-0 border">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Room Details - {{ $room->room_number }}</h4>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Rooms
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Room Number</div>
                                    <div class="detail-value">{{ $room->room_number }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Type</div>
                                    <div class="detail-value">{{ $room->type }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Floor</div>
                                    <div class="detail-value">{{ $room->floor }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Status</div>
                                    <div class="detail-value">
                                        <span class="status-badge status-{{ $room->status }}">
                                            {{ ucfirst($room->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Price</div>
                                    <div class="detail-value">${{ number_format($room->price, 2) }} <small
                                            class="text-muted">/ night</small></div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Capacity</div>
                                    <div class="detail-value">{{ $room->capacity }} <small class="text-muted">guests</small>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Created At</div>
                                    <div class="detail-value">
                                        {{ $room->created_at->format('D M, Y H:i') }}
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Amenities</div>
                                    <div class="detail-value">
                                        @forelse ($room->amenities as $amenity)
                                            <span class="amenity-badge"><i class="fa {{ $amenity->icon }} me-1"></i> |
                                                {{ $amenity->name }}</span>
                                        @empty
                                            <span class="text-muted">No amenities added</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="detail-item">
                                    <div class="detail-label">Description</div>
                                    <div class="detail-value">{{ $room->description ?? 'No description provided' }}</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="image-gallery-container">
                            <h5 class="mb-4">Room Images</h5>

                            <form action="{{ route('admin.rooms.upload-images', $room->id) }}" method="POST"
                                enctype="multipart/form-data" id="uploadForm">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="upload-container">
                                    <label for="fileInput" class="file-upload-label">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <h5>Upload Room Images</h5>
                                        <p>Drag & drop images here or click to browse</p>
                                        <small class="text-muted">Supports JPG, PNG up to 5MB</small>
                                    </label>
                                    <input type="file" id="fileInput" name="images[]" multiple accept="image/*">
                                </div>

                                <div class="preview-container" id="imagePreviewContainer"></div>

                                <button type="submit" class="btn btn-primary mt-3 w-100" id="uploadBtn" disabled>
                                    <i class="fas fa-upload me-2"></i> Upload Images
                                </button>
                            </form>

                            <div class="row mt-5" id="roomImagesGallery">
                                @foreach ($room->images as $image)
                                    @php
                                        $imagePath = public_path($image->image_path);
                                        $imageSize = file_exists($imagePath) ? filesize($imagePath) : 0;
                                        $imageDimensions = getimagesize($imagePath) ?: [0, 0];
                                    @endphp

                                    <div class="col-md-3 mb-4 image-container" data-id="{{ $image->id }}">
                                        <div class="card image-card">
                                            <img src="{{ asset($image->image_path) }}" class="card-img-top"
                                                alt="Room Image">
                                            <div class="card-body">
                                                <div class="image-meta">
                                                    <span><i class="fas fa-file-image"></i>
                                                        {{ strtoupper(pathinfo($image->image_path, PATHINFO_EXTENSION)) }}</span>
                                                    <span><i class="fas fa-ruler-combined"></i> {{ $imageDimensions[0] }} ×
                                                        {{ $imageDimensions[1] }} px</span>
                                                    <span><i class="fas fa-weight-hanging"></i>
                                                        {{ round($imageSize / 1024 / 1024, 1) }} MB</span>
                                                    <span><i class="fas fa-calendar-alt"></i>
                                                        {{ $image->created_at->format('M d, Y H:i') }}</span>
                                                </div>
                                                <button class="btn btn-outline-danger btn-sm w-100 delete-image-btn">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($room->images->isEmpty())
                                    <div class="col-12 text-center py-4">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No images uploaded for this room yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Handle image preview before upload
            const fileInput = document.getElementById('fileInput');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const uploadBtn = document.getElementById('uploadBtn');

            fileInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';

                if (this.files.length > 0) {
                    uploadBtn.disabled = false;

                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const img = new Image();
                                img.src = e.target.result;

                                img.onload = function() {
                                    const previewItem = document.createElement('div');
                                    previewItem.className = 'preview-item';

                                    const imgElement = document.createElement('img');
                                    imgElement.src = e.target.result;

                                    const metaContainer = document.createElement('div');
                                    metaContainer.className = 'preview-meta';

                                    const fileType = document.createElement('span');
                                    fileType.innerHTML =
                                        `<i class="fas fa-file-image"></i> ${file.name.split('.').pop().toUpperCase()}`;

                                    const dimensions = document.createElement('span');
                                    dimensions.innerHTML =
                                        `<i class="fas fa-ruler-combined"></i> ${img.width} × ${img.height} px`;

                                    const fileSize = document.createElement('span');
                                    fileSize.innerHTML =
                                        `<i class="fas fa-weight-hanging"></i> ${((file.size / 1024)/1024).toFixed(1)} MB`;

                                    const removeBtn = document.createElement('div');
                                    removeBtn.className = 'remove-btn';
                                    removeBtn.innerHTML = '×';
                                    removeBtn.addEventListener('click', function() {
                                        previewItem.remove();
                                        // Check if any files left
                                        if (previewContainer.children.length === 0) {
                                            uploadBtn.disabled = true;
                                        }
                                    });

                                    metaContainer.appendChild(fileType);
                                    metaContainer.appendChild(dimensions);
                                    metaContainer.appendChild(fileSize);

                                    previewItem.appendChild(imgElement);
                                    previewItem.appendChild(metaContainer);
                                    previewItem.appendChild(removeBtn);
                                    previewContainer.appendChild(previewItem);
                                };
                            }

                            reader.readAsDataURL(file);
                        }
                    }
                } else {
                    uploadBtn.disabled = true;
                }
            });

            // Drag and drop functionality
            const uploadLabel = document.querySelector('.file-upload-label');

            uploadLabel.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#0d6efd';
                this.style.backgroundColor = 'rgba(13, 110, 253, 0.05)';
            });

            uploadLabel.addEventListener('dragleave', function() {
                this.style.borderColor = '#dee2e6';
                this.style.backgroundColor = '';
            });

            uploadLabel.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.backgroundColor = '';

                fileInput.files = e.dataTransfer.files;
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            });

            // Handle image deletion
            // Handle image deletion
            $(document).on('click', '.delete-image-btn', function() {
                const imageContainer = $(this).closest('.image-container');
                const imageId = imageContainer.data('id');

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: `/admin/rooms/images/${imageId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            imageContainer.remove();
                            toastr.success(response.success);
                        }
                    });
                }
            });
            // Toast notification setup
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        });
    </script>
@endpush
