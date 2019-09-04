<?php

class Mahasiswa_m extends CI_Model {
    public function getAllMhs($id = null)
    {
        if($id === NULL)
        {
            return $this->db->get('mahasiswa')->result_array();
        }else{
            return $this->db->get_where('mahasiswa',['id'=> $id])->result_array();
        }
    }

    public function deleteMhs($id)
    {
        $this->db->delete('mahasiswa',['id'=> $id]);
        return $this->db->affected_rows();
    }

    public function createMhs($data)
    {
        $this->db->insert('mahasiswa',$data);
        return $this->db->affected_rows();
    }

    public function updateMhs($data,$id)
    {
        $this->db->update('mahasiswa',$data,['id'=> $id]);
        return $this->db->affected_rows();
    }
}