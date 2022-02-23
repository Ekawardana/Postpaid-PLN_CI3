<div class="container-fluid">
    <div class="col-lg-6">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- From Tambah -->
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="<?= $datapel['username']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $datapel['password']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="nomor_kwh">Nomor KWH</label>
                <input type="text" class="form-control" id="nomor_kwh" name="nomor_kwh" value="<?= $datapel['nomor_kwh']; ?>">
                <small class="form-text text-danger"><?= form_error('nomor_kwh'); ?></small>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="textarea" class="form-control" id="alamat" name="alamat" value="<?= $datapel['alamat']; ?>">
                <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
            </div>

            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $datapel['nama_pelanggan']; ?>">
                <small class="form-text text-danger"><?= form_error('nama_pelanggan'); ?></small>
            </div>

            <div class="form-group">
                <label for="id_tarif">Daya</label>
                <select class="form-control" id="id_tarif" name="id_tarif">
                    <!-- Foreach untuk menampilkan data tarif dati tabel tarif -->
                    <?php foreach ($tarif as $t) : ?>
                        <!-- Cek id_tarif -->
                        <?php if ($t['id_tarif'] == $datapel['id_tarif']) : ?>
                            <!-- Jika sama maka selected -->
                            <option value="<?= $t['id_tarif']; ?>" selected>
                                <?= $t['daya']; ?>
                            </option>
                        <?php else : ?>
                            <!-- jika tidak maka tampil semua data tarif -->
                            <option value="<?= $t['id_tarif']; ?>">
                                <?= $t['daya']; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-info mb-3 float-right"><i class="fas fa-edit mr-1"></i>Ubah</button>
            <a href="<?= base_url('dataPel'); ?>" class="btn btn-danger float-right mr-2"><i class="fas fa-ban mr-1"></i>Kembali</a>
        </form>
        <!-- End Form Tambah -->

    </div>
</div>
</div>