<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="d-flex align-items-end justify-content-between" style="flex-wrap:wrap;gap:10px">
    <div>
        <div class="mono" style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:#2F6B3C"><?= date('l, d F Y') ?></div>
        <h1 class="page-title mb-0" style="margin-top:3px">Selamat datang, <?= esc(session('name') ?? 'Admin') ?></h1>
    </div>
    <a href="<?= base_url('list/books') ?>" class="btn btn-primary"><i class="ti ti-plus" style="font-size:14px;vertical-align:-2px"></i> Kelola buku</a>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
  .kpi-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:14px;}
  .kpi{background:#fff;border:1px solid var(--border);border-radius:16px;padding:16px 18px;box-shadow:var(--sh-sm);}
  .kpi .l{font-size:13px;color:var(--muted);}
  .kpi .v{font-family:var(--mono);font-size:25px;font-weight:500;margin-top:6px;letter-spacing:-.01em;color:var(--ink);}
  .kpi .d{font-size:11.5px;margin-top:2px;}
  .dash-2{display:grid;grid-template-columns:1.5fr 1fr;gap:14px;}
  .dcard{background:#fff;border:1px solid var(--border);border-radius:16px;padding:16px 18px;box-shadow:var(--sh-sm);}
  .dcard .h{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;}
  .dcard .h .t{font-size:14px;font-weight:600;}
  .dcard .h .x{font-family:var(--mono);font-size:10px;color:var(--faint);letter-spacing:.06em;}
  .jt{display:flex;align-items:center;gap:11px;padding:9px 0;border-top:1px solid var(--border);}
  .jt:first-of-type{border-top:0;}
  .jt .av{width:30px;height:30px;border-radius:999px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;background:var(--tint);color:var(--forest);}
  .jt .m{flex:1;min-width:0;}
  .jt .m .a{font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .jt .m .b{font-size:11.5px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .jt .pill{font-family:var(--mono);font-size:10px;padding:2px 8px;border-radius:999px;white-space:nowrap;}
  .act{display:flex;gap:11px;padding:10px 0;border-top:1px solid var(--border);}
  .act:first-of-type{border-top:0;}
  .act .ic{width:30px;height:30px;border-radius:9px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:15px;}
  .act .ic.p{background:var(--tint);color:var(--forest);} .act .ic.k{background:var(--paper);color:var(--muted);}
  .empty-sm{font-size:13px;color:var(--faint);font-style:italic;padding:14px 0;}
  @media(max-width:900px){.kpi-row{grid-template-columns:repeat(2,1fr);}.dash-2{grid-template-columns:1fr;}}
</style>

<!-- KPI -->
<div class="kpi-row">
    <div class="kpi"><div class="l">Total buku</div><div class="v"><?= number_format($totalBuku) ?></div><div class="d" style="color:var(--accent)"><?= $bukuBaru > 0 ? '↑ '.$bukuBaru.' bulan ini' : '—' ?></div></div>
    <div class="kpi"><div class="l">Anggota</div><div class="v"><?= number_format($totalMember) ?></div><div class="d" style="color:var(--accent)"><?= $memberBaru > 0 ? '↑ '.$memberBaru.' baru' : '—' ?></div></div>
    <div class="kpi"><div class="l">Dipinjam aktif</div><div class="v"><?= number_format($dipinjamAktif) ?></div><div class="d" style="color:var(--muted)">sedang berjalan</div></div>
    <div class="kpi"><div class="l">Denda aktif</div><div class="v">Rp <?= number_format($denda, 0, ',', '.') ?></div><div class="d" style="color:var(--muted)">belum tertagih</div></div>
</div>

<div class="dash-2">
    <!-- Grafik -->
    <div class="dcard">
        <div class="h"><span class="t">Peminjaman</span><span class="x">7 HARI TERAKHIR</span></div>
        <div style="position:relative;height:210px;margin-top:6px"><canvas id="loanChart"></canvas></div>
    </div>
    <!-- Jatuh tempo -->
    <div class="dcard">
        <div class="h"><span class="t">Jatuh tempo</span><span class="x"><i class="ti ti-clock-exclamation" style="font-size:13px;vertical-align:-2px"></i></span></div>
        <?php if (empty($jatuhTempo)): ?>
            <div class="empty-sm">Tidak ada peminjaman mendekati jatuh tempo.</div>
        <?php else: foreach ($jatuhTempo as $item):
            $sisa = (int) $item['sisa_hari'];
            if ($sisa < 0)      { $cls='warn'; $lbl=abs($sisa).'h telat'; }
            elseif ($sisa===0)  { $cls='ok';   $lbl='Hari ini'; }
            elseif ($sisa===1)  { $cls='ok';   $lbl='Besok'; }
            else                { $cls='mut';  $lbl=$sisa.' hari'; }
            $ini = mb_strtoupper(mb_substr($item['name_member'], 0, 2));
        ?>
            <div class="jt">
                <div class="av"><?= esc($ini) ?></div>
                <div class="m"><div class="a"><?= esc($item['name_member']) ?></div><div class="b"><?= esc($item['title_book']) ?></div></div>
                <span class="pill" style="<?= $cls==='warn'?'background:var(--amber-bg);color:var(--amber)':($cls==='ok'?'background:var(--tint);color:var(--forest)':'background:var(--paper);color:var(--muted);border:1px solid var(--border)') ?>"><?= $lbl ?></span>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<!-- Aktivitas -->
<div class="dcard" style="margin-top:14px">
    <div class="h"><span class="t">Aktivitas terbaru</span></div>
    <?php if (empty($aktivitas)): ?>
        <div class="empty-sm">Belum ada aktivitas tercatat.</div>
    <?php else: foreach ($aktivitas as $act):
        $isPinjam = $act['tipe'] === 'pinjam';
        $waktu = isset($act['waktu']) ? time_ago($act['waktu']) : '-';
    ?>
        <div class="act">
            <div class="ic <?= $isPinjam ? 'p' : 'k' ?>"><i class="ti ti-<?= $isPinjam ? 'arrow-up-right' : 'arrow-down-left' ?>"></i></div>
            <div style="flex:1;min-width:0">
                <div style="font-size:13.5px"><b style="font-weight:600"><?= esc($act['name_member']) ?></b> <?= $isPinjam ? 'meminjam' : 'mengembalikan' ?> <span style="color:var(--forest)"><?= esc($act['title_book']) ?></span></div>
                <div class="mono" style="font-size:10.5px;color:var(--faint);margin-top:2px"><?= $waktu ?></div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
(function(){
    var cv = document.getElementById('loanChart'); if(!cv) return;
    var ctx = cv.getContext('2d');
    var grad = ctx.createLinearGradient(0,0,0,210);
    grad.addColorStop(0,'rgba(34,75,41,.16)'); grad.addColorStop(1,'rgba(34,75,41,0)');
    new Chart(cv,{
        type:'line',
        data:{ labels:<?= $grafikLabels ?>, datasets:[{ label:'Peminjaman', data:<?= $grafikData ?>,
            borderColor:'#224B29', backgroundColor:grad, fill:true, tension:.4, borderWidth:2.5,
            pointBackgroundColor:'#224B29', pointBorderColor:'#fff', pointBorderWidth:2, pointRadius:3, pointHoverRadius:5 }] },
        options:{ responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{display:false}, tooltip:{ backgroundColor:'#18241B', cornerRadius:8, padding:10,
                titleFont:{family:'Geist',weight:'600'}, bodyFont:{family:'Geist Mono'}, displayColors:false,
                callbacks:{ label:function(c){ return '  '+c.parsed.y+' buku'; } } } },
            scales:{ x:{ grid:{display:false}, border:{display:false}, ticks:{ color:'#9AA29B', font:{family:'Geist Mono',size:11} } },
                y:{ beginAtZero:true, grid:{color:'#F1EFE9'}, border:{display:false}, ticks:{ color:'#9AA29B', font:{family:'Geist Mono',size:11}, stepSize:1, precision:0 } } }
        }
    });
})();
</script>
<?= $this->endSection() ?>
