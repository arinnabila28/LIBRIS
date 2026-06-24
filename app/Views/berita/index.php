<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .bt-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:6px;}
  .bt-card{display:flex;flex-direction:column;overflow:hidden;transition:transform .15s var(--ease),box-shadow .15s;}
  .bt-card:hover{transform:translateY(-3px);box-shadow:var(--sh-md);}
  .bt-cover{aspect-ratio:16/9;background:var(--tint);position:relative;overflow:hidden;}
  .bt-cover img{width:100%;height:100%;object-fit:cover;}
  .bt-cover.doc{display:flex;align-items:center;justify-content:center;
    background:radial-gradient(90% 90% at 30% 20%,var(--accent),var(--forest));color:#fff;}
  .bt-cover.doc i{font-size:42px;opacity:.95;}
  .bt-cover .kpill{position:absolute;top:10px;left:10px;}
  .bt-body{padding:18px 18px 20px;display:flex;flex-direction:column;gap:8px;flex:1;}
  .bt-date{font-family:var(--mono);font-size:10.5px;letter-spacing:.05em;color:var(--accent);text-transform:uppercase;}
  .bt-body h3{font-size:16px;font-weight:600;letter-spacing:-.01em;line-height:1.3;}
  .bt-body p{font-size:13px;color:var(--muted);line-height:1.55;flex:1;}
  .bt-more{font-size:13px;font-weight:500;color:var(--forest);display:inline-flex;align-items:center;gap:5px;margin-top:2px;}
  @media(max-width:860px){.bt-grid{grid-template-columns:1fr;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php helper('text'); ?>

<div class="phead">
  <div class="ph-k">Kabar Perpustakaan</div>
  <h1>Berita &amp; Dokumen</h1>
  <p>Pengumuman, kegiatan, dan berita acara resmi LIBRIS.</p>
</div>

<div class="mylib-tabs" style="margin-bottom:22px">
  <a href="<?= base_url('berita') ?>" class="<?= ! $filter ? 'on' : '' ?>">Semua</a>
  <a href="<?= base_url('berita?k=berita') ?>" class="<?= $filter === 'berita' ? 'on' : '' ?>">Berita</a>
  <a href="<?= base_url('berita?k=dokumen') ?>" class="<?= $filter === 'dokumen' ? 'on' : '' ?>">Dokumen</a>
</div>

<?php if (empty($list)): ?>
  <div class="emptybox">
    <div class="em"><i class="ti ti-news"></i></div>
    <h3>Belum ada apa-apa di sini</h3>
    <p>Berita dan dokumen akan tampil begitu pustakawan menerbitkannya.</p>
  </div>
<?php else: ?>
  <div class="bt-grid">
    <?php foreach ($list as $b): ?>
      <?php $isDoc = $b['kategori'] === 'dokumen'; ?>
      <a href="<?= base_url('berita/' . $b['slug']) ?>" class="card bt-card">
        <div class="bt-cover <?= $isDoc ? 'doc' : '' ?>">
          <?php if (! $isDoc && ! empty($b['gambar'])): ?>
            <img src="<?= base_url('uploads/berita/' . $b['gambar']) ?>" alt="<?= esc($b['judul']) ?>">
          <?php elseif ($isDoc): ?>
            <i class="ti ti-file-text"></i>
            <span class="pill kpill" style="background:rgba(255,255,255,.16);color:#fff">Dokumen</span>
          <?php else: ?>
            <span class="pill kpill">Berita</span>
          <?php endif; ?>
        </div>
        <div class="bt-body">
          <span class="bt-date"><?= $b['tanggal'] ? date('d M Y', strtotime($b['tanggal'])) : '' ?></span>
          <h3><?= esc($b['judul']) ?></h3>
          <p><?= esc($b['ringkasan'] ?: character_limiter(strip_tags($b['isi'] ?? ''), 110)) ?></p>
          <span class="bt-more"><?= $isDoc ? 'Lihat dokumen' : 'Baca selengkapnya' ?> <i class="ti ti-arrow-right" style="font-size:14px"></i></span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
