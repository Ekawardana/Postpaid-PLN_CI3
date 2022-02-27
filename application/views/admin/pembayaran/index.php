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
                            <th>Tanggal Bayar</th>
                            <th>Bulan</th>
                            <th>Tarif KWH</th>
                            <th>Total Bayar</th>
                            <th>Nama Admin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Membuat perulangan untuk menampilkan seluruh data penggunaan -->
                        <?php
                        // Menggunakan alias fungsi dari $penggunaan menjadi $p
                        foreach ($bayar as $bay) : ?>
                            <tr>
                                <!-- Panggil data penggunaan -->
                                <th scope="row"><?= $bay['nomor_kwh'] ?></th>
                                <td><?= $bay['nama_pelanggan']; ?></td>
                                <td><?= date('d F Y', $bay['tgl_bayar']); ?></td>
                                <td><?= date('M', $bay['bulan']); ?></td>
                                <td><?= $bay['tarif_perkwh']; ?></td>
                                <td><?= $bay['total_bayar']; ?></td>
                                <td><?= $bay['nama_admin']; ?></td>
                                <td>
                                    <a href="<?= base_url('pembayaran/hapusPembayaran/') . $bay['id_pembayaran']; ?>" class="badge badge-danger tombol-hapus">
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