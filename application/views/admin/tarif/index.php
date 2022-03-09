<!-- Konten Tarif -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Menampilkan session jika data berhasil di tambah, ubah, hapus-->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
    <div class="row">
        <div class="col-lg-8">
            <a href="" class="btn btn-info btn-icon-split mb-3" data-toggle="modal" data-target="#tarifBaruModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Tambah Tarif</span>
            </a>


            <!-- Tabel -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Daya</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Membuat perulangan untuk menampilkan data tarif -->
                    <?php
                    $i = 1;
                    // Menggunakan alias fungsi ari $tarif menjadi $t
                    foreach ($tarif as $t) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <!-- Panggil data tarif -->
                            <td><?= $t['daya']; ?></td>
                            <td><?= 'Rp' . $t['tarif_perkwh'] . ' / KWH'; ?></td>
                            <td>
                                <a href="<?= base_url('tarif/ubahTarif/') . $t['id_tarif']; ?>" class="badge badge-info">
                                    <i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('tarif/hapus/') . $t['id_tarif']; ?>" class="badge badge-danger tombol-hapus"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tabel -->
        </div>
    </div>

</div>
<!-- End Konten Tarif -->

<!-- Modal Tambah Tarif Baru-->
<div class="modal fade" id="tarifBaruModal" tabindex="-1" role="dialog" aria-labelledby="tarifBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="tarifBaruModalLabel">Tambah Tarif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <form action="<?= base_url('tarif'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="daya" name="daya" placeholder="Masukkan Daya" value="<?= set_value('daya'); ?>">
                        <!-- Menampilkan validasi jika data tidak sesuai -->
                        <small class="form-text text-danger"><?= form_error('daya'); ?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tarif_perkwh" name="tarif_perkwh" placeholder="Masukkan Tarif KWH" value="<?= set_value('tarif_perkwh'); ?>">
                        <!-- Menampilkan validasi jika data tidak sesuai -->
                        <small class="form-text text-danger"><?= form_error('tarif_perkwh'); ?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i>Tambah</button>
                </div>
            </form>
            <!-- End form -->

        </div>
    </div>
</div>
<!-- End Modal Tambah Tarif -->
</div>