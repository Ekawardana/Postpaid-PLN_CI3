<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    //Membuat construct agar fungsi dari class lain dapat digunakan
    public function __construct()
    {
        parent::__construct();
        //Panggil model dari User_Model
        $this->load->model('User_Model', 'user');
        //fungsi pada helpers (cek data dari login)
        cek_login();
        //Panggil fungsi pada helpers (cek jika bukan admin maka tidak boleh akses)
        cek_admin();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        //Ambil satu data dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|min_length[3]', [
            'required' => 'Nama Harus Diisi!!',
            'min_length' => 'Nama terlalu pendek'
        ]);

        //Cek jika validasi tidak sesuai maka akan dikembalikan ke halaman profile
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/profile/index', $data);
            $this->load->view('templates/footer');
        } else {
            /*
              Jika Ada gambar yang diupload
              Buat variabel upload gambar yang berisi $_FILES
              $_FILES merupakan variabel super global yang nanti akan terisi file yang dipilih
            */
            $upload_gambar = $_FILES['image']['name'];

            //Cek requirement gambarnya
            if ($upload_gambar) {
                //Tipe gambar harus gif, jpg, png
                $config['allowed_types'] = 'gif|jpg|png';
                //Tize file gambar yang diupload
                $config['max_size']     = '2048';
                //Tempat menyimpan file gambar yang telah diupload
                $config['upload_path'] = './assets/img/profile';
                //Panggil library upload filenya
                $this->load->library('upload', $config);

                // Cek jika berhasil
                if ($this->upload->do_upload('image')) {
                    // Cari gambar lama yang akan dihapus setelah gambar diupdate
                    $gambar_lama = $data['user']['image'];
                    //Cek jika gambar lama bukan default.jpg, hapus gambarnya setelah ada gambar baru
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }
                    //Tampung data file upload beserta semua informasinya di variabel $gambar_baru
                    $gambar_baru = $this->upload->data('file_name');
                    //Panggil fungsi set untuk menyimpan gambar baru ke tabel user
                    $this->db->set('image', $gambar_baru);
                } else {
                    // jika gagal
                    echo $this->upload->display_errors();
                }
            }
            //Jika berhasil, Panggil fungsi ubah user dari User_Model
            $this->user->ubahUser();
            //Tampilkan Pesan
            $this->session->set_flashdata('pesan', 'Diubah');
            redirect('profile');
        }
    }
}
