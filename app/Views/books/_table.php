<div class="table-responsive">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>ISBN</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Keterangan</th>
            <th>Stok</th>
            <th>Deskripsi Fisik</th>                
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($books)) : ?>
            <?php $no = 1; foreach ($books as $book) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($book['code_book']) ?></td>
                    <td><?= esc($book['isbn_book']) ?></td>
                    <td><?= esc($book['title_book']) ?></td>
                    <td><?= esc($book['author_book']) ?></td>
                    <td><?= esc($book['published_year']) ?></td>
                    <td>
                        <div title="<?= esc($book['description_book']) ?>" style="max-width: 250px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                         <?= esc($book['description_book']) ?>
                        </div>
                    </td>
                    <td><?= isset($book['stock']) ? esc($book['stock']) : '-' ?></td>
                    <td><?= esc($book['deskripsi_fisik']) ?></td>
                    <td>
                        <button class="btn btn-info btn-sm btnEdit" data-id="<?= $book['id_book'] ?>">Edit</button>
    
                        <a href="<?= base_url('delete/book/' . $book['id_book']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="9" class="text-center">Belum ada buku.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>