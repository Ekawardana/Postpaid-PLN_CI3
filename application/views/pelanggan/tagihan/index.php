<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="col-xl-6">
            <!-- Earnings (Monthly) Card Example -->
            <?= $this->session->flashdata('pesan'); ?>
            <!-- Page Heading -->
            <h2 class="h3 mb-4 text-gray-800"> Data <?= $title; ?></b></h2>
            <div class="card">
                <!-- Header Card -->
                <div class="card-header">
                    <h1 class="h3 text-gray-800">Tagihan</h1>
                </div>
                <div class="card-block mx-3 my-2">
                    <ul class="list-group list-group-flush">
                        <?php if (!empty($tagihan['id_tagihan'])) : ?>
                            <li class="list-group-item">Nomor KWH : <?= $tagihan['nomor_kwh']; ?></li>
                            <li class="list-group-item">Nama Pelanggan : <?= $tagihan['nama_pelanggan']; ?></li>
                            <li class="list-group-item">Meter Awal : <?= $tagihan['meter_awal']; ?> </li>
                            <li class="list-group-item">Meter Akhir : <?= $tagihan['meter_akhir']; ?></li>
                            <li class="list-group-item">Jumlah Meter : <?= $tagihan['jumlah_meter']; ?></li>
                            <li class="list-group-item">Status :
                                <?php if ($tagihan['status'] != 'Dibayar') : ?>
                                    <div class='btn btn-outline-danger'><?= $tagihan['status']; ?></div>
                                <?php else : ?>
                                    <div class='btn btn-outline-success'><?= $tagihan['status']; ?></div>
                                <?php endif; ?>
                            </li>
                        <?php else : ?>
                            <li class="list-group-item">Data Tagihan Belum di Input Admin Gan!!</li>
                        <?php endif; ?>

                    </ul>

                </div>
            </div>
            <a href="<?= base_url('pelanggan'); ?>" class="btn btn-outline-danger mb-2 mt-3 ml-2 float-right">
                <i class="fas fa-fw fa-ban mr-1"></i>Kembali
            </a>
        </div>

    </div>
</div>
<!-- /.container-fluid -->