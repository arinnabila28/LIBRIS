<?php $pendingPengajuan = (new \App\Models\PengajuanModel())->where('status', 'menunggu')->countAllResults(); $u = uri_string(); ?>
<aside class="main-sidebar sidebar-light-primary elevation-1">

    <a href="<?= base_url('/dashboard') ?>" class="brand-link">
        <svg viewBox="0 0 100 100" style="width:26px;height:26px;color:#224B29;flex:none" fill="none" stroke="currentColor" stroke-width="7" stroke-linecap="round"><line x1="92" y1="50" x2="61.9" y2="60.7"/><line x1="71" y1="86.4" x2="46.7" y2="65.6"/><line x1="29" y1="86.4" x2="34.8" y2="54.9"/><line x1="8" y1="50" x2="38.1" y2="39.3"/><line x1="29" y1="13.6" x2="53.3" y2="34.4"/><line x1="71" y1="13.6" x2="65.2" y2="45.1"/></svg>
        <span class="brand-text">LIBRIS</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link <?= $u === 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-layout-grid"></i><p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Katalog</li>
                <li class="nav-item">
                    <a href="<?= base_url('/list/books') ?>" class="nav-link <?= str_contains($u, 'book') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-book-2"></i><p>Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/list/members') ?>" class="nav-link <?= str_contains($u, 'member') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-users"></i><p>Anggota</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('kelola/jurnal') ?>" class="nav-link <?= str_contains($u, 'jurnal') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-file-text"></i><p>Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('kelola/subjek') ?>" class="nav-link <?= str_contains($u, 'subjek') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-tags"></i><p>Subjek &amp; Bidang</p>
                    </a>
                </li>

                <li class="nav-header">Sirkulasi</li>
                <li class="nav-item">
                    <a href="<?= base_url('pengajuan') ?>" class="nav-link <?= str_contains($u, 'pengajuan') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-inbox"></i>
                        <p>Pengajuan
                            <?php if ($pendingPengajuan > 0): ?><span class="badge badge-success right"><?= $pendingPengajuan ?></span><?php endif; ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/list/peminjaman') ?>" class="nav-link <?= str_contains($u, 'peminjaman') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-arrows-exchange"></i><p>Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/list/pengembalian') ?>" class="nav-link <?= str_contains($u, 'pengembalian') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-corner-down-left"></i><p>Pengembalian</p>
                    </a>
                </li>

                <li class="nav-header">Konten</li>
                <li class="nav-item">
                    <a href="<?= base_url('kelola/berita') ?>" class="nav-link <?= str_contains($u, 'berita') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-news"></i><p>Berita &amp; Dokumen</p>
                    </a>
                </li>

                <li class="nav-header">Sistem</li>
                <li class="nav-item">
                    <a href="<?= base_url('kelola/pengaturan') ?>" class="nav-link <?= str_contains($u, 'pengaturan') ? 'active' : '' ?>">
                        <i class="nav-icon ti ti-settings"></i><p>Pengaturan</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
