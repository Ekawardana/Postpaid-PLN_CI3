<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; EKA_Sertifikasi <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Logout" Jika Anda Benar Ingin Keluar</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-ban mr-1"></i>Cancel</button>
                <a class="btn btn-info" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-ui.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/myscript.js"></script>
<script>
    // Carikan dokumen yang akan dijalankan dan jika sudah maka jalankan function berikut
    $(document).ready(function() {
        // Ambil document berdasarkan id=meter_akhir
        document.getElementById("meter_akhir").addEventListener(
            "keydown",
            debounce(e => {
                // buat varibel yang berisi id dari meter_awal dan meter_akhir
                let awal = Number(document.getElementById("meter_awal").value);
                let akhir = Number(document.getElementById("meter_akhir").value);
                if (akhir <= 0) {
                    // Cek jika variabel akhir lebih kecil dari 0
                    document.getElementById("error_meter_akhir").innerHTML = "Tidak boleh kosong !";
                    return;
                }
                if (awal > akhir) {
                    // Cek jika variabel awal > dari variabel akhir 
                    document.getElementById("error_meter_akhir").innerHTML = "Tidak boleh lebih kecil dari Meter Awal !";
                } else {
                    document.getElementById("error_meter_akhir").innerHTML = "";
                }
            }, 1000)
        );
    });

    const debounce = (fn, delay) => {
        let timeoutID;
        return function(...args) {
            if (timeoutID) {
                clearTimeout(timeoutID);
            }
            timeoutID = setTimeout(() => {
                fn(...args);

            }, delay)
        }
    }
</script>

</body>

</html>