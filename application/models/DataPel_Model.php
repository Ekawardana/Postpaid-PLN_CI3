<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPel_Model extends CI_Model
{
    // Membuat fungsi untuk menampilkan semua data tarif dengan join
    public function getAllDataPel()
    {
        //Join tabel pelanggan dan tarif
        $queryDataAll = "SELECT *
                           FROM `pelanggan` JOIN `tarif`
                             ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        //Tampilkan semua data dari hasil join pelanggan dengan tarif
        return $this->db->query($queryDataAll)->result_array();
    }

    //Fungsi Get data by id dengan join
    public function getDataPelById($id)
    {
        //Join tabel pelanggan dan tarif where = id
        $queryDataPel = "SELECT *
                           FROM `pelanggan` JOIN `tarif`
                             ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`
                          WHERE `pelanggan`.`id_pelanggan` = $id";
        //Tampilkan data dari hasil join pelanggan dengan tarif berdasarkan id
        return $this->db->query($queryDataPel)->row_array();
    }

    // Membuat fungsi untuk menambah data tarif baru
    public function tambahDataPel()
    {
        //Siapkan data yang nanti akan di input
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'nomor_kwh' => htmlspecialchars($this->input->post('nomor_kwh', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'image' => 'default.jpg',
            'id_tarif' => htmlspecialchars($this->input->post('id_tarif', true))
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->insert('pelanggan', $data);
    }

    // Membuat fungsi untuk menambah data tarif baru
    public function ubahDataPel($where = null)
    {
        //Siapkan data yang nanti akan di update
        $data = [
            'nomor_kwh' => htmlspecialchars($this->input->post('nomor_kwh', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'id_tarif' => htmlspecialchars($this->input->post('id_tarif', true))
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->update('pelanggan', $data, $where);
    }

    //Membuat fungsi hapus data pelanggan
    public function hapusDataPel($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
    }

    public function cariDataPel()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nama_pelanggan', $keyword);
        $this->db->or_like('nomor_kwh', $keyword);
        return $this->db->get('v_pelanggan')->result_array();
    }
}
