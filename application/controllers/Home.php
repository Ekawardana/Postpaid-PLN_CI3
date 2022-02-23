<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        //jika sudah login maka tidak bisa akses controller home
        if ($this->session->userdata('username')) {
            redirect('pelanggan');
        }
        //Rules validasinya jika input tidak sesuai 
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username Harus Diisi!!',
        ]);
        //Rules validasinya jika input password tidak sesuai
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus Diisi!!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pembayaran Listrik';
            $this->load->view('templates/temp-pelanggan/log-header', $data);
            $this->load->view('Home/index');
            $this->load->view('templates/temp-pelanggan/log-footer');
        } else {
            //Jika Validasinya Sukses 
            $this->_masuk();
        }
    }

    // Buat private function untuk cek user saat login
    private function _masuk()
    {
        //Memanggil Model Pelanggan
        $this->load->model('Pelanggan_Model', 'pelanggan');

        //Membuat variabel $user yang berisi cek login pelanggan dari model
        $pelanggan =  $this->pelanggan->cekPelLogin();

        //Ambil input dari form password
        $password = $this->input->post('password');
        // jika usernya ada
        if ($pelanggan) {
            //cek passwordnya
            if (password_verify($password, $pelanggan['password'])) {
                // Buat variabel $data yang berisi username dan id_level
                $data = [
                    'id_pelanggan' => $pelanggan['id_pelanggan'],
                    'username' => $pelanggan['username']
                ];
                //VIsi session dengan variabel $data
                $this->session->set_userdata($data);

                //cek id_levelnya jika admin maka akan masuk sebagai admin
                if ($pelanggan['username']) {
                    //Pesan jika login berhasil
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda Berhasil Login!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button></div>');
                    redirect('pelanggan');
                    // echo 'Login Berhasil';
                } else {
                    //Jika bukan pelanggan maka admin
                    redirect('home');
                }
            } else {
                //Pesan jika password salah
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Salah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button></div>');
                //Maka akan dikembalikan kehalaman login
                redirect('home');
            }
        } else {
            //Pesan jika username belum registrasi
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username Belum Ada!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            //maka akan dikembalikan kehalaman login
            redirect('home');
        }
    }

    public function registrasi()
    {
        //Memanggil Model Pelanggan Dan Tarif
        $this->load->model('Pelanggan_Model', 'pelanggan');
        $this->load->model('Tarif_Model', 'tarif');

        //Ambil data user dari session
        //jika sudah login maka tidak bisa akses controller home
        if ($this->session->userdata('id_pelanggan')) {
            redirect('pelanggan');
        }
        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|is_unique[user.username]', [
            'required' => 'Username Harus Diisi!!',
            'min_length' => 'Username Terlalu Pendek!',
            'is_unique' => 'Username Sudah Ada'
        ]);

        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password Harus Diisi!!',
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Password Terlalu Pendek!'
        ]);

        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|min_length[3]', [
            'required' => 'Nama Harus Diisi!!',
            'min_length' => 'Nama Terlalu Pendek!'
        ]);

        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|numeric|min_length[6]', [
            'required' => 'Nomor Harus Diisi!!',
            'min_length' => 'Nomor Terlalu Pendek!',
            'numeric' => 'Harus Angka'
        ]);

        //Rules validasinya jika ada input yang tidak sesuai
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[6]', [
            'required' => 'Alamat Harus Diisi!!',
            'min_length' => 'Alamat Terlalu Pendek!'
        ]);
        //Panggil model user untuk digunakan
        $this->load->model('Pelanggan_Model', 'pelanggan');
        $data['tarif'] = $this->tarif->getAllTarif();
        if ($this->form_validation->run() == FALSE) {
            //Jika validasinya gagal maka akan dikembalikan ke halaman registrasi
            $data['title'] = 'Registrasi';
            $this->load->view('templates/temp-pelanggan/log-header', $data);
            $this->load->view('home/registrasi', $data);
            $this->load->view('templates/temp-pelanggan/log-footer');
        } else {
            //Jika berhasil maka akan menginput data user
            $this->pelanggan->insertPelanggan();
            //Pesan jika akun sudah berhasil teregistrasi
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Selamat Akun Anda Telah Teregistrasi!!, Silahkan Login<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('home');
        }
    }

    public function logout()
    {
        //Unset data pelanggan yang diambil berdasarkan username 
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_pelanggan');
        //Pesan logout berhasil dan akan dikembalikan kehalaman home
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda Telah Logout!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('home');
    }

    // Fungsi Blocked
    public function blocked()
    {
        $this->load->view('home/blocked');
    }
}
