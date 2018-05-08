<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Kurzy_model extends CI_Model {


    function getRows($id = "")
{
    if (!empty($id)) {
        $query = $this->db->get_where('kurzy', array('idKurzy' => $id));
        return $query->result_array();

    } else {
        $query = $this->db->get('kurzy');
        return $query->result_array();
    }
}


public function update($data,$id){
    if(!empty($data) && !empty($id)){
        $update = $this->db->update('kurzy',$data,array('id'=>$id));
        return $update?true:false;

    }
    else{return false;}

}


public function delete($id){
    $delete = $this->db->delete('kurzy',array('id'=>$id));
    return $delete?true:false;

}

    //  naplnenie selectu z tabulky users
    public function get_lektor_dropdown($id = ""){
        $this->db->order_by('Priezvisko')
            ->select('idLektor, CONCAT(Meno," ", Priezvisko) AS celeMeno')
            ->from('lektor');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->idLektor] = $dropdown->celeMeno;

            }
            $dropdownlist[''] = 'Vyber lektora ... ';
            return $dropdownlist;
        }
    }

    // vlozenie zaznamu
    public function insertLektor($data = array()) {
        $insert = $this->db->insert('lektor_kurz', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    // vlozenie zaznamu
    public function insert($data = array()) {
        $insert = $this->db->insert('kurzy', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

}





