<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_Model extends CI_Model
{
    // Membuat fungsi untuk menampilkan semua data tarif dengan join
    public function getAllTagihan()
    {
        //Join tabel tagihan, penggunaan, pelanggan,
        $queryTagihan = "SELECT `tagihan`.*, 
                                `pelanggan`.`nomor_kwh`, 
                                `pelanggan`.`nama_pelanggan`, 
                                `penggunaan`.`bulan`, 
                                `penggunaan`.`meter_awal`, 
                                `penggunaan`.`meter_akhir` 
                           FROM `tagihan` 
                           JOIN `penggunaan` ON `tagihan`.`id_penggunaan` = `penggunaan`.`id_penggunaan`
                           JOIN `pelanggan` ON `penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`";
        //Tampilkan semua data dari hasil join pelanggan dengan tarif
        return $this->db->query($queryTagihan)->result_array();
    }

    // Fungsi Hapus Tagihan
    public function hapusTagihan($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('tagihan', ['id_tagihan' => $id]);
    }

    //Cek data tagihan pelanggan
    public function cekTagihanPel($where = null)
    {
        //Cek data tagihan yang diambil dari view tagihan
        return $this->db->get_where('v_tagihan', $where)->row_array();
    }

    // Fungsi Cari Tagihan
    public function cariTagihan()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nama_pelanggan', $keyword);
        $this->db->or_like('nomor_kwh', $keyword);
        return $this->db->get('v_tagihan')->result_array();
    }
}
