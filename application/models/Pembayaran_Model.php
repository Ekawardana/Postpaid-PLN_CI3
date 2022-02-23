<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_Model extends CI_Model
{
    public function getAllPembayaran()
    {
        //Join tabel tagihan, penggunaan, pelanggan,
        $queryPembayaran = "SELECT `pembayaran`.*, 
                                   `pelanggan`.`nomor_kwh`, 
                                   `pelanggan`.`nama_pelanggan`, 
                                   `tagihan`.`jumlah_meter`, 
                                   `tagihan`.`status`,
                                   `user`.`nama_admin`,
                                   `tarif`.`tarif_perkwh`
                              FROM `pembayaran` 
                              JOIN `tagihan` ON `pembayaran`.`id_tagihan` = `tagihan`.`id_tagihan`
                              JOIN `pelanggan` ON `tagihan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`
                              JOIN `user` ON `pembayaran`.`id_user` = `user`.`id_user`
                              JOIN `tarif` ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        //Tampilkan semua data dari hasil join pelanggan dengan tarif
        return $this->db->query($queryPembayaran)->result_array();
    }

    public function pembayaran()
    {
        //Siapkan data yang nanti akan dimasukan ke tabel pembayaran
        $data = [
            'id_tagihan' => $this->input->post('id_tagihan', true),
            'id_pelanggan' => $this->input->post('id_pelanggan', true),
            'tgl_bayar' => time(),
            'bulan' => time(),
            'biaya_admin' => $this->input->post('biaya_admin', true),
            'total_bayar' => $this->input->post('total_bayar', true),
            'id_user' => $this->input->post('id_user', true),
        ];
        //Tambah data menggunakan fungsi insert
        $this->db->insert('pembayaran', $data);
    }

    // Fungsi Hapus Tagihan
    public function hapusPembayaran($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('pembayaran', ['id_pembayaran' => $id]);
    }
}
