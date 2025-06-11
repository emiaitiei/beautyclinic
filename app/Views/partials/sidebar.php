<div class="sidebar" data-background-color="light">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="light">
        <a href="index.html" class="logo">
            <img
            src="<?= base_url('assets/upload/' . session()->get('logo')) ?>"
            alt="navbar brand"
            class="navbar-brand"
            height="50"
            />
        </a>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
            </button>
        </div>
        <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
        </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
        <ul class="nav nav-secondary">

            <?php $level = session()->get('level'); ?>

            <li class="nav-item">
                <a
                    href="<?= base_url() ?>"
                    aria-expanded="false"
                >
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <?php if ($level == 1 || $level == 2 || $level == 3 || $level == 4):?>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Data</h4>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-database"></i>
                <p>Data Master</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                    <ul class="nav nav-collapse">

                        <?php if ($level == 1 || $level == 2):?>
                        <li>
                            <a
                            href="<?= base_url('user') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-users"></i>
                            <p>User</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if ($level == 1 || $level == 2 || $level == 3 || $level == 4):?>
                        <li>
                            <a
                            href="<?= base_url('patient') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-user"></i>
                            <p>Pasien</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if ($level == 1 || $level == 2 || $level == 3):?>
                        <li>
                            <a
                            href="<?= base_url('doctor') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-user-md"></i>
                            <p>Dokter</p>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </li>
            <?php endif; ?>

            <?php if ($level == 1 || $level == 2 || $level == 3 || $level == 4):?>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base2">
                <i class="fas fa-box"></i>
                <p>Data Produk</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="base2">
                    <ul class="nav nav-collapse">

                        <li>
                            <a
                            href="<?= base_url('service') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-spa"></i>
                            <p>Layanan</p>
                            </a>
                        </li>

                        <li>
                            <a
                            href="<?= base_url('product') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-tag"></i>
                            <p>Produk</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <?php endif; ?>

            <?php if ($level == 1 || $level == 2 || $level == 3):?>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base3">
                <i class="fas fa-receipt"></i>
                <p>Data Pemesanan</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="base3">
                    <ul class="nav nav-collapse">

                        <li>
                            <a
                            href="<?= base_url('booking') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-list-alt"></i>
                            <p>Booking</p>
                            </a>
                        </li>

                        <li>
                            <a
                            href="<?= base_url('penjualan_produk') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-store"></i>
                            <p>Penjualan Produk</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <?php endif; ?>

            <?php if ($level == 1 || $level == 2 || $level == 3):?>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base4">
                <i class="fas fa-money-bill-wave"></i>
                <p>Data Pembayaran</p>
                <span class="caret"></span>
                </a>
                <div class="collapse" id="base4">
                    <ul class="nav nav-collapse">

                        <li>
                            <a
                            href="<?= base_url('pembayaran') ?>"
                            aria-expanded="false"
                            >
                            <i class="fas fa-credit-card"></i>
                            <p>Pembayaran</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <?php endif; ?>

            <?php if ($level == 1 || $level == 2):?>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Setting</h4>
            </li>

                <?php if ($level == 2):?>
                    <li class="nav-item">
                        <a
                        href="<?= base_url('logactivity') ?>"
                        aria-expanded="false"
                        >
                        <i class="fas fa-address-card"></i>
                        <p>Log Activity</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($level == 1 || $level == 2):?>
                    <li class="nav-item">
                        <a
                        href="<?= base_url('setting') ?>"
                        aria-expanded="false"
                        >
                        <i class="fas fa-cog"></i>
                        <p>Setting</p>
                        </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

        </ul>
        </div>
    </div>
</div>