<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2 align-items-center">
    <div class="col-sm-6"><h1>Kelola Jurnal</h1></div>
    <div class="col-sm-6 text-right">
        <a href="<?= base_url('kelola/jurnal/baru') ?>" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Jurnal</a>
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
                    <th>Nama Jurnal</th>
                    <th style="width:80px">Tahun</th>
                    <th style="width:80px">PDF</th>
                    <th style="width:150px">Aksi</th>
                    <th style="width:80px">Cover</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($list)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada jurnal.</td></tr>
                <?php else: $i = 1; foreach ($list as $j): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($j['judul']) ?></td>
                        <td><?= esc($j['nama_jurnal'] ?: '—') ?></td>
                        <td><?= esc($j['tahun'] ?: '—') ?></td>
                        <td><?= ! empty($j['file_pdf']) ? '<i class="ti ti-check text-success"></i>' : '<span class="text-muted">—</span>' ?></td>
                        <td>
                            <a href="<?= base_url('jurnal/' . $j['slug']) ?>" target="_blank" class="btn btn-sm btn-default" title="Lihat"><i class="ti ti-eye"></i></a>
                            <a href="<?= base_url('kelola/jurnal/edit/' . $j['id_jurnal']) ?>" class="btn btn-sm btn-default" title="Edit"><i class="ti ti-pencil"></i></a>
                            <a href="<?= base_url('kelola/jurnal/hapus/' . $j['id_jurnal']) ?>" class="btn btn-sm btn-default text-danger" title="Hapus"
                               onclick="return confirm('Hapus jurnal ini?')"><i class="ti ti-trash"></i></a>
                        </td>
                        <td>
                            <?php if (!empty($j['cover'])): ?>
                                <img src="<?= base_url('uploads/covers/' . esc($j['cover'])) ?>" style="width:50px; height:auto; border-radius:4px;">
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
