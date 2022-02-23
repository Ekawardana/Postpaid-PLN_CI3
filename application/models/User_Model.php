<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    //Cek user saat login
    public function cekUserLogin()
    {
        //Variabel $username berisi input dari form username
        $username = $this->input->post('username');
        //Ambil data dari tabel user berdasarkan username
        return $this->db->get_where('user',  ['username' => $username])->row_array();
    }

    //Panggil semua user 
    public function getAllUser()
    {
        //Cek data user yang diambil dari view qw admin
        return $this->db->get('qw_admin')->row_array();
    }

    //Cek data user dari session
    public function cekDataUser($where = null)
    {
        //Cek data user yang diambil dari view qw admin
        return $this->db->get_where('qw_admin', $where);
    }

    //Fungsi insert dari database
    public function insertAdmin()
    {
        //Variabel $data yang berisi data yang akan diinsert 
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'nama_admin' => htmlspecialchars($this->input->post('nama_admin', true)),
            'id_level' => 1,
            'image' => 'default.jpg',
        ];
        //Fungsi insert dari database 
        $this->db->insert('user', $data);
    }

    //Fungsi ubah data user
    public function ubahUser()
    {
        // Siapkan data yang akan diupdate
        $name = $this->input->post('nama_admin');
        $username = $this->input->post('username');

        //Data yang diubah
        $this->db->set('nama_admin', $name);
        //Data yang diupdate diambil berdasarkan username
        $this->db->where('username', $username);
        //Panggil fungsi update data
        $this->db->update('user');
    }

    // Fungsi Ubah Password
    public function ubahPassword()
    {
        // Variabel password lama untuk ambil data password lama dari form
        $password_lama = $this->input->post('password_lama');

        // Variabel password lama untuk ambil data password lama dari form
        $password_baru = $this->input->post('password_baru1');

        // Ambil data user dari session
        $data['user'] = $this->user->cekDataUser(['username' => $this->session->userdata('username')])->row_array();

        // Cek jika password lama tidak sama 
        if (!password_verify($password_lama, $data['user']['password'])) {
            // Tampil Pesan Eror
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Salah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ubahPassword');
        } else {
            // Cek jika password lama sama dengan password yang baru
            if ($password_lama == $password_baru) {
                // Tampil Pesan Eror
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Baru Tidak Boleh Sama Dengan Password Lama!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/ubahPassword');
            } else {
                // Jika Passwordnya Sudah Ok
                $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('user');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password Telah Diubah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/ubahPassword');
            }
        }
    }
}
