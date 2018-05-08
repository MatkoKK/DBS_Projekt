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


    public function insert($data = array()){

        $insert = $this->db->insert('kurzy',$data);

        if($insert){
        return  $this->db->insert_id();}
        else{
        return false;}

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

}




