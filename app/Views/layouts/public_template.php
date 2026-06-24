<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($title ?? 'LIBRIS — Perpustakaan Digital') ?></title>
<link rel="icon" type="image/png" href="<?= base_url('assets/libris-favicon.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/tabler/tabler-icons.min.css') ?>">
<style>
  /* ════════════════════════════════════════════════════════════
     LIBRIS — a quiet, premium digital library
     Design system: Geist · forest green · calm whitespace
     ════════════════════════════════════════════════════════════ */
  :root{
    --forest:#224B29; --accent:#2F6B3C; --tint:#EAF1E9;
    --paper:#FAFAF8;  --surface:#FFFFFF;
    --ink:#18241B;    --muted:#6B7280;  --faint:#9AA29B;
    --border:#ECECEC; --border-2:#E2E2DE;
    --amber:#8A5A1A;  --amber-bg:#F3EAD6;
    --r-sm:10px; --r-md:14px; --r-lg:18px; --r-xl:24px; --r-pill:999px;
    --sh-sm:0 1px 3px rgba(24,36,27,.05);
    --sh-md:0 8px 24px rgba(24,36,27,.06);
    --sh-lg:0 20px 48px rgba(24,36,27,.10);
    --ease:cubic-bezier(.2,.6,.2,1);
    --mono:'Geist Mono',ui-monospace,monospace;
    --max:1280px;

    /* legacy aliases — supaya halaman yang belum dirombak tetap waras */
    --green:var(--forest); --green-hover:var(--accent); --green-deep:#16331c;
    --ink-soft:var(--muted); --ink-faint:var(--faint); --rule:var(--border);
    --card:var(--surface); --navy:var(--accent); --stamp:var(--forest);
    --pink:var(--forest); --pinkhot:var(--accent); --blue:var(--ink);
    --cream:var(--tint); --paper-2:#F1EFEA; --radius:var(--r-md);
    --shadow:var(--sh-sm); --shadow-lift:var(--sh-md);
  }
  *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
  body{
    font-family:'Geist',system-ui,-apple-system,sans-serif;
    background:var(--paper);color:var(--ink);min-height:100vh;
    display:flex;flex-direction:column;line-height:1.6;
    -webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
  }
  a{color:inherit;text-decoration:none;}
  img{display:block;max-width:100%;}
  ::selection{background:var(--tint);color:var(--forest);}
  .mono{font-family:var(--mono);}
  .kick{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--accent);}

  /* ── NAVBAR ── */
  .lb-nav{position:sticky;top:0;z-index:50;background:rgba(250,250,248,.82);backdrop-filter:saturate(150%) blur(12px);
    border-bottom:1px solid var(--border);}
  .lb-nav-in{max-width:var(--max);margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:18px;padding:13px 28px;}
  .lb-nav-l{display:flex;align-items:center;gap:26px;min-width:0;}
  .lb-brand{display:inline-flex;align-items:center;gap:9px;}
  .lb-brand .apx{width:22px;height:22px;color:var(--forest);flex:none;}
  .lb-brand b{font-weight:600;letter-spacing:.2em;font-size:15px;}
  .lb-links{display:flex;align-items:center;gap:22px;}
  .lb-links a{font-size:13.5px;color:var(--muted);font-weight:500;transition:color .15s var(--ease);}
  .lb-links a:hover{color:var(--ink);}
  .lb-links a.on{color:var(--ink);}
  .lb-nav-r{display:flex;align-items:center;gap:12px;}
  .lb-search{display:flex;align-items:center;gap:8px;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-sm);padding:7px 11px;color:var(--faint);font-size:12.5px;transition:border-color .15s,box-shadow .15s;cursor:text;}
  .lb-search:hover{border-color:var(--border-2);}
  .lb-search .k{font-family:var(--mono);font-size:9.5px;border:1px solid var(--border);border-radius:5px;padding:1px 5px;margin-left:16px;color:var(--faint);}
  .lb-avatar{width:30px;height:30px;border-radius:var(--r-pill);background:var(--forest);color:#fff;display:flex;
    align-items:center;justify-content:center;font-weight:600;font-size:12px;}
  .lb-ghost{font-size:13px;font-weight:500;color:var(--ink);padding:8px 12px;border-radius:var(--r-sm);transition:background .15s;}
  .lb-ghost:hover{background:var(--tint);}
  .lb-cta{background:var(--forest);color:#fff;border-radius:var(--r-sm);padding:9px 16px;font-size:13px;font-weight:500;
    box-shadow:var(--sh-sm);transition:transform .15s var(--ease),box-shadow .15s;}
  .lb-cta:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(34,75,41,.22);}

  /* ── MAIN ── */
  .lb-main{flex:1 0 auto;width:100%;max-width:var(--max);margin:0 auto;padding:34px 28px 72px;}

  /* ── Shared components ── */
  .btn{display:inline-flex;align-items:center;gap:8px;font-family:inherit;font-weight:500;font-size:13.5px;
    border-radius:var(--r-sm);padding:10px 18px;cursor:pointer;border:1px solid transparent;
    transition:transform .15s var(--ease),box-shadow .15s,background .15s;}
  .btn:hover{transform:translateY(-1px);}
  .btn-primary{background:var(--forest);color:#fff;box-shadow:0 6px 16px rgba(34,75,41,.18);}
  .btn-primary:hover{background:#1d4124;box-shadow:0 10px 22px rgba(34,75,41,.24);}
  .btn-ghost{background:var(--surface);color:var(--ink);border-color:var(--border-2);}
  .btn-ghost:hover{border-color:var(--faint);}
  .btn-tint{background:var(--tint);color:var(--forest);}
  .btn-lg{padding:13px 22px;font-size:14px;}
  /* legacy btn aliases used by un-rebuilt pages */
  .btn-pink{background:var(--forest);color:#fff;} .btn-blue{background:var(--accent);color:#fff;}
  .btn-ghost.btn-blue{background:var(--surface);color:var(--ink);}

  .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);}
  .pill{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;letter-spacing:.04em;
    color:var(--accent);background:var(--tint);padding:3px 9px;border-radius:7px;}
  .pill.muted{color:var(--muted);background:var(--paper);border:1px solid var(--border);}
  .pill.warn{color:var(--amber);background:var(--amber-bg);}
  .star{color:var(--forest);display:inline-flex;gap:1.5px;}

  /* Page header */
  .phead{margin-bottom:26px;}
  .phead .ph-k{font-family:var(--mono);font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:var(--accent);}
  .phead h1{font-size:30px;font-weight:600;letter-spacing:-.025em;line-height:1.05;margin-top:6px;}
  .phead p{color:var(--muted);font-size:15px;margin-top:7px;max-width:560px;}

  /* Section label row */
  .seclabel{display:flex;align-items:baseline;justify-content:space-between;margin-bottom:16px;}
  .seclabel h2{font-size:19px;font-weight:600;letter-spacing:-.015em;}
  .seclabel a{font-size:13px;font-weight:500;color:var(--accent);}

  /* Flash */
  .flash{display:flex;align-items:center;gap:10px;border:1px solid var(--border);background:var(--surface);
    border-radius:var(--r-md);padding:13px 16px;font-size:14px;margin-bottom:22px;box-shadow:var(--sh-sm);
    animation:lbup .4s var(--ease) both;}
  .flash i{font-size:18px;}
  .flash.ok{border-left:3px solid var(--forest);} .flash.ok i{color:var(--forest);}
  .flash.err{border-left:3px solid var(--amber);color:var(--amber);} .flash.err i{color:var(--amber);}

  /* Empty state */
  .emptybox{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);
    padding:54px 30px;text-align:center;box-shadow:var(--sh-sm);}
  .emptybox .em{font-size:30px;display:inline-flex;width:60px;height:60px;align-items:center;justify-content:center;
    background:var(--tint);color:var(--forest);border-radius:var(--r-pill);margin-bottom:14px;}
  .emptybox h3{font-size:18px;font-weight:600;letter-spacing:-.01em;margin-bottom:6px;}
  .emptybox p{color:var(--muted);font-size:14px;margin-bottom:18px;}

  /* ── My Library tab bar (shared across user pages) ── */
  .mylib-tabs{display:inline-flex;gap:4px;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-md);padding:4px;margin-bottom:26px;box-shadow:var(--sh-sm);}
  .mylib-tabs a{font-size:13px;font-weight:500;color:var(--muted);padding:8px 16px;border-radius:10px;transition:all .15s;}
  .mylib-tabs a:hover{color:var(--ink);}
  .mylib-tabs a.on{background:var(--tint);color:var(--forest);}

  /* ── FOOTER ── */
  .lb-foot{border-top:1px solid var(--border);background:var(--surface);padding:40px 28px 26px;}
  .lb-foot-in{max-width:var(--max);margin:0 auto;display:flex;justify-content:space-between;gap:40px;flex-wrap:wrap;}
  .lb-foot .apx{width:22px;height:22px;color:var(--forest);}
  .lb-foot-brand{max-width:280px;}
  .lb-foot-brand .row{display:flex;align-items:center;gap:9px;}
  .lb-foot-brand b{font-weight:600;letter-spacing:.2em;font-size:15px;}
  .lb-foot-brand p{color:var(--muted);font-size:13px;margin-top:11px;line-height:1.55;}
  .lb-foot-col h4{font-family:var(--mono);font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--faint);margin-bottom:12px;}
  .lb-foot-col a{display:block;font-size:13.5px;color:var(--muted);margin-bottom:9px;transition:color .15s;}
  .lb-foot-col a:hover{color:var(--ink);}
  .lb-foot-bot{max-width:var(--max);margin:28px auto 0;padding-top:18px;border-top:1px solid var(--border);
    display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;}
  .lb-foot-bot span{font-family:var(--mono);font-size:11px;color:var(--faint);letter-spacing:.04em;}

  /* ── Toast ── */
  #toast{position:fixed;left:50%;bottom:26px;transform:translateX(-50%) translateY(120px);
    background:var(--ink);color:#fff;border-radius:var(--r-md);padding:12px 18px;font-size:13.5px;z-index:200;
    box-shadow:var(--sh-lg);transition:transform .35s var(--ease);}
  #toast.show{transform:translateX(-50%) translateY(0);}

  /* ── Search palette ── */
  .lb-search{font-family:inherit;}
  .lb-search-ov{position:fixed;inset:0;z-index:300;display:none;align-items:flex-start;justify-content:center;
    padding-top:14vh;background:rgba(24,36,27,.32);backdrop-filter:blur(3px);}
  .lb-search-ov.show{display:flex;animation:lbfade .18s var(--ease) both;}
  .lb-search-box{width:min(560px,92vw);background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-lg);box-shadow:var(--sh-lg);overflow:hidden;animation:lbup .22s var(--ease) both;}
  .lb-search-box form{display:flex;align-items:center;gap:11px;padding:15px 17px;border-bottom:1px solid var(--border);}
  .lb-search-box form > i{font-size:19px;color:var(--faint);flex:none;}
  .lb-search-box input{flex:1;border:0;outline:0;background:transparent;font-family:inherit;font-size:16px;color:var(--ink);}
  .lb-search-box input::placeholder{color:var(--faint);}
  .lb-search-box .go{font-family:var(--mono);font-size:10px;color:var(--accent);background:var(--tint);
    border:0;border-radius:6px;padding:5px 9px;cursor:pointer;letter-spacing:.04em;}
  .lb-search-hint{padding:11px 17px;font-size:12px;color:var(--muted);background:var(--paper);}
  .lb-search-hint b{font-family:var(--mono);font-size:10px;color:var(--ink);background:var(--surface);
    border:1px solid var(--border);border-radius:5px;padding:1px 5px;}

  @keyframes lbfade{from{opacity:0;}to{opacity:1;}}
  @keyframes lbup{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:none;}}
  @media (prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important;}}

  @media(max-width:760px){
    .lb-nav-in{padding:12px 16px;}
    .lb-links{display:none;}
    .lb-search .k{display:none;}
    .lb-main{padding:24px 16px 56px;}
    .phead h1{font-size:25px;}
  }
</style>
<?= $this->renderSection('head') ?>
</head>
<body>

<!-- Aperture mark (reusable) -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true"><symbol id="ap-mark" viewBox="0 0 100 100"><g fill="none" stroke="currentColor" stroke-width="7" stroke-linecap="round"><line x1="92" y1="50" x2="61.9" y2="60.7"/><line x1="71" y1="86.4" x2="46.7" y2="65.6"/><line x1="29" y1="86.4" x2="34.8" y2="54.9"/><line x1="8" y1="50" x2="38.1" y2="39.3"/><line x1="29" y1="13.6" x2="53.3" y2="34.4"/><line x1="71" y1="13.6" x2="65.2" y2="45.1"/></g></symbol></svg>

<?php $logged = session('isLoggedIn'); $isUser = $logged && session('role') === 'user'; $isAdmin = $logged && session('role') === 'admin'; $uri = uri_string(); ?>
<header class="lb-nav">
  <div class="lb-nav-in">
    <div class="lb-nav-l">
        <a href="<?= base_url('/') ?>" class="lb-brand"><svg class="apx"><use href="#ap-mark"/></svg><b>LIBRIS</b></a>
        <nav class="lb-links">
            <a href="<?= base_url('home') ?>" class="<?= $uri === 'home' ? 'on' : '' ?>">Beranda</a>
            <a href="<?= base_url('katalog') ?>" class="<?= str_contains($uri,'katalog') ? 'on' : '' ?>">Katalog</a>
            <a href="<?= base_url('diskusi') ?>" class="<?= str_contains($uri,'diskusi') ? 'on' : '' ?>">Diskusi</a>
            <a href="<?= base_url('jurnal') ?>" class="<?= str_contains($uri,'jurnal') ? 'on' : '' ?>">Jurnal</a>
            <a href="<?= base_url('berita') ?>" class="<?= str_contains($uri,'berita') ? 'on' : '' ?>">Berita</a>
            <a href="<?= base_url($logged ? 'wishlist' : 'login') ?>" class="<?= preg_match('#wishlist|pinjaman|profil#',$uri) ? 'on' : '' ?>">My Library</a>
        </nav>
    </div>
    <div class="lb-nav-r">
        <button type="button" class="lb-search" onclick="lbOpenSearch()"><i class="ti ti-search" style="font-size:14px"></i> Cari <span class="k">⌘K</span></button>
        <?php if ($logged): ?>
            <?php if ($isAdmin): ?><a href="<?= base_url('dashboard') ?>" class="lb-ghost">Dashboard</a><?php endif; ?>
            <a href="<?= base_url('logout') ?>" class="lb-ghost" title="Keluar"><i class="ti ti-logout" style="font-size:17px;vertical-align:-3px"></i></a>
            <a href="<?= base_url('profil') ?>" class="lb-avatar" title="<?= esc(session('name')) ?>"><?= strtoupper(mb_substr(session('name') ?? 'U', 0, 1)) ?></a>
        <?php else: ?>
            <a href="<?= base_url('login') ?>" class="lb-ghost">Masuk</a>
            <a href="<?= base_url('register') ?>" class="lb-cta">Daftar gratis</a>
        <?php endif; ?>
    </div>
  </div>
</header>

<main class="lb-main">
    <?php if (session('success')): ?>
        <div class="flash ok"><i class="ti ti-circle-check"></i> <?= esc(session('success')) ?></div>
    <?php endif; ?>
    <?php if (session('error')): ?>
        <div class="flash err"><i class="ti ti-alert-triangle"></i> <?= esc(session('error')) ?></div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</main>

<footer class="lb-foot">
    <div class="lb-foot-in">
        <div class="lb-foot-brand">
            <div class="row"><svg class="apx"><use href="#ap-mark"/></svg><b>LIBRIS</b></div>
            <p>Ruang baca yang tenang. Ribuan judul fisik &amp; digital, dikurasi untuk kamu yang serius membaca.</p>
        </div>
        <div class="lb-foot-col">
            <h4>Jelajahi</h4>
            <a href="<?= base_url('katalog') ?>">Katalog</a>
            <a href="<?= base_url('jurnal') ?>">Jurnal</a>
            <a href="<?= base_url('diskusi') ?>">Diskusi</a>
            <a href="<?= base_url('berita') ?>">Berita &amp; Dokumen</a>
        </div>
        <div class="lb-foot-col">
            <h4>Akun</h4>
            <a href="<?= base_url($logged ? 'wishlist' : 'login') ?>">My Library</a>
            <a href="<?= base_url($logged ? 'pinjaman-saya' : 'login') ?>">Pinjaman</a>
            <a href="<?= base_url($logged ? 'profil' : 'register') ?>"><?= $logged ? 'Profil' : 'Daftar' ?></a>
        </div>
        <div class="lb-foot-col">
            <h4>Tentang</h4>
            <a href="<?= base_url('visi-misi') ?>">Visi &amp; Misi</a>
            <a href="<?= base_url('literasi') ?>">Literasi Informasi</a>
            <a href="<?= base_url('kontak') ?>">Kontak</a>
        </div>
    </div>
    <div class="lb-foot-bot">
        <span>LIBRIS · Perpustakaan Digital © <?= date('Y') ?></span>
        <span>Dibuat dengan tenang.</span>
    </div>
</footer>

<!-- Search palette -->
<div id="lbSearch" class="lb-search-ov" role="dialog" aria-modal="true" aria-label="Pencarian">
  <div class="lb-search-box">
    <form action="<?= base_url('katalog') ?>" method="get">
      <i class="ti ti-search"></i>
      <input type="text" name="q" id="lbSearchInput" placeholder="Cari judul, penulis, atau subjek…" autocomplete="off">
      <button type="submit" class="go">Enter</button>
    </form>
    <div class="lb-search-hint">Tekan <b>Enter</b> untuk mencari di katalog &nbsp;·&nbsp; <b>Esc</b> untuk menutup</div>
  </div>
</div>

<div id="toast"></div>
<script>
  function showToast(msg){
    var t=document.getElementById('toast');
    t.textContent=msg;t.classList.add('show');
    clearTimeout(window._tt);window._tt=setTimeout(function(){t.classList.remove('show');},2600);
  }
  // ── Search palette ──
  function lbOpenSearch(){
    var ov=document.getElementById('lbSearch');
    ov.classList.add('show');
    var i=document.getElementById('lbSearchInput');
    setTimeout(function(){i.focus();i.select();},30);
  }
  function lbCloseSearch(){ document.getElementById('lbSearch').classList.remove('show'); }
  document.addEventListener('keydown',function(e){
    if((e.metaKey||e.ctrlKey)&&e.key.toLowerCase()==='k'){e.preventDefault();lbOpenSearch();}
    if(e.key==='Escape'){lbCloseSearch();}
  });
  // klik di luar kotak → tutup
  document.getElementById('lbSearch').addEventListener('click',function(e){
    if(e.target===this){lbCloseSearch();}
  });
</script>
<?= $this->renderSection('js') ?>
</body>
</html>
