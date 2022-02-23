<?php
defined('BASEPATH') or exit('No Direct Access Script allowed');

class Testunit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Pelanggan_Model', 'pelanggan');
    }

    private function login()
    {
        $pelanggan = $this->pelanggan->cekDataPel(['username' => $this->session->userdata('username')])->row_array();

        return $pelanggan['username'];
    }

    public function index()
    {
        echo "Pengujian Unit Test CI";
        // Fungsi Test  
        $test = $this->login('pelanggan'); // Parameter Bisa di isi nama dari table
        $expected_result = 'ekaskitz';
        $test_name = "Test Login Pelanggan";
        $notes = "Jika password bertipe data integer maka login gagal";
        echo $this->unit->run($test, $expected_result, $test_name, $notes);
    }
}
