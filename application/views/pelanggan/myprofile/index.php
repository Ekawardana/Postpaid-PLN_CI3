<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 justify-content-x">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <div class="card shadow mb-3 col-lg-4">
            <div class="card-block">
                <center class="mt-4">
                    <img src="<?= base_url('assets/img/profile/') . $pelanggan['image']; ?>" class="rounded-circle" width="150" />
                    <h4 class="card-title text-dark"><?= $pelanggan['nama_pelanggan']; ?></h4>
                </center>
            </div>
            <hr>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th><?= $pelanggan['username']; ?></th>
                    </tr>
                    <tr>
                        <th>Nomor KWH</th>
                        <th>
                            <div class="badge badge-primary">
                                <?= $pelanggan['nomor_kwh']; ?>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Daya</th>
                        <th><?= $pel['daya']; ?></th>
                    </tr>
                </thead>
            </table>

            <div class="btn mb-3">
                <a href="<?= base_url(); ?>" class="btn btn-danger">
                    <i class="fas fa-ban"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->