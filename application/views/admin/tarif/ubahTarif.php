<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4>Ubah Tarif</h4>
                </div>
                <div class="card-body">
                    <!-- Form ubah -->
                    <form action="" method="post">
                        <!-- Input daya -->
                        <div class="form-group">
                            <label for="daya">Daya</label>
                            <input type="text" name="daya" class="form-control" id="daya" value="<?= $tarif['daya']; ?>">
                            <small class="form-text text-danger"><?= form_error('daya'); ?></small>
                        </div>
                        <!-- Input tarif kwh -->
                        <div class="form-group">
                            <label for="tarif_perkwh">Tarif KWH</label>
                            <input type="text" name="tarif_perkwh" class="form-control" id="tarif_perkwh" value="<?= $tarif['tarif_perkwh']; ?>">
                            <small class="form-text text-danger"><?= form_error('tarif_perkwh'); ?></small>
                        </div>
                        <!-- Button -->
                        <button type="submit" name="ubah" class="btn btn-primary float-right"><i class="fas fa-edit mr-1"></i>Simpan</button>
                        <a href="<?= base_url('tarif'); ?>" class="btn btn-danger float-right mr-2"><i class="fas fa-ban mr-1"></i>Kembali</a>
                    </form>
                    <!-- End form ubah -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>