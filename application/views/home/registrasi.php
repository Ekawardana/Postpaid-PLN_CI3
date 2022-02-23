<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class=" card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-success mb-4">Buat Akun<i class="fas fa-exclamation ml-2"></i></h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('home/registrasi'); ?>">

                            <!-- Form Input username -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-address-book"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-user rounded-right" id="username" name="username" placeholder="Username..." value="<?= set_value('username') ?>">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <small class="text-danger"><?= form_error('username'); ?></small>
                            </div>
                            <!-- End Input Username -->

                            <!-- Form Input Nama -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-user rounded-right" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Lengkap..." value="<?= set_value('nama_pelanggan') ?>">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <small class="text-danger">
                                    <?= form_error('nama_pelanggan'); ?>
                                </small>
                            </div>
                            <!-- End Input Nama -->

                            <!-- Form Input Nomor KWH -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-user rounded-right" id="nomor_kwh" name="nomor_kwh" placeholder="Masukan Nomor KWH..." value="<?= set_value('nomor_kwh') ?>">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <small class="text-danger">
                                    <?= form_error('nomor_kwh'); ?>
                                </small>
                            </div>
                            <!-- End Input Nama -->

                            <!-- Form Input Alamat -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-user rounded-right" id="alamat" name="alamat" placeholder="Masukan Alamat..." value="<?= set_value('alamat') ?>">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <small class="text-danger"><?= form_error('alamat'); ?></small>
                            </div>
                            <!-- End Input Alamat -->

                            <!-- Select Tarif -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-list"></i>
                                        </span>
                                        <select class="form-control" id="id_tarif" name="id_tarif">
                                            <!-- Foreach untuk menampilkan data tarif dati tabel tarif -->
                                            <?php foreach ($tarif as $t) : ?>
                                                <option value="<?= $t['id_tarif']; ?>">
                                                    <?= $t['daya']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Select Tarif -->

                            <!-- Form Input Password -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user rounded" id="password1" name="password1" placeholder="Password...">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user rounded" id="password2" name="password2" placeholder="Ulangi Password...">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- End Input Password -->

                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Registrasi Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small text-success" href="<?= base_url('home'); ?>">Sudah Punya Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>