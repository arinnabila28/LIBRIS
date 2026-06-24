<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .jd-back{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);font-weight:500;margin-bottom:18px;}
  .jd-back:hover{color:var(--ink);}
  .jd{display:grid;grid-template-columns:1fr 300px;gap:34px;align-items:start;}
  .jd-bidang{font-family:var(--mono);font-size:11px;letter-spacing:.07em;text-transform:uppercase;color:var(--accent);}
  .jd h1{font-size:28px;font-weight:600;letter-spacing:-.025em;line-height:1.14;margin:8px 0 10px;}
  .jd .by{font-size:15px;color:var(--ink);}
  .jd .src{font-size:13.5px;color:var(--muted);margin-top:6px;font-style:italic;}
  .jd-sec{margin-top:28px;}
  .jd-sec h3{font-size:13px;font-family:var(--mono);letter-spacing:.1em;text-transform:uppercase;color:var(--faint);margin-bottom:10px;}
  .jd-abs{font-size:15px;line-height:1.8;color:#3a463d;white-space:pre-line;}
  .jd-meta{display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:var(--border);border:1px solid var(--border);
    border-radius:var(--r-md);overflow:hidden;}
  .jd-meta .row{background:var(--surface);padding:12px 16px;}
  .jd-meta .k{font-family:var(--mono);font-size:10px;letter-spacing:.06em;text-transform:uppercase;color:var(--faint);}
  .jd-meta .v{font-size:14px;color:var(--ink);margin-top:3px;word-break:break-word;}

  .jd-side{position:sticky;top:84px;display:flex;flex-direction:column;gap:12px;}
  .jd-side .panel{padding:22px;text-align:center;}
  .jd-side .em{width:54px;height:54px;border-radius:14px;background:var(--tint);color:var(--forest);
    display:inline-flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:12px;}
  .jd-side .panel p{font-size:13px;color:var(--muted);margin-bottom:14px;}
  .jd-side .btn{width:100%;justify-content:center;}
  .jd-side .scholar{display:inline-flex;align-items:center;justify-content:center;gap:7px;width:100%;
    font-size:13px;font-weight:500;color:var(--ink);border:1px solid var(--border-2);border-radius:var(--r-sm);
    padding:10px 14px;transition:border-color .15s,background .15s;}
  .jd-side .scholar:hover{border-color:var(--faint);background:var(--paper);}
  @media(max-width:820px){.jd{grid-template-columns:1fr;}.jd-side{position:static;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  $loggedIn  = session('isLoggedIn');
  $scholarUrl = 'https://scholar.google.com/scholar?q=' . urlencode($jurnal['judul'] . ' ' . ($jurnal['penulis'] ?? ''));
  $srcBits = array_filter([
    $jurnal['nama_jurnal'] ?? null,
    $jurnal['volume'] ? 'Vol. ' . $jurnal['volume'] : null,
    $jurnal['nomor'] ? 'No. ' . $jurnal['nomor'] : null,
    $jurnal['halaman'] ? 'hlm. ' . $jurnal['halaman'] : null,
    $jurnal['tahun'] ?: null,
  ]);
?>

<a href="<?= base_url('jurnal') ?>" class="jd-back"><i class="ti ti-arrow-left" style="font-size:15px"></i> Semua jurnal</a>

<div class="jd">
  <article>
    <?php if (! empty($jurnal['bidang'])): ?><div class="jd-bidang"><?= esc($jurnal['bidang']) ?></div><?php endif; ?>
    <h1><?= esc($jurnal['judul']) ?></h1>
    <?php if (! empty($jurnal['penulis'])): ?><div class="by"><?= esc($jurnal['penulis']) ?></div><?php endif; ?>
    <?php if ($srcBits): ?><div class="src"><?= esc(implode(', ', $srcBits)) ?></div><?php endif; ?>

    <?php if (! empty($jurnal['abstrak'])): ?>
      <div class="jd-sec">
        <h3>Abstrak</h3>
        <div class="jd-abs"><?= esc($jurnal['abstrak']) ?></div>
      </div>
    <?php endif; ?>

    <div class="jd-sec">
      <h3>Detail</h3>
      <div class="jd-meta">
        <div class="row"><div class="k">Nama jurnal</div><div class="v"><?= esc($jurnal['nama_jurnal'] ?: '—') ?></div></div>
        <div class="row"><div class="k">Penerbit</div><div class="v"><?= esc($jurnal['penerbit'] ?: '—') ?></div></div>
        <div class="row"><div class="k">Tahun</div><div class="v"><?= esc($jurnal['tahun'] ?: '—') ?></div></div>
        <div class="row"><div class="k">Volume / Nomor</div><div class="v"><?= esc(trim(($jurnal['volume'] ?: '—') . ' / ' . ($jurnal['nomor'] ?: '—'))) ?></div></div>
        <div class="row"><div class="k">Halaman</div><div class="v"><?= esc($jurnal['halaman'] ?: '—') ?></div></div>
        <div class="row"><div class="k">ISSN</div><div class="v mono" style="font-family:var(--mono)"><?= esc($jurnal['issn'] ?: '—') ?></div></div>
        <div class="row"><div class="k">DOI</div><div class="v mono" style="font-family:var(--mono)"><?= esc($jurnal['doi'] ?: '—') ?></div></div>
        <div class="row"><div class="k">Bidang</div><div class="v"><?= esc($jurnal['bidang'] ?: '—') ?></div></div>
      </div>
    </div>
  </article>

  <aside class="jd-side">
    <div class="card panel">
      <div class="em"><i class="ti ti-file-type-pdf"></i></div>
      <?php if (! empty($jurnal['file_pdf'])): ?>
        <?php if ($loggedIn): ?>
          <p>Baca teks lengkap jurnal ini.</p>
          <a href="<?= base_url('jurnal/file/' . $jurnal['id_jurnal']) ?>" target="_blank" class="btn btn-primary btn-lg">
            <i class="ti ti-book"></i> Baca PDF
          </a>
        <?php else: ?>
          <p>Masuk untuk membaca teks lengkap.</p>
          <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg"><i class="ti ti-lock"></i> Masuk untuk baca</a>
        <?php endif; ?>
      <?php else: ?>
        <p>Teks lengkap belum diunggah untuk jurnal ini.</p>
      <?php endif; ?>
    </div>
    <a href="<?= $scholarUrl ?>" target="_blank" rel="noopener nofollow" class="scholar">
      <i class="ti ti-external-link" style="font-size:15px"></i> Cari di Google Scholar
    </a>
  </aside>
</div>

<?= $this->endSection() ?>
