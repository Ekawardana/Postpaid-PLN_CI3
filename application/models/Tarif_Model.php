<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_Model extends CI_Model
{
    // Membuat fungsi untuk menampilkan semua data tarif
    public function getAllTarif()
    {
        return $this->db->get('tarif')->result_array();
    }

    // Membuat fungsi untuk menambah data tarif baru
    public function tambahTarif()
    {
        //Siapkan data yang nanti akan di input
        $data = [
            'daya' => $this->input->post('daya', true),
            'tarif_perkwh' => $this->input->post('tarif_perkwh', true)
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->insert('tarif', $data);
    }

    //Membuat fungsi getTarifById untuk ambil id dari masing data
    public function getTarifById($id)
    {
        //Ambil data berdasarkan id saat diklik
        return $this->db->get_where('tarif', ['id_tarif' => $id])->row_array();
    }

    //Membuat fungsi update data tarif
    public function ubahTarif($where = null)
    {
        //Siapkan data yang akan diupdate berdasarkan where = id
        $data = [
            'daya' => $this->input->post('daya', true),
            'tarif_perkwh' => $this->input->post('tarif_perkwh', true)
        ];
        //Ubah data menggunakan fungsi update
        $this->db->update('tarif', $data, $where);
    }

    //Membuat fungsi hapus data tarif
    public function hapusTarif($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('tarif', ['id_tarif' => $id]);
    }
}
