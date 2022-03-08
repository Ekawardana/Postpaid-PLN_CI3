<div class="container-fluid">
    <div class="col-lg-6">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- From Tambah -->
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_pelanggan">Masukan Pelanggan</label>
                <select class="form-control" id="id_pelanggan" name="id_pelanggan">
                    <option value="" selected disabled>--Cari Pelanggan--</option>
                    <?php foreach ($dataPel as $dp) : ?>
                        <option value="<?= $dp['id_pelanggan']; ?>">
                            <?= $dp['nama_pelanggan']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Pilih Bulan -->
            <div class="form-group">
                <label for="bulan">Pilih Bulan</label>
                <select name="bulan" class="form-control form-control-user">
                    <option value="">Pilih Bulan</option>
                    <?php
                    foreach ($bulan as $b) : ?>
                        <option value="<?= $b['bulan']; ?>">
                            <?= $b['bulan']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <small class="form-text text-danger"><?= form_error('id_pelanggan'); ?></small>
            <div class="form-group">
                <label for="meter_awal">Meter Awal</label>
                <input type="text" class="form-control" id="meter_awal" name="meter_awal" placeholder="Masukan Meter Awal..." value="<?= $penggunaan['meter_akhir'] = 0; ?>" readonly>
            </div>


            <div class="form-group">
                <label for="meter_akhir">Meter Akhir</label>
                <input type="text" class="form-control" id="meter_akhir" name="meter_akhir" placeholder="Masukan Meter akhir..." value="<?= set_value('meter_akhir'); ?>">
                <small class="form-text text-danger"><?= form_error('meter_akhir'); ?></small>
            </div>

            <button type="submit" class="btn btn-info mb-3 float-right">
                <i class="fas fa-plus-circle mr-1"></i>Tambah
            </button>
            <a href="<?= base_url('penggunaan'); ?>" class="btn btn-danger float-right mr-2">
                <i class="fas fa-ban mr-1"></i>Kembali
            </a>
        </form>
        <!-- End Form Tambah -->

    </div>
</div>
</div>