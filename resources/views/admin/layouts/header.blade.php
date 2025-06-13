   <style>
       .notification-dropdown {
           position: relative;
           cursor: pointer;
       }

       .notification-content {
           display: none;
           position: absolute;
           right: 0;
           top: 100%;
           width: 350px;
           background: white;
           border-radius: 8px;
           box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
           z-index: 1000;
       }

       .notification-content.show {
           display: block;
       }

       .notification-item {
           border-bottom: 1px solid #f0f0f0;
           transition: background-color 0.2s;
       }

       .notification-item:hover {
           background-color: #f8f9fa;
       }

       .badge-notification {
           position: absolute;
           top: -5px;
           right: 5px;
           background-color: #ff4757;
           color: white;
           border-radius: 50%;
           padding: 3px 6px;
           font-size: 10px;
       }
   </style>
   <header class="main-header">
       <button class="menu-toggle" id="menuToggle">
           <i class="fas fa-bars"></i>
       </button>
       <div class="col-md-4 btn-group border shadow-0 d-none d-md-flex">
           <button class="btn btn-white">
               <i class="fa fa-search"></i>
           </button>
           <input id="search-input" type="search" class="form-control border-0" placeholder="Search at any table..."
               aria-label="Search">
       </div>
       <div class="d-flex align-items-center">
           <!-- Notification Dropdown -->
           <div class="notification-dropdown mx-2 position-relative">
               @if (auth()->user()->unreadNotifications->count() > 0)
                   <i class="fas fa-bell mx-3 notification-icon" id="notificationIcon"></i>
                   <span class="badge-notification">{{ auth()->user()->unreadNotifications->count() }}</span>
               @else
                   <i class="fas fa-bell-slash mx-3 notification-icon" id="notificationIcon"></i>
                   <span class="badge-notification">0</span>
               @endif
               <div class="notification-content shadow-0 border" id="notificationDropdown">
                   <div class="notification-header d-flex justify-content-between align-items-center p-3">
                       <h6 class="mb-0 font-bold">Notifications</h6>
                       <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                           @csrf
                           <button type="submit" class="btn btn-link p-0 text-primary">
                               <small>Mark all as read</small>
                           </button>
                       </form>
                   </div>
                   <div class="notification-items" style="max-height: 300px; overflow-y: auto;">
                       @forelse(auth('admin')->user()->unreadNotifications->take(5) as $notification)
                           <a href="{{ $notification->data['url'] ?? '#' }}"
                               class="notification-item mark-as-read p-3 d-block text-dark"
                               data-id="{{ $notification->id }}">
                               <div class="d-flex justify-content-between">
                                   <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                   @if (!$notification->read_at)
                                       <span class="badge bg-primary rounded-pill">New</span>
                                   @endif
                               </div>
                               <p class="mb-0 mt-1">
                                   @switch($notification->type)
                                       @case('App\Notifications\ReservationCreatedNotification')
                                           <i class="fas fa-calendar-plus text-primary me-2"></i>
                                       @break

                                       @case('App\Notifications\CheckInNotification')
                                           <i class="fas fa-sign-in-alt text-success me-2"></i>
                                       @break

                                       @case('App\Notifications\CheckOutNotification')
                                           <i class="fas fa-sign-out-alt text-info me-2"></i>
                                       @break

                                       @case('App\Notifications\InvoiceNotification')
                                           <i class="fas fa-file-invoice-dollar text-warning me-2"></i>
                                       @break

                                       @default
                                           <i class="fas fa-bell text-warning me-2"></i>
                                   @endswitch
                                   {{ $notification->data['message'] ?? 'New notification' }}
                               </p>
                           </a>
                           @empty
                               <div class="notification-item p-3 text-center">
                                   <i class="fas fa-bell-slash text-muted mb-2 fa-2xl"></i>
                               </div>
                           @endforelse
                       </div>
                       <div class="notification-footer text-center p-2 border-top">
                           <a href="{{ route('admin.notifications.index') }}" class="text-primary">View all
                               notifications</a>
                       </div>
                   </div>
               </div>

               <!-- Profile Dropdown -->
               <div class="dropdown profile-dropdown">
                   <button class="btn btn-primary rounded-circle p-2 bg-navy text-white shadow-0" type="button"
                       id="profileDropdown" data-mdb-toggle="dropdown" aria-expanded="false">
                       @auth

                           {{ substr(Auth::user('admin')->first_name[0], 0, 1) }}{{ substr(Auth::user('admin')->last_name[0], 0, 1) }}
                       @else
                           GU
                       @endauth
                   </button>
                   <ul class="dropdown-menu dropdown-menu-end p-3 shadow-0 border mt-2" aria-labelledby="profileDropdown">
                       <li class="border-bottom border-secondary">
                           <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                               <i class="fas fa-user me-2"></i> Profile
                           </a>
                       </li>
                       <li class="border-bottom border-secondary">
                           <a class="dropdown-item" href="">
                               <i class="fas fa-cog me-2"></i> Settings
                           </a>
                       </li>
                       <li class="">
                           <form method="POST" action="{{ route('logout.admin') }}">
                               @csrf
                               <button type="submit" class="dropdown-item">
                                   <i class="fas fa-sign-out-alt me-2"></i> Logout
                               </button>
                           </form>
                       </li>
                   </ul>
               </div>
           </div>
       </header>

       @push('scripts')
           <script>
               $(document).ready(function() {
                   // Toggle notification dropdown
                   $('#notificationIcon').click(function(e) {
                       e.stopPropagation();
                       $('#notificationDropdown').toggleClass('show');
                   });

                   // Close dropdown when clicking outside
                   $(document).click(function() {
                       $('#notificationDropdown').removeClass('show');
                   });

                   // Mark notification as read when clicked
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
