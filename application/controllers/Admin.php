<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['title'] = 'Ubah Password';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim|min_length[3]', [
            'required' => 'Password Lama harus diisi',
            'min_length' => 'Password Terlalu Pendek!'
        ]);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_baru1', 'Password Baru1', 'required|trim|min_length[3]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password Terlalu Pendek!',
            'matches' => 'Password Harus Sama'
        ]);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_baru2', 'Password Baru2', 'required|trim|min_length[3]|matches[password_baru1]', [
            'required' => 'Confirm Password harus diisi',
            'min_length' => 'Password Terlalu Pendek!',
            'matches' => 'Password Harus Sama'
        ]);

        // Cek Jika Rules Tidak Sesuai
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubahPassword', $data);
            $this->load->view('templates/footer');
        } else {
            // Fungsi Ubah Password
            $this->user->ubahPassword();
        }
    }
}
