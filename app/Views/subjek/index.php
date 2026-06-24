<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2"><div class="col-sm-6"><h1>Kelola Subjek &amp; Bidang</h1></div></div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session('error')): ?><div class="alert alert-danger"><?= esc(session('error')) ?></div><?php endif; ?>

<?php
    // Komponen tabel ringkas, dipakai ulang untuk buku & jurnal
    $renderTabel = function (array $rows, string $satuan): string {
        ob_start(); ?>
        <table class="table table-hover">
            <thead><tr><th style="width:55px">#</th><th>Nama</th><th style="width:110px">Dipakai</th><th style="width:80px">Aksi</th></tr></thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada.</td></tr>
                <?php else: $i = 1; foreach ($rows as $s): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($s['nama']) ?></td>
                        <td><span class="badge badge-secondary"><?= $s['jml'] ?> <?= $satuan ?></span></td>
                        <td>
                            <a href="<?= base_url('kelola/subjek/hapus/' . $s['id_subjek']) ?>"
                               class="btn btn-sm btn-default text-danger"
                               onclick="return confirm('Hapus &quot;<?= esc($s['nama']) ?>&quot;? Data buku/jurnal yang sudah memakainya tidak berubah, hanya pilihan & filter yang hilang.')">
                                <i class="ti ti-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
        <?php return ob_get_clean();
    };
?>

<!-- Form tambah (pilih untuk Buku atau Jurnal) -->
<div class="card card-primary mb-3">
    <div class="card-header"><h3 class="card-title">Tambah Subjek / Bidang</h3></div>
    <form action="<?= base_url('kelola/subjek/simpan') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Untuk</label>
                    <select name="tipe" class="form-control">
                        <option value="buku">Subjek Buku</option>
                        <option value="jurnal">Bidang Jurnal</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="mis. Romansa / Pendidikan" required>
                </div>
                <div class="form-group col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block"><i class="ti ti-plus"></i> Tambah</button>
                </div>
            </div>
            <small class="text-muted">Subjek buku dipakai sebagai genre &amp; filter di katalog. Bidang jurnal dipakai di form &amp; filter halaman jurnal.</small>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="ti ti-book-2 mr-1"></i> Subjek Buku (<?= count($buku) ?>)</h3></div>
            <div class="card-body table-responsive p-0"><?= $renderTabel($buku, 'buku') ?></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="ti ti-file-text mr-1"></i> Bidang Jurnal (<?= count($jurnal) ?>)</h3></div>
            <div class="card-body table-responsive p-0"><?= $renderTabel($jurnal, 'jurnal') ?></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
