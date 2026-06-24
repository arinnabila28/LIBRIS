<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6"><h1>Pengaturan Sirkulasi</h1></div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card card-primary" style="max-width:560px">
    <div class="card-header"><h3 class="card-title">Kebijakan Peminjaman</h3></div>

    <form action="<?= base_url('kelola/pengaturan') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <p class="text-muted" style="font-size:13px">
                Nilai ini dipakai di seluruh aplikasi: pembuatan jatuh tempo, perhitungan denda,
                dan tampilan "Pinjaman Saya".
            </p>

            <div class="form-group">
                <label>Lama pinjam (hari)</label>
                <input type="number" name="lama_pinjam" class="form-control" min="1" required
                       value="<?= esc(old('lama_pinjam', $pengaturan['lama_pinjam'])) ?>">
                <small class="text-muted">Jatuh tempo = tanggal disetujui + lama pinjam.</small>
            </div>

            <div class="form-group">
                <label>Denda per hari telat (Rp)</label>
                <input type="number" name="denda_per_hari" class="form-control" min="0" required
                       value="<?= esc(old('denda_per_hari', $pengaturan['denda_per_hari'])) ?>">
                <small class="text-muted">Denda = jumlah hari telat × tarif ini.</small>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
