<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggunaan extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil model dari Penggunaan_Model
        $this->load->model('Penggunaan_Model', 'penggunaan');
        //Panggil model dari dataPel_Model
        $this->load->model('DataPel_Model', 'datapelanggan');
        //Panggil fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }

    public function index()
    {
        $data['title'] = 'Data Penggunaan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil semua data penggunaan
        $data['penggunaan'] = $this->penggunaan->getAllPenggunaan();
        if ($this->input->post('keyword')) {
            $data['penggunaan'] = $this->penggunaan->cariPenggunaan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penggunaan/index', $data);
        $this->load->view('templates/footer');
    }

    // Membuat Fungsi Tambah Penggunaan
    public function tambahPenggunaan()
    {
        $data['title'] = 'Tambah Penggunaan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil data pelanggan
        $data['dataPel'] = $this->datapelanggan->getAllDataPel();
        //Panggil semua data penggunaan
        $data['penggunaan'] = $this->penggunaan->getAllPenggunaan();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'required|is_unique[penggunaan.id_pelanggan]', [
            'required' => 'Nama harus diisi!!',
            'is_unique' => 'Pelanggan Sudah Ada!!'
        ]);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules(
            'meter_awal',
            'Meter Awal',
            'required|numeric',
            [
                'required' => 'Meter harus diisi',
                'numeric' => 'Harus Angka'
            ]
        );

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules(
            'meter_akhir',
            'Meter Akhir',
            'required|numeric|greater_than[' . $this->input->post('meter_awal') . ']',
            [
                'required' => 'Meter harus diisi',
                'greater_than' => 'Tidak boleh lebih kecil dari Meter Awal !',
                'numeric' => 'Harus angka !'
            ]
        );

        //Cek jika validasi tidak sesuai 
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('penggunaan/tambahPenggunaan', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika berhasil
            $this->penggunaan->tambahPenggunaan();
            //Tampilkan session jika data berhasil ditambah
            $this->session->set_flashdata('pesan', 'Ditambah');
            redirect('penggunaan');
        }
    }

    public function ubahPenggunaan($id)
    {
        $data['title'] = 'Ubah Penggunaan';
        //Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        //Panggil semua data penggunaan
        $data['penggunaan'] = $this->penggunaan->getPenggunanById($id);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules(
            'meter_awal',
            'Meter Awal',
            'required|numeric',
            [
                'required' => 'Meter harus diisi',
                'numeric' => 'Harus angka !'
            ]
        );

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules(
            'meter_akhir',
            'Meter Akhir',
            'required|numeric|greater_than[' . $this->input->post('meter_awal') . ']',
            [
                'required' => 'Meter harus diisi',
                'greater_than' => 'Tidak boleh lebih kecil dari Meter Awal !',
                'numeric' => 'Harus angka !'
            ]
        );

        //Cek jika validasi tidak sesuai 
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('penggunaan/ubahPenggunaan', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika berhasil
            $this->penggunaan->ubahPenggunaan(['id_penggunaan' => $id]);
            //Tampilkan session jika data berhasil diubah
            $this->session->set_flashdata('pesan', 'Diubah');
            redirect('penggunaan');
        }
    }

    // Fungsi Hapus Data Penggunaan
    public function hapusPenggunaan($id)
    {
        // Panggil fungsi hapus dari model
        $this->penggunaan->hapusPenggunaan($id);
        //Tampilkan session jika data berhasil dihapus
        $this->session->set_flashdata('pesan', 'Dihapus');
        redirect('penggunaan');
    }
}
