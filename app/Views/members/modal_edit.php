<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Edit Data Member</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('update/member/' . $member['id_member']) ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <input type="text" name="name_member" class="form-control" value="<?= esc($member['name_member']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email_member" class="form-control" value="<?= esc($member['email_member']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak / No. HP</label>
                        <input type="text" name="contact_member" class="form-control" value="<?= esc($member['contact_member']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status_member" class="form-control" required>
                            <option value="Aktif" <?= $member['status_member'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Nonaktif" <?= $member['status_member'] == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>