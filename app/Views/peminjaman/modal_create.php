<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Catat Peminjaman Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            
            <form action="<?= base_url('create/peminjaman') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Nama Member</label>
                        <select name="id_member" class="form-control" required>
                            <option value="">-- Pilih Member --</option>
                            <?php foreach ($members as $m) : ?>
                                <option value="<?= $m['id_member'] ?>"><?= esc($m['name_member']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select name="id_book" class="form-control" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($books as $b) : ?>
                                <option value="<?= $b['id_book'] ?>"><?= esc($b['title_book']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Target Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                </div>
            </form>
            
        </div>
    </div>
</div>