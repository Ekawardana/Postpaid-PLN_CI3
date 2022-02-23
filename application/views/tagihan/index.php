<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

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
                            <th>Jumlah Meter</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Membuat perulangan untuk menampilkan seluruh data penggunaan -->
                        <?php
                        // Menggunakan alias fungsi dari $penggunaan menjadi $p
                        foreach ($tagihan as $tag) : ?>
                            <tr>
                                <!-- Panggil data penggunaan -->
                                <th scope="row"><?= $tag['nomor_kwh'] ?></th>
                                <td><?= $tag['nama_pelanggan']; ?></td>
                                <td><?= $tag['bulan'] = date('M'); ?></td>
                                <td><?= $tag['tahun']; ?></td>
                                <td><?= $tag['meter_awal']; ?></td>
                                <td><?= $tag['meter_akhir']; ?></td>
                                <td><?= $tag['jumlah_meter']; ?></td>
                                <td>
                                    <?php if ($tag['status'] != 'Dibayar') : ?>
                                        <div class='btn btn-outline-danger'><?= $tag['status']; ?></div>
                                    <?php else : ?>
                                        <div class='btn btn-outline-info'><?= $tag['status']; ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('tagihan/hapusTagihan/') . $tag['id_tagihan']; ?>" class="badge badge-danger tombol-hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->
</div>