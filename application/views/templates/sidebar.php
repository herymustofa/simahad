<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fab fa-app-store-ios"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMA'HAD <sup>2019</sup></div>
    </a>

    <!-- Divider -->

    <hr class="sidebar-divider">
    <?php
    $role_id = $this->session->userdata('role_id');
    if ($role_id == 2) :

        ?>
        <div class="sidebar-heading">
            Santri
        </div>
        <li class="nav-item ">
            <a class="nav-link pb-1 pt-1" href="<?= base_url('santri') ?>">
                <i class="fas  fa-fw fa-sign-out-alt"></i>
                <span>Ijin</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pb-1 pt-1" href="<?= base_url('santri/historiIjin') ?>">
                <i class="fas  fa-fw fa-sign-out-alt"></i>
                <span>History Ijin</span></a>
        </li>
        <hr class="sidebar-divider">
    <?php elseif ($role_id == 1) :  ?>
        <div class="sidebar-heading">
            Santri
        </div>
        <li class="nav-item ">
            <a class="nav-link pb-1 pt-1" href="<?= base_url('admin/inputIjin') ?>">
                <i class="fas  fa-fw fa-sign-out-alt"></i>
                <span>Ijin</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pb-1 pt-1" href="<?= base_url('admin/historiIjin') ?>">
                <i class="fas  fa-fw fa-sign-out-alt"></i>
                <span>History Ijin</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pb-1 pt-1" href="<?= base_url('santri/historiIjin') ?>">
                <i class="fas  fa-fw fa-sign-out-alt"></i>
                <span>Laporan Ijin</span></a>
        </li>
        <hr class="sidebar-divider">
    <?php endif ?>
    <div class="sidebar-heading">
        Setting
    </div>
    <li class="nav-item ">
        <a class="nav-link pb-1 pt-1" href="<?= base_url('user') ?>">
            <i class="fas  fa-fw fa-sign-out-alt"></i>
            <span>My Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-1 pt-1" href="<?= base_url('user/edit') ?>">
            <i class="fas  fa-fw fa-sign-out-alt"></i>
            <span>Edit Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-1 pt-1" href="<?= base_url('user/changePassword') ?>">
            <i class="fas  fa-fw fa-sign-out-alt"></i>
            <span>Change Password</span></a>
    </li>
    <hr class="sidebar-divider mt-0 mb-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas  fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->