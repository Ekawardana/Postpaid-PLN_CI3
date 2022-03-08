<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

    <!-- Card -->
    <div class="card shadow mb-4">
        <!-- Button Tambah Penggunaan -->
        <div class="card-header py-3">
            <!-- Row -->
            <div class="row mt-2">
                <div class="col">
                    <a href="<?= base_url('penggunaan/tambahPenggunaan') ?>" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Tambah Penggunaan</span>
                    </a>
                </div>

                <!-- Search -->
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group mb-2">
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
                <!-- End Search -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Card -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No KWH</th>
                            <th>Nama</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Meter Awal</th>
                            <th>Meter Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Membuat perulangan untuk menampilkan seluruh data penggunaan -->
                        <?php
                        // Menggunakan alias fungsi dari $penggunaan menjadi $p
                        foreach ($penggunaan as $p) : ?>
                            <tr>
                                <!-- Panggil data penggunaan -->
                                <th scope="row"><?= $p['nomor_kwh'] ?></th>
                                <td><?= $p['nama_pelanggan']; ?></td>
                                <td><?= $p['bulan']; ?></td>
                                <td><?= $p['tahun']; ?></td>
                                <td><?= $p['meter_awal']; ?></td>
                                <!-- <?php if ($p['bulan']) : ?>
                                    <td><?= $p['meter_awal'] = $p['meter_akhir']; ?></td>
                                <?php else : ?>
                                    <td><?= $p['meter_awal']; ?></td>
                                <?php endif; ?> -->
                                <td><?= $p['meter_akhir']; ?></td>
                                <td>
                                    <a href="<?= base_url('penggunaan/ubahPenggunaan/') . $p['id_penggunaan']; ?>" class="btn btn-outline-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('penggunaan/hapusPenggunaan/') . $p['id_penggunaan']; ?>" class="btn btn-outline-danger tombol-hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Cek jika data pelanggan tidak ada -->
                <?php if (empty($penggunaan)) : ?>
                    <div class="alert alert-danger col-md-6" role="alert">
                        Pengguna Tidak Ditemukan....!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->
</div>