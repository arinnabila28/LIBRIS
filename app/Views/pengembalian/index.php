<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="m-0 text-dark">Data Pengembalian Buku</h1>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mt-1 font-weight-bold">Riwayat Pengembalian</h5>
            
            <div class="card-tools">
                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalKembali">
                    <i class="fas fa-plus"></i> Pengajuan Pengembalian
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th width="50">No.</th>
                        <th>Nama Member</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Harus Kembali</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat)) : ?>
                        <?php $no = 1; foreach ($riwayat as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td class="text-left"><?= esc($row['name_member'] ?? 'Data terhapus') ?></td>
                                <td class="text-left font-italic"><?= esc($row['title_book'] ?? 'Data terhapus') ?></td>
                                <td><?= esc($row['tanggal_kembali'] ?? '-') ?></td>
                                
                                <td><?= esc($row['tanggal_kembali_aktual']) ?></td>
                                <td>
                                    <?php if ($row['total_denda'] > 0) : ?>
                                        <?php $lunas = ($row['status_bayar'] ?? 'belum') === 'lunas'; ?>
                                        <span class="badge badge-danger">Rp <?= number_format($row['total_denda'], 0, ',', '.') ?></span>
                                        <br>
                                        <span class="badge <?= $lunas ? 'badge-success' : 'badge-warning' ?> mt-1">
                                            <?= $lunas ? 'Lunas' : 'Belum dibayar' ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Tidak ada denda</span>
                                    <?php endif; ?>
                                </td>

                                 <td>
                                    <?php if ($row['total_denda'] > 0 && ($row['status_bayar'] ?? 'belum') !== 'lunas') : ?>
                                        <a href="<?= base_url('pengembalian/lunas/' . $row['id_pengembalian']) ?>"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Tandai denda ini sudah dibayar (lunas)?')">
                                             <i class="fas fa-check"></i> Tandai Lunas
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('pengembalian/hapus/' . $row['id_pengembalian']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus riwayat ini? Data yang dihapus tidak bisa dikembalikan.')">
                                         <i class="fas fa-trash"></i> Hapus
                                    </a>
                                 </td>
                             </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center font-italic">Belum ada riwayat pengembalian buku.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalKembali" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('create/pengembalian') ?>" method="post" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Proses Pengembalian Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Transaksi Peminjaman (Yang Sedang Aktif)</label>
                    <select name="id_peminjaman" class="form-control" required>
                        <option value="">-- Pilih Buku yang Ingin Dikembalikan --</option>
                        <?php if (!empty($peminjaman_aktif)) : ?>
                            <?php foreach ($peminjaman_aktif as $p) : ?>
                                <option value="<?= $p['id_peminjaman'] ?>">
                                    <?= esc($p['name_member']) ?> meminjam "<?= esc($p['title_book']) ?>" 
                                    (Deadline: <?= esc($p['tanggal_kembali']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>-- Tidak ada buku yang sedang dipinjam --</option>
                        <?php endif; ?>
                    </select>
                    <small class="text-muted mt-2 d-block">
                        *Sistem akan otomatis menghitung denda keterlambatan (Rp <?= number_format(lib_denda_per_hari(), 0, ',', '.') ?>/hari) saat Anda menyimpan data ini.
                    </small>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Proses Pengembalian</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>