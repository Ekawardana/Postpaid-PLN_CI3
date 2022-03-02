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
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

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
            $id_pembayaran  = $this->pembayaran->kodeOtomatis('pembayaran', 'id_pembayaran');
            //Siapkan data yang nanti akan dimasukan ke tabel pembayaran
            $data = [
                'id_pembayaran' => $id_pembayaran,
                'id_tagihan' => $this->input->post('id_tagihan', true),
                'id_pelanggan' => $this->input->post('id_pelanggan', true),
                'tgl_bayar' => time(),
                'bulan' => time(),
                'biaya_admin' => $this->input->post('biaya_admin', true),
                'total_bayar' => $this->input->post('total_bayar', true),
                'id_user' => $this->input->post('id_user', true),
            ];
            // Panggil fungsi pembayaran
            $this->pembayaran->pembayaran($data);
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
        //Ambil satu data dari model tagihan
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

        $data['title'] = 'Profil Saya';
        $this->load->view('templates/temp-pelanggan/header', $data);
        $this->load->view('pelanggan/myProfile/index', $data);
        $this->load->view('templates/temp-pelanggan/footer', $data);
    }

    // fungsi Cek Pembayaran
    public function cekPembayaran()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $data['pelanggan'] = $this->session->userdata('nama_pelanggan');

        //Ambil data pelanggan dari session
        $data['pel'] = $this->pelanggan->cekPelanggan(['username' => $this->session->userdata('username')])->result();

        //Ambil satu data dari model tagihan
        $data['tagihan'] = $this->tagihan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);

        $data['items'] = $this->db->query("select*from v_tagihan, pembayaran where v_tagihan.id_tagihan=pembayaran.id_tagihan and v_tagihan.id_pelanggan='$id_pelanggan'")->result_array();

        if ($data['tagihan']['status'] == 'Belum Dibayar') {
            redirect('auth/blocked');
        } else {
            $data['title'] = "Cek Pembayaran";
            $this->load->view('templates/temp-pelanggan/header', $data);
            $this->load->view('pelanggan/pembayaran/cek-pembayaran', $data);
            $this->load->view('templates/temp-pelanggan/footer', $data);
        }
        // $this->load->library('dompdf_gen');

        // $paper_size = 'A4'; // ukuran kertas
        // $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);
        // //Convert to PDF
        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("Bukti Bayar.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
