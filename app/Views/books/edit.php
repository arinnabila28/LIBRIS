<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Buku</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Buku</h3>
    </div>

   <form action="<?= base_url('update/book/' . $book['id_book']) ?>" method="post">
        <!-- Form fields will go here -->
         <?= csrf_field() ?>
         <div class="card-body">
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" name="code_book" class="form-control" placeholder="Masukkan kode buku" value="<?= $book['code_book'] ?>">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="title_book" class="form-control" placeholder="Masukkan judul buku" value="<?= $book['title_book'] ?>">
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn_book" class="form-control" placeholder="Masukkan ISBN" value="<?= $book['isbn_book'] ?>">
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="title_book" class="form-control" placeholder="Masukkan judul buku" value="<?= $book['title_book'] ?>">
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="author_book" class="form-control" placeholder="Masukkan nama penulis" value="<?= $book['author_book'] ?>">
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="publisher_book" class="form-control" placeholder="Masukkan nama penerbit" value="<?= $book['publisher_book'] ?>">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="text" name="published_year" class="form-control" placeholder="Masukkan tahun terbit" value="<?= $book['published_year'] ?>">
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stock" class="form-control" placeholder="Masukkan stok buku" value="<?= $book['stock'] ?>">
            </div>
            <div class="form-group">
                <label>Deskripsi Fisik</label>
                <input type="text" name="deskripsi_fisik" class="form-control" placeholder="Masukkan deskripsi fisik buku" value="<?= $book['deskripsi_fisik'] ?>">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="description_book" class="form-control" placeholder="Masukkan keterangan buku" value="<?= $book['description_book'] ?>">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="updateButton" onclick="return confirm('Apakah anda yakin akan mengupdate data ini?')">Simpan</button>
            </div>
         </div>
    </form>
</div>
<?= $this->endSection() ?>