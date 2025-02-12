<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Website Admin Toolstore</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 16px;"> Daftar Alat </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/daftar_pinjam">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 16px;"> Daftar Permintaan Alat </span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/pinjaman">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 16px;"> Daftar Peminjaman Alat </span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/history">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 16px;"> History Peminjaman </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<script>
    // Menandai halaman aktif di sidebar
    document.addEventListener("DOMContentLoaded", function() {
        var currentLocation = window.location.pathname;
        var navItems = document.querySelectorAll('.nav-item');

        for (var i = 0; i < navItems.length; i++) {
            var navLink = navItems[i].querySelector('.nav-link');

            if (navLink.getAttribute('href') === currentLocation) {
                navItems[i].classList.add('active');
                break;
            }
        }
    });
</script>
