<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  /* tonal designed cover (fallback ketika tak ada gambar) */
  .bcov{position:relative;border-radius:5px;overflow:hidden;box-shadow:0 10px 26px rgba(24,36,27,.16);
    display:flex;flex-direction:column;}
  .bcov img{width:100%;height:100%;object-fit:cover;}
  .bcov .ph{display:flex;flex-direction:column;height:100%;padding:14px 13px;}
  .bcov .ph .t{font-weight:700;letter-spacing:-.01em;line-height:1.04;margin-top:auto;}
  .bcov .ph .r{height:2px;width:20px;margin:8px 0;opacity:.7;}
  .bcov .ph .a{font-family:var(--mono);font-size:8px;letter-spacing:.06em;opacity:.7;}

  /* ── HERO: book of the week ── */
  .hx{display:grid;grid-template-columns:1.5fr .9fr;gap:24px;padding:14px 0 30px;position:relative;}
  .hx::before{content:"";position:absolute;inset:-20px -40px auto -40px;height:240px;z-index:-1;
    background:radial-gradient(60% 100% at 12% 0%,rgba(34,75,41,.06),transparent 60%);}
  .hx-txt{align-self:center;}
  .hx-meta{display:flex;align-items:center;gap:10px;}
  .hx-meta .ln{height:1px;width:42px;background:var(--border-2);}
  .hx h1{font-size:42px;font-weight:600;letter-spacing:-.035em;line-height:.98;margin-top:13px;}
  .hx-by{font-size:14px;color:var(--muted);margin-top:6px;}
  .hx-quote{border-left:2px solid var(--forest);padding-left:13px;margin:16px 0;font-size:14.5px;line-height:1.55;
    color:#3f4a42;max-width:340px;}
  .hx-rate{display:flex;align-items:center;gap:9px;flex-wrap:wrap;}
  .hx-cta{display:flex;align-items:center;gap:10px;margin-top:20px;flex-wrap:wrap;}
  .hx-cover{position:relative;height:288px;}
  .hx-cover .main{position:absolute;right:0;top:14px;width:176px;height:250px;}
  .hx-cover .back{position:absolute;right:36px;top:34px;width:150px;height:212px;transform:rotate(-7deg);opacity:.85;}

  /* ── book grid ── */
  .bgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(148px,1fr));gap:20px 16px;}
  .bcard{display:block;transition:transform .18s var(--ease);}
  .bcard:hover{transform:translateY(-4px);}
  .bcard .cw{aspect-ratio:5/7;}
  .bcard .bt{font-weight:500;font-size:13.5px;margin-top:9px;line-height:1.25;
    display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;}
  .bcard .ba{font-size:12px;color:var(--muted);margin-top:1px;}
  .bcard .bf{display:flex;align-items:center;justify-content:space-between;margin-top:7px;}

  /* ── collection strip ── */
  .coll{display:flex;align-items:center;gap:16px;background:linear-gradient(110deg,#244B29,#16331c);
    border-radius:var(--r-lg);padding:20px 22px;color:#dfe9e1;margin:34px 0;position:relative;overflow:hidden;}
  .coll .t{font-size:19px;font-weight:600;color:#fff;line-height:1.15;}
  .coll .s{font-size:12.5px;color:#aec6b3;margin-top:5px;}
  .coll .spines{position:absolute;right:160px;bottom:-12px;display:flex;gap:6px;opacity:.5;}
  .coll .spines span{width:40px;height:58px;border-radius:3px;}
  @media(max-width:760px){
    .hx{grid-template-columns:1fr;} .hx-cover{height:250px;order:-1;}
    .hx h1{font-size:32px;} .coll .spines{display:none;}
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  // tonal palette untuk sampul fallback (LIBRIS)
  $tones = [['#244B29','#dfe9e1'],['#2A2A28','#e7e3d6'],['#3a7d4a','#eaf3ec'],['#C9B79A','#3a2f1a'],
            ['#1d3b24','#cfe0d2'],['#D7E0CE','#2a3a2c'],['#ECE7DA','#18241B']];
  function tone($b, $tones){ return $tones[((int)($b['id_book'] ?? 0)) % count($tones)]; }
  function libStars($avg){ $n=(int)round((float)$avg); $o='<span class="star">'; for($i=1;$i<=5;$i++){ $on=$i<=$n; $o.='<i class="ti ti-star'.($on?'-filled':'').'" style="font-size:13px'.($on?'':';color:#d6dcd6').'"></i>'; } return $o.'</span>'; }

  $feat = $top[0] ?? null;
  $rest = array_slice($top ?? [], 1);
?>

<?php if (! $feat): ?>
    <div class="phead"><div class="ph-k">Beranda</div><h1>Selamat datang di LIBRIS</h1></div>
    <div class="emptybox"><span class="em"><i class="ti ti-books"></i></span><h3>Katalog masih kosong</h3><p>Belum ada buku yang ditampilkan. Cek lagi nanti.</p><a href="<?= base_url('katalog') ?>" class="btn btn-primary">Jelajahi katalog</a></div>
<?php else: ?>

<!-- HERO: Buku Pekan Ini -->
<section class="hx">
    <div class="hx-txt">
        <div class="hx-meta"><span class="kick">Buku Pekan Ini</span><span class="ln"></span><span class="mono" style="font-size:11px;color:var(--faint)">Dikurasi LIBRIS</span></div>
        <h1><?= esc($feat['title_book']) ?></h1>
        <div class="hx-by"><?= esc($feat['author_book'] ?: 'Penulis tidak diketahui') ?> · <?= ($feat['tipe'] ?? '')==='keduanya' ? 'Fisik + Digital' : (($feat['tipe'] ?? '')==='digital' ? 'Digital' : 'Fisik') ?></div>
        <?php if (! empty($feat['avg_rating']) && (int)$feat['jml'] > 0): ?>
            <div class="hx-quote">Salah satu judul paling banyak diulas anggota minggu ini — favorit yang terus dibicarakan.</div>
            <div class="hx-rate"><?= libStars($feat['avg_rating']) ?><span class="mono" style="font-size:12px"><?= number_format((float)$feat['avg_rating'],1) ?></span><span style="font-size:12px;color:var(--muted)">· <?= (int)$feat['jml'] ?> ulasan</span></div>
        <?php else: ?>
            <div class="hx-quote">Baru ditambahkan ke rak LIBRIS — jadilah yang pertama membaca dan mengulasnya.</div>
        <?php endif; ?>
        <div class="hx-cta">
            <a href="<?= base_url('katalog/' . $feat['id_book']) ?>" class="btn btn-primary btn-lg">Lihat buku</a>
            <a href="<?= base_url('diskusi/' . $feat['id_book']) ?>" class="btn btn-ghost btn-lg"><i class="ti ti-message-circle" style="font-size:16px"></i> Diskusi</a>
        </div>
    </div>
    <div class="hx-cover">
        <?php $t = tone($feat, $tones); ?>
        <div class="bcov back" style="background:<?= $t[0] ?>"></div>
        <div class="bcov main" style="background:<?= $t[0] ?>">
            <?php if (! empty($feat['cover'])): ?>
                <img src="<?= base_url('uploads/covers/' . $feat['cover']) ?>" alt="<?= esc($feat['title_book']) ?>">
            <?php else: ?>
                <div class="ph" style="color:<?= $t[1] ?>">
                    <span class="mono" style="font-size:8.5px;letter-spacing:.14em;opacity:.6">LIBRIS · PILIHAN</span>
                    <span class="t" style="font-size:23px"><?= esc(mb_strimwidth($feat['title_book'],0,34,'…')) ?></span>
                    <span class="r" style="background:<?= $t[1] ?>"></span>
                    <span class="a"><?= esc(mb_strtoupper($feat['author_book'] ?: 'PENULIS')) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Pilihan pekan ini -->
<div class="seclabel"><h2>Pilihan pekan ini</h2><a href="<?= base_url('katalog') ?>">Lihat katalog →</a></div>
<div class="bgrid">
    <?php foreach ($rest as $b): $t = tone($b, $tones); ?>
    <a href="<?= base_url('katalog/' . $b['id_book']) ?>" class="bcard">
        <div class="bcov cw" style="background:<?= $t[0] ?>">
            <?php if (! empty($b['cover'])): ?>
                <img src="<?= base_url('uploads/covers/' . $b['cover']) ?>" alt="<?= esc($b['title_book']) ?>">
            <?php else: ?>
                <div class="ph" style="color:<?= $t[1] ?>">
                    <span class="t" style="font-size:15px"><?= esc(mb_strimwidth($b['title_book'],0,30,'…')) ?></span>
                    <span class="r" style="background:<?= $t[1] ?>"></span>
                    <span class="a"><?= esc(mb_strtoupper(mb_strimwidth($b['author_book'] ?: 'PENULIS',0,22,'…'))) ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="bt"><?= esc($b['title_book']) ?></div>
        <div class="ba"><?= esc($b['author_book'] ?: 'Penulis') ?></div>
        <?php $bt = $b['tipe'] ?? 'fisik'; $btLabel = $bt==='keduanya' ? 'Fisik+Digital' : ($bt==='digital' ? 'Digital' : 'Fisik'); ?>
        <div class="bf"><span class="pill <?= $bt==='fisik' ? 'muted' : '' ?>"><?= $btLabel ?></span><i class="ti ti-arrow-up-right" style="font-size:15px;color:var(--faint)"></i></div>
    </a>
    <?php endforeach; ?>
</div>

<!-- Koleksi kurasi -->
<a href="<?= base_url('katalog') ?>" class="coll">
    <div style="flex:1">
        <span class="kick" style="color:#9bc0a4">Koleksi Kurasi</span>
        <div class="t">Filsafat untuk hidup yang lebih tenang</div>
        <div class="s">Stoik, Zen, &amp; minimalis · jelajahi koleksinya</div>
    </div>
    <span class="btn" style="background:#fff;color:var(--forest);white-space:nowrap">Buka koleksi <i class="ti ti-arrow-right" style="font-size:15px"></i></span>
    <div class="spines"><span style="background:#C9B79A;transform:rotate(6deg)"></span><span style="background:#ECE7DA;transform:rotate(-5deg);margin-left:-10px"></span></div>
</a>

<?php endif; ?>
<?= $this->endSection() ?>
