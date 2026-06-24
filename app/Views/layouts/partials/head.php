<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title ?? 'LIBRIS — Admin' ?></title>

<!-- AdminLTE deps (Bootstrap grid + komponen JS dipertahankan) -->
<link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css') ?>">

<!-- LIBRIS type -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/tabler/tabler-icons.min.css') ?>">
<link rel="icon" type="image/png" href="<?= base_url('assets/libris-favicon.png') ?>">

<style>
  /* ════════ LIBRIS — Admin (over AdminLTE) ════════ */
  :root{
    --forest:#224B29; --accent:#2F6B3C; --tint:#EAF1E9; --paper:#FAFAF8; --surface:#FFF;
    --ink:#18241B; --muted:#6B7280; --faint:#9AA29B; --border:#ECECEC; --border-2:#E2E2DE;
    --amber:#8A5A1A; --amber-bg:#F3EAD6; --mono:'Geist Mono',ui-monospace,monospace;
    --r-sm:9px; --r-md:12px; --r-lg:16px;
    --sh-sm:0 1px 3px rgba(24,36,27,.05); --sh-md:0 8px 24px rgba(24,36,27,.06); --sh-lg:0 20px 48px rgba(24,36,27,.12);
    /* alias lama supaya inline var() di halaman lama → LIBRIS */
    --y2k-blue:#224B29; --y2k-blue-deep:#16331c; --y2k-pink:#2F6B3C; --y2k-pink-hot:#224B29;
    --y2k-pink-soft:#EAF1E9; --y2k-cyan:#EAF1E9; --y2k-lime:#EAF1E9; --y2k-yellow:#F3EAD6; --y2k-peach:#F3EAD6;
    --y2k-bg:#FAFAF8; --y2k-surface:#FFF; --y2k-ink:#18241B; --y2k-ink-soft:#6B7280; --y2k-border:#ECECEC;
    --ink-900:#18241B; --ink-700:#224B29; --ink-500:#6B7280; --ink-300:#9AA29B; --ink-100:#EAF1E9; --ink-50:#FAFAF8;
    --surface:#FFF; --border:#ECECEC; --accent-2:#2F6B3C; --radius:12px;
  }
  body,.wrapper,.content-wrapper,.main-sidebar,.main-header,.card,.btn,.table,
  input,select,textarea,.modal,.nav-link,.brand-text,h1,h2,h3,h4,h5,h6,p,a,span,div,td,th,label{
    font-family:'Geist',system-ui,-apple-system,sans-serif;
  }
  .font-mono,.mono{font-family:var(--mono)!important;}
  body.hold-transition,.wrapper{background:var(--paper)!important;}
  body{color:var(--ink);-webkit-font-smoothing:antialiased;}
  ::selection{background:var(--tint);color:var(--forest);}
  a{color:var(--forest);}

  /* ── Sidebar (light, Notion-style) ── */
  .main-sidebar{background:var(--surface)!important;border-right:1px solid var(--border)!important;box-shadow:none!important;}
  .main-sidebar .brand-link{background:transparent!important;border-bottom:1px solid var(--border)!important;
    padding:15px 16px!important;display:flex;align-items:center;gap:9px;}
  .brand-link .brand-text{color:var(--ink)!important;font-weight:600!important;letter-spacing:.18em;font-size:15px;}
  .nav-sidebar .nav-header{color:var(--faint)!important;font-family:var(--mono);font-size:10px!important;
    letter-spacing:.14em!important;text-transform:uppercase;padding:16px 18px 7px!important;opacity:1;}
  .nav-sidebar .nav-header::before{content:none!important;}
  .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link,
  .nav-sidebar>.nav-item>.nav-link{color:var(--muted)!important;font-size:13.5px!important;font-weight:500!important;
    border-radius:9px!important;margin:2px 10px!important;padding:9px 12px!important;border:0!important;transform:none!important;transition:background .14s,color .14s;}
  .nav-sidebar>.nav-item>.nav-link:hover{background:var(--paper)!important;color:var(--ink)!important;transform:none!important;}
  .nav-sidebar>.nav-item>.nav-link.active{background:var(--tint)!important;color:var(--forest)!important;
    box-shadow:none!important;transform:none!important;font-weight:500!important;}
  .nav-sidebar .nav-icon{color:inherit!important;font-size:17px!important;margin-right:9px;}
  .brand-link img{filter:none!important;}

  /* ── Topbar ── */
  .main-header.navbar{background:var(--surface)!important;border-bottom:1px solid var(--border)!important;
    box-shadow:none!important;min-height:58px;}
  .main-header .nav-link{color:var(--muted)!important;}
  .main-header .nav-link:hover{color:var(--ink)!important;}

  /* ── Content ── */
  .content-wrapper{background:var(--paper)!important;background-image:none!important;}
  .content-header{padding:24px 28px 6px!important;}
  .content-header h1,.content-header .page-title{font-size:22px!important;font-weight:600!important;letter-spacing:-.02em!important;
    color:var(--ink)!important;text-shadow:none!important;}
  .content{padding:10px 28px 36px!important;}
  .page-sub{color:var(--muted)!important;}

  /* ── Cards ── */
  .card,.lis-card{background:var(--surface)!important;border:1px solid var(--border)!important;
    border-radius:var(--r-lg)!important;box-shadow:var(--sh-sm)!important;margin-bottom:20px;transition:box-shadow .18s,transform .18s;}
  .card:hover,.lis-card:hover{box-shadow:var(--sh-md)!important;transform:none;}
  .card-header{background:transparent!important;border-bottom:1px solid var(--border)!important;padding:16px 20px!important;}
  .card-title,.card-header h3{font-size:15px!important;font-weight:600!important;color:var(--ink)!important;letter-spacing:-.01em;}
  .card-body,.lis-card-body{padding:18px 20px!important;}
  .card-tools .btn+.btn{margin-left:7px;}

  /* ── Buttons ── */
  .btn{border-radius:var(--r-sm)!important;font-weight:500!important;font-size:13px!important;
    border:1px solid transparent!important;box-shadow:none!important;padding:8px 15px!important;
    transition:transform .14s,background .14s,box-shadow .14s!important;}
  .btn:hover{transform:translateY(-1px);}
  .btn-sm{font-size:12px!important;padding:6px 11px!important;border-radius:8px!important;}
  .btn-primary,.btn-success{background:var(--forest)!important;border-color:var(--forest)!important;color:#fff!important;box-shadow:0 4px 12px rgba(34,75,41,.18)!important;}
  .btn-primary:hover,.btn-success:hover{background:#1d4124!important;}
  .btn-secondary,.btn-default,.btn-light{background:var(--surface)!important;border-color:var(--border-2)!important;color:var(--ink)!important;}
  .btn-secondary:hover,.btn-default:hover{border-color:var(--faint)!important;background:var(--paper)!important;}
  .btn-info,.btn-warning{background:var(--tint)!important;border-color:transparent!important;color:var(--forest)!important;}
  .btn-danger{background:var(--amber-bg)!important;border-color:transparent!important;color:var(--amber)!important;}
  .btn-danger:hover{background:#ecddc4!important;}

  /* ── Tables ── */
  .table{color:var(--ink)!important;margin-bottom:0;}
  /* Header tabel SELALU putih & modern — netralkan kelas warna bawaan (bg-success/primary/dark/light, text-white) */
  .table thead,.table thead tr,.table thead th{background:transparent!important;background-color:transparent!important;}
  .table thead th{color:var(--faint)!important;font-family:var(--mono)!important;
    font-size:11px!important;letter-spacing:.05em;text-transform:uppercase;font-weight:500!important;
    border-top:0!important;border-bottom:1px solid var(--border)!important;padding:11px 14px!important;}
  .table td,.table th{border-color:var(--border)!important;border-top:1px solid var(--border)!important;
    vertical-align:middle!important;padding:12px 14px!important;font-size:13.5px;}
  .table-hover tbody tr{transition:background .12s;}
  .table-hover tbody tr:hover{background:var(--paper)!important;}
  .table-bordered,.table-bordered td,.table-bordered th{border-color:var(--border)!important;}
  .dataTables_wrapper .dataTables_filter input,.dataTables_wrapper .dataTables_length select{
    border:1px solid var(--border-2)!important;border-radius:8px!important;padding:6px 10px!important;}

  /* ── Forms ── */
  .form-control,.custom-select,select.form-control{border:1px solid var(--border-2)!important;border-radius:var(--r-sm)!important;
    color:var(--ink)!important;background:var(--surface)!important;box-shadow:none!important;height:calc(2.5rem + 2px);font-size:14px;}
  textarea.form-control{height:auto;}
  .form-control:focus,.custom-select:focus{border-color:var(--forest)!important;box-shadow:0 0 0 3px var(--tint)!important;}
  label{font-weight:500!important;color:var(--ink)!important;font-size:13px;margin-bottom:6px;}
  .form-group{margin-bottom:16px;}

  /* ── Modals ── */
  .modal-content{border:1px solid var(--border)!important;border-radius:var(--r-lg)!important;box-shadow:var(--sh-lg)!important;}
  .modal-header{background:transparent!important;border-bottom:1px solid var(--border)!important;padding:16px 20px!important;}
  .modal-title{font-size:16px!important;font-weight:600!important;color:var(--ink)!important;}
  .modal-header .close{color:var(--faint)!important;text-shadow:none!important;opacity:1;font-weight:400;}
  .modal-body{padding:20px!important;} .modal-footer{border-top:1px solid var(--border)!important;padding:14px 20px!important;}
  .modal-backdrop.show{background:rgba(24,36,27,.4)!important;opacity:1!important;}

  /* ── Badges / pills ── */
  .badge{border-radius:999px!important;font-weight:500!important;font-family:var(--mono);font-size:10.5px!important;
    letter-spacing:.02em;padding:.4em .8em!important;}
  .badge-success,.badge-primary{background:var(--tint)!important;color:var(--forest)!important;}
  .badge-danger,.badge-warning{background:var(--amber-bg)!important;color:var(--amber)!important;}
  .badge-secondary,.badge-info{background:var(--paper)!important;color:var(--muted)!important;border:1px solid var(--border);}

  /* ── Pagination ── */
  .page-link{color:var(--ink)!important;border-color:var(--border)!important;border-radius:8px!important;margin:0 2px;}
  .page-item.active .page-link{background:var(--forest)!important;border-color:var(--forest)!important;color:#fff!important;}

  /* ── Alerts ── */
  .alert{border:1px solid var(--border)!important;border-radius:var(--r-md)!important;font-size:14px;box-shadow:var(--sh-sm)!important;}
  .alert-success{background:var(--surface)!important;border-left:3px solid var(--forest)!important;color:var(--forest)!important;}
  .alert-danger,.alert-warning{background:var(--surface)!important;border-left:3px solid var(--amber)!important;color:var(--amber)!important;}

  /* ── Footer ── */
  .main-footer{background:var(--surface)!important;border-top:1px solid var(--border)!important;color:var(--muted)!important;font-size:12px;font-family:var(--mono);letter-spacing:.03em;}
  .main-footer a{color:var(--forest)!important;}

  .text-muted{color:var(--muted)!important;}
  .text-dark{color:var(--ink)!important;}
  ::-webkit-scrollbar{width:11px;height:11px;}
  ::-webkit-scrollbar-thumb{background:#dcdcd6;border:3px solid var(--paper);border-radius:10px;}
  ::-webkit-scrollbar-thumb:hover{background:#c8c8c2;}
</style>
