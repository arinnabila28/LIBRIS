<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Beranda — LIBRIS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Pinyon+Script&family=Spectral:ital,wght@0,400;0,500;1,400&family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/tabler/tabler-icons.min.css') ?>">
<style>
  :root{--paper:#FFF4E7;--paper-2:#f3e6d2;--card:#fffaf1;--ink:#1d2c1e;--ink-soft:#4a5a49;--ink-faint:#8b948a;
    --rule:#d9ccb4;--green:#224B29;--green-deep:#193820;--navy:#193820;--radius:5px;--shadow:3px 4px 0 rgba(29,44,30,.13);--shadow-lift:5px 7px 0 rgba(29,44,30,.16);}
  *{margin:0;padding:0;box-sizing:border-box;}
  body{font-family:'Spectral',Georgia,serif;min-height:100vh;padding:24px;color:var(--ink);
    background:var(--paper);
    background-image:
      repeating-linear-gradient(transparent 0 31px,rgba(34,75,41,.05) 31px 32px),
      url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
    background-attachment:fixed;}
  .topbar{max-width:980px;margin:0 auto 22px;display:flex;align-items:center;justify-content:space-between;}
  .brand{font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.3rem;color:var(--green);letter-spacing:.02em;border-bottom:1.5px solid var(--green);padding-bottom:3px;}
  .logout{background:var(--card);border:1.5px solid var(--ink);box-shadow:var(--shadow);border-radius:var(--radius);padding:8px 16px;
    font-family:'Courier Prime',monospace;font-size:.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--ink);text-decoration:none;transition:transform .14s;}
  .logout:hover{transform:translateY(-2px);}
  .hero{position:relative;max-width:980px;margin:0 auto;background:var(--card);border:2px solid var(--ink);border-radius:var(--radius);box-shadow:var(--shadow-lift);
    padding:42px 36px;overflow:hidden;animation:pop .5s cubic-bezier(.2,.8,.3,1.2) both;}
  .hero::before{content:"";position:absolute;inset:8px;border:1px solid rgba(34,75,41,.3);pointer-events:none;}
  @keyframes pop{from{opacity:0;transform:translateY(20px) scale(.98);}to{opacity:1;transform:none;}}
  .hello{font-family:'Pinyon Script',cursive;font-size:2rem;color:var(--green);line-height:1;}
  h1{font-family:'Cormorant Garamond',serif;font-weight:700;color:var(--ink);font-size:2.4rem;margin:2px 0 10px;line-height:1.04;letter-spacing:.01em;}
  .lead{color:var(--ink-soft);font-family:'Spectral',serif;font-size:1.05rem;max-width:580px;line-height:1.7;}
  .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-top:30px;}
  .tile{background:var(--paper);border:1.5px solid var(--ink);border-radius:var(--radius);padding:18px;box-shadow:var(--shadow);position:relative;overflow:hidden;}
  .tile .ic{font-size:24px;filter:grayscale(1) sepia(.5) brightness(.55) hue-rotate(60deg);}
  .tile .t{font-family:'Cormorant Garamond',serif;font-weight:700;font-size:1.2rem;color:var(--ink);margin-top:8px;}
  .tile .d{font-family:'Spectral',serif;font-size:.85rem;color:var(--ink-soft);margin-top:2px;}
  .soon{position:absolute;top:11px;right:11px;background:var(--green);border-radius:2px;font-family:'Courier Prime',monospace;font-size:.55rem;font-weight:700;letter-spacing:.08em;padding:3px 8px;color:var(--card);}
  .grid .tile:nth-child(2) .soon,.grid .tile:nth-child(4) .soon{background:var(--navy);}
  .note{margin-top:28px;font-family:'Courier Prime',monospace;font-size:.7rem;letter-spacing:.04em;color:var(--ink-faint);border-top:1px solid var(--rule);padding-top:16px;}
  .note strong{color:var(--green);}
</style>
</head>
<body>
  <div class="topbar">
    <span class="brand">LIBRIS</span>
    <a href="<?= base_url('logout') ?>" class="logout">Logout →</a>
  </div>

  <div class="hero">
    <span class="hello">Halo, <?= esc(session('name')) ?></span>
    <h1>Selamat Datang</h1>
    <p class="lead">Akunmu sudah aktif. Sebentar lagi kamu bisa menjelajah katalog, meminjam buku, menyusun wishlist, dan ikut diskusi buku di sini.</p>

    <div class="grid">
      <div class="tile"><div class="ic">📖</div><div class="t">Katalog Buku</div><div class="d">Jelajah &amp; baca</div><span class="soon">Soon</span></div>
      <div class="tile"><div class="ic">📥</div><div class="t">Pinjam Buku</div><div class="d">Ajukan &amp; lacak</div><span class="soon">Soon</span></div>
      <div class="tile"><div class="ic">♡</div><div class="t">Wishlist</div><div class="d">Mau dibaca</div><span class="soon">Soon</span></div>
      <div class="tile"><div class="ic">💬</div><div class="t">Diskusi</div><div class="d">Ngobrol &amp; rating</div><span class="soon">Soon</span></div>
    </div>

    <div class="note">Kamu login sebagai <strong>ANGGOTA</strong>. Fitur-fitur di atas akan dibuka pada tahap pengembangan berikutnya.</div>
  </div>
</body>
</html>
