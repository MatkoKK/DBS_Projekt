<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Zakaznik_model extends CI_Model {


    function getRows($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('zakazik', array('idZakaznik' => $id));
            return $query->result_array();

        } else {
            $query = $this->db->get('zakazik');
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

    //  naplnenie selectu z tabulky users
    public function get_users_dropdown($id = ""){
        $this->db->order_by('priezvisko')
            ->select('idZakaznik,firma_meno,priezvisko')
            ->from('zakazik');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->idZakaznik] = $dropdown->firma_meno;
            }
            $dropdownlist[''] = 'Select a user ... ';
            return $dropdownlist;
        }
    }




    public function pridaj_zakaznika($data = array()){

        $insert = $this->db->insert('Zakazik',$data);

        if($insert){
            return  $this->db->insert_id();}
        else{
            return false;}

    }
}




