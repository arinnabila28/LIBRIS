<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Daftar — LIBRIS</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/libris-favicon.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/tabler/tabler-icons.min.css') ?>">
<style>
  :root{--forest:#224B29;--accent:#2F6B3C;--tint:#EAF1E9;--paper:#FAFAF8;--surface:#FFF;--ink:#18241B;--muted:#6B7280;--faint:#9AA29B;--border:#ECECEC;--border-2:#E2E2DE;--mono:'Geist Mono',monospace;}
  *{margin:0;padding:0;box-sizing:border-box;}
  body{font-family:'Geist',system-ui,sans-serif;background:var(--paper);color:var(--ink);min-height:100vh;
    display:flex;flex-direction:column;-webkit-font-smoothing:antialiased;line-height:1.6;}
  a{color:inherit;text-decoration:none;}
  .top{padding:22px 28px;}
  .brand{display:inline-flex;align-items:center;gap:9px;}
  .brand svg{width:22px;height:22px;color:var(--forest);}
  .brand b{font-weight:600;letter-spacing:.2em;font-size:15px;}
  .wrap{flex:1;display:flex;align-items:center;justify-content:center;padding:24px;}
  .card{width:100%;max-width:420px;}
  .card .k{font-family:var(--mono);font-size:11px;letter-spacing:.18em;text-transform:uppercase;color:var(--accent);}
  .card h1{font-size:30px;font-weight:600;letter-spacing:-.025em;margin-top:8px;}
  .card .sub{color:var(--muted);font-size:14.5px;margin-top:6px;margin-bottom:24px;}
  .field{margin-bottom:14px;}
  .row2{display:flex;gap:12px;} .row2 .field{flex:1;}
  label{display:block;font-size:12.5px;font-weight:500;color:var(--ink);margin-bottom:7px;}
  input{width:100%;height:44px;padding:0 14px;border:1px solid var(--border-2);border-radius:11px;font-family:inherit;
    font-size:14.5px;color:var(--ink);background:var(--surface);outline:none;transition:border-color .15s,box-shadow .15s;}
  input::placeholder{color:var(--faint);}
  input:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .btn{width:100%;height:46px;margin-top:10px;background:var(--forest);color:#fff;border:0;border-radius:11px;
    font-family:inherit;font-weight:500;font-size:14.5px;cursor:pointer;box-shadow:0 6px 16px rgba(34,75,41,.18);
    transition:transform .15s,box-shadow .15s;display:flex;align-items:center;justify-content:center;gap:8px;}
  .btn:hover{transform:translateY(-1px);box-shadow:0 10px 22px rgba(34,75,41,.24);}
  .alt{margin-top:22px;text-align:center;font-size:14px;color:var(--muted);}
  .alt a{color:var(--forest);font-weight:500;}
  .flash{border:1px solid var(--border);border-left:3px solid #8A5A1A;color:#8A5A1A;background:var(--surface);
    border-radius:11px;padding:11px 14px;font-size:13.5px;margin-bottom:18px;}
  .flash ul{margin:0;padding-left:18px;}
  .foot{padding:20px 28px;text-align:center;font-family:var(--mono);font-size:11px;color:var(--faint);letter-spacing:.04em;}
</style>
</head>
<body>
  <div class="top"><a href="<?= base_url('/') ?>" class="brand"><svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="7" stroke-linecap="round"><line x1="92" y1="50" x2="61.9" y2="60.7"/><line x1="71" y1="86.4" x2="46.7" y2="65.6"/><line x1="29" y1="86.4" x2="34.8" y2="54.9"/><line x1="8" y1="50" x2="38.1" y2="39.3"/><line x1="29" y1="13.6" x2="53.3" y2="34.4"/><line x1="71" y1="13.6" x2="65.2" y2="45.1"/></svg><b>LIBRIS</b></a></div>

  <div class="wrap">
    <div class="card">
      <div class="k">Daftar</div>
      <h1>Buat akun LIBRIS</h1>
      <div class="sub">Gratis — langsung bisa membaca, meminjam, dan berdiskusi.</div>

      <?php if (session('errors')): ?>
        <div class="flash"><ul><?php foreach (session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div>
      <?php endif; ?>

      <form action="<?= base_url('register') ?>" method="post">
        <?= csrf_field() ?>
        <div class="field"><label>Nama lengkap</label><input type="text" name="name" value="<?= esc(old('name')) ?>" placeholder="Nama kamu" required autofocus></div>
        <div class="field"><label>Email</label><input type="email" name="email" value="<?= esc(old('email')) ?>" placeholder="kamu@email.com" required></div>
        <div class="field"><label>No. kontak <span style="color:var(--faint);font-weight:400">(opsional)</span></label><input type="text" name="contact" value="<?= esc(old('contact')) ?>" placeholder="08xxxxxxxxxx"></div>
        <div class="row2">
          <div class="field"><label>Kata sandi</label><input type="password" name="password" placeholder="min. 6 karakter" required></div>
          <div class="field"><label>Ulangi sandi</label><input type="password" name="pass_confirm" placeholder="••••••••" required></div>
        </div>
        <button type="submit" class="btn">Buat akun <i class="ti ti-arrow-right" style="font-size:16px"></i></button>
      </form>

      <div class="alt">Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk</a></div>
    </div>
  </div>

  <div class="foot">LIBRIS · Perpustakaan Digital © <?= date('Y') ?></div>
</body>
</html>
