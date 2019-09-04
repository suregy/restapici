<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Mahasiswa extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_m');
    }

    public function index_get(){
        $id = $this->get('id');
        if ($id == NULL)
        {
            $mhs = $this->mahasiswa_m->getAllMhs();
            $satu = [];
            $dua = [];
            $tiga = [];
            $empat = [];
            foreach($mhs as $m)
            {
                $mhsid = $m['id'];
                $dua['id'] = $m['id'];
                $dua['nrp'] = $m['nrp'];
                $dua['nama'] = $m['nama'];
                $dua['email'] = $m['email'];
                $dua['jurusan'] = $m['jurusan'];
                $dua['imageurl'] = base_url('upload/'.$m['image']);
                $dua['nilai'] = [];
                $dua['hobby'] = [];
                
                $nilai = $this->mahasiswa_m->getNilai($mhsid);
                foreach($nilai as $n)
                {
                    $tiga['idnilai'] = $n['id'];
                    $tiga['idmahasiswa'] = $n['mhs_id'];
                    $tiga['matkul'] = $n['matkul'];
                    $tiga['nilai'] = $n['nilai'];
                    array_push($dua['nilai'],$tiga);
                    //var_dump($tiga);
                }

                $hobby = $this->mahasiswa_m->getHobby($mhsid);
                foreach($hobby as $h)
                {
                    $empat['id'] = $h['id'];
                    $empat['hobby'] = $h['nama'];
                    array_push($dua['hobby'],$empat);
                }
                array_push($satu,$dua);
                //var_dump($satu);
            }
        }else{
            $mhs = $this->mahasiswa_m->getAllMhs($id);
        }
        if($mhs)
        {
            $this->response([
                'status' => true,
                'data' => $satu
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if($id === NULL)
        {
            $this->response([
                'status' => FALSE,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->mahasiswa_m->deleteMhs($id) > 0)
            {
                $this->response([
                    'status' => true,
                    'id' => $id
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nrp'=> $this->post('nrp'),
            'nama'=> $this->post('nama'),
            'jurusan'=> $this->post('jurusan'),
            'email'=> $this->post('email'),
            'image' => $this->uploadImage()
        ];

        //var_dump($data);

        if($this->mahasiswa_m->createMhs($data) > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'data berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'id not found'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp'=> $this->put('nrp'),
            'nama'=> $this->put('nama'),
            'jurusan'=> $this->put('jurusan'),
            'email'=> $this->put('email')
        ];

        if($this->mahasiswa_m->updateMhs($data,$id) > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'data berhasil diupdate'
            ], REST_Controller::HTTP_NO_CONTENT);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'data gagal di update'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function uploadImage()
    {
        $config['upload_path']   = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']	= FALSE;
        $config['encrypt_name'] = TRUE;
        $config['max_size']     = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if($this->upload->do_upload('image'))
        {
            $data =  $this->upload->data();
            $file_name = $data['file_name'];
            return $file_name;
        }else{
            return $this->upload->display_errors();
        }

    }

}