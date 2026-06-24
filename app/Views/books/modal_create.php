<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Buku Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('create/book') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Kode Buku</label>
                            <input type="text" name="code_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn_book" class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="title_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penulis</label>
                            <input type="text" name="author_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penerbit</label>
                            <input type="text" name="publisher_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="published_year" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Stok Buku</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Keterangan / Deskripsi</label>
                            <textarea name="description_book" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Subjek / Genre</label>
                            <?php if (empty($subjekList)): ?>
                                <div class="text-muted" style="font-size:13px">Belum ada subjek. Tambahkan dulu di menu <a href="<?= base_url('kelola/subjek') ?>" target="_blank">Subjek / Genre</a>.</div>
                            <?php else: ?>
                                <div style="border:1px solid #e2e2de;border-radius:8px;padding:10px;max-height:150px;overflow:auto;display:flex;flex-wrap:wrap;gap:8px">
                                    <?php foreach ($subjekList as $s): ?>
                                        <label style="display:inline-flex;align-items:center;gap:6px;margin:0;font-weight:400;font-size:13px;background:#f6f6f4;border:1px solid #e2e2de;border-radius:6px;padding:5px 10px;cursor:pointer">
                                            <input type="checkbox" name="subjek[]" value="<?= esc($s) ?>"> <?= esc($s) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <small class="text-muted">Centang subjek yang sesuai (boleh lebih dari satu).</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>No. Klasifikasi</label>
                            <input type="text" name="no_klasifikasi" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Edisi</label>
                            <input type="text" name="edisi" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Volume</label>
                            <input type="text" name="volume" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Kota Terbit</label>
                            <input type="text" name="kota_terbit" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Deskripsi Fisik</label>
                            <input type="text" name="deskripsi_fisik" class="form-control" placeholder="mis. xiv, 320 hlm. ; 24 cm">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tipe Buku</label>
                            <select name="tipe" class="form-control">
                                <option value="fisik">Fisik (bisa dipinjam)</option>
                                <option value="digital">Digital (bisa dibaca)</option>
                                <option value="keduanya">Fisik &amp; Digital (dipinjam + dibaca)</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>File PDF (untuk buku digital)</label>
                            <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Cover Buku (gambar)</label>
                            <input type="file" name="cover_img" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>