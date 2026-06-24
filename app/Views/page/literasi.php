<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .li-hero{display:grid;grid-template-columns:1.2fr .8fr;gap:30px;align-items:center;
    background:var(--surface);border:1px solid var(--border);border-radius:var(--r-xl);
    padding:46px 44px;box-shadow:var(--sh-md);overflow:hidden;}
  .li-hero h1{font-size:33px;font-weight:600;letter-spacing:-.03em;line-height:1.1;margin-top:10px;}
  .li-hero p{color:var(--muted);font-size:15.5px;margin-top:14px;line-height:1.65;max-width:480px;}
  .li-hero .cta{margin-top:22px;display:flex;gap:12px;flex-wrap:wrap;}
  .li-hero .art{aspect-ratio:1;border-radius:var(--r-lg);background:
    radial-gradient(90% 90% at 30% 20%,var(--accent),var(--forest));position:relative;overflow:hidden;
    box-shadow:var(--sh-lg);display:flex;align-items:center;justify-content:center;}
  .li-hero .art svg{width:52%;height:52%;color:rgba(255,255,255,.92);}

  .li-what{margin-top:30px;display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
  .li-what .card{padding:24px 22px;}
  .li-what .ic{width:42px;height:42px;border-radius:12px;background:var(--tint);color:var(--forest);
    display:flex;align-items:center;justify-content:center;font-size:21px;margin-bottom:13px;}
  .li-what h3{font-size:15px;font-weight:600;letter-spacing:-.01em;margin-bottom:5px;}
  .li-what p{font-size:13px;color:var(--muted);line-height:1.55;}

  .li-prog{margin-top:34px;}
  .li-prog-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:16px;}
  .li-card{padding:26px 26px 24px;display:flex;gap:18px;align-items:flex-start;
    transition:transform .15s var(--ease),box-shadow .15s;}
  .li-card:hover{transform:translateY(-2px);box-shadow:var(--sh-md);}
  .li-card .badge{width:50px;height:50px;border-radius:14px;background:var(--forest);color:#fff;
    display:flex;align-items:center;justify-content:center;font-size:24px;flex:none;box-shadow:0 6px 14px rgba(34,75,41,.2);}
  .li-card h3{font-size:16.5px;font-weight:600;letter-spacing:-.01em;}
  .li-card .meta{font-family:var(--mono);font-size:10.5px;letter-spacing:.06em;text-transform:uppercase;color:var(--accent);margin:4px 0 8px;}
  .li-card p{font-size:13.5px;color:var(--muted);line-height:1.55;}

  .li-steps{margin-top:34px;background:var(--forest);color:#fff;border-radius:var(--r-xl);padding:40px 40px;
    position:relative;overflow:hidden;box-shadow:var(--sh-lg);}
  .li-steps::after{content:"";position:absolute;inset:0;background:radial-gradient(110% 80% at 90% 0,rgba(47,107,60,.5),transparent 60%);}
  .li-steps h2{position:relative;font-size:22px;font-weight:600;letter-spacing:-.02em;}
  .li-steps .row{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:22px;}
  .li-step .n{font-family:var(--mono);font-size:12px;color:#A9C6AC;}
  .li-step h4{font-size:15.5px;font-weight:600;margin:6px 0 5px;}
  .li-step p{color:#D6E4D7;font-size:13.5px;line-height:1.55;}

  @media(max-width:860px){
    .li-hero{grid-template-columns:1fr;padding:34px 26px;}
    .li-hero .art{display:none;}
    .li-what,.li-prog-grid,.li-steps .row{grid-template-columns:1fr;}
    .li-hero h1{font-size:27px;}
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="li-hero">
  <div>
    <span class="kick">Program Literasi Informasi</span>
    <h1>Bukan sekadar mencari — tapi tahu cara menemukan yang benar.</h1>
    <p>Literasi informasi adalah kemampuan mengenali kebutuhan informasi, menemukannya,
       menilai kredibilitasnya, lalu menggunakannya secara etis. LIBRIS membuka kelas
       dan pendampingan gratis untuk seluruh pemustaka.</p>
    <div class="cta">
      <a href="<?= base_url('katalog') ?>" class="btn btn-primary btn-lg"><i class="ti ti-books"></i> Mulai jelajahi katalog</a>
      <a href="<?= base_url('visi-misi') ?>" class="btn btn-ghost btn-lg">Tentang LIBRIS</a>
    </div>
  </div>
  <div class="art"><svg viewBox="0 0 100 100"><use href="#ap-mark"/></svg></div>
</section>

<div class="li-what">
  <article class="card"><div class="ic"><i class="ti ti-search"></i></div>
    <h3>Menemukan</h3><p>Teknik penelusuran katalog, basis data, dan jurnal secara efektif.</p></article>
  <article class="card"><div class="ic"><i class="ti ti-shield-check"></i></div>
    <h3>Menilai</h3><p>Membedakan sumber kredibel dari misinformasi dan hoaks.</p></article>
  <article class="card"><div class="ic"><i class="ti ti-quote"></i></div>
    <h3>Menggunakan</h3><p>Mengutip dan menyitir dengan etis, terhindar dari plagiarisme.</p></article>
</div>

<section class="li-prog">
  <div class="seclabel"><h2>Program yang kami tawarkan</h2></div>
  <div class="li-prog-grid">
    <article class="card li-card">
      <span class="badge"><i class="ti ti-compass"></i></span>
      <div><h3>Orientasi Perpustakaan</h3><div class="meta">Pemustaka baru · 60 menit</div>
        <p>Pengenalan layanan, tata letak koleksi, dan cara memakai LIBRIS dari awal.</p></div>
    </article>
    <article class="card li-card">
      <span class="badge"><i class="ti ti-database-search"></i></span>
      <div><h3>Kelas Penelusuran Informasi</h3><div class="meta">Mahasiswa & peneliti · 90 menit</div>
        <p>Strategi pencarian, kata kunci, operator boolean, dan penelusuran jurnal ilmiah.</p></div>
    </article>
    <article class="card li-card">
      <span class="badge"><i class="ti ti-writing-sign"></i></span>
      <div><h3>Manajemen Sitasi & Referensi</h3><div class="meta">Workshop · 120 menit</div>
        <p>Mengelola referensi dan menyusun daftar pustaka secara konsisten dan rapi.</p></div>
    </article>
    <article class="card li-card">
      <span class="badge"><i class="ti ti-copy-check"></i></span>
      <div><h3>Kelas Anti-Plagiarisme</h3><div class="meta">Umum · 60 menit</div>
        <p>Memahami parafrase, kutipan, dan etika penggunaan karya orang lain.</p></div>
    </article>
  </div>
</section>

<section class="li-steps">
  <h2>Cara mengikuti</h2>
  <div class="row">
    <div class="li-step"><div class="n">01</div><h4>Daftar akun</h4>
      <p>Buat akun LIBRIS gratis, atau masuk bila sudah punya.</p></div>
    <div class="li-step"><div class="n">02</div><h4>Pilih program</h4>
      <p>Tentukan kelas yang sesuai kebutuhanmu dari daftar di atas.</p></div>
    <div class="li-step"><div class="n">03</div><h4>Hubungi pustakawan</h4>
      <p>Sampaikan jadwal yang diinginkan ke meja layanan atau kontak perpustakaan.</p></div>
  </div>
</section>

<?= $this->endSection() ?>
