<div class="container-fluid">
    <div class="col-lg-6">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- From Tambah -->
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $penggunaan['nama_pelanggan']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="meter_awal">Meter Awal</label>
                <input type="text" class="form-control" id="meter_awal" name="meter_awal" value="<?= $penggunaan['meter_akhir']; ?>" autocomplete="off" readonly>
                <small class="form-text text-danger"><?= form_error('meter_awal') ?></small>
            </div>

            <div class="form-group">
                <label for="meter_akhir">Meter Akhir</label>
                <input type="text" class="form-control" id="meter_akhir" name="meter_akhir" value="<?= $penggunaan['meter_akhir']; ?>" autocomplete="off">
                <small id="error_meter_akhir" class="form-text text-danger"><?= form_error('meter_akhir') ?></small>
            </div>

            <button type="submit" class="btn btn-outline-info mb-3 float-right">
                <i class="fas fa-edit mr-1"></i>Ubah
            </button>
            <a href="<?= base_url('penggunaan'); ?>" class="btn btn-outline-danger float-right mr-2">
                <i class="fas fa-ban mr-1"></i>Kembali
            </a>
        </form>
        <!-- End Form Tambah -->

    </div>
</div>
</div>