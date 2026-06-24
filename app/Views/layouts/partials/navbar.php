<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="padding:8px 12px">
                <i class="ti ti-menu-2" style="font-size:20px;color:var(--muted)"></i>
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <span onclick="if(window.showToast){showToast('Pencarian cepat segera hadir')}else{location='<?= base_url('list/books') ?>'}"
                  style="display:flex;align-items:center;gap:8px;background:var(--paper);border:1px solid var(--border);border-radius:9px;padding:7px 12px;color:var(--faint);font-size:12.5px;cursor:pointer;min-width:280px">
                <i class="ti ti-search" style="font-size:14px"></i> Cari buku, anggota, atau perintah…
                <span style="margin-left:auto;font-family:var(--mono);font-size:9.5px;border:1px solid var(--border);border-radius:5px;padding:1px 5px">⌘K</span>
            </span>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center" style="gap:6px">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('/') ?>" class="nav-link" style="font-size:13px;font-weight:500;color:var(--muted);display:inline-flex;align-items:center;gap:6px">
                <i class="ti ti-external-link" style="font-size:16px"></i> Lihat situs
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" role="button" title="Notifikasi"><i class="ti ti-bell" style="font-size:18px;color:var(--muted)"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" style="gap:9px;padding:5px 8px 5px 6px">
                <span style="width:30px;height:30px;border-radius:999px;background:#224B29;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px"><?= strtoupper(mb_substr(session('name') ?? 'A', 0, 1)) ?></span>
                <span style="font-size:13.5px;font-weight:500;color:var(--ink)"><?= esc(session('name') ?? 'Admin') ?></span>
                <i class="ti ti-chevron-down" style="font-size:14px;color:var(--faint)"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="border:1px solid var(--border);border-radius:12px;box-shadow:var(--sh-lg);padding:6px;min-width:180px;margin-top:8px">
                <a href="<?= base_url('profil') ?>" class="dropdown-item" style="border-radius:8px;font-size:13.5px;font-weight:500;padding:9px 12px;color:var(--ink)"><i class="ti ti-user-circle mr-2" style="color:var(--muted)"></i>Profil</a>
                <div class="dropdown-divider" style="margin:5px 6px;border-top:1px solid var(--border)"></div>
                <a href="<?= base_url('logout') ?>" class="dropdown-item" style="border-radius:8px;font-size:13.5px;font-weight:500;padding:9px 12px;color:var(--amber)"><i class="ti ti-logout mr-2"></i>Keluar</a>
            </div>
        </li>
    </ul>
</nav>
