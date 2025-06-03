// Toggle sidebar in mobile view
document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("menuToggle");
  const closeSidebar = document.getElementById("closeSidebar");
  const sidebar = document.getElementById("sidebar");
  const notificationIcon = document.getElementById("notificationIcon");
  const notificationDropdown = document.getElementById("notificationDropdown");

  // Sidebar toggle
  menuToggle.addEventListener("click", function () {
    sidebar.classList.toggle("active");
  });

  closeSidebar.addEventListener("click", function () {
    sidebar.classList.remove("active");
  });

  // Notification dropdown toggle
  notificationIcon.addEventListener("click", function (e) {
    e.stopPropagation();
    notificationDropdown.classList.toggle("show");
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (event) {
    // Close sidebar on mobile when clicking outside
    // if (
    //   window.innerWidth <= 768 &&
    //   !sidebar.contains(event.target) &&
    //   event.target !== menuToggle
    // ) {
    //   sidebar.classList.remove("active");
    // }

    // Close notification dropdown when clicking outside
    if (!notificationIcon.contains(event.target)) {
      notificationDropdown.classList.remove("show");
    }
  });

});

var currentUrl = window.location.href;
document.querySelectorAll(".sidebar .sidebar-menu a").forEach(function (link) {
  if (link.href === currentUrl) {
    link.classList.add("active-link");
  }
});
