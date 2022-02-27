<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil model dari Tarif_Model
        $this->load->model('Tarif_Model', 'tarif');
        //fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }

    public function index()
    {
        $data['title'] = 'Data Tarif';
        //Ambil satu data dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        // Panggil fungsi tarif dari model tarif
        $data['tarif'] = $this->tarif->getAllTarif();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('daya', 'Daya', 'required|min_length[5]', [
            'required' => 'Daya Harus Diisi!!',
            'min_length' => 'Daya terlalu pendek'
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('tarif_perkwh', 'Tarif KWH', 'required|numeric|min_length[3]', [
            'required' => 'Tarif Harus Diisi!!',
            'min_length' => 'Tarif terlalu pendek',
            'numeric' => 'Harus Angka!!'
        ]);
        //Cek jika falidasinya tidak sesuai maka akan dikembalikan ke halaman tarif
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tarif/index', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika berhasil
            //Panggil fungsi tambah tarif dari Tarif_Model
            $this->tarif->tambahTarif();
            //Tampilkan session jika data berhasil ditambah
            $this->session->set_flashdata('pesan', 'Ditambah');
            //Kembalikan ke tampilan tarif
            redirect('tarif');
        }
    }

    // Membuat fungsi ubah tarif
    public function ubahTarif($id)
    {
        //Ambil user data dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil getTarifById dari Tarif_Model, sesuai dengan parameter $id
        $data['tarif'] = $this->tarif->getTarifById($id);
        $data['title'] = 'Ubah Tarif';

        //Rules validasinya jika tidak sesuai
        $this->form_validation->set_rules('daya', 'Daya', 'required|min_length[5]', [
            'required' => 'Daya Harus Diisi!!',
            'min_length' => 'Daya terlalu pendek'
        ]);

        //Rules validasinya jika tidak sesuai
        $this->form_validation->set_rules('tarif_perkwh', 'Tarif KWH', 'required|numeric|min_length[3]', [
            'required' => 'Tarif Harus Diisi!!',
            'min_length' => 'Tarif terlalu pendek',
            'numeric' => 'Harus Angka!!'
        ]);

        //Cek jika validasi tidak sesuai maka akan dikembalikan ke halaman tarif
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tarif/ubahTarif', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika berhasil, Panggil fungsi ubah tarif dari Tarif_Model
            $this->tarif->ubahTarif(['id_tarif' => $id]);
            //Tampilkan session jika data berhasil diubah
            $this->session->set_flashdata('pesan', 'Diubah');
            //Kembali ke halaman tarif
            redirect('tarif');
        }
    }

    //Hapus data tarif
    public function hapus($id)
    {
        $this->tarif->hapusTarif($id);
        $this->session->set_flashdata('pesan', 'Dihapus');
        redirect('tarif');
    }
}
