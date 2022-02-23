<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('dataPel/tambahDataPel'); ?>" class="btn btn-info mb-3">
                Tambah Data<i class="fas fa-plus-circle ml-1"></i>
            </a>

            <!-- Search -->
            <div class="row mt-2">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Data Pelanggan..." name="keyword" autocomplete="off" value="<?= set_value('keyword'); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Search -->

            <!-- Menampilkan semua data pelanggan -->
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Kode User</th> -->
                        <th>No KWH</th>
                        <th>Alamat</th>
                        <th>Nama Pelanggan</th>
                        <th>Tarif</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datapelanggan as $dp) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $dp['nomor_kwh']; ?></td>
                            <td><?= $dp['alamat']; ?></td>
                            <td><?= $dp['nama_pelanggan']; ?></td>
                            <td><?= $dp['daya']; ?></td>
                            <td><img src="<?= base_url('assets/img/profile/') . $dp['image']; ?>" width="80" /></td>
                            <td>
                                <a href="<?= base_url() ?>dataPel/detail/<?= $dp['id_pelanggan']; ?>" title="Detail user" class="badge badge-warning">
                                    <i class="fas fa-info-circle mr-1"></i>Detail
                                </a>
                                <a href="<?= base_url(); ?>dataPel/ubahDataPel/<?= $dp['id_pelanggan']; ?>" title="Ubah user" class="badge badge-info">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <a href="<?= base_url('dataPel/hapusDataPel/') . $dp['id_pelanggan']; ?>" title="Hapus Pelanggan" class="badge badge-danger tombol-hapus">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Cek jika data pelanggan tidak ada -->
            <?php if (empty($datapelanggan)) : ?>
                <div class="alert alert-danger col-md-6" role="alert">
                    Pelanggan Tidak Ditemukan....!
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>