<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Menampilkan session jika data berhasil diubah-->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-block mb-2">
                    <center class="mt-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="rounded-circle" width="150" />
                        <h4 class="card-title text-dark mt-3"><?= $user['nama_admin']; ?></h4>
                        <h6 class="card-subtitle mt-2 mb-4 text-primary"><?= $user['nama_level']; ?></h6>
                    </center>
                </div>
            </div>
        </div>

        <!-- Tampilan Edit Profile -->
        <div class="col-lg-6 col-xlg-3 col-md-5">
            <?= form_open_multipart('profile'); ?>
            <div class="card">
                <div class="card-block mx-3 my-2">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $user['username']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_admin">Nama</label>
                        <input type="text" class="form-control" name="nama_admin" id="nama_admin" value="<?= $user['nama_admin']; ?>">
                        <?= form_error('nama_admin', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="image">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" width="100" /></label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>

                    <button type="submit" class="btn btn-info float-right mb-2 ml-2">
                        <i class="fas fa-fw fa-edit mr-1"></i>Simpan
                    </button>
                    <a href="<?= base_url('admin'); ?>" class="btn btn-danger float-right mb-2">
                        <i class="fas fa-fw fa-ban mr-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->