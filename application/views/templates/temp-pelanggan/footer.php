</div>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

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
                <a class="btn btn-primary" href="<?= base_url('home/logout'); ?>"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/user/js/bootstrap.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script>
    $('.alert').alert().delay(3000).slideUp('slow');
</script>
</body>

</html>