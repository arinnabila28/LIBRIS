<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .lsec{margin-bottom:30px;}
  .lsec-h{display:flex;align-items:center;gap:9px;margin-bottom:12px;}
  .lsec-h h3{font-size:15px;font-weight:600;letter-spacing:-.01em;}
  .lsec-h .n{font-family:var(--mono);font-size:11px;color:var(--muted);background:var(--paper);border:1px solid var(--border);border-radius:999px;padding:1px 8px;}
  .lrow{display:flex;align-items:center;gap:14px;background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-md);padding:14px 16px;margin-bottom:10px;box-shadow:var(--sh-sm);transition:transform .14s,box-shadow .14s;}
  .lrow:hover{transform:translateY(-1px);box-shadow:var(--sh-md);}
  .lic{width:38px;height:38px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:18px;}
  .lic.a{background:var(--tint);color:var(--forest);} .lic.b{background:#F1EFE9;color:var(--muted);}
  .lic.c{background:var(--amber-bg);color:var(--amber);}
  .lrow .m{flex:1;min-width:0;}
  .lrow .bt{font-size:14px;font-weight:600;}
  .lrow .mt{font-family:var(--mono);font-size:11px;color:var(--muted);margin-top:2px;}
  .lrow .denda{font-family:var(--mono);font-size:11px;color:var(--amber);margin-top:2px;}
  .lbadge{font-family:var(--mono);font-size:10.5px;font-weight:500;letter-spacing:.02em;padding:4px 10px;border-radius:999px;white-space:nowrap;}
  .b-ok{background:var(--tint);color:var(--forest);} .b-wait{background:var(--paper);border:1px solid var(--border);color:var(--muted);}
  .b-late{background:var(--amber-bg);color:var(--amber);} .b-done{background:transparent;border:1px solid var(--border);color:var(--muted);}
  .lempty{font-size:13px;color:var(--faint);font-style:italic;padding:14px 16px;background:var(--surface);border:1px dashed var(--border-2);border-radius:var(--r-md);}
  .lempty a{color:var(--forest);font-weight:500;}
  .lret{margin:0;}
  .lret button{display:inline-flex;align-items:center;gap:6px;font-family:inherit;font-size:12.5px;font-weight:500;
    color:var(--forest);background:var(--tint);border:1px solid transparent;border-radius:var(--r-sm);
    padding:8px 13px;cursor:pointer;white-space:nowrap;transition:background .15s,transform .15s;}
  .lret button:hover{background:#dceadd;transform:translateY(-1px);}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
  function fmt_tgl($d){ return $d ? date('d M Y', strtotime($d)) : '-'; }
  $today = strtotime(date('Y-m-d'));
  $DENDA = lib_denda_per_hari();
?>

<div class="phead"><div class="ph-k">Akun</div><h1>Perpustakaan Saya</h1></div>
<div class="mylib-tabs">
    <a href="<?= base_url('wishlist') ?>">Wishlist</a>
    <a href="<?= base_url('pinjaman-saya') ?>" class="on">Pinjaman</a>
    <a href="<?= base_url('profil') ?>">Profil</a>
</div>

<!-- SEDANG DIPINJAM -->
<div class="lsec">
    <div class="lsec-h"><h3>Sedang dipinjam</h3><span class="n"><?= count($aktif) ?></span></div>
    <?php if (empty($aktif)): ?>
        <div class="lempty">Belum ada buku yang sedang kamu pinjam. <a href="<?= base_url('katalog') ?>">Jelajahi katalog →</a></div>
    <?php else: foreach ($aktif as $a):
        $deadline = strtotime($a['tanggal_kembali']); $telat = $today > $deadline;
        $hariTelat = $telat ? (int) floor(($today - $deadline)/86400) : 0; $denda = $hariTelat * $DENDA;
        $sisa = (int) floor(($deadline - $today)/86400);
    ?>
        <div class="lrow">
            <div class="lic a"><i class="ti ti-book-2"></i></div>
            <div class="m">
                <div class="bt"><?= esc($a['title_book'] ?: 'Buku') ?></div>
                <div class="mt">Dipinjam <?= fmt_tgl($a['tanggal_peminjaman']) ?> · jatuh tempo <?= fmt_tgl($a['tanggal_kembali']) ?></div>
                <?php if ($telat): ?><div class="denda">Telat <?= $hariTelat ?> hari · denda Rp <?= number_format($denda,0,',','.') ?></div><?php endif; ?>
            </div>
            <?php if ($telat): ?><span class="lbadge b-late">Telat <?= $hariTelat ?>h</span>
            <?php elseif ($sisa <= 1): ?><span class="lbadge b-wait"><?= $sisa <= 0 ? 'Hari ini' : 'Besok' ?></span>
            <?php else: ?><span class="lbadge b-ok"><?= $sisa ?> hari lagi</span><?php endif; ?>
            <form action="<?= base_url('pinjam/kembalikan') ?>" method="post" class="lret"
                  onsubmit="return confirm('<?= $telat ? 'Buku ini telat ' . $hariTelat . ' hari. Denda Rp ' . number_format($denda,0,',','.') . ' dibayar di meja perpustakaan. Kembalikan sekarang?' : 'Kembalikan buku ini sekarang?' ?>')">
                <?= csrf_field() ?>
                <input type="hidden" name="id_peminjaman" value="<?= $a['id_peminjaman'] ?>">
                <button type="submit"><i class="ti ti-corner-down-left" style="font-size:14px"></i> Kembalikan</button>
            </form>
        </div>
    <?php endforeach; endif; ?>
</div>

<!-- PENGAJUAN -->
<div class="lsec">
    <div class="lsec-h"><h3>Pengajuan</h3><span class="n"><?= count($pengajuan) ?></span></div>
    <?php if (empty($pengajuan)): ?>
        <div class="lempty">Tidak ada pengajuan aktif.</div>
    <?php else: foreach ($pengajuan as $p): ?>
        <div class="lrow">
            <div class="lic b"><i class="ti ti-clock"></i></div>
            <div class="m"><div class="bt"><?= esc($p['title_book'] ?: 'Buku') ?></div><div class="mt">Diajukan <?= fmt_tgl($p['tanggal_pengajuan']) ?></div></div>
            <?php if ($p['status'] === 'menunggu'): ?><span class="lbadge b-wait">Menunggu</span>
            <?php else: ?><span class="lbadge b-late">Ditolak</span><?php endif; ?>
        </div>
    <?php endforeach; endif; ?>
</div>

<!-- RIWAYAT -->
<div class="lsec">
    <div class="lsec-h"><h3>Riwayat pengembalian</h3><span class="n"><?= count($riwayat) ?></span></div>
    <?php if (empty($riwayat)): ?>
        <div class="lempty">Belum ada riwayat pengembalian.</div>
    <?php else: foreach ($riwayat as $r): ?>
        <div class="lrow">
            <div class="lic <?= (int)$r['total_denda'] > 0 ? 'c' : 'b' ?>"><i class="ti ti-circle-check"></i></div>
            <div class="m">
                <div class="bt"><?= esc($r['title_book'] ?: 'Buku') ?></div>
                <div class="mt">Dikembalikan <?= fmt_tgl($r['tanggal_kembali_aktual']) ?> · jatuh tempo <?= fmt_tgl($r['tanggal_kembali']) ?></div>
                <?php if ((int)$r['total_denda'] > 0): ?>
                    <?php $lunas = ($r['status_bayar'] ?? 'belum') === 'lunas'; ?>
                    <div class="denda">Denda Rp <?= number_format($r['total_denda'],0,',','.') ?> · <?= $lunas ? 'lunas' : 'belum dibayar' ?></div>
                <?php endif; ?>
            </div>
            <?php if ((int)$r['total_denda'] > 0): ?>
                <?php if (($r['status_bayar'] ?? 'belum') === 'lunas'): ?><span class="lbadge b-ok">Denda lunas</span>
                <?php else: ?><span class="lbadge b-late">Belum dibayar</span><?php endif; ?>
            <?php else: ?><span class="lbadge b-done">Tepat waktu</span><?php endif; ?>
        </div>
    <?php endforeach; endif; ?>
</div>
<?= $this->endSection() ?>
