<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .lhero{display:grid;grid-template-columns:1.05fr .95fr;gap:20px;align-items:center;padding:30px 0 26px;position:relative;}
  .lhero::before{content:"";position:absolute;inset:-30px -60px auto -60px;height:300px;z-index:-1;
    background:radial-gradient(55% 100% at 18% 10%,rgba(34,75,41,.07),transparent 62%);}
  .lhero h1{font-size:50px;font-weight:600;letter-spacing:-.04em;line-height:1.0;margin-top:14px;}
  .lhero h1 span{color:var(--forest);}
  .lhero .sub{font-size:16.5px;color:var(--muted);margin-top:16px;max-width:380px;line-height:1.55;}
  .lcta{display:flex;align-items:center;gap:12px;margin-top:26px;flex-wrap:wrap;}
  .lproof{display:flex;align-items:center;gap:10px;margin-top:26px;}
  .lproof .avs{display:flex;}
  .lproof .avs span{width:26px;height:26px;border-radius:999px;border:2px solid var(--paper);margin-left:-8px;font-size:9px;font-weight:600;display:flex;align-items:center;justify-content:center;}
  .lproof .avs span:first-child{margin-left:0;}
  .lproof .tx{font-size:12.5px;color:var(--muted);}

  .wall{position:relative;height:360px;}
  .wall .cv{position:absolute;border-radius:5px;overflow:hidden;box-shadow:0 16px 36px rgba(24,36,27,.2);
    display:flex;flex-direction:column;padding:13px;}
  .wall .cv .t{font-weight:700;letter-spacing:-.01em;line-height:1.04;margin-top:auto;}
  .wall .cv .a{font-family:var(--mono);font-size:8px;letter-spacing:.06em;opacity:.7;margin-top:6px;}

  .statband{display:flex;align-items:center;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);
    padding:18px 6px;box-shadow:var(--sh-sm);margin:14px 0 44px;}
  .statband .s{flex:1;text-align:center;}
  .statband .s .v{font-family:var(--mono);font-size:20px;font-weight:500;}
  .statband .s .l{font-size:11.5px;color:var(--muted);margin-top:2px;}
  .statband .d{width:1px;height:30px;background:var(--border);}

  .lcoll{display:grid;grid-template-columns:1.5fr 1fr;gap:16px;}
  .lcoll .big{border-radius:var(--r-lg);background:linear-gradient(150deg,#244B29,#16331c);padding:22px;color:#dfe9e1;
    position:relative;overflow:hidden;min-height:150px;display:flex;flex-direction:column;justify-content:space-between;}
  .lcoll .big .t{font-size:22px;font-weight:600;color:#fff;line-height:1.12;}
  .lcoll .small{display:flex;flex-direction:column;gap:16px;}
  .lcoll .small a{flex:1;display:flex;align-items:center;gap:13px;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-lg);padding:16px;box-shadow:var(--sh-sm);transition:transform .16s,box-shadow .16s;}
  .lcoll .small a:hover{transform:translateY(-2px);box-shadow:var(--sh-md);}
  .lcoll .small .sp{width:40px;height:56px;border-radius:3px;flex-shrink:0;box-shadow:0 5px 12px rgba(24,36,27,.18);}
  @media(max-width:780px){.lhero{grid-template-columns:1fr;}.wall{height:300px;order:-1;}.lhero h1{font-size:36px;}.lcoll{grid-template-columns:1fr;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="lhero">
    <div>
        <div class="kick">Perpustakaan Digital · Est. 2026</div>
        <h1>Tempat yang <span>tenang</span><br>untuk seribu cerita.</h1>
        <p class="sub">Telusuri, pinjam, dan baca ribuan judul fisik maupun digital — dikurasi untuk kamu yang serius membaca.</p>
        <div class="lcta">
            <a href="<?= base_url('katalog') ?>" class="btn btn-primary btn-lg">Mulai membaca</a>
            <?php if (session('isLoggedIn')): ?>
                <a href="<?= base_url('home') ?>" class="btn btn-ghost btn-lg">Ke Beranda <i class="ti ti-arrow-right" style="font-size:15px"></i></a>
            <?php else: ?>
                <a href="<?= base_url('register') ?>" class="btn btn-ghost btn-lg">Daftar gratis <i class="ti ti-arrow-right" style="font-size:15px"></i></a>
            <?php endif; ?>
        </div>
        <div class="lproof">
            <div class="avs">
                <span style="background:#224B29;color:#fff">RA</span>
                <span style="background:#C9B79A;color:#3a2f1a">SW</span>
                <span style="background:#2A2A28;color:#e7e3d6">BP</span>
                <span style="background:#EAF1E9;color:#224B29">+3k</span>
            </div>
            <div class="tx">Bergabung dengan <b style="color:var(--ink);font-weight:600">3,200 pembaca</b></div>
        </div>
    </div>
    <div class="wall">
        <?php 
        // Menyimpan gaya/posisi unik untuk 4 slot buku di wall
        $wallStyles = [
            "width:120px;height:172px;left:8px;top:10px;transform:rotate(-8deg);",
            "width:122px;height:174px;right:0;top:2px;transform:rotate(7deg);",
            "width:146px;height:208px;left:50%;top:72px;transform:translateX(-50%) rotate(-2deg);box-shadow:0 24px 46px rgba(24,36,27,.24);",
            "width:104px;height:150px;right:14px;bottom:4px;transform:rotate(5deg);"
        ];
        ?>

        <?php if (!empty($books)): ?>
            <?php foreach ($books as $index => $b): ?>
                <?php if ($index > 3) break; // Maksimal hanya 4 buku untuk wall ?>
                
                <div class="cv" style="<?= $wallStyles[$index] ?> padding:0; background:var(--surface);">
                    <?php if (!empty($b['cover'])): ?>
                        <img src="<?= base_url('uploads/covers/' . esc($b['cover'])) ?>" alt="<?= esc($b['title_book']) ?>" style="width:100%; height:100%; object-fit:cover; border-radius:5px;">
                    <?php else: ?>
                        <div style="padding:13px; display:flex; flex-direction:column; height:100%; background:#244B29; color:#cfe0d2; border-radius:5px;">
                            <span class="t" style="font-size:14px; margin-top:auto;"><?= esc($b['title_book']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; margin-top:50px; color:var(--muted);">Koleksi belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<div class="statband">
    <div class="s"><div class="v">12,480</div><div class="l">Volumes</div></div>
    <div class="d"></div>
    <div class="s"><div class="v">3,200</div><div class="l">Anggota</div></div>
    <div class="d"></div>
    <div class="s"><div class="v">98%</div><div class="l">Tersedia</div></div>
    <div class="d"></div>
    <div class="s"><div class="v">Fisik<span style="color:var(--faint)">+</span>Digital</div><div class="l">Dua format</div></div>
</div>

<div class="seclabel"><h2>Mulai dari koleksi pilihan</h2><a href="<?= base_url('katalog') ?>">Semua koleksi →</a></div>
<div class="lcoll">
    <a href="<?= base_url('katalog') ?>" class="big">
        <div><span class="kick" style="color:#9bc0a4">Sorotan</span><div class="t">Sastra<br>Modern</div></div>
        <div style="font-size:12.5px;color:#cfe0d2;font-weight:500">5 judul · jelajahi →</div>
    </a>
    <div class="small">
        <a href="<?= base_url('katalog') ?>"><span class="sp" style="background:#2A2A28"></span><div><div style="font-weight:600;font-size:14px">Politik</div><div style="font-size:12px;color:var(--muted);margin-top:2px">12 judul</div></div></a>
        <a href="<?= base_url('katalog') ?>"><span class="sp" style="background:#3a7d4a"></span><div><div style="font-weight:600;font-size:14px">Ilmu Informasi &amp; Perpustakaan</div><div style="font-size:12px;color:var(--muted);margin-top:2px">4 judul</div></div></a>
    </div>
</div>
<?= $this->endSection() ?>
