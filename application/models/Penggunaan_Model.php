<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggunaan_Model extends CI_Model
{
    // Membuat fungsi untuk menampilkan semua data tarif
    public function getAllPenggunaan()
    {
        //Join tabel penggunaan, pelanggan, tarif
        $queryPenggunaanAll = "SELECT `penggunaan`.*,`pelanggan`.`nomor_kwh`, `pelanggan`.`nama_pelanggan`, `tarif`.`daya` 
                                 FROM `penggunaan` 
                                 JOIN `pelanggan` ON `penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`
                                 JOIN `tarif` ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        //Tampilkan semua data dari hasil join pelanggan dengan tarif
        return $this->db->query($queryPenggunaanAll)->result_array();
    }

    public function getPenggunanById($id)
    {
        //Join tabel penggunaan, pelanggan, tarif
        $queryPenggunaanId =  "SELECT `pelanggan`.`nomor_kwh`, `pelanggan`.`nama_pelanggan`, `penggunaan`.*, `tarif`.`daya` 
                                 FROM `penggunaan` 
                                 JOIN `pelanggan` ON `pelanggan`.`id_pelanggan` = `penggunaan`.`id_pelanggan`
                                 JOIN `tarif` ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`
                                 WHERE `penggunaan`.`id_penggunaan` = $id";
        //Tampilkan semua data dari hasil join pelanggan dengan tarif
        return $this->db->query($queryPenggunaanId)->row_array();
    }

    // Fungsi Untuk Memanggil Semua Bulan
    public function getBulan()
    {
        return $this->db->get('bulan')->result_array();
    }

    public function tambahPenggunaan()
    {
        //Siapkan data yang nanti akan di input
        $data = [
            'id_pelanggan' => $this->input->post('id_pelanggan', true),
            'bulan' => $this->input->post('bulan', true),
            'tahun' => date('Y'),
            'meter_awal' => $this->input->post('meter_awal', true),
            'meter_akhir' => $this->input->post('meter_akhir', true)
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->insert('penggunaan', $data);
    }

    public function ubahPenggunaan($where = null)
    {
        //Siapkan data yang nanti akan di input
        $data = [
            'bulan' => $this->input->post('bulan', true),
            // 'tahun' => date('Y'),
            'meter_awal' => $this->input->post('meter_awal', true),
            'meter_akhir' => $this->input->post('meter_akhir', true)
        ];

        //Tambah data menggunakan fungsi insert
        $this->db->update('penggunaan', $data, $where);
    }

    //Membuat fungsi hapus data pelanggan
    public function hapusPenggunaan($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('penggunaan', ['id_penggunaan' => $id]);
    }

    // Fungsi Cari Data Pelanggan
    public function cariPenggunaan()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nama_pelanggan', $keyword);
        $this->db->or_like('nomor_kwh', $keyword);
        return $this->db->get('v_penggunaan')->result_array();
    }
}
