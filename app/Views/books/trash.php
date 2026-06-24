<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tong Sampah Buku</h3>
        <div class="card-tools">
            <a href="<?= base_url('list/books') ?>" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)) : ?>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td><?= esc($book['title_book']) ?></td>
                            <td><?= esc($book['author_book']) ?></td>
                            <td>
                                <a href="<?= base_url('restore/book/' . $book['id_book']) ?>" class="btn btn-success btn-sm">Restore</a>
                                <a href="<?= base_url('purge/book/' . $book['id_book']) ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus permanen?')">Hapus Selamanya</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="3" class="text-center">Tong sampah kosong.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endsection() ?>