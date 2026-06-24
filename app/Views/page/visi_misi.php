<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .vm-hero{position:relative;overflow:hidden;background:var(--forest);color:#fff;border-radius:var(--r-xl);
    padding:54px 44px;box-shadow:var(--sh-lg);}
  .vm-hero::after{content:"";position:absolute;inset:0;background:
    radial-gradient(120% 90% at 88% -10%,rgba(47,107,60,.55),transparent 60%);pointer-events:none;}
  .vm-hero .kick{color:#A9C6AC;position:relative;}
  .vm-hero h1{position:relative;font-size:34px;font-weight:600;letter-spacing:-.03em;line-height:1.12;margin-top:10px;max-width:640px;}
  .vm-hero p{position:relative;color:#D6E4D7;font-size:15.5px;margin-top:14px;max-width:560px;line-height:1.65;}

  .vm-grid{display:grid;grid-template-columns:1fr 1.3fr;gap:22px;margin-top:24px;}
  .vm-card{padding:30px 30px 32px;}
  .vm-card .lab{display:flex;align-items:center;gap:9px;margin-bottom:14px;}
  .vm-card .lab .ic{width:38px;height:38px;border-radius:11px;background:var(--tint);color:var(--forest);
    display:flex;align-items:center;justify-content:center;font-size:20px;flex:none;}
  .vm-card .lab h2{font-size:18px;font-weight:600;letter-spacing:-.01em;}
  .vm-visi p{font-size:19px;line-height:1.6;color:var(--ink);font-weight:500;letter-spacing:-.01em;}

  .vm-misi ol{list-style:none;counter-reset:m;display:flex;flex-direction:column;gap:14px;}
  .vm-misi li{counter-increment:m;display:flex;gap:14px;align-items:flex-start;font-size:14.5px;line-height:1.6;color:var(--ink);}
  .vm-misi li::before{content:counter(m,decimal-leading-zero);font-family:var(--mono);font-size:11px;color:var(--accent);
    background:var(--tint);border-radius:7px;padding:4px 7px;flex:none;margin-top:1px;letter-spacing:.04em;}

  .vm-nilai{margin-top:30px;}
  .vm-nilai-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:16px;}
  .vm-val{padding:22px 20px;}
  .vm-val .ic{width:42px;height:42px;border-radius:12px;background:var(--tint);color:var(--forest);
    display:flex;align-items:center;justify-content:center;font-size:21px;margin-bottom:13px;}
  .vm-val h3{font-size:15px;font-weight:600;letter-spacing:-.01em;margin-bottom:5px;}
  .vm-val p{font-size:13px;color:var(--muted);line-height:1.55;}

  @media(max-width:860px){
    .vm-grid{grid-template-columns:1fr;}
    .vm-nilai-grid{grid-template-columns:repeat(2,1fr);}
    .vm-hero{padding:40px 26px;}
    .vm-hero h1{font-size:27px;}
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="vm-hero">
  <span class="kick">Tentang LIBRIS</span>
  <h1>Ruang baca yang tenang, untuk kamu yang serius bertumbuh.</h1>
  <p>LIBRIS hadir sebagai pusat sumber belajar dan literasi informasi — menghubungkan
     koleksi tercetak dan digital dalam satu pengalaman yang rapi dan manusiawi.</p>
</section>

<div class="vm-grid">
  <article class="card vm-card vm-visi">
    <div class="lab"><span class="ic"><i class="ti ti-eye"></i></span><h2>Visi</h2></div>
    <p>Menjadi perpustakaan yang unggul dengan fasilitas yang lengkap, modern, dan
       mampu memberikan pelayanan terbaik kepada pemakai berbasis teknologi informasi
       dan komunikasi.</p>
  </article>

  <article class="card vm-card vm-misi">
    <div class="lab"><span class="ic"><i class="ti ti-target-arrow"></i></span><h2>Misi</h2></div>
    <ol>
      <?php foreach ($misi as $m): ?>
        <li><?= esc($m) ?></li>
      <?php endforeach; ?>
    </ol>
  </article>
</div>

<section class="vm-nilai">
  <div class="seclabel"><h2>Nilai yang kami pegang</h2></div>
  <div class="vm-nilai-grid">
    <?php foreach ($nilai as [$icon, $judul, $teks]): ?>
      <article class="card vm-val">
        <div class="ic"><i class="ti <?= esc($icon) ?>"></i></div>
        <h3><?= esc($judul) ?></h3>
        <p><?= esc($teks) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<?= $this->endSection() ?>
