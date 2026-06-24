<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .dback{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);font-weight:500;margin-bottom:20px;transition:color .15s;}
  .dback:hover{color:var(--ink);}
  .dt{display:grid;grid-template-columns:300px 1fr;gap:40px;align-items:start;}
  .dt-side{position:sticky;top:84px;display:flex;flex-direction:column;gap:16px;}

  .dcover{aspect-ratio:5/7;border-radius:8px;overflow:hidden;box-shadow:0 20px 44px rgba(24,36,27,.18);position:relative;display:flex;flex-direction:column;}
  .dcover img{width:100%;height:100%;object-fit:cover;}
  .dcover .ph{display:flex;flex-direction:column;height:100%;padding:24px 20px;}
  .dcover .ph .t{font-weight:700;font-size:26px;letter-spacing:-.02em;line-height:1.02;margin-top:auto;}
  .dcover .ph .r{height:2px;width:26px;margin:12px 0;}
  .dcover .ph .a{font-family:var(--mono);font-size:10px;letter-spacing:.08em;opacity:.7;}
  .dact{display:flex;gap:10px;}
  .dact .btn{flex:1;justify-content:center;}
  .icb{width:44px;flex:none!important;display:inline-flex;align-items:center;justify-content:center;padding:10px;background:var(--surface);border:1px solid var(--border-2);border-radius:var(--r-sm);color:var(--ink);cursor:pointer;transition:transform .15s,background .15s,color .15s;}
  .icb:hover{transform:translateY(-1px);}
  .icb.on{background:var(--forest);color:#fff;border-color:var(--forest);}
  .icb form{display:flex;}
  .icb button{all:unset;display:flex;align-items:center;justify-content:center;cursor:pointer;}
  .davail{display:flex;align-items:center;justify-content:center;gap:7px;font-size:12.5px;color:var(--muted);}

  .dt-main h1{font-size:34px;font-weight:600;letter-spacing:-.03em;line-height:1.05;margin-top:8px;}
  .dt-by{font-size:15px;color:var(--muted);margin-top:7px;}
  .drate{display:flex;align-items:center;gap:9px;margin-top:14px;}
  .dchips{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
  .dchip{font-size:12px;color:var(--muted);background:var(--surface);border:1px solid var(--border);border-radius:999px;padding:5px 12px;}
  .dchip b{color:var(--ink);font-weight:600;}
  .dsec{margin-top:32px;}
  .dsec h3{font-size:13px;font-family:var(--mono);letter-spacing:.1em;text-transform:uppercase;color:var(--faint);margin-bottom:12px;}
  .dsyn{font-size:15.5px;line-height:1.7;color:#3a463d;}
  .dl{display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:var(--border);border:1px solid var(--border);border-radius:var(--r-md);overflow:hidden;}
  .dl .row{background:var(--surface);padding:12px 16px;}
  .dl .k{font-family:var(--mono);font-size:10px;letter-spacing:.06em;text-transform:uppercase;color:var(--faint);}
  .dl .v{font-size:14px;color:var(--ink);margin-top:3px;}

  /* ulasan */
  .ulsum{display:flex;align-items:center;gap:16px;margin-bottom:18px;}
  .ulsum .big{font-size:40px;font-weight:600;letter-spacing:-.02em;line-height:.9;}
  .ulform{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:16px;margin-bottom:18px;box-shadow:var(--sh-sm);}
  .ulform textarea{width:100%;margin-top:10px;padding:11px 13px;border:1px solid var(--border-2);border-radius:var(--r-sm);
    font-family:inherit;font-size:14px;color:var(--ink);resize:vertical;min-height:70px;outline:none;transition:border-color .15s,box-shadow .15s;}
  .ulform textarea:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .starpick{display:inline-flex;flex-direction:row-reverse;}
  .starpick input{display:none;}
  .starpick label{font-size:24px;color:#d6dcd6;cursor:pointer;padding:0 1px;transition:transform .1s,color .12s;}
  .starpick label:hover{transform:scale(1.12);}
  .starpick label:hover,.starpick label:hover ~ label,.starpick input:checked ~ label{color:var(--forest);}
  .lognote{background:var(--tint);border-radius:var(--r-md);padding:14px 16px;font-size:14px;color:var(--forest);}
  .lognote a{font-weight:600;text-decoration:underline;}
  .rev{display:flex;gap:12px;padding:16px 0;border-top:1px solid var(--border);}
  .rev .ava{width:36px;height:36px;border-radius:999px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:var(--tint);color:var(--forest);font-weight:600;font-size:13px;}
  .rev .who{font-size:14px;font-weight:600;}
  .rev .when{font-family:var(--mono);font-size:10.5px;color:var(--faint);}
  .rev .cmt{font-size:14px;color:#3a463d;line-height:1.6;margin-top:5px;}

  /* serupa */
  .skgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:16px;}
  .sk{display:block;transition:transform .18s var(--ease);}
  .sk:hover{transform:translateY(-3px);}
  .sk .skc{aspect-ratio:5/7;border-radius:5px;overflow:hidden;box-shadow:0 6px 16px rgba(24,36,27,.14);position:relative;display:flex;flex-direction:column;}
  .sk .skc img{width:100%;height:100%;object-fit:cover;}
  .sk .skc .ph{padding:11px;display:flex;flex-direction:column;height:100%;}
  .sk .skc .ph .t{font-weight:700;font-size:12px;line-height:1.04;margin-top:auto;}
  .sk .skt{font-size:12.5px;font-weight:500;margin-top:7px;line-height:1.2;
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

  @media(max-width:820px){.dt{grid-template-columns:1fr;}.dt-side{position:static;flex-direction:row;align-items:flex-start;}.dt-side .dcover{width:160px;flex:none;}.dt-side .dactwrap{flex:1;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  $tones = [['#244B29','#dfe9e1'],['#2A2A28','#e7e3d6'],['#3a7d4a','#eaf3ec'],['#C9B79A','#3a2f1a'],
            ['#1d3b24','#cfe0d2'],['#D7E0CE','#2a3a2c'],['#ECE7DA','#18241B']];
  $t = $tones[((int)$book['id_book']) % count($tones)];
  $tipe     = $book['tipe'] ?? 'fisik';
  $stok     = (int) ($book['stock'] ?? 0);
  $canRead   = in_array($tipe, ['digital', 'keduanya'], true);            // punya versi digital
  $physical  = in_array($tipe, ['fisik', 'keduanya'], true);             // punya eksemplar fisik
  $canBorrow = $physical && $stok > 0;                                    // bisa dipinjam
  $tipeLabel = $tipe === 'keduanya' ? 'Fisik & Digital' : ($tipe === 'digital' ? 'Digital' : 'Fisik');
  $loggedIn = session('isLoggedIn');
  $loginUrl = base_url('login');
  $detailUrl= base_url('katalog/' . $book['id_book']);
  $subjek   = array_filter(array_map('trim', explode(',', (string) ($book['subjek'] ?? ''))));
  $myRating = $myReview ? (int) $myReview['rating'] : 0;
  function libStars($avg,$sz=14){ $n=(int)round((float)$avg); $o='<span class="star">'; for($i=1;$i<=5;$i++){ $on=$i<=$n; $o.='<i class="ti ti-star'.($on?'-filled':'').'" style="font-size:'.$sz.'px'.($on?'':';color:#d6dcd6').'"></i>'; } return $o.'</span>'; }
?>

<a href="<?= base_url('katalog') ?>" class="dback"><i class="ti ti-arrow-left" style="font-size:15px"></i> Katalog</a>

<div class="dt">
    <!-- LEFT -->
    <div class="dt-side">
        <div class="dcover" style="background:<?= $t[0] ?>">
            <?php if (! empty($book['cover'])): ?>
                <img src="<?= base_url('uploads/covers/' . $book['cover']) ?>" alt="<?= esc($book['title_book']) ?>">
            <?php else: ?>
                <div class="ph" style="color:<?= $t[1] ?>">
                    <span class="mono" style="font-size:9px;letter-spacing:.14em;opacity:.6">LIBRIS</span>
                    <span class="t"><?= esc(mb_strimwidth($book['title_book'],0,40,'…')) ?></span>
                    <span class="r" style="background:<?= $t[1] ?>"></span>
                    <span class="a"><?= esc(mb_strtoupper($book['author_book'] ?: 'PENULIS')) ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="dactwrap" style="display:flex;flex-direction:column;gap:12px">
            <!-- Tombol aksi: Baca (kalau digital) &/atau Ajukan pinjam (kalau ada stok) -->
            <div class="dact">
                <?php if ($canRead): ?>
                    <a class="btn btn-primary" href="<?= $loggedIn ? base_url('baca/' . $book['id_book']) : $loginUrl ?>"><i class="ti ti-book" style="font-size:16px"></i> Baca</a>
                <?php endif; ?>
                <?php if ($canBorrow): ?>
                    <?php $borrowClass = $canRead ? 'btn-ghost' : 'btn-primary'; ?>
                    <?php if ($loggedIn): ?>
                        <form action="<?= base_url('pinjam/ajukan') ?>" method="post" style="flex:1;display:flex"><?= csrf_field() ?><input type="hidden" name="id_book" value="<?= $book['id_book'] ?>"><button type="submit" class="btn <?= $borrowClass ?>" style="flex:1;justify-content:center"><i class="ti ti-bookmark" style="font-size:16px"></i> Ajukan pinjam</button></form>
                    <?php else: ?>
                        <a class="btn <?= $borrowClass ?>" href="<?= $loginUrl ?>"><i class="ti ti-bookmark" style="font-size:16px"></i> Ajukan pinjam</a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (! $canRead && ! $canBorrow): ?>
                    <span class="btn btn-ghost" style="flex:1;justify-content:center;opacity:.6;cursor:not-allowed"><?= $physical ? 'Stok habis' : 'Belum tersedia' ?></span>
                <?php endif; ?>
            </div>
            <!-- Wishlist + Share -->
            <div class="dact">
                <?php if ($loggedIn): ?>
                    <span class="icb <?= ! empty($inWishlist) ? 'on' : '' ?>" title="Wishlist" style="flex:1"><form action="<?= base_url('wishlist/toggle') ?>" method="post" style="flex:1;justify-content:center"><?= csrf_field() ?><input type="hidden" name="id_book" value="<?= $book['id_book'] ?>"><button type="submit"><i class="ti ti-heart<?= ! empty($inWishlist) ? '-filled' : '' ?>" style="font-size:18px"></i></button></form></span>
                <?php else: ?>
                    <a href="<?= $loginUrl ?>" class="icb" title="Wishlist" style="flex:1"><i class="ti ti-heart" style="font-size:18px"></i></a>
                <?php endif; ?>
                <span class="icb" title="Salin tautan" style="flex:1" onclick="navigator.clipboard.writeText('<?= $detailUrl ?>').then(()=>showToast('Tautan disalin'))"><i class="ti ti-share-3" style="font-size:18px"></i></span>
            </div>
            <div class="davail">
                <?php if ($canRead && $canBorrow): ?><i class="ti ti-circle-check" style="font-size:15px;color:var(--accent)"></i> Bisa dibaca &amp; <?= $stok ?> eksemplar untuk dipinjam
                <?php elseif ($canRead): ?><i class="ti ti-cloud" style="font-size:15px;color:var(--accent)"></i> Tersedia sebagai buku digital
                <?php elseif ($canBorrow): ?><i class="ti ti-circle-check" style="font-size:15px;color:var(--accent)"></i> <?= $stok ?> eksemplar tersedia
                <?php else: ?><i class="ti ti-clock" style="font-size:15px;color:var(--amber)"></i> Sedang tidak tersedia<?php endif; ?>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="dt-main">
        <div class="kick"><?= esc($tipeLabel) ?><?= $subjek ? ' · ' . esc($subjek[0]) : '' ?></div>
        <h1><?= esc($book['title_book']) ?></h1>
        <div class="dt-by"><?= esc($book['author_book'] ?: 'Penulis tidak diketahui') ?></div>
        <?php if ($count > 0): ?>
            <div class="drate"><?= libStars($avg,15) ?><span class="mono" style="font-size:13px"><?= number_format((float)$avg,1) ?></span><span style="font-size:13px;color:var(--muted)">· <?= $count ?> ulasan</span></div>
        <?php endif; ?>
        <div class="dchips">
            <?php if (! empty($book['published_year'])): ?><span class="dchip">Terbit <b><?= esc($book['published_year']) ?></b></span><?php endif; ?>
            <?php if (! empty($book['deskripsi_fisik'])): ?><span class="dchip"><b><?= esc($book['deskripsi_fisik']) ?></b></span><?php endif; ?>
            <?php if (! empty($book['publisher_book'])): ?><span class="dchip"><?= esc($book['publisher_book']) ?></span><?php endif; ?>
            <?php if (! empty($book['isbn_book'])): ?><span class="dchip mono" style="font-family:var(--mono)">ISBN <?= esc($book['isbn_book']) ?></span><?php endif; ?>
        </div>

        <div class="dsec">
            <h3>Sinopsis</h3>
            <div class="dsyn"><?= nl2br(esc($book['description_book'] ?: 'Belum ada sinopsis untuk buku ini.')) ?></div>
        </div>

        <div class="dsec">
            <h3>Detail bibliografi</h3>
            <div class="dl">
                <div class="row"><div class="k">Penerbit</div><div class="v"><?= esc($book['publisher_book'] ?: '—') ?></div></div>
                <div class="row"><div class="k">Kota terbit</div><div class="v"><?= esc($book['kota_terbit'] ?: '—') ?></div></div>
                <div class="row"><div class="k">Tahun</div><div class="v"><?= esc($book['published_year'] ?: '—') ?></div></div>
                <div class="row"><div class="k">Edisi</div><div class="v"><?= esc($book['edisi'] ?: '—') ?></div></div>
                <div class="row"><div class="k">No. klasifikasi</div><div class="v"><?= esc($book['no_klasifikasi'] ?: '—') ?></div></div>
                <div class="row"><div class="k">Volume</div><div class="v"><?= esc($book['volume'] ?: '—') ?></div></div>
                <div class="row"><div class="k">ISBN</div><div class="v mono" style="font-family:var(--mono)"><?= esc($book['isbn_book'] ?: '—') ?></div></div>
                <div class="row"><div class="k">Subjek</div><div class="v"><?= $subjek ? esc(implode(', ', $subjek)) : '—' ?></div></div>
            </div>
        </div>

        <!-- ULASAN -->
        <div class="dsec" id="ulasan">
            <h3>Ulasan pembaca (<?= $count ?>)</h3>
            <?php if ($count > 0): ?>
                <div class="ulsum"><div class="big"><?= number_format((float)$avg,1) ?></div><div><?= libStars($avg,16) ?><div class="mono" style="font-size:11px;color:var(--faint);margin-top:3px"><?= $count ?> ULASAN</div></div></div>
            <?php endif; ?>

            <?php if ($loggedIn): ?>
                <form class="ulform" action="<?= base_url('diskusi/simpan') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_book" value="<?= $book['id_book'] ?>">
                    <input type="hidden" name="back" value="<?= $detailUrl ?>#ulasan">
                    <div style="display:flex;align-items:center;justify-content:space-between">
                        <span style="font-size:13px;font-weight:600"><?= $myReview ? 'Edit ulasanmu' : 'Tulis ulasan' ?></span>
                        <span class="starpick"><?php for ($i = 5; $i >= 1; $i--): ?><input type="radio" name="rating" id="ds<?= $i ?>" value="<?= $i ?>" <?= $myRating === $i ? 'checked' : '' ?>><label for="ds<?= $i ?>">★</label><?php endfor; ?></span>
                    </div>
                    <textarea name="comment" placeholder="Apa pendapatmu tentang buku ini?"><?= esc($myReview['comment'] ?? '') ?></textarea>
                    <button type="submit" class="btn btn-primary" style="margin-top:12px"><?= $myReview ? 'Perbarui ulasan' : 'Kirim ulasan' ?></button>
                </form>
            <?php else: ?>
                <div class="lognote"><i class="ti ti-lock" style="font-size:15px;vertical-align:-2px"></i> <a href="<?= $loginUrl ?>">Masuk</a> untuk memberi rating &amp; ulasan.</div>
            <?php endif; ?>

            <?php if (! empty($reviews)): foreach ($reviews as $r): ?>
                <div class="rev">
                    <div class="ava"><?= strtoupper(mb_substr($r['user_name'] ?? 'U', 0, 1)) ?></div>
                    <div style="flex:1;min-width:0">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px">
                            <span class="who"><?= esc($r['user_name'] ?: 'Pengguna') ?></span>
                            <span class="when"><?= date('d M Y', strtotime($r['updated_at'] ?? $r['created_at'])) ?></span>
                        </div>
                        <?= libStars($r['rating'],12) ?>
                        <?php if (! empty($r['comment'])): ?><div class="cmt"><?= esc($r['comment']) ?></div><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>

        <!-- SERUPA -->
        <?php if (! empty($rekom)): ?>
        <div class="dsec">
            <h3>Buku serupa</h3>
            <div class="skgrid">
                <?php foreach ($rekom as $rk): $rt = $tones[((int)$rk['id_book']) % count($tones)]; ?>
                <a href="<?= base_url('katalog/' . $rk['id_book']) ?>" class="sk">
                    <div class="skc" style="background:<?= $rt[0] ?>">
                        <?php if (! empty($rk['cover'])): ?><img src="<?= base_url('uploads/covers/' . $rk['cover']) ?>" alt="">
                        <?php else: ?><div class="ph" style="color:<?= $rt[1] ?>"><span class="t"><?= esc(mb_strimwidth($rk['title_book'],0,24,'…')) ?></span></div><?php endif; ?>
                    </div>
                    <div class="skt"><?= esc($rk['title_book']) ?></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
