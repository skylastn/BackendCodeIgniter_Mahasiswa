<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        // echo "coba";
        $where['id'] = $id;
        if ($id == '') {
            $kontak['listmhs'] = $this->db->select('*')->from('mahasiswa')->get()->result();
        } else {
            $this->db->where('id', $id);
            $kontak['listmhs'] = $this->db->select('*')->from('mahasiswa')->where($where)->get()->row();
        }
        $this->response($kontak, 200);
    }

    function add_mahasiswa_post() {
        $data = array(
                    'id'            => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'email'         => $this->post('email'),
                    'tempat_lahir'  => $this->post('tempat_lahir'),
                    'alamat'        => $this->post('alamat'),
                    'asal_sekolah'  => $this->post('asal_sekolah'),
                    'kota'          => $this->post('kota'),
                    'provinsi'      => $this->post('provinsi'),
                    'tgl_lahir'     => $this->post('tgl_lahir'));
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $result['status'] = true;
            $result['data'] = $data;
            $this->response($result, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini

    function prov_get() {
        $id = $this->get('id');
        $where['id'] = $id;
        if ($id == '') {
            $kontak['listprov'] = $this->db->select('*')->from('provinces')->get()->result();
        } else {
            $this->db->where('id', $id);
            $kontak['listprov'] = $this->db->select('*')->from('provinces')->where($where)->get()->row();
        }
        $this->response($kontak, 200);
    }
    
    
    
    function kota_get() {
        $province_id = $this->get('province_id');
        $where['province_id'] = $province_id;
        if ($province_id == '') {
            $kontak['listkota2'] = $this->db->select('*')->from('regencies')->get()->result();
        } else {
            $this->db->where('province_id', $province_id);
            $kontak['listkota'] = $this->db->select('*')->from('regencies')->where($where)->get()->result();
        }
        $this->response($kontak, 200);
    }
    
    
}
?>