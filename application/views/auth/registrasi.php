<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class=" card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-info mb-4">Buat Akun<i class="fas fa-exclamation ml-2"></i></h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registrasi'); ?>">

                            <!-- Form Input username -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
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
                                    <input type="text" class="form-control form-control-user rounded-right" id="nama_admin" name="nama_admin" placeholder="Nama Lengkap..." value="<?= set_value('nama_admin') ?>">
                                </div>
                                <!-- Tampilkan validation eror jika input tidak sesuai -->
                                <small class="text-danger"><?= form_error('nama_admin'); ?></small>
                            </div>
                            <!-- End Input Nama -->

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

                            <button type="submit" class="btn btn-info btn-user btn-block">
                                Registrasi Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small text-info" href="<?= base_url('auth'); ?>">Sudah Punya Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>