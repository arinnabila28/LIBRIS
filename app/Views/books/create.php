<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Tambah Buku</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Buku</h3>
    </div>

    <form action="<?= base_url('create/book') ?>" method="post">
        <!-- Form fields will go here -->
         <?= csrf_field() ?>
         <div class="card-body">
            
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="title_book" class="form-control" placeholder="Masukkan judul buku">
            </div>
            <div class='form-group'>
                <label>Kode Buku</label>
                <input type='text' name='code_book' class='form-control' placeholder='Masukkan kode buku'>
            </div>
            <div class='form-group'>
                <label>ISBN</label>
                <input type='text' name='isbn_book' class='form-control' placeholder='Masukkan ISBN buku'>
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="author_book" class="form-control" placeholder="Masukkan nama penulis">
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="publisher_book" class="form-control" placeholder="Masukkan nama penerbit">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="text" name="published_year" class="form-control" placeholder="Masukkan tahun terbit">
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stock" class="form-control" placeholder="Masukkan stok buku">
            </div>
            <div class="form-group">
                <label>Deskripsi Fisik</label>
                <input type="text" name="deskripsi_fisik" class="form-control" placeholder="Masukkan deskripsi fisik buku">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="description_book" class="form-control" placeholder="Masukkan keterangan buku">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $('.saveButton').click(function(e) {
            e.preventDefault();
            alert('Buku berhasil disimpan!');
            // You can add AJAX code here to submit the form data to the server
        });
    });
</script>
<?= $this->endSection() ?>