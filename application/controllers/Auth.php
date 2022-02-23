<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        //Ambil data user dari session
        //jika sudah login maka tidak bisa akses controller auth
        if ($this->session->userdata('username')) {
            redirect('admin');
        }

        //Rules validasinya jika input tidak sesuai 
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username Harus Diisi!!',
        ]);
        //Rules validasinya jika input password tidak sesuai
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus Diisi!!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            //Jika Validasinya Gagal
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //Jika Validasinya Sukses 
            $this->_login();
        }
    }

    // Buat private function untuk cek user saat login
    private function _login()
    {
        //Memanggil Model User
        $this->load->model('User_Model', 'user');

        //Membuat variabel $user yang berisi cek login user dari model
        $user =  $this->user->cekUserLogin();

        //Ambil input dari form password
        $password = $this->input->post('password');

        // jika usernya ada
        if ($user) {
            //cek passwordnya
            if (password_verify($password, $user['password'])) {
                // Buat variabel $data yang berisi username dan id_level
                $data = [
                    'username' => $user['username'],
                    'id_user' => $user['id_user'],
                    'id_level' => $user['id_level']
                ];
                //VIsi session dengan variabel $data
                $this->session->set_userdata($data);

                //cek id_levelnya jika admin maka akan masuk sebagai admin
                if ($user['id_level'] == 1) {
                    //Pesan jika login berhasil
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda Berhasil Login!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button></div>');
                    redirect('admin');
                    // echo 'Login Berhasil';
                } else {
                    //Jika bukan admin 
                    redirect('auth');
                }
            } else {
                //Pesan jika password salah
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Salah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button></div>');
                //Maka akan dikembalikan kehalaman login
                redirect('auth');
            }
        } else {
            //Pesan jika username belum registrasi
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username Belum Teregistrasi!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            //maka akan dikembalikan kehalaman login
            redirect('auth');
        }
    }

    public function registrasi()
    {
        //Ambil data user dari session
        //jika sudah login maka tidak bisa akses controller auth
        if ($this->session->userdata('username')) {
            redirect('profile');
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
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|min_length[3]', [
            'required' => 'Nama Harus Diisi!!',
            'min_length' => 'Nama Terlalu Pendek!'
        ]);
        //Panggil model user untuk digunakan
        $this->load->model('User_Model', 'user');
        if ($this->form_validation->run() == FALSE) {
            //Jika validasinya gagal maka akan dikembalikan ke halaman registrasi
            $data['title'] = 'Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            //Jika berhasil maka akan menginput data user
            $this->user->insertAdmin();
            //Pesan jika akun sudah berhasil teregistrasi
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Selamat Akun Anda Telah Teregistrasi!!, Silahkan Login<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('auth');
        }
    }

    // Fungsi Logout
    public function logout()
    {
        //Unset data user yang diambil berdasarkan username dan id_level
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_level');
        //Pesan logout berhasil dan akan dikembalikan kehalaman auth/login
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda Telah Logout!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('auth');
    }

    // Fungsi Blocked
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
