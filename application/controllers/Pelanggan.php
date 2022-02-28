<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('Pelanggan_Model', 'pelanggan');
        //Panggil model dari Tagihan_Model
        $this->load->model('Tagihan_Model', 'tagihan');
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil model dari Pembayaran_Model
        $this->load->model('Pembayaran_Model', 'pembayaran');
        //cek login pelanggan
        cek_logPel();
        // cek akses pelanggan
        cek_pelanggan();
    }

    public function index()
    {

        $data['title'] = 'Pembayaran Listrik';
        //Ambil data pelanggan dari session
        $data['pelanggan'] = $this->pelanggan->cekDataPel(['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/temp-pelanggan/header', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/temp-pelanggan/footer');
    }

    public function tagihan()
    {
        $data['title'] = 'Tagihan Listrik';
        //Ambil data pelanggan dari session
        $data['pelanggan'] = $this->pelanggan->cekDataPel(['username' => $this->session->userdata('username')])->row_array();
        //Ambil satu data dari model tagihan
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

        $this->load->view('templates/temp-pelanggan/header', $data);
        $this->load->view('pelanggan/tagihan/index', $data);
        $this->load->view('templates/temp-pelanggan/footer');
    }

    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        //Ambil data pelanggan dari session
        $data['pelanggan'] = $this->pelanggan->cekDataPel(['username' => $this->session->userdata('username')])->row_array();

        //Ambil satu data dari model tagihan
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

        //Ambil satu data dari model user
        $data['user'] = $this->user->getAllUser('id_user' == 2);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|numeric|greater_than[' . $this->input->post('total_bayar') . ']',
            [
                'required' => 'Nominal harus diisi',
                'greater_than' => 'Tidak boleh lebih kecil dari Total Bayar !!',
                'numeric' => 'Harus angka !'
            ]
        );

        //Cek jika falidasinya tidak sesuai maka akan dikembalikan ke halaman pembayaran
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/temp-pelanggan/header', $data);
            $this->load->view('pelanggan/pembayaran/index', $data);
            $this->load->view('templates/temp-pelanggan/footer');
        } else {
            // Panggil fungsi pembayaran
            $this->pembayaran->pembayaran();
            //Tampilkan session jika pembayaran berhasil
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Pembayaran Berhasil <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            // Kembalikan ke tampilan tagihan
            redirect('pelanggan/tagihan');
        }
    }

    public function myProfil()
    {
        //Ambil data pelanggan dari session
        $data['pelanggan'] = $this->pelanggan->cekDataPel(['username' => $this->session->userdata('username')])->row_array();
        //Ambil data pelanggan dari session
        $data['pel'] = $this->pelanggan->cekPelanggan(['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Profil Saya';
        $this->load->view('templates/temp-pelanggan/header', $data);
        $this->load->view('pelanggan/myProfile/index', $data);
        $this->load->view('templates/temp-pelanggan/footer', $data);
    }

    // fungsi eksport PDF
    public function exportToPdf()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $data['pelanggan'] = $this->session->userdata('nama_pelanggan');
        //Ambil data pelanggan dari session
        $data['pel'] = $this->pelanggan->cekPelanggan(['username' => $this->session->userdata('username')])->result();

        $data['items'] = $this->db->query("select*from pembayaran, v_tagihan where pembayaran.id_tagihan=v_tagihan.id_tagihan and pembayaran.id_pelanggan='$id_pelanggan'")->result_array();

        $data['title'] = "Cetak Bukti Booking";
        $this->load->view('pelanggan/pembayaran/bukti-pdf', $data);
        $this->load->library('dompdf_gen');

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Bukti Bayar.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
