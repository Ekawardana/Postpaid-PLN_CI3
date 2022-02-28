<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran-Listrik | <?= $title; ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/'); ?>logo-pb.png">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.css">
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>"><b>Pembayaran Listrik</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="<?= base_url(); ?>">
                        <i class="fas fa-fw fa-home"></i>
                        Beranda <span class="sr-only">(current)</span>
                    </a>

                    <a class="nav-item nav-link" href="<?= base_url('pelanggan/myprofil'); ?>"><i class="fas fa-fw fa-user"></i>Profile Saya</a>

                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pembayaran
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('pelanggan/tagihan'); ?>">Tagihan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('pelanggan/pembayaran'); ?>">Pembayaran</a>
                        </div>
                    </div>

                    <a class="nav-item nav-link" data-toggle="modal" data-target="#logoutModal" href="<?= base_url('home/logout'); ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i> Log out
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End of Topbar -->
    <div class="mt-4">