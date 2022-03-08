<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-uppercase">Berlamour</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="<?= base_url() ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="line-height: 1rem;">
                <a href="#" class="d-block text-uppercase"><?= session()->get('nama') ?></a>
                <span class="text-secondary"><?= session()->get('role') ?></span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="<?= (session()->get('role') == 'manager') ? '/manager' : '/admin' ?>" class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Managements</li>
                <?php if (session()->get('role') == 'admin') : ?>
                    <li class="nav-item">
                        <a href="/admin/manage-pegawai" class="nav-link <?= ($page == 'mPegawai') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Manage Pegawai
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/log-pegawai" class="nav-link <?= ($page == 'mLog') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Log Pegawai
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (session()->get('role') == 'manager') : ?>
                    <li class="nav-item">
                        <a href="/manager/manage-menu" class="nav-link <?= ($page == 'mMenu') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Manage Menu
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link <?= ($page == 'mRT') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Rekap Transaksi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <!-- <li class="nav-item">
                                <a href="/manager/total-transaksi" class="nav-link">
                                    <i class="fas fa-arrow-right nav-icon"></i>
                                    <p>Seluruh Transaksi</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="/manager/rekap-transaksi" class="nav-link">
                                    <i class="fas fa-arrow-right nav-icon"></i>
                                    <p>Semua Kasir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manager/rekap-transaksi-harian" class="nav-link">
                                    <i class="fas fa-arrow-right nav-icon"></i>
                                    <p>Transaksi Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manager/rekap-transaksi-bulanan" class="nav-link">
                                    <i class="fas fa-arrow-right nav-icon"></i>
                                    <p>Transaksi Bulanan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/manager/log-kasir" class="nav-link <?= ($page == 'mLog') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Log Kasir
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-header text-uppercase">User Control</li>
                <?php if (session()->get('role') == 'admin') : ?>
                    <li class="nav-item">
                        <a href="/profile" class="nav-link <?= ($page == 'mProfile') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cog text-info"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a href="/logout/<?= $_SESSION['id_user'] ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>