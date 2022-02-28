<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <!-- Page Heading -->
        <h2 class="h3 mb-4 text-gray-800"></b></h2>
        <div class="col-md-6">
            <div class="card">
                <!-- Header Card -->
                <div class="card-header">
                    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
                </div>

                <?php if (!empty($tagihan['status'] == 'Belum Dibayar')) : ?>
                    <div class="card-block col-md mx-auto my-2">
                        <!-- From Pembayaran -->
                        <form action="" method="post">
                            <!-- Row -->
                            <div class="row">
                                <!-- Col 1 -->
                                <div class="col">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id_tagihan" name="id_tagihan" value="<?= $tagihan['id_tagihan'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama</label>
                                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>" readonly>
                                        <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_meter">Jumlah Meter</label>
                                        <input type="text" class="form-control" id="jumlah_meter" name="jumlah_meter" value="<?= $tagihan['jumlah_meter']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_bayar">Tanggal Bayar</label>
                                        <input type="text" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('d-F-Y'); ?>" readonly>
                                    </div>
                                </div>
                                <!-- End Col 1 -->

                                <!-- Col 2 -->
                                <div class="col mt-3">
                                    <div class="form-group">
                                        <label for="nama_admin">Nama Admin</label>
                                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?= $user['nama_admin']; ?>" readonly>
                                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="id_pelanggan">Biaya Admin</label>
                                        <input type="text" class="form-control" id="biaya_admin" name="biaya_admin" value="3000" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_pelanggan">Total Bayar</label>
                                        <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="<?= $tagihan['jumlah_meter'] * $tagihan['tarif_perkwh'] + 3000; ?>" readonly>
                                    </div>
                                </div>
                                <!-- End Col 2 -->
                            </div>
                            <!-- End Row -->
                            <div class="form-group">
                                <label for="nominal">Masukan Nominal Bayar</label>
                                <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukan Nominal...">
                                <!-- Menampilkan Eror -->
                                <small class="form-text text-danger"><?= form_error('nominal'); ?></small>
                            </div>

                            <button type="submit" class="btn btn-info mb-3 float-right">
                                <i class="fas fa-money-bill mr-1"></i>Bayar
                            </button>
                            <a href="<?= base_url('pelanggan'); ?>" class="btn btn-danger float-right mr-2">
                                <i class="fas fa-backward mr-1"></i>Kembali
                            </a>
                        </form>
                        <!-- End Form -->
                    </div>

                <?php else : ?>
                    <li class="list-group-item">Data Pembayaran Belum Ada Gan!!</li>
            </div>
            <a href="<?= base_url() . 'pelanggan/exportToPdf/' . $this->session->userdata('id_pelanggan'); ?>" class=" btn btn-sm btn-outline-danger mt-2">
                <span class="far fa-lg fa-fw fa-file-pdf"></span> Bukti Pembayaran
            </a>
        <?php endif; ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->