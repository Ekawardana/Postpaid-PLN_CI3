<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <!-- <i class="fas fa-5x fa-bolt text-warning mb-3 rotate-n-15"></i> -->
                                    <h1 class="h4 text-primary mb-4">Pembayaran Listrik!</h1>
                                </div>
                                <hr>
                                <!-- Memberi pesan yang diambil dari session -->
                                <?= $this->session->flashdata('pesan'); ?>

                                <!-- Form -->
                                <form class="user" method="post" action="<?= base_url('home'); ?>">
                                    <!-- Form Input Username -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-user rounded-right" name="username" id="username" placeholder="Enter Username..." value="<?= set_value('username') ?>">
                                        </div>
                                        <!-- Pemberitahuan Jika Terjadi Salah Input -->
                                        <small class="text-danger"><?= form_error('username'); ?></small>
                                    </div>
                                    <!-- End Form Username-->

                                    <!-- Form Input Password -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-user rounded-right" id="password" name="password" placeholder="Password">
                                        </div>
                                        <!-- Pemberitahuan Jika Terjadi Salah Input -->
                                        <small class="text-danger"><?= form_error('password'); ?></small>
                                    </div>
                                    <!-- End Input Password -->

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <!-- End Form -->
                                <hr>

                                <div class="text-center">
                                    <a class="small text-primary" href="<?= base_url('home/registrasi'); ?>">Buat Akun!</a>
                                </div>

                                <div class="text-center">
                                    <a class="small text-primary" href="<?= base_url('menu_utama'); ?>">Halaman Utama</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Nested Row within Card Body -->

                </div>
            </div>

        </div>

    </div>
    <!-- End Outer Row -->

</div>