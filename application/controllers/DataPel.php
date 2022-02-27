<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPel extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil model dari DataPel_Model
        $this->load->model('DataPel_Model', 'datapelanggan');
        //Panggil fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }

    public function index()
    {
        $data['title'] = 'Data Pelanggan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil semua data pelanggan
        $data['datapelanggan'] = $this->datapelanggan->getAllDataPel();
        if ($this->input->post('keyword')) {
            $data['datapelanggan'] = $this->datapelanggan->cariDataPel();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dataPel/index', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi melihat detail data
    public function detail($id = null)
    {
        $data['title'] = 'Detail Pelanggan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil satu data pelanggan berdasarkan id
        $data['detail'] = $this->datapelanggan->getDataPelById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dataPel/detail', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi menambah data pelanggan
    public function tambahDatapel()
    {
        //Panggil model tarif
        $this->load->model('Tarif_Model', 'tarif');
        $data['title'] = 'Tambah Pelanggan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        $data['tarif'] = $this->tarif->getAllTarif();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[pelanggan.username]', [
            'required' => 'username harus diisi',
            'min_length' => 'username terlalu pendel',
            'is_unique' => 'Data Sudah Ada!!'
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'required' => 'password harus diisi',
            'min_length' => 'Password Terlalu Pendek!'
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|min_length[3]|numeric', [
            'required' => 'Nomor KWH harus diisi',
            'min_length' => 'Nomor KWH Terlalu Pendek!',
            'numeric' => 'Harus Angka!',
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat Terlalu Pendek!'
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|min_length[3]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama Terlalu Pendek!'
        ]);
        //Cek jika form validasi gagal
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/dataPel/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika berhasil
            //Panggil fungsi tambah pelanggan dari DataPel_Model
            $this->datapelanggan->tambahDataPel();
            //Tampilkan session jika data berhasil ditambah
            $this->session->set_flashdata('pesan', 'Ditambah');
            //Kembalikan ke tampilan dataPel
            redirect('dataPel');
        }
    }

    // Fungsi mngubah data pelanggan
    public function ubahDatapel($id)
    {
        $data['title'] = 'Ubah Pelanggan';
        //Panggil data tarif
        $this->load->model('Tarif_Model', 'tarif');
        $data['tarif'] = $this->tarif->getAllTarif();
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil satu data pelanggan berdasarkan id
        $data['datapel'] = $this->datapelanggan->getDataPelById($id);


        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|min_length[3]|numeric', [
            'required' => 'Nomor KWH harus diisi',
            'min_length' => 'Nomor KWH Terlalu Pendek!',
            'numeric' => 'Harus Angka!',
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat Terlalu Pendek!'
        ]);
        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|min_length[3]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama Terlalu Pendek!'
        ]);
        //Cek jika form validasi gagal
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/dataPel/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            //Jika berhasil
            //Panggil fungsi tambah pelanggan dari DataPel_Model
            $this->datapelanggan->ubahDataPel(['id_pelanggan' => $id]);
            //Tampilkan session jika data berhasil ditambah
            $this->session->set_flashdata('pesan', 'Diubah');
            //Kembalikan ke tampilan dataPel
            redirect('dataPel');
        }
    }

    // Fungsi Hapus Data Pelanggan
    public function hapusDataPel($id)
    {
        $this->datapelanggan->hapusDataPel($id);
        $this->session->set_flashdata('pesan', 'Dihapus');
        redirect('dataPel');
    }
}
