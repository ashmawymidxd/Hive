@extends('admin.layouts.master')

@section('title')
    Notifications
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-1 border">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Notifications</h4>
                        <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm shadow-0">
                                <i class="fas fa-check-double me-2"></i> | Mark All as Read
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}"
                                    class="list-group-item list-group-item-action flex-column align-items-start mark-as-read"
                                    data-id="{{ $notification->id }}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">
                                            @php
                                                $icon = match ($notification->type) {
                                                    'App\Notifications\ReservationCreatedNotification'
                                                        => 'fa-calendar-plus text-info',
                                                    'App\Notifications\CheckInNotification'
                                                        => 'fa-sign-in-alt text-success',
                                                    'App\Notifications\CheckOutNotification'
                                                        => 'fa-sign-out-alt text-warning',
                                                    default => 'fa-bell text-primary',
                                                };
                                            @endphp
                                            <i class="fas {{ $icon }} mr-2"></i>
                                            {{ $notification->data['message'] ?? 'Notification' }}
                                        </h5>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">
                                        @if (isset($notification->data['guest_name']))
                                            Guest: {{ $notification->data['guest_name'] }}
                                        @endif
                                        @if (isset($notification->data['room_number']))
                                            | Room: {{ $notification->data['room_number'] }}
                                        @endif
                                    </p>
                                    <small class="text-muted">
                                        @if ($notification->read_at)
                                            <i class="fa fa-eye"></i> Read
                                        @else
                                            <i class="fa fa-eye-slash"></i> UnRead
                                        @endif
                                    </small>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <p class="mb-0">No notifications found.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-3">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.mark-as-read').click(function(e) {
                e.preventDefault();
                const notificationId = $(this).data('id');
                const url = $(this).attr('href');

                // Mark as read via AJAX
                $.ajax({
                    url: '/admin/notifications/' + notificationId + '/mark-as-read',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endpush
