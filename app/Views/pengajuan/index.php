<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-12">
        <h1>Pengajuan Peminjaman</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengajuan dari Member</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Member</th>
                    <th>Buku</th>
                    <th>Tgl Pengajuan</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($pengajuan)): ?>
                    <?php $no = 1; foreach ($pengajuan as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($p['name_member'] ?: '-') ?></td>
                            <td><?= esc($p['title_book'] ?: '-') ?></td>
                            <td><?= $p['tanggal_pengajuan'] ? date('d M Y', strtotime($p['tanggal_pengajuan'])) : '-' ?></td>
                            <td><?= (int) ($p['stock'] ?? 0) ?></td>
                            <td>
                                <?php if ($p['status'] === 'menunggu'): ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                <?php elseif ($p['status'] === 'disetujui'): ?>
                                    <span class="badge badge-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p['status'] === 'menunggu'): ?>
                                    <a href="<?= base_url('pengajuan/setujui/' . $p['id_pengajuan']) ?>" class="btn btn-success btn-sm"
                                       onclick="return confirm('Setujui pengajuan ini? Stok akan berkurang.')">
                                        <i class="fas fa-check"></i> Setujui
                                    </a>
                                    <a href="<?= base_url('pengajuan/tolak/' . $p['id_pengajuan']) ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Tolak pengajuan ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">Belum ada pengajuan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
