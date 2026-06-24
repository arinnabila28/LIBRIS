<?= $this->extend('layouts/public_template') ?>

<?= $this->section('head') ?>
<style>
  .pcard{max-width:540px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);
    padding:26px;box-shadow:var(--sh-sm);}
  .phdr{display:flex;align-items:center;gap:14px;padding-bottom:20px;border-bottom:1px solid var(--border);margin-bottom:22px;}
  .pava{width:56px;height:56px;border-radius:999px;background:var(--forest);color:#fff;display:flex;align-items:center;
    justify-content:center;font-size:22px;font-weight:600;flex-shrink:0;}
  .phdr .nm{font-size:18px;font-weight:600;letter-spacing:-.01em;}
  .prole{display:inline-flex;align-items:center;gap:5px;font-family:var(--mono);font-size:10px;letter-spacing:.06em;
    text-transform:uppercase;color:var(--accent);background:var(--tint);padding:3px 9px;border-radius:999px;margin-top:5px;}
  .field{margin-bottom:16px;}
  label{display:block;font-size:12.5px;font-weight:500;color:var(--ink);margin-bottom:7px;}
  input{width:100%;height:44px;padding:0 14px;border:1px solid var(--border-2);border-radius:11px;font-family:inherit;
    font-size:14.5px;color:var(--ink);background:var(--surface);outline:none;transition:border-color .15s,box-shadow .15s;}
  input:focus{border-color:var(--forest);box-shadow:0 0 0 3px var(--tint);}
  .flash-i{display:flex;align-items:center;gap:9px;border:1px solid var(--border);border-left:3px solid var(--forest);color:var(--forest);
    background:var(--surface);border-radius:11px;padding:11px 14px;font-size:13.5px;margin-bottom:18px;}
  .flash-e{border-left-color:#8A5A1A;color:#8A5A1A;}
  .flash-e ul{margin:0;padding-left:18px;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="phead"><div class="ph-k">Akun</div><h1>Perpustakaan Saya</h1></div>
<div class="mylib-tabs">
    <a href="<?= base_url('wishlist') ?>">Wishlist</a>
    <a href="<?= base_url('pinjaman-saya') ?>">Pinjaman</a>
    <a href="<?= base_url('profil') ?>" class="on">Profil</a>
</div>

<div class="pcard">
    <div class="phdr">
        <div class="pava"><?= strtoupper(mb_substr(session('name') ?? 'U',0,1)) ?></div>
        <div>
            <div class="nm"><?= esc(session('name')) ?></div>
            <span class="prole"><i class="ti ti-user" style="font-size:11px"></i> <?= esc(session('role')) ?></span>
        </div>
    </div>

    <?php if (session('success')): ?><div class="flash-i"><i class="ti ti-circle-check" style="font-size:16px"></i> <?= esc(session('success')) ?></div><?php endif; ?>
    <?php if (session('errors')): ?><div class="flash-i flash-e"><ul><?php foreach (session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

    <form action="<?= base_url('profil') ?>" method="post">
        <?= csrf_field() ?>
        <div class="field"><label>Nama lengkap</label><input type="text" name="name" value="<?= esc(old('name', $user['name'] ?? '')) ?>" required></div>
        <div class="field"><label>Email</label><input type="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>" required></div>
        <div class="field"><label>No. kontak</label><input type="text" name="contact" value="<?= esc(old('contact', $member['contact_member'] ?? '')) ?>" placeholder="08xxxxxxxxxx"></div>
        <button type="submit" class="btn btn-primary" style="margin-top:6px"><i class="ti ti-device-floppy" style="font-size:16px"></i> Simpan perubahan</button>
    </form>
</div>
<?= $this->endSection() ?>
