<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Nama Member</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($peminjaman)) : ?>
            <?php $no = 1; foreach ($peminjaman as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="text-left font-weight-bold"><?= esc($row['name_member']) ?></td>
                    <td class="text-left font-italic"><?= esc($row['title_book']) ?></td>
                    <td><?= esc($row['tanggal_peminjaman']) ?></td>
                    <td><?= esc($row['tanggal_kembali']) ?></td>
                    <td>
                        <button class="btn btn-info btn-sm btnEdit" data-id="<?= $row['id_peminjaman'] ?>">Edit</button>
                        <a href="<?= base_url('delete/peminjaman/' . $row['id_peminjaman']) ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Hapus data peminjaman ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center font-italic">Belum ada data peminjaman buku.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>