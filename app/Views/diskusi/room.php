<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .dback{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);font-weight:500;margin-bottom:8px;transition:color .15s;}
  .dback:hover{color:var(--ink);}
  .dr{display:grid;grid-template-columns:1.55fr 1fr;gap:30px;align-items:start;}
  .dr h2{font-size:24px;font-weight:600;letter-spacing:-.02em;}
  .dr .cnt{font-size:13px;color:var(--muted);margin-top:2px;margin-bottom:18px;}

  .compose{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:14px;margin-bottom:16px;box-shadow:var(--sh-sm);}
  .compose .top{display:flex;align-items:center;justify-content:space-between;gap:10px;}
  .compose .me{display:flex;align-items:center;gap:10px;font-size:13px;color:var(--muted);}
  .ava{width:30px;height:30px;border-radius:999px;flex-shrink:0;display:flex;align-items:center;justify-content:center;
    background:var(--forest);color:#fff;font-weight:600;font-size:12px;}
  .starpick{display:inline-flex;flex-direction:row-reverse;}
  .starpick input{display:none;}
  .starpick label{font-size:22px;color:#d6dcd6;cursor:pointer;padding:0 1px;transition:transform .1s,color .12s;}
  .starpick label:hover{transform:scale(1.12);}
  .starpick label:hover,.starpick label:hover ~ label,.starpick input:checked ~ label{color:var(--forest);}
  .compose textarea{width:100%;margin-top:12px;padding:11px 13px;border:1px solid var(--border-2);border-radius:var(--r-sm);
    font-family:inherit;font-size:14px;color:var(--ink);resize:vertical;min-height:64px;outline:none;transition:border-color .15s,box-shadow .15s;}
  .compose textarea:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .lognote{background:var(--tint);border-radius:var(--r-md);padding:14px 16px;font-size:14px;color:var(--forest);margin-bottom:16px;}
  .lognote a{font-weight:600;text-decoration:underline;}

  .rev{display:flex;gap:12px;padding:16px 0;border-top:1px solid var(--border);}
  .rev .ava2{width:36px;height:36px;border-radius:999px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:var(--tint);color:var(--forest);font-weight:600;font-size:13px;}
  .rev .who{font-size:14px;font-weight:600;}
  .rev .who .me-tag{font-family:var(--mono);font-size:9px;color:var(--accent);background:var(--tint);padding:1px 6px;border-radius:5px;margin-left:6px;letter-spacing:.05em;text-transform:uppercase;}
  .rev .when{font-family:var(--mono);font-size:10.5px;color:var(--faint);}
  .rev .cmt{font-size:14px;color:#3a463d;line-height:1.6;margin-top:5px;}
  .rev .del{font-family:var(--mono);font-size:10.5px;color:var(--amber,#8A5A1A);margin-top:8px;display:inline-flex;align-items:center;gap:4px;}
  .dr-empty{font-size:14px;color:var(--faint);font-style:italic;text-align:center;padding:24px;}

  .dside{position:sticky;top:84px;display:flex;flex-direction:column;gap:14px;}
  .bookmini{display:flex;gap:12px;align-items:center;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:13px;box-shadow:var(--sh-sm);}
  .bookmini .c{width:42px;height:60px;border-radius:4px;flex-shrink:0;overflow:hidden;box-shadow:0 4px 10px rgba(24,36,27,.16);display:flex;flex-direction:column;justify-content:flex-end;padding:6px;}
  .bookmini .c img{width:100%;height:100%;object-fit:cover;}
  .bookmini .c .t{font-weight:700;font-size:8px;line-height:1.05;}
  .ratecard{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:16px;box-shadow:var(--sh-sm);}
  .ratecard .big{font-size:36px;font-weight:600;letter-spacing:-.02em;line-height:.9;}
  .distrow{display:flex;align-items:center;gap:8px;margin-top:7px;}
  .distrow .lbl{font-family:var(--mono);font-size:10px;color:var(--faint);width:8px;}
  .distrow .bar{flex:1;height:6px;background:#F1EFE9;border-radius:9px;overflow:hidden;}
  .distrow .bar i{display:block;height:100%;background:var(--forest);}
  .distrow .pct{font-family:var(--mono);font-size:9.5px;color:var(--faint);}
  @media(max-width:820px){.dr{grid-template-columns:1fr;}.dside{position:static;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  $tones = [['#244B29','#dfe9e1'],['#2A2A28','#e7e3d6'],['#3a7d4a','#eaf3ec'],['#C9B79A','#3a2f1a'],
            ['#1d3b24','#cfe0d2'],['#D7E0CE','#2a3a2c'],['#ECE7DA','#18241B']];
  $t = $tones[((int)$book['id_book']) % count($tones)];
  $myRating = $myReview ? (int) $myReview['rating'] : 0;
  $myId = (int) session('id_user');
  function libStars($avg,$sz=14){ $n=(int)round((float)$avg); $o='<span class="star">'; for($i=1;$i<=5;$i++){ $on=$i<=$n; $o.='<i class="ti ti-star'.($on?'-filled':'').'" style="font-size:'.$sz.'px'.($on?'':';color:#d6dcd6').'"></i>'; } return $o.'</span>'; }
  // distribusi rating dari reviews
  $dist = [5=>0,4=>0,3=>0,2=>0,1=>0];
  foreach (($reviews ?? []) as $r){ $k=(int)round((float)$r['rating']); if(isset($dist[$k])) $dist[$k]++; }
?>

<a href="<?= base_url('diskusi') ?>" class="dback"><i class="ti ti-arrow-left" style="font-size:15px"></i> Diskusi</a>

<div class="dr">
    <!-- THREAD -->
    <div>
        <h2>Apa kata pembaca</h2>
        <div class="cnt"><b style="color:var(--ink)"><?= $count ?></b> ulasan untuk <i>“<?= esc($book['title_book']) ?>”</i></div>

        <?php if (session('isLoggedIn')): ?>
            <form class="compose" action="<?= base_url('diskusi/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_book" value="<?= $book['id_book'] ?>">
                <div class="top">
                    <div class="me"><span class="ava"><?= strtoupper(mb_substr(session('name') ?? 'U',0,1)) ?></span> <?= $myReview ? 'Edit ulasanmu' : 'Bagikan pendapatmu…' ?></div>
                    <span class="starpick"><?php for ($i=5;$i>=1;$i--): ?><input type="radio" name="rating" id="r<?= $i ?>" value="<?= $i ?>" <?= $myRating===$i?'checked':'' ?>><label for="r<?= $i ?>">★</label><?php endfor; ?></span>
                </div>
                <textarea name="comment" placeholder="Apa yang kamu suka (atau tidak) dari buku ini?"><?= esc($myReview['comment'] ?? '') ?></textarea>
                <div style="margin-top:11px"><button type="submit" class="btn btn-primary"><?= $myReview ? 'Perbarui ulasan' : 'Kirim ulasan' ?></button></div>
            </form>
        <?php else: ?>
            <div class="lognote"><i class="ti ti-lock" style="font-size:15px;vertical-align:-2px"></i> <a href="<?= base_url('login') ?>">Masuk</a> untuk ikut berdiskusi &amp; memberi rating.</div>
        <?php endif; ?>

        <?php if (empty($reviews)): ?>
            <div class="dr-empty">Belum ada ulasan. Jadilah yang pertama berdiskusi.</div>
        <?php else: foreach ($reviews as $r): $mine = session('isLoggedIn') && (int)$r['id_user'] === $myId; ?>
            <div class="rev">
                <div class="ava2"><?= strtoupper(mb_substr($r['user_name'] ?? 'U',0,1)) ?></div>
                <div style="flex:1;min-width:0">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px">
                        <span class="who"><?= esc($r['user_name'] ?: 'Pengguna') ?><?php if ($mine): ?><span class="me-tag">kamu</span><?php endif; ?></span>
                        <span class="when"><?= date('d M Y', strtotime($r['updated_at'] ?? $r['created_at'])) ?></span>
                    </div>
                    <?= libStars($r['rating'],12) ?>
                    <?php if (! empty($r['comment'])): ?><div class="cmt"><?= esc($r['comment']) ?></div><?php endif; ?>
                    <?php if ($mine): ?><a href="<?= base_url('diskusi/hapus/' . $r['id_review']) ?>" class="del" onclick="return confirm('Hapus ulasanmu?')"><i class="ti ti-trash" style="font-size:13px"></i> Hapus</a><?php endif; ?>
                </div>
            </div>
        <?php endforeach; endif; ?>
    </div>

    <!-- SIDEBAR -->
    <aside class="dside">
        <a href="<?= base_url('katalog/' . $book['id_book']) ?>" class="bookmini">
            <div class="c" style="background:<?= $t[0] ?>;color:<?= $t[1] ?>">
                <?php if (! empty($book['cover'])): ?><img src="<?= base_url('uploads/covers/' . $book['cover']) ?>" alt="">
                <?php else: ?><span class="t"><?= esc(mb_strimwidth($book['title_book'],0,14,'…')) ?></span><?php endif; ?>
            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:14px;font-weight:600;line-height:1.2"><?= esc($book['title_book']) ?></div>
                <div style="font-size:12px;color:var(--muted);margin-top:1px"><?= esc($book['author_book'] ?: 'Penulis') ?></div>
                <div style="font-size:12.5px;color:var(--accent);font-weight:500;margin-top:6px">Lihat buku →</div>
            </div>
        </a>

        <div class="ratecard">
            <div style="display:flex;align-items:flex-end;gap:10px">
                <div class="big"><?= $count > 0 ? number_format((float)$avg,1) : '–' ?></div>
                <div style="padding-bottom:3px"><?= libStars($avg,13) ?><div class="mono" style="font-size:11px;color:var(--faint);margin-top:2px"><?= $count ?> ulasan</div></div>
            </div>
            <div style="margin-top:14px">
                <?php foreach ([5,4,3,2,1] as $k): $p = $count > 0 ? round($dist[$k]/$count*100) : 0; ?>
                <div class="distrow"><span class="lbl"><?= $k ?></span><span class="bar"><i style="width:<?= $p ?>%;<?= $p==0?'background:#d6dcd6':'' ?>"></i></span><span class="pct"><?= $p ?>%</span></div>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>
</div>
<?= $this->endSection() ?>
