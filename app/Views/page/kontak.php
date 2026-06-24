<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .kt-wrap{display:grid;grid-template-columns:.9fr 1.1fr;gap:26px;align-items:start;}
  .kt-info{padding:30px;}
  .kt-info .lead{font-size:15px;color:var(--muted);line-height:1.65;margin-bottom:22px;}
  .kt-item{display:flex;gap:14px;align-items:flex-start;padding:14px 0;border-top:1px solid var(--border);}
  .kt-item:first-of-type{border-top:0;}
  .kt-item .ic{width:42px;height:42px;border-radius:12px;background:var(--tint);color:var(--forest);
    display:flex;align-items:center;justify-content:center;font-size:20px;flex:none;}
  .kt-item .k{font-family:var(--mono);font-size:10.5px;letter-spacing:.07em;text-transform:uppercase;color:var(--faint);}
  .kt-item .v{font-size:14.5px;color:var(--ink);margin-top:2px;word-break:break-all;}
  .kt-item .v a{color:var(--forest);font-weight:500;}
  .kt-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px;}

  .kt-form{padding:30px;}
  .kt-form h2{font-size:18px;font-weight:600;letter-spacing:-.01em;margin-bottom:4px;}
  .kt-form .sub{font-size:13.5px;color:var(--muted);margin-bottom:18px;}
  .kt-field{margin-bottom:14px;}
  .kt-field label{display:block;font-size:13px;font-weight:500;margin-bottom:6px;}
  .kt-field input,.kt-field textarea{width:100%;padding:11px 13px;border:1px solid var(--border-2);border-radius:var(--r-sm);
    font-family:inherit;font-size:14px;color:var(--ink);background:var(--surface);outline:none;transition:border-color .15s,box-shadow .15s;}
  .kt-field input:focus,.kt-field textarea:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .kt-field textarea{resize:vertical;min-height:120px;}
  .kt-note{font-size:12px;color:var(--faint);margin-top:10px;line-height:1.5;}
  @media(max-width:820px){.kt-wrap{grid-template-columns:1fr;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="phead">
  <div class="ph-k">Hubungi Kami</div>
  <h1>Kontak</h1>
  <p>Punya pertanyaan, masukan, atau kendala? Kami senang mendengar darimu.</p>
</div>

<div class="kt-wrap">
  <!-- Info kontak -->
  <aside class="card kt-info">
    <p class="lead">Hubungi pengelola LIBRIS lewat email di bawah. Untuk pertanyaan layanan
       perpustakaan, sertakan detail yang jelas agar cepat kami bantu.</p>

    <div class="kt-item">
      <span class="ic"><i class="ti ti-mail"></i></span>
      <div>
        <div class="k">Email</div>
        <div class="v"><a href="mailto:<?= esc($email) ?>"><?= esc($email) ?></a></div>
      </div>
    </div>
    <div class="kt-item">
      <span class="ic"><i class="ti ti-clock-hour-4"></i></span>
      <div>
        <div class="k">Jam Layanan</div>
        <div class="v">Senin–Jumat, 08.00–16.00 WIB</div>
      </div>
    </div>
    <div class="kt-item">
      <span class="ic"><i class="ti ti-map-pin"></i></span>
      <div>
        <div class="k">Lokasi</div>
        <div class="v">Perpustakaan LIBRIS</div>
      </div>
    </div>

    <div class="kt-actions">
      <a href="mailto:<?= esc($email) ?>" class="btn btn-primary"><i class="ti ti-mail"></i> Kirim email</a>
      <button type="button" class="btn btn-ghost" onclick="ktSalin('<?= esc($email) ?>')"><i class="ti ti-copy"></i> Salin email</button>
    </div>
  </aside>

  <!-- Form -->
  <div class="card kt-form">
    <h2>Tulis pesan</h2>
    <div class="sub">Isi formulir ini, lalu klik kirim — aplikasi email kamu akan terbuka dengan pesan siap dikirim.</div>
    <form onsubmit="return ktKirim(event)">
      <div class="kt-field">
        <label for="k_nama">Nama</label>
        <input type="text" id="k_nama" required placeholder="Nama lengkap">
      </div>
      <div class="kt-field">
        <label for="k_email">Email kamu</label>
        <input type="email" id="k_email" required placeholder="email@contoh.com">
      </div>
      <div class="kt-field">
        <label for="k_subjek">Subjek</label>
        <input type="text" id="k_subjek" placeholder="Perihal pesan">
      </div>
      <div class="kt-field">
        <label for="k_pesan">Pesan</label>
        <textarea id="k_pesan" required placeholder="Tulis pesanmu di sini…"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-lg"><i class="ti ti-send"></i> Kirim pesan</button>
      <div class="kt-note">Tujuan: <?= esc($email) ?>. Pesan dikirim lewat aplikasi email kamu (Gmail, Outlook, dll).</div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  var KT_EMAIL = <?= json_encode($email) ?>;
  function ktSalin(em){
    navigator.clipboard.writeText(em).then(function(){ showToast('Email disalin'); });
  }
  function ktKirim(e){
    e.preventDefault();
    var nama   = document.getElementById('k_nama').value.trim();
    var email  = document.getElementById('k_email').value.trim();
    var subjek = document.getElementById('k_subjek').value.trim() || ('Pesan dari ' + nama + ' — LIBRIS');
    var pesan  = document.getElementById('k_pesan').value.trim();
    var body   = 'Nama: ' + nama + '\nEmail: ' + email + '\n\n' + pesan;
    window.location.href = 'mailto:' + KT_EMAIL +
      '?subject=' + encodeURIComponent(subjek) +
      '&body='   + encodeURIComponent(body);
    showToast('Membuka aplikasi email…');
    return false;
  }
</script>
<?= $this->endSection() ?>
