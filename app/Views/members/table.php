<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Nama Member</th>
            <th>Email</th>
            <th>Kontak (No. HP)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($members) && is_array($members)) : ?>
            <?php $no = 1; foreach ($members as $member) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="text-left"><?= esc($member['name_member']) ?></td>
                    <td class="text-left"><?= esc($member['email_member']) ?></td>
                    <td><?= esc($member['contact_member']) ?></td>
                    <td>
                        <?php if($member['status_member'] == 'Aktif'): ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm btnEdit" data-id="<?= $member['id_member'] ?>">Edit</button>
                        
                        <a href="<?= base_url('delete/member/' . $member['id_member']) ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Hapus data ini ke tong sampah?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center font-italic">Belum ada data member.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>