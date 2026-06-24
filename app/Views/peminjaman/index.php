<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Sirkulasi / Peminjaman</h1>
        </div>
        <div class="col-sm-6 text-right">
            <button class="btn btn-primary" id="btnTambahPeminjaman">
                <i class="fas fa-plus"></i> Catat Peminjaman
            </button>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="viewDataTabel"></div>
        </div>
    </div>
</div>

<div id="viewModal" style="display:none;"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Load Tabel Otomatis
        $('#viewDataTabel').html('<p class="text-center text-muted">Sedang memuat data...</p>');
        $('#viewDataTabel').load("<?= base_url('list/peminjaman/table') ?>");

        // Aksi Tambah
        $('#btnTambahPeminjaman').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('ajax/create/peminjaman') ?>",
                success: function(response) {
                    $('#viewModal').html(response).show();
                    $('#modalTambah').modal('show');
                }
            });
        });

            // Aksi Edit
            $('#viewDataTabel').on('click', '.btnEdit', function(e) {
            e.preventDefault();
            let id = $(this).data('id'); 
            
            $.ajax({
                url: "<?= base_url('ajax/edit/peminjaman/') ?>" + id,
                success: function(response) {
                    $('#viewModal').html(response).show();
                    $('#modalEdit').modal('show');
                },
                error: function(xhr) {
                    alert("Gagal memuat form edit. Error: " + xhr.status);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>