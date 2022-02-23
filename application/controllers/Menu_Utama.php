<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_Utama extends CI_Controller
{
    public function index()
    {
        //jika sudah login maka tidak bisa akses 
        if ($this->session->userdata('username')) {
            redirect('pelanggan');
        }

        $data['title'] = 'Menu Utama';
        $this->load->view('templates/temp-menu/header', $data);
        $this->load->view('menu_utama/index');
        $this->load->view('templates/temp-menu/footer');
    }
}
