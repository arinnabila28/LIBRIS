<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($book['title_book']) ?> — LIBRIS</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/libris-favicon.png') ?>">
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/tabler/tabler-icons.min.css') ?>">
<style>
  :root{--forest:#224B29;--accent:#2F6B3C;--tint:#EAF1E9;--paper:#FAFAF8;--surface:#FFF;--ink:#18241B;--muted:#6B7280;--faint:#9AA29B;--border:#ECECEC;--border-2:#E2E2DE;--mono:'Geist Mono',monospace;}
  *{margin:0;padding:0;box-sizing:border-box;}
  body{font-family:'Geist',system-ui,sans-serif;height:100vh;display:flex;flex-direction:column;background:#F1EFEA;color:var(--ink);}
  a{color:inherit;text-decoration:none;}
  .bar{display:flex;align-items:center;gap:14px;padding:11px 18px;background:rgba(250,250,248,.9);backdrop-filter:blur(10px);
    border-bottom:1px solid var(--border);}
  .bk{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:var(--muted);border:1px solid var(--border-2);
    border-radius:9px;padding:7px 12px;transition:background .15s,color .15s;}
  .bk:hover{background:var(--surface);color:var(--ink);}
  .ttl{font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .tag{font-family:var(--mono);font-size:10px;letter-spacing:.06em;color:var(--accent);background:var(--tint);padding:3px 9px;border-radius:6px;}
  .open{margin-left:auto;display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:#fff;background:var(--forest);
    border-radius:9px;padding:8px 14px;box-shadow:0 4px 12px rgba(34,75,41,.18);transition:transform .15s;}
  .open:hover{transform:translateY(-1px);}
  .stage{flex:1;min-height:0;}
  .stage iframe{width:100%;height:100%;border:0;display:block;background:#F1EFEA;}
  .noload{flex:1;display:flex;align-items:center;justify-content:center;padding:30px;}
  .noload .box{background:var(--surface);border:1px solid var(--border);border-radius:18px;box-shadow:0 12px 32px rgba(24,36,27,.08);
    padding:44px 38px;text-align:center;max-width:440px;}
  .noload .em{width:60px;height:60px;border-radius:999px;background:var(--tint);color:var(--forest);display:inline-flex;align-items:center;justify-content:center;font-size:28px;margin-bottom:16px;}
  .noload h2{font-size:19px;font-weight:600;letter-spacing:-.01em;margin-bottom:8px;}
  .noload p{color:var(--muted);font-size:14px;line-height:1.6;}
</style>
</head>
<body>
  <div class="bar">
    <a href="<?= base_url('katalog/' . $book['id_book']) ?>" class="bk"><i class="ti ti-arrow-left" style="font-size:15px"></i> Kembali</a>
    <span class="ttl"><?= esc($book['title_book']) ?></span>
    <span class="tag">DIGITAL</span>
    <?php if ($hasFile): ?>
        <a href="<?= base_url('baca/file/' . $book['id_book']) ?>" target="_blank" class="open"><i class="ti ti-external-link" style="font-size:15px"></i> Tab baru</a>
    <?php endif; ?>
  </div>

  <?php if ($hasFile): ?>
    <div class="stage"><iframe src="<?= base_url('baca/file/' . $book['id_book']) ?>" title="<?= esc($book['title_book']) ?>"></iframe></div>
  <?php else: ?>
    <div class="noload">
        <div class="box">
            <div class="em"><i class="ti ti-file-text"></i></div>
            <h2>Konten digital belum tersedia</h2>
            <p>File untuk buku ini belum diunggah. Pustakawan dapat menambahkan PDF-nya melalui panel kelola buku.</p>
        </div>
    </div>
  <?php endif; ?>
</body>
</html>
