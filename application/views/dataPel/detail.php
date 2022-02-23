<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-block mb-2">
                    <center class="mt-4">
                        <img src="<?= base_url('assets/img/profile/') . $detail['image']; ?>" class="rounded-circle" width="150" />
                        <h4 class="card-title text-dark mt-3"><?= $detail['nama_pelanggan']; ?></h4>
                        <h6 class="card-subtitle mt-2 mb-4 text-primary"><?= $detail['nomor_kwh']; ?></h6>
                    </center>
                </div>
            </div>
        </div>

        <!-- Tampilan Detail -->
        <div class="col-lg-6 col-xlg-3 col-md-5">
            <div class="card">
                <!-- Header Card -->
                <div class="card-header">
                    <h1 class="h3 text-gray-800">Detail</h1>
                </div>
                <div class="card-block mx-3 my-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Username : <?= $detail['username']; ?></li>
                        <li class="list-group-item">nomor KWH : <?= $detail['nomor_kwh']; ?></li>
                        <li class="list-group-item">Nama Pelanggan : <?= $detail['nama_pelanggan']; ?></li>
                        <li class="list-group-item">Alamat : <?= $detail['alamat']; ?> </li>
                        <li class="list-group-item">Daya : <?= $detail['daya']; ?></li>
                        <li class="list-group-item">Tarif KWH : Rp.<?= $detail['tarif_perkwh']; ?></li>
                    </ul>

                    <a href="<?= base_url('dataPel'); ?>" class="btn btn-secondary mb-2 mt-3"><i class="fas fa-fw fa-ban mr-1"></i>Kembali</a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>