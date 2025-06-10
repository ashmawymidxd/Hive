 <nav class="sidebar" id="sidebar">
     <div class="sidebar-header bg-navy border-b">
         <div class="d-flex align-items-center gap-3">
             <span class="rounded-2 bg-info-tranc p-1">
                 <img draggable="false" class="rounded-2 shadow" src="{{ asset('assets/admin/img/logo/hive.png') }}"
                     width="30px" alt="" srcset="">
             </span>
             <h4 class="font-bold p-1 ">Hotel Hive</h4>
         </div>
         <button class="btn btn-sm btn-outline-light d-md-none" id="closeSidebar">
             <i class="fas fa-times"></i>
         </button>
     </div>
     <div class="sidebar-menu">
         <a href="{{ route('admin') }}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
         <a href="{{ route('admin.reservations.index') }}"><i class="fas fa-calendar-alt"></i> Reservations</a>
         <a href="{{ route('admin.rooms.index') }}"><i class="fas fa-bed"></i> Rooms</a>
         <a href="{{ route('admin.guests.index') }}"><i class="fas fa-users"></i> Guests</a>
         <a href="{{ route('admin.staff.index') }}"><i class="fas fa-clock"></i> Staff</a>
         <a href="{{ route('admin.inventories.page') }}"><i class="fas fa-box"></i> Inventory</a>
         <a href="./pages/billing.html"><i class="fas fa-file-invoice-dollar"></i> Billing</a>
         <a href="./pages/analytics.html"><i class="fas fa-chart-line"></i> Reports</a>
         <a href="./pages/settings.html"><i class="fas fa-cog"></i> Settings</a>
     </div>

     <!-- Admin Profile Section -->
     <div class="admin-profile">
         <a href="{{ route('admin.profile.edit') }}" class="admin-info">
             <div class="admin-avatar">
                 @if (auth()->user('admin')->image_path)
                     <img class="rounded-circle"
                         src="{{ asset('assets/admin/img/admin/' . auth()->user('admin')->image_path) }}"
                         alt="Profile Image" style="width:100%;height:100%;object-fit:cover;">
                 @else
                     <i class="fas fa-user-circle fa-xl"></i>
                 @endif
             </div>
             <div>
                 <div class="font-weight-bold text-white">{{ Auth::user('admin')->name }}</div>
                 <small class="text-muted">Hotel Manger</small>
             </div>
         </a>
     </div>
 </nav>
