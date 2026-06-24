<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Buku</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>

        <div class="card-tools">
            <a href="<?= base_url('book/trash') ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-trash"></i> Tong Sampah
            </a>
            
            <button id="btnTambahBuku" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Buku
            </button>
        </div>
    </div>

    <div class="card-body">
        <div id="viewDataTabel"></div>
    </div>
</div>

<div id="viewModal" style="display: none;"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        
        // 1. Memuat Tabel Otomatis
        $('#viewDataTabel').html('<p class="text-center text-muted">Sedang memuat data...</p>');
        $('#viewDataTabel').load("<?= base_url('list/books/table') ?>");

        // 2. Aksi saat tombol TAMBAH BUKU diklik
        $('#btnTambahBuku').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('ajax/create/book') ?>",
                success: function(response) {
                    $('#viewModal').html(response).show();
                    $('#modalTambah').modal('show');
                }
            });
        });

        // 3. Aksi saat tombol EDIT diklik (Jurus Event Delegation)
        // Kita perintahkan '#viewDataTabel' untuk memantau klik pada '.btnEdit'
        $('#viewDataTabel').on('click', '.btnEdit', function(e) {
            e.preventDefault();
            
            // Ambil ID buku dari atribut data-id di tombol
            let id = $(this).data('id'); 
            
            $.ajax({
                url: "<?= base_url('ajax/edit/book/') ?>" + id,
                success: function(response) {
                    $('#viewModal').html(response).show();
                    $('#modalEdit').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert("Gagal memuat form edit. Error: " + xhr.status);
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>