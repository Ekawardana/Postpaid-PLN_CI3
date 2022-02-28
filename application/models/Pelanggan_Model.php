<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model
{
    //Cek pelanggans aat login
    public function cekPelLogin()
    {
        //Variabel $username berisi input dari form username
        $username = $this->input->post('username');
        //Ambil data dari tabel user berdasarkan username
        return $this->db->get_where('pelanggan',  ['username' => $username])->row_array();
    }

    //Cek data pelanggan dari session
    public function cekDataPel($where = null)
    {
        //Cek data user yang diambil dari view qw admin
        return $this->db->get_where('pelanggan', $where);
    }
    //Cek data pelanggan dari session
    public function cekPelanggan($where = null)
    {
        //Cek data user yang diambil dari view qw admin
        return $this->db->get_where('v_pelanggan', $where);
    }

    //Fungsi insert dari database
    public function insertPelanggan()
    {
        //Siapkan data yang nanti akan di input
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'nomor_kwh' => htmlspecialchars($this->input->post('nomor_kwh', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'image' => 'default.jpg',
            'id_tarif' => htmlspecialchars($this->input->post('id_tarif', true))
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->insert('pelanggan', $data);
    }
}
