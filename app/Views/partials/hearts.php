<?php
/**
 * Rating bintang: 5 bintang. Terisi = hijau (#224B29) bila ada ulasan,
 * sisanya kosong (cream + outline ink). Param: $avg (float), $count (int), $size (px, opsional).
 * Perpustakaan umum → pakai bintang, bukan hati.
 */
$score = (($count ?? 0) > 0) ? (int) round($avg ?? 0) : 0;
$size  = $size ?? 28;
$star  = 'M12 1.6l3.3 6.7 7.4 1.07-5.35 5.22 1.26 7.36L12 18.48l-6.61 3.47 1.26-7.36L1.3 9.37l7.4-1.07z';
?>
<span class="hrate" style="display:inline-flex;gap:4px;align-items:center;line-height:0">
<?php for ($i = 1; $i <= 5; $i++): $on = $i <= $score; ?>
    <svg viewBox="0 0 24 24" style="height:<?= $size ?>px;width:auto" xmlns="http://www.w3.org/2000/svg">
        <path d="<?= $star ?>" fill="<?= $on ? '#224B29' : '#fffaf1' ?>" stroke="#1d2c1e" stroke-width="1" stroke-linejoin="round"/>
    </svg>
<?php endfor; ?>
</span>
