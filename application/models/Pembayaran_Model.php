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

    public function pembayaran($data)
    {
        //Tambah data menggunakan fungsi insert
        $this->db->insert('pembayaran', $data);
    }

    // Fungsi Hapus Tagihan
    public function hapusPembayaran($id)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('pembayaran', ['id_pembayaran' => $id]);
    }

    public function kodeOtomatis($tabel, $key)
    {
        $this->db->select('right(' . $key . ',3) as kode', false);
        $this->db->order_by($key, 'desc');
        $this->db->limit(1);

        $query = $this->db->get($tabel);
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodejadi = date('dmY') . $kodemax;
        return $kodejadi;
    }
}
