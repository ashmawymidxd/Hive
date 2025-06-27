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
   <header class="main-header bg-white">
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
       <div class="d-flex align-items-center justify-content-end flex-grow-1">
           <div class="dropdown settings-dropdown me-4">
               <a class="list-group-item" href="#" id="settingsDropdown" data-mdb-toggle="dropdown"
                   aria-expanded="false">
                   <i class="fa-solid fa-gear"></i> Settings
               </a>
               <ul class="dropdown-menu dropdown-menu-end p-3 shadow-0 border mt-2" aria-labelledby="settingsDropdown"
                   style="width: 300px;">
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                           <i class="fas fa-cog me-2"></i> General Settings
                       </a>
                   </li>
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                           <i class="fas fa-envelope me-2"></i> Email Settings
                       </a>
                   </li>
                   <li class="">
                       <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                           <i class="fas fa-credit-card me-2"></i> Payment Settings
                       </a>
                   </li>
               </ul>
           </div>

           {{-- to do list --}}
           <div class="dropdown todo-dropdown me-4">
               <a class="list-group-item" href="#" id="todoDropdown" data-mdb-toggle="dropdown"
                   aria-expanded="false">
                   <i class="fa-solid fa-list-check"></i>
               </a>
               <ul class="dropdown-menu dropdown-menu-end p-3 shadow-0 border mt-2" aria-labelledby="todoDropdown"
                   style="width: 300px;">
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item" href="{{ route('admin.todo.create') }}">
                           <i class="fas fa-plus me-2"></i> Add New Task
                       </a>
                   </li>
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item" href="{{ route('admin.todo.index') }}">
                           <i class="fas fa-tasks me-2"></i> View Tasks
                       </a>
                   </li>
                   <li>
                       <a class="dropdown-item" href="{{ route('admin.todo.completed') }}">
                           <i class="fas fa-check-circle me-2"></i> Completed Tasks
                       </a>
                   </li>
               </ul>
           </div>

           <div class="dropdown timer-dropdown me-2">
               <a class="list-group-item" href="#" id="timerDropdown" data-mdb-toggle="dropdown"
                   aria-expanded="false">
                   <i class="fa-solid fa-clock fa-spin fa-spin-reverse"></i>
                   <span id="timerDisplay">00:00:00</span>
               </a>
               <ul class="dropdown-menu dropdown-menu-end p-3 shadow-0 border mt-2" aria-labelledby="timerDropdown"
                   style="width: 300px;">
                   <li class="mt-2">
                       <small class="dropdown-item-text text-muted">
                           Last login:
                           {{ auth('admin')->user()->last_login_at ? auth('admin')->user()->last_login_at : 'Never' }}
                       </small>
                   </li>
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item start-timer" href="#" data-url="{{ route('admin.timer.start') }}">
                           <i class="fas fa-play me-2"></i> Start Timer
                       </a>
                   </li>
                   <li class="border-bottom border-secondary">
                       <a class="dropdown-item stop-timer" href="#" data-url="{{ route('admin.timer.stop') }}">
                           <i class="fas fa-stop me-2"></i> Stop Timer
                       </a>
                   </li>
                   <li>
                       <a class="dropdown-item reset-timer" href="#" data-url="{{ route('admin.timer.reset') }}">
                           <i class="fas fa-redo me-2"></i> Reset Timer
                       </a>
                   </li>
               </ul>
           </div>





           <div class="notification-dropdown position-relative me-2">
               @if (auth()->user()->unreadNotifications->count() > 0)
                   <i class="fas fa-bell mx-3 notification-icon" id="notificationIcon"></i>
                   <span class="badge-notification">{{ auth()->user()->unreadNotifications->count() }}</span>
               @else
                   <i class="fas fa-bell-slash mx-3 notification-icon" id="notificationIcon"></i>
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
                   <button class="btn btn-primary rounded-circle p-2 bg-navy text-white shadow-0 font-bold" type="button"
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
                           <a class="dropdown-item" href="{{route('admin.settings.index')}}">
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



       @push('js')
           <!-- JS before closing body tag -->
           <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
           <script>
               // Configure toastr
               toastr.options = {
                   "closeButton": true,
                   "debug": false,
                   "newestOnTop": true,
                   "progressBar": true,
                   "positionClass": "toast-top-right",
                   "preventDuplicates": false,
                   "onclick": null,
                   "showDuration": "300",
                   "hideDuration": "1000",
                   "timeOut": "5000",
                   "extendedTimeOut": "1000",
                   "showEasing": "swing",
                   "hideEasing": "linear",
                   "showMethod": "fadeIn",
                   "hideMethod": "fadeOut"
               };
           </script>
           <script>
               $(document).ready(function() {
                   // Set up CSRF token for all AJAX requests
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });

                   // Timer variables
                   let timerInterval;
                   let totalSeconds = 0;
                   let isRunning = false;
                   let serverTimerStartedAt = null;

                   // Format time display
                   function formatTime(seconds) {
                       const hours = Math.floor(seconds / 3600);
                       const minutes = Math.floor((seconds % 3600) / 60);
                       const secs = seconds % 60;
                       return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                   }

                   // Update timer display
                   function updateTimerDisplay() {
                       $('#timerDisplay').text(formatTime(totalSeconds));
                   }

                   // Start the timer
                   function startTimer() {
                       if (!isRunning) {
                           isRunning = true;
                           timerInterval = setInterval(function() {
                               totalSeconds++;
                               updateTimerDisplay();
                           }, 1000);
                       }
                   }

                   // Stop the timer
                   function stopTimer() {
                       if (isRunning) {
                           clearInterval(timerInterval);
                           isRunning = false;
                       }
                   }

                   // Reset the timer
                   function resetTimer() {
                       stopTimer();
                       totalSeconds = 0;
                       serverTimerStartedAt = null;
                       updateTimerDisplay();
                   }

                   // Check timer status on page load
                   function syncTimerStatus() {
                       $.get("{{ route('admin.timer.status') }}", function(response) {
                           totalSeconds = response.total_seconds;
                           serverTimerStartedAt = response.timer_started_at;
                           updateTimerDisplay();

                           if (response.is_running) {
                               startTimer();
                           } else {
                               stopTimer();
                           }
                       });
                   }

                   // Initial sync
                   syncTimerStatus();

                   // Start timer button
                   $('.start-timer').click(function(e) {
                       e.preventDefault();
                       const url = $(this).data('url');

                       $.post(url, function(response) {
                           if (response.success) {
                               serverTimerStartedAt = response.timer_started_at;
                               totalSeconds = response.total_seconds || 0;
                               startTimer();
                               toastr.success('Timer started');
                           } else {
                               toastr.warning(response.message);
                               syncTimerStatus(); // Sync with server state
                           }
                       }).fail(function() {
                           toastr.error('Error starting timer');
                       });
                   });

                   // Stop timer button
                   $('.stop-timer').click(function(e) {
                       e.preventDefault();
                       const url = $(this).data('url');

                       // Calculate elapsed time on client side first
                       const clientElapsed = isRunning ? 1 : 0;

                       $.post(url, function(response) {
                           if (response.success) {
                               stopTimer();
                               totalSeconds = response.total_seconds;
                               serverTimerStartedAt = null;
                               updateTimerDisplay();
                               toastr.success('Timer stopped');
                           } else {
                               toastr.warning(response.message);
                               syncTimerStatus(); // Sync with server state
                           }
                       }).fail(function() {
                           toastr.error('Error stopping timer');
                       });
                   });

                   // Reset timer button
                   $('.reset-timer').click(function(e) {
                       e.preventDefault();
                       const url = $(this).data('url');

                       $.post(url, function(response) {
                           if (response.success) {
                               resetTimer();
                               toastr.success('Timer reset');
                           }
                       }).fail(function() {
                           toastr.error('Error resetting timer');
                       });
                   });

               });
           </script>
       @endpush
