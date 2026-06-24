<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2 align-items-center">
    <div class="col-sm-6"><h1>Kelola Berita</h1></div>
    <div class="col-sm-6 text-right">
        <a href="<?= base_url('kelola/berita/baru') ?>" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Berita
        </a>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width:60px">#</th>
                    <th>Judul</th>
                    <th style="width:120px">Kategori</th>
                    <th style="width:130px">Tanggal</th>
                    <th style="width:90px">PDF</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($list)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada berita.</td></tr>
                <?php else: $i = 1; foreach ($list as $b): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($b['judul']) ?></td>
                        <td>
                            <span class="badge <?= $b['kategori'] === 'dokumen' ? 'badge-secondary' : 'badge-success' ?>">
                                <?= ucfirst($b['kategori']) ?>
                            </span>
                        </td>
                        <td><?= $b['tanggal'] ? date('d M Y', strtotime($b['tanggal'])) : '-' ?></td>
                        <td><?= ! empty($b['file_dokumen']) ? '<i class="ti ti-check text-success"></i>' : '<span class="text-muted">—</span>' ?></td>
                        <td>
                            <a href="<?= base_url('berita/' . $b['slug']) ?>" target="_blank" class="btn btn-sm btn-default" title="Lihat"><i class="ti ti-eye"></i></a>
                            <a href="<?= base_url('kelola/berita/edit/' . $b['id_berita']) ?>" class="btn btn-sm btn-default" title="Edit"><i class="ti ti-pencil"></i></a>
                            <a href="<?= base_url('kelola/berita/hapus/' . $b['id_berita']) ?>" class="btn btn-sm btn-default text-danger" title="Hapus"
                               onclick="return confirm('Hapus berita ini?')"><i class="ti ti-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
