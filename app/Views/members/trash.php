<?= $this->extend('layouts/template'); // Ganti dengan nama file template AdminLTE kalian jika berbeda ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tong Sampah (Member Terhapus)</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('list/members') ?>" class="btn btn-secondary">
                &larr; Kembali ke Daftar Member
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dihapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($members)) : ?>
                        <?php $no = 1; foreach ($members as $member) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($member['name_member']) ?></td>
                                <td><?= esc($member['email_member']) ?></td>
                                <td><?= esc($member['deleted_at']) ?></td>
                                <td>
                                    <a href="<?= base_url('restore/member/' . $member['id_member']) ?>" 
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Kembalikan member ini ke daftar utama?')">
                                        Restore (Kembalikan)
                                    </a>
                                    <a href="<?= base_url('delete-permanent/member/' . $member['id_member']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini secara PERMANEN? Data tidak bisa dikembalikan!')">
                                         Hapus Permanen
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Tong sampah kosong.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>