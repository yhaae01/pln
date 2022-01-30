<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <?php if($this->session->userdata('id_user')) : ?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
    <?php elseif ($this->session->userdata('id_pelanggan')) : ?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('pelanggan') ?>">
    <?php endif ?>
        <div class="sidebar-brand-icon">
            <i class="fas fa-bolt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PLN-Ku </div>
    </a>

    <!-- Admin -->
    <?php if($this->session->userdata('id_user')) : ?>
        <div>
            <!-- Divider -->
            <hr class="sidebar-divider my-3">

            <!-- Heading Admin -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/pelanggan') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tagihan') ?>">
                    <i class="fas fa-fw fa-money-bill-alt"></i>
                    <span>Tagihan</span></a>
            </li>
        </div>
    
    <!-- Pelanggan -->
    <?php elseif ($this->session->userdata('id_pelanggan')) : ?>
        <div>
            <!-- Divider -->
            <hr class="sidebar-divider my-3">

            <!-- Heading Pelanggan -->
            <div class="sidebar-heading">
                Pelanggan
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('pelanggan') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('pelanggan/penggunaan') ?>">
                    <i class="fas fa-fw fa-industry"></i>
                    <span>Penggunaan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('pelanggan/tagihan') ?>">
                    <i class="fas fa-fw fa-money-bill-alt"></i>
                    <span>Tagihan</span></a>
            </li>
        </div>
    <?php endif ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->