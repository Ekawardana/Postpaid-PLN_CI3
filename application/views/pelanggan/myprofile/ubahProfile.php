<div class="container-fluid">
    <div class="container">
        <?= form_open_multipart('pelanggan/ubahProfile'); ?>
        <div class="card col-lg-6">
            <div class="card-block mx-3 my-2">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= $pelanggan['username']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nama_pelanggan">Nama</label>
                    <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>">
                    <?= form_error('nama_pelanggan', '<small class="form-text text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="image">
                        <img src="<?= base_url('assets/img/profile/') . $pelanggan['image']; ?>" width="100" /></label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>

                <button type="submit" class="btn btn-info float-right mb-2 ml-2">
                    <i class="fas fa-fw fa-edit mr-1"></i>Simpan
                </button>
                <a href="<?= base_url('pelanggan/myprofil'); ?>" class="btn btn-danger float-right mb-2">
                    <i class="fas fa-fw fa-ban mr-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>
    <!-- End Container -->
</div>
<!-- End Container-Fluid -->