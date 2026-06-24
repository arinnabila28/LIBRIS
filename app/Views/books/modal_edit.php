<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditLabel">Edit Data Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('update/book/' . $book['id_book']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Kode Buku</label>
                            <input type="text" name="code_book" class="form-control" value="<?= esc($book['code_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn_book" class="form-control" value="<?= esc($book['isbn_book']) ?>" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="title_book" class="form-control" value="<?= esc($book['title_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penulis</label>
                            <input type="text" name="author_book" class="form-control" value="<?= esc($book['author_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penerbit</label>
                            <input type="text" name="publisher_book" class="form-control" value="<?= esc($book['publisher_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="published_year" class="form-control" value="<?= esc($book['published_year']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Stok Buku</label>
                            <input type="number" name="stock" class="form-control" value="<?= esc($book['stock']) ?>" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Keterangan / Deskripsi</label>
                            <textarea name="description_book" class="form-control" rows="3"><?= esc($book['description_book']) ?></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Subjek / Genre</label>
                            <?php
                                $selLower = array_map('mb_strtolower', array_filter(array_map('trim', explode(',', $book['subjek'] ?? ''))));
                            ?>
                            <?php if (empty($subjekList)): ?>
                                <div class="text-muted" style="font-size:13px">Belum ada subjek. Tambahkan dulu di menu <a href="<?= base_url('kelola/subjek') ?>" target="_blank">Subjek / Genre</a>.</div>
                            <?php else: ?>
                                <div style="border:1px solid #e2e2de;border-radius:8px;padding:10px;max-height:150px;overflow:auto;display:flex;flex-wrap:wrap;gap:8px">
                                    <?php foreach ($subjekList as $s): $on = in_array(mb_strtolower($s), $selLower, true); ?>
                                        <label style="display:inline-flex;align-items:center;gap:6px;margin:0;font-weight:400;font-size:13px;background:<?= $on ? '#e6f0e7' : '#f6f6f4' ?>;border:1px solid <?= $on ? '#9cc3a3' : '#e2e2de' ?>;border-radius:6px;padding:5px 10px;cursor:pointer">
                                            <input type="checkbox" name="subjek[]" value="<?= esc($s) ?>" <?= $on ? 'checked' : '' ?>> <?= esc($s) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <small class="text-muted">Centang subjek yang sesuai (boleh lebih dari satu).</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>No. Klasifikasi</label>
                            <input type="text" name="no_klasifikasi" class="form-control" value="<?= esc($book['no_klasifikasi'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Edisi</label>
                            <input type="text" name="edisi" class="form-control" value="<?= esc($book['edisi'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Volume</label>
                            <input type="text" name="volume" class="form-control" value="<?= esc($book['volume'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Kota Terbit</label>
                            <input type="text" name="kota_terbit" class="form-control" value="<?= esc($book['kota_terbit'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Deskripsi Fisik</label>
                            <input type="text" name="deskripsi_fisik" class="form-control" value="<?= esc($book['deskripsi_fisik'] ?? '') ?>" placeholder="mis. xiv, 320 hlm. ; 24 cm">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tipe Buku</label>
                            <select name="tipe" class="form-control">
                                <option value="fisik" <?= ($book['tipe'] ?? 'fisik') === 'fisik' ? 'selected' : '' ?>>Fisik (bisa dipinjam)</option>
                                <option value="digital" <?= ($book['tipe'] ?? '') === 'digital' ? 'selected' : '' ?>>Digital (bisa dibaca)</option>
                                <option value="keduanya" <?= ($book['tipe'] ?? '') === 'keduanya' ? 'selected' : '' ?>>Fisik &amp; Digital (dipinjam + dibaca)</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>File PDF (untuk buku digital)</label>
                            <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                            <?php if (! empty($book['file_digital'])): ?>
                                <small class="text-muted">File saat ini: <?= esc($book['file_digital']) ?> — unggah baru untuk mengganti.</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Cover Buku (gambar)</label>
                            <input type="file" name="cover_img" class="form-control" accept="image/*">
                            <?php if (! empty($book['cover'])): ?>
                                <small class="text-muted">Cover saat ini: <?= esc($book['cover']) ?> — unggah baru untuk mengganti.</small>
                            <?php endif; ?>
                        </div>
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