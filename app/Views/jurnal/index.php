<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .jf{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:22px;}
  .jf form{display:flex;gap:8px;flex:1;min-width:240px;}
  .jf input{flex:1;padding:10px 14px;border:1px solid var(--border-2);border-radius:var(--r-sm);font-family:inherit;
    font-size:14px;color:var(--ink);outline:none;background:var(--surface);transition:border-color .15s,box-shadow .15s;}
  .jf input:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .jchips{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:22px;}
  .jchip{font-size:12.5px;color:var(--muted);background:var(--surface);border:1px solid var(--border);
    border-radius:999px;padding:6px 13px;transition:all .15s;}
  .jchip:hover{border-color:var(--faint);color:var(--ink);}
  .jchip.on{background:var(--forest);color:#fff;border-color:var(--forest);}

  .jlist{display:flex;flex-direction:column;gap:14px;}
  .jcard{display:flex;gap:18px;padding:22px 22px;align-items:flex-start;
    transition:transform .15s var(--ease),box-shadow .15s;}
  .jcard:hover{transform:translateY(-2px);box-shadow:var(--sh-md);}
  .jcard .ic{width:48px;height:58px;border-radius:8px;flex:none;background:
    radial-gradient(90% 90% at 30% 20%,var(--accent),var(--forest));color:#fff;
    display:flex;align-items:center;justify-content:center;font-size:22px;box-shadow:0 6px 14px rgba(34,75,41,.2);}
  .jcard .body{flex:1;min-width:0;}
  .jcard .bidang{font-family:var(--mono);font-size:10px;letter-spacing:.07em;text-transform:uppercase;color:var(--accent);}
  .jcard h3{font-size:16.5px;font-weight:600;letter-spacing:-.012em;line-height:1.3;margin:3px 0 5px;}
  .jcard .by{font-size:13.5px;color:var(--muted);}
  .jcard .src{font-size:12.5px;color:var(--faint);margin-top:6px;font-style:italic;}
  .jcard .pdf{font-family:var(--mono);font-size:10px;color:var(--forest);background:var(--tint);
    border-radius:6px;padding:3px 8px;display:inline-flex;align-items:center;gap:4px;margin-top:8px;}
  @media(max-width:680px){.jcard .ic{display:none;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="phead">
  <div class="ph-k">Koleksi Ilmiah</div>
  <h1>Jurnal</h1>
  <p>Kumpulan artikel dan jurnal ilmiah, tersedia sebagai PDF di LIBRIS.</p>
</div>

<div class="jf">
  <form action="<?= base_url('jurnal') ?>" method="get">
    <input type="text" name="q" value="<?= esc($cari) ?>" placeholder="Cari judul, penulis, atau nama jurnal…">
    <?php if ($bidang): ?><input type="hidden" name="bidang" value="<?= esc($bidang) ?>"><?php endif; ?>
    <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> Cari</button>
  </form>
</div>

<?php if (! empty($bidangList)): ?>
<div class="jchips">
  <a href="<?= base_url('jurnal' . ($cari ? '?q=' . urlencode($cari) : '')) ?>" class="jchip <?= ! $bidang ? 'on' : '' ?>">Semua bidang</a>
  <?php foreach ($bidangList as $b): ?>
    <a href="<?= base_url('jurnal?bidang=' . urlencode($b) . ($cari ? '&q=' . urlencode($cari) : '')) ?>"
       class="jchip <?= $bidang === $b ? 'on' : '' ?>"><?= esc($b) ?></a>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if (empty($list)): ?>
  <div class="emptybox">
    <div class="em"><i class="ti ti-file-text"></i></div>
    <h3><?= $cari || $bidang ? 'Tidak ada jurnal yang cocok' : 'Belum ada jurnal' ?></h3>
    <p><?= $cari || $bidang ? 'Coba kata kunci atau bidang lain.' : 'Jurnal akan tampil setelah pustakawan menambahkannya.' ?></p>
  </div>
<?php else: ?>
  <div class="jlist">
    <?php foreach ($list as $j): ?>
      <a href="<?= base_url('jurnal/' . $j['slug']) ?>" class="card jcard">
        <?php if (! empty($j['cover']) && file_exists(FCPATH . 'uploads/covers/' . $j['cover'])): ?>
          <img src="<?= base_url('uploads/covers/' . esc($j['cover'])) ?>" style="width:48px; height:64px; object-fit:cover; border-radius:4px; flex-shrink:0;">
        <?php else: ?>
          <span class="ic"><i class="ti ti-file-text"></i></span>
        <?php endif; ?>

        <div class="body">
          <?php if (! empty($j['bidang'])): ?><div class="bidang"><?= esc($j['bidang']) ?></div><?php endif; ?>
          <h3><?= esc($j['judul']) ?></h3>
          <?php if (! empty($j['penulis'])): ?><div class="by"><?= esc($j['penulis']) ?></div><?php endif; ?>
          <div class="src">
            <?= esc($j['nama_jurnal'] ?: 'Jurnal') ?><?php
              $bits = array_filter([$j['volume'] ? 'Vol. ' . $j['volume'] : null, $j['nomor'] ? 'No. ' . $j['nomor'] : null, $j['tahun'] ?: null]);
              echo $bits ? ' · ' . esc(implode(', ', $bits)) : '';
            ?>
          </div>
          <?php if (! empty($j['file_pdf'])): ?><span class="pdf"><i class="ti ti-file-type-pdf" style="font-size:12px"></i> PDF tersedia</span><?php endif; ?>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?= $this->endSection() ?>
