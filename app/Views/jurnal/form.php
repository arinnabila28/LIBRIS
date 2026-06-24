<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2"><div class="col-sm-6"><h1><?= esc($title) ?></h1></div></div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $isEdit = ! empty($jurnal); $v = fn($k) => esc(old($k, $isEdit ? $jurnal[$k] : '')); ?>

<?php if (session('errors')): ?>
    <div class="alert alert-danger"><ul class="mb-0">
        <?php foreach (session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
    </ul></div>
<?php endif; ?>

<div class="card card-primary">
    <div class="card-header"><h3 class="card-title">Form Jurnal</h3></div>

    <form action="<?= $isEdit ? base_url('kelola/jurnal/update/' . $jurnal['id_jurnal']) : base_url('kelola/jurnal/simpan') ?>"
          method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body">

            <div class="form-group">
                <label>Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control" required value="<?= $v('judul') ?>" placeholder="Judul artikel / jurnal">
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="<?= $v('penulis') ?>" placeholder="Nama penulis (pisahkan dengan koma)">
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nama Jurnal</label>
                    <input type="text" name="nama_jurnal" class="form-control" value="<?= $v('nama_jurnal') ?>" placeholder="mis. Jurnal Ilmu Perpustakaan">
                </div>
                <div class="form-group col-md-6">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $v('penerbit') ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="<?= $v('tahun') ?>" placeholder="2026">
                </div>
                <div class="form-group col-md-3">
                    <label>Volume</label>
                    <input type="text" name="volume" class="form-control" value="<?= $v('volume') ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Nomor</label>
                    <input type="text" name="nomor" class="form-control" value="<?= $v('nomor') ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>Halaman</label>
                    <input type="text" name="halaman" class="form-control" value="<?= $v('halaman') ?>" placeholder="12-20">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>DOI</label>
                    <input type="text" name="doi" class="form-control" value="<?= $v('doi') ?>" placeholder="10.xxxx/xxxx">
                </div>
                <div class="form-group col-md-4">
                    <label>ISSN</label>
                    <input type="text" name="issn" class="form-control" value="<?= $v('issn') ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Bidang</label>
                    <?php $curBidang = old('bidang', $isEdit ? ($jurnal['bidang'] ?? '') : ''); ?>
                    <select name="bidang" class="form-control">
                        <option value="">— pilih bidang —</option>
                        <?php foreach (($bidangList ?? []) as $bd): ?>
                            <option value="<?= esc($bd) ?>" <?= $curBidang === $bd ? 'selected' : '' ?>><?= esc($bd) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Tambah bidang baru di menu <a href="<?= base_url('kelola/subjek') ?>" target="_blank">Subjek &amp; Bidang</a>.</small>
                </div>
            </div>

            <div class="form-group">
                <label>Abstrak</label>
                <textarea name="abstrak" class="form-control" rows="5" placeholder="Abstrak jurnal…"><?= $v('abstrak') ?></textarea>
            </div>

            <div class="form-group">
                <label>Berkas PDF</label>
                <input type="file" name="file_pdf" class="form-control-file" accept="application/pdf">
                <?php if ($isEdit && ! empty($jurnal['file_pdf'])): ?>
                    <small class="text-muted d-block mt-1">Saat ini: <?= esc($jurnal['file_pdf']) ?> — unggah baru untuk mengganti.</small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Cover Jurnal</label>
                <input type="file" name="cover_img" class="form-control-file" accept="image/png, image/jpeg, image/webp">
                <?php if ($isEdit && ! empty($jurnal['cover'])): ?>
                    <small class="text-muted d-block mt-1">Saat ini: <?= esc($jurnal['cover']) ?></small>
                <?php endif; ?>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
            <a href="<?= base_url('kelola/jurnal') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
