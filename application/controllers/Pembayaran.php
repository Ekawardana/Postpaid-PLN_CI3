<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan 
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //Panggil model dari Pembayaran_Model
        $this->load->model('Pembayaran_Model', 'pembayaran');
        //Panggil model dari Tagihan_Model
        $this->load->model('Tagihan_Model', 'tagihan');
        //Panggil fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }

    public function index()
    {
        $data['title'] = 'Data Pembayaran';
        //Ambil satu data dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();
        // Panggil fungsi tampilkan semua data tagihan
        $data['bayar'] = $this->pembayaran->getAllPembayaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pembayaran/index', $data);
        $this->load->view('templates/footer');
    }

    // fungsi hapus bayar
    public function hapusPembayaran($id)
    {
        // panggil function ha[pus dari Pembayaran_Model
        $this->pembayaran->hapusPembayaran($id);
        $this->session->set_flashdata('pesan', 'Dihapus');
        redirect('pembayaran');
    }

    // Cetak Pembayaran
    public function pembayaranPdf()
    {
        $data['pelanggan'] = $this->session->userdata('nama_pelanggan');

        //Ambil satu data dari model tagihan
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

        $data['items'] = $this->db->query("select*from pembayaran, v_tagihan where pembayaran.id_tagihan=v_tagihan.id_tagihan")->result_array();


        $this->load->view('admin/pembayaran/pembayaran-pdf', $data);

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
