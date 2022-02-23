<?php
// Fungsi cek apakah user sudah login
function cek_login()
{
    // Fungsi yang dapat memanggil instansiasi CI ke helper
    $ci = get_instance();
    // Cek jika session nya tidak ada atau bukan user 
    if (!$ci->session->userdata('username')) {
        // Tampilkan pesan (akses ditolak)
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akses Ditolak, Anda Belum Login!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button></div>');
        // Jika usernya ada
        if ($ci->session->userdata('id_user') == !0) {
            // Maka tampilkan
            redirect('admin');
        } else {
            //Jika tidak ada maka kembalikan ke auth
            redirect('auth');
        }
    } else {
        $id_user    = $ci->session->userdata('id_user');
        $level       = $ci->session->userdata('id_level');
    }
}

//Fungsi Cek  akses admin
function cek_admin()
{
    $ci     = get_instance();
    $level   = $ci->session->userdata('id_level');

    if ($level == !1) {
        // Cek jika bukan admin maka blok aksesnya
        redirect('home/blocked');
    }
}

/** PELANGGAN */

// Cek login pelanggan
function cek_logPel()
{
    // Fungsi yang dapat memanggil instansiasi CI ke helper
    $ci = get_instance();
    // Cek jika session nya tidak ada atau bukan pelanggan
    if (!$ci->session->userdata('username')) {
        // Tampilkan pesan (akses ditolak)
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akses Ditolak, Anda Belum Login!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button></div>');
        // Jika usernya ada
        if ($ci->session->userdata('id_pelanggan') == !0) {
            // Maka tampilkan
            redirect('pelanggan');
        } else {
            //Jika tidak ada maka kembalikan ke home
            redirect('home');
        }
    } else {
        $pelanggan   = $ci->session->userdata('username');
        $id_pelanggan  = $ci->session->userdata('id_pelanggan');
    }
}

//Fungsi Cek admin
function cek_pelanggan()
{
    $ci     = get_instance();
    $id_pelanggan   = $ci->session->userdata('id_pelanggan');

    if (!$id_pelanggan) {
        // Cek jika bukan admin maka blok aksesnya
        redirect('auth/blocked');
    }
}
