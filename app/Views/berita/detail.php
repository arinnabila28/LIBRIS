<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .bd-wrap{display:grid;grid-template-columns:1fr 300px;gap:34px;align-items:start;}
  .bd-back{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);font-weight:500;margin-bottom:18px;}
  .bd-back:hover{color:var(--ink);}
  .bd-meta{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
  .bd-date{font-family:var(--mono);font-size:11px;letter-spacing:.05em;color:var(--accent);text-transform:uppercase;}
  .bd-title{font-size:30px;font-weight:600;letter-spacing:-.025em;line-height:1.12;}
  .bd-by{color:var(--muted);font-size:13px;margin-top:8px;}
  .bd-hero{margin:22px 0;border-radius:var(--r-lg);overflow:hidden;border:1px solid var(--border);box-shadow:var(--sh-sm);}
  .bd-hero img{width:100%;display:block;}
  .bd-body{font-size:15.5px;line-height:1.8;color:var(--ink);}
  .bd-body p{margin-bottom:16px;white-space:pre-line;}
  .bd-doc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:24px;
    box-shadow:var(--sh-sm);text-align:center;margin-top:22px;}
  .bd-doc .ic{width:54px;height:54px;border-radius:14px;background:var(--tint);color:var(--forest);
    display:inline-flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:12px;}
  .bd-doc h3{font-size:16px;font-weight:600;margin-bottom:4px;}
  .bd-doc p{font-size:13px;color:var(--muted);margin-bottom:16px;}
  .bd-side h4{font-family:var(--mono);font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--faint);margin-bottom:14px;}
  .bd-side a{display:flex;gap:11px;padding:10px;border-radius:var(--r-md);transition:background .15s;}
  .bd-side a:hover{background:var(--tint);}
  .bd-side .th{width:54px;height:54px;border-radius:10px;background:var(--tint);flex:none;overflow:hidden;
    display:flex;align-items:center;justify-content:center;color:var(--forest);}
  .bd-side .th img{width:100%;height:100%;object-fit:cover;}
  .bd-side .tt{font-size:13.5px;font-weight:500;line-height:1.4;color:var(--ink);}
  .bd-side .dd{font-family:var(--mono);font-size:10px;color:var(--faint);margin-top:3px;text-transform:uppercase;letter-spacing:.04em;}
  @media(max-width:860px){.bd-wrap{grid-template-columns:1fr;}.bd-title{font-size:25px;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $isDoc = $berita['kategori'] === 'dokumen'; ?>

<a href="<?= base_url('berita') ?>" class="bd-back"><i class="ti ti-arrow-left" style="font-size:15px"></i> Semua berita</a>

<div class="bd-wrap">
  <article>
    <div class="bd-meta">
      <span class="pill <?= $isDoc ? '' : 'muted' ?>"><?= $isDoc ? 'Dokumen' : 'Berita' ?></span>
      <span class="bd-date"><?= $berita['tanggal'] ? date('d F Y', strtotime($berita['tanggal'])) : '' ?></span>
    </div>
    <h1 class="bd-title"><?= esc($berita['judul']) ?></h1>
    <?php if (! empty($berita['penulis'])): ?>
      <div class="bd-by">oleh <?= esc($berita['penulis']) ?></div>
    <?php endif; ?>

    <?php if (! $isDoc && ! empty($berita['gambar'])): ?>
      <div class="bd-hero"><img src="<?= base_url('uploads/berita/' . $berita['gambar']) ?>" alt="<?= esc($berita['judul']) ?>"></div>
    <?php endif; ?>

    <?php if (! empty($berita['ringkasan'])): ?>
      <p style="font-size:17px;color:var(--muted);line-height:1.6;margin:18px 0"><?= esc($berita['ringkasan']) ?></p>
    <?php endif; ?>

    <?php if (! empty($berita['isi'])): ?>
      <div class="bd-body"><p><?= esc($berita['isi']) ?></p></div>
    <?php endif; ?>

    <?php if (! empty($berita['file_dokumen'])): ?>
      <div class="bd-doc">
        <div class="ic"><i class="ti ti-file-type-pdf"></i></div>
        <h3>Dokumen resmi tersedia</h3>
        <p>Berita acara dalam format PDF.</p>
        <a href="<?= base_url('berita/file/' . $berita['id_berita']) ?>" target="_blank" class="btn btn-primary btn-lg">
          <i class="ti ti-download"></i> Buka / Unduh PDF
        </a>
      </div>
    <?php endif; ?>
  </article>

  <aside class="bd-side">
    <h4>Lainnya</h4>
    <?php if (empty($lain)): ?>
      <p style="color:var(--muted);font-size:13px">Belum ada berita lain.</p>
    <?php else: foreach ($lain as $l): ?>
      <a href="<?= base_url('berita/' . $l['slug']) ?>">
        <span class="th">
          <?php if ($l['kategori'] !== 'dokumen' && ! empty($l['gambar'])): ?>
            <img src="<?= base_url('uploads/berita/' . $l['gambar']) ?>" alt="">
          <?php else: ?>
            <i class="ti <?= $l['kategori'] === 'dokumen' ? 'ti-file-text' : 'ti-news' ?>"></i>
          <?php endif; ?>
        </span>
        <span>
          <span class="tt"><?= esc($l['judul']) ?></span>
          <span class="dd"><?= $l['tanggal'] ? date('d M Y', strtotime($l['tanggal'])) : '' ?></span>
        </span>
      </a>
    <?php endforeach; endif; ?>
  </aside>
</div>

<?= $this->endSection() ?>
