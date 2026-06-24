<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .bgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:22px 16px;}
  .bcard .cw{aspect-ratio:5/7;border-radius:5px;overflow:hidden;box-shadow:0 8px 20px rgba(24,36,27,.14);position:relative;display:flex;flex-direction:column;}
  .bcard .cw img{width:100%;height:100%;object-fit:cover;}
  .bcard .cw .ph{display:flex;flex-direction:column;height:100%;padding:14px 13px;}
  .bcard .cw .ph .t{font-weight:700;font-size:15px;letter-spacing:-.01em;line-height:1.04;margin-top:auto;}
  .bcard .cw .ph .r{height:2px;width:20px;margin:8px 0;opacity:.7;}
  .bcard .cw .ph .a{font-family:var(--mono);font-size:8px;letter-spacing:.06em;opacity:.7;}
  .bcard .bt{font-weight:500;font-size:13.5px;margin-top:9px;line-height:1.25;}
  .bcard .ba{font-size:12px;color:var(--muted);margin-top:1px;}
  .wfoot{display:flex;align-items:center;gap:8px;margin-top:9px;}
  .wfoot a.see{flex:1;text-align:center;font-size:12px;font-weight:500;color:var(--ink);border:1px solid var(--border-2);border-radius:8px;padding:7px;transition:background .15s;}
  .wfoot a.see:hover{background:var(--tint);}
  .wfoot .rm{display:flex;}
  .wfoot .rm button{all:unset;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border:1px solid var(--border-2);border-radius:8px;color:var(--muted);cursor:pointer;transition:color .15s,border-color .15s;}
  .wfoot .rm button:hover{color:#8A5A1A;border-color:#e3cdb0;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  $tones = [['#244B29','#dfe9e1'],['#2A2A28','#e7e3d6'],['#3a7d4a','#eaf3ec'],['#C9B79A','#3a2f1a'],
            ['#1d3b24','#cfe0d2'],['#D7E0CE','#2a3a2c'],['#ECE7DA','#18241B']];
  $tone = fn($b) => $tones[((int)($b['id_book'] ?? 0)) % count($tones)];
?>

<div class="phead"><div class="ph-k">Akun</div><h1>Perpustakaan Saya</h1></div>
<div class="mylib-tabs">
    <a href="<?= base_url('wishlist') ?>" class="on">Wishlist</a>
    <a href="<?= base_url('pinjaman-saya') ?>">Pinjaman</a>
    <a href="<?= base_url('profil') ?>">Profil</a>
</div>

<?php if (empty($items)): ?>
    <div class="emptybox">
        <span class="em"><i class="ti ti-heart"></i></span>
        <h3>Wishlist masih kosong</h3>
        <p>Simpan buku yang ingin kamu baca nanti dari halaman katalog.</p>
        <a href="<?= base_url('katalog') ?>" class="btn btn-primary"><i class="ti ti-books" style="font-size:16px"></i> Jelajahi katalog</a>
    </div>
<?php else: ?>
    <div class="bgrid">
        <?php foreach ($items as $w): $t = $tone($w); $dig = in_array($w['tipe'] ?? '', ['digital','keduanya'], true); ?>
        <div class="bcard">
            <a href="<?= base_url('katalog/' . $w['id_book']) ?>">
                <div class="cw" style="background:<?= $t[0] ?>">
                    <?php if (! empty($w['cover'])): ?><img src="<?= base_url('uploads/covers/' . $w['cover']) ?>" alt="<?= esc($w['title_book']) ?>">
                    <?php else: ?><div class="ph" style="color:<?= $t[1] ?>"><span class="t"><?= esc(mb_strimwidth($w['title_book'] ?: 'Buku',0,30,'…')) ?></span><span class="r" style="background:<?= $t[1] ?>"></span><span class="a"><?= esc(mb_strtoupper(mb_strimwidth($w['author_book'] ?: 'PENULIS',0,22,'…'))) ?></span></div><?php endif; ?>
                </div>
                <div class="bt"><?= esc($w['title_book'] ?: 'Buku') ?></div>
                <div class="ba"><?= esc($w['author_book'] ?: 'Penulis') ?></div>
            </a>
            <div class="wfoot">
                <a href="<?= base_url('katalog/' . $w['id_book']) ?>" class="see">Lihat</a>
                <form class="rm" action="<?= base_url('wishlist/toggle') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_book" value="<?= $w['id_book'] ?>">
                    <input type="hidden" name="from" value="wishlist">
                    <button type="submit" title="Hapus dari wishlist"><i class="ti ti-heart-filled" style="font-size:15px;color:var(--forest)"></i></button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
