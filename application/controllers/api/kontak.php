<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        $where['id'] = $id;
        if ($id == '') {
            $kontak = $this->db->select('versi')->from('versi_wa')->get()->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->select('versi')->from('versi_wa')->where($where)->get()->row();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini

    function coba_get() {
        $id = $this->get('id');
        $where['id'] = $id;
        if ($id == '') {
            $kontak = $this->db->select('versi AS nama')->from('versi_wa')->get()->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->select('versi AS nama')->from('versi_wa')->where($where)->get()->row();
        }
        $this->response($kontak, 200);
    }
}
?>