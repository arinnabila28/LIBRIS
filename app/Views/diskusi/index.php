<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .dsearch{display:flex;align-items:center;gap:8px;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-md);padding:10px 14px;max-width:460px;margin-bottom:24px;box-shadow:var(--sh-sm);}
  .dsearch input{border:0;outline:0;background:transparent;font-family:inherit;font-size:14px;color:var(--ink);width:100%;}
  .dfeed{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:14px;}
  .drow{display:flex;gap:14px;align-items:center;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-lg);padding:14px;box-shadow:var(--sh-sm);transition:transform .16s var(--ease),box-shadow .16s;}
  .drow:hover{transform:translateY(-2px);box-shadow:var(--sh-md);}
  .dthumb{width:46px;height:64px;border-radius:4px;flex-shrink:0;overflow:hidden;box-shadow:0 4px 10px rgba(24,36,27,.16);
    display:flex;flex-direction:column;justify-content:flex-end;padding:7px;}
  .dthumb img{width:100%;height:100%;object-fit:cover;}
  .dthumb .t{font-weight:700;font-size:9px;line-height:1.05;}
  .dmain{flex:1;min-width:0;}
  .dtitle{font-size:15px;font-weight:600;letter-spacing:-.01em;line-height:1.2;
    display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;}
  .dauth{font-size:12.5px;color:var(--muted);margin-top:1px;}
  .dmeta{display:flex;align-items:center;gap:8px;margin-top:8px;}
  .dmeta .c{font-family:var(--mono);font-size:11px;color:var(--muted);}
  .dnone{font-size:12px;color:var(--faint);font-style:italic;margin-top:8px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  $tones = [['#244B29','#dfe9e1'],['#2A2A28','#e7e3d6'],['#3a7d4a','#eaf3ec'],['#C9B79A','#3a2f1a'],
            ['#1d3b24','#cfe0d2'],['#D7E0CE','#2a3a2c'],['#ECE7DA','#18241B']];
  $tone = fn($b) => $tones[((int)($b['id_book'] ?? 0)) % count($tones)];
  function libStars($avg,$sz=12){ $n=(int)round((float)$avg); $o='<span class="star">'; for($i=1;$i<=5;$i++){ $on=$i<=$n; $o.='<i class="ti ti-star'.($on?'-filled':'').'" style="font-size:'.$sz.'px'.($on?'':';color:#d6dcd6').'"></i>'; } return $o.'</span>'; }
?>

<div class="phead">
    <div class="ph-k">Diskusi</div>
    <h1>Apa kata pembaca</h1>
    <p>Baca ulasan, beri rating, dan diskusikan tiap judul bersama anggota LIBRIS lainnya.</p>
</div>

<form class="dsearch" action="<?= base_url('diskusi') ?>" method="get">
    <i class="ti ti-search" style="font-size:15px;color:var(--faint)"></i>
    <input type="text" name="q" value="<?= esc($q ?? '') ?>" placeholder="Cari buku untuk didiskusikan…">
</form>

<?php if (empty($books)): ?>
    <div class="emptybox"><span class="em"><i class="ti ti-message-off"></i></span><h3>Tidak ditemukan</h3><p>Tidak ada buku yang cocok. Coba kata kunci lain.</p><a href="<?= base_url('diskusi') ?>" class="btn btn-primary">Lihat semua</a></div>
<?php else: ?>
<div class="dfeed">
    <?php foreach ($books as $b): $t = $tone($b); $jml = (int)($b['jml'] ?? 0); $avg = $jml > 0 ? (float)$b['avg_rating'] : 0; ?>
    <a href="<?= base_url('diskusi/' . $b['id_book']) ?>" class="drow">
        <div class="dthumb" style="background:<?= $t[0] ?>;color:<?= $t[1] ?>">
            <?php if (! empty($b['cover'])): ?><img src="<?= base_url('uploads/covers/' . $b['cover']) ?>" alt="">
            <?php else: ?><span class="t"><?= esc(mb_strimwidth($b['title_book'],0,16,'…')) ?></span><?php endif; ?>
        </div>
        <div class="dmain">
            <div class="dtitle"><?= esc($b['title_book']) ?></div>
            <div class="dauth"><?= esc($b['author_book'] ?: 'Penulis') ?></div>
            <?php if ($jml > 0): ?>
                <div class="dmeta"><?= libStars($avg) ?><span class="c"><?= number_format($avg,1) ?> · <?= $jml ?> ulasan</span></div>
            <?php else: ?>
                <div class="dnone">Belum ada ulasan — mulai diskusi</div>
            <?php endif; ?>
        </div>
        <i class="ti ti-chevron-right" style="font-size:17px;color:var(--faint);flex:none"></i>
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
