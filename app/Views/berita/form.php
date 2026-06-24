<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6"><h1><?= esc($title) ?></h1></div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $isEdit = ! empty($berita); ?>

<?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card card-primary">
    <div class="card-header"><h3 class="card-title">Form Berita</h3></div>

    <form action="<?= $isEdit ? base_url('kelola/berita/update/' . $berita['id_berita']) : base_url('kelola/berita/simpan') ?>"
          method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-body">

            <div class="form-group">
                <label>Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control" required
                       value="<?= esc(old('judul', $isEdit ? $berita['judul'] : '')) ?>" placeholder="Judul berita / dokumen">
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Kategori <span class="text-danger">*</span></label>
                    <?php $kat = old('kategori', $isEdit ? $berita['kategori'] : 'berita'); ?>
                    <select name="kategori" class="form-control">
                        <option value="berita"  <?= $kat === 'berita'  ? 'selected' : '' ?>>Berita / Pengumuman</option>
                        <option value="dokumen" <?= $kat === 'dokumen' ? 'selected' : '' ?>>Dokumen (Berita Acara)</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="<?= esc(old('tanggal', $isEdit ? $berita['tanggal'] : date('Y-m-d'))) ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Ringkasan</label>
                <input type="text" name="ringkasan" class="form-control" maxlength="300"
                       value="<?= esc(old('ringkasan', $isEdit ? $berita['ringkasan'] : '')) ?>"
                       placeholder="Ringkasan singkat (opsional)">
            </div>

            <div class="form-group">
                <label>Isi</label>
                <textarea name="isi" class="form-control" rows="7"
                          placeholder="Tulis isi berita di sini…"><?= esc(old('isi', $isEdit ? $berita['isi'] : '')) ?></textarea>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Gambar Cover (untuk berita)</label>
                    <input type="file" name="gambar" class="form-control-file" accept="image/*">
                    <?php if ($isEdit && ! empty($berita['gambar'])): ?>
                        <small class="text-muted d-block mt-1">Saat ini: <?= esc($berita['gambar']) ?> — unggah baru untuk mengganti.</small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label>Dokumen PDF (untuk berita acara)</label>
                    <input type="file" name="file_dokumen" class="form-control-file" accept="application/pdf">
                    <?php if ($isEdit && ! empty($berita['file_dokumen'])): ?>
                        <small class="text-muted d-block mt-1">Saat ini: <?= esc($berita['file_dokumen']) ?> — unggah baru untuk mengganti.</small>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
            <a href="<?= base_url('kelola/berita') ?>" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
