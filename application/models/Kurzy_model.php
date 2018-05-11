<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Kurzy_model extends CI_Model {


    function getRows($id)
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
        $update = $this->db->update('kurzy',$data,array('idKurzy'=>$id));
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
                $dropdownlist[$dropdown->idLektor] = $dropdown->celeMeno ;

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


    function KurzyLektora($id) {
        if(empty($id)){
            $this->db->select('lektor_kurz.id as id,lektor_kurz.idKurz as idKurz,lektor.Meno as meno,lektor.Priezvisko as priezvisko, kurzy.Nazov as kurz')
                ->from('lektor_kurz')
                ->join('lektor','lektor_kurz.idLektor = lektor.idLektor')
                ->join('kurzy','lektor_kurz.idKurz = kurzy.idKurzy');
            $query = $this->db->get();
            return $query->result_array();
        }
        else {
            $this->db->select('lektor_kurz.id as id ,lektor_kurz.idKurz as idKurz,lektor.Meno as meno,lektor.Priezvisko as priezvisko, kurzy.Nazov as kurz')
                ->join('lektor','lektor_kurz.idLektor = lektor.idLektor')
                ->join('kurzy','lektor_kurz.idKurz = kurzy.idKurzy');
            $query = $this->db->get_where('lektor_kurz', array('kurzy.idKurzy' => $id));
            return $query->result_array();

        }
    }

    public function vymazLektora($id){
        $delete = $this->db->delete('lektor_kurz',array('id'=>$id));
        return $delete?true:false;

    }

    public function fetch_data($limit,$start) {
        $this->db->limit($limit,$start);
        $query = $this->db->get("kurzy");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function record_count_per_user() {
        //$this->db->select('');
        $this->db->from('lektor');
        //$this->db->join('users','temperatures.user = users.id');
        //$this->db->group_by('temperatures.user');
        return $this->db->get();
    }

    public function record_count_per_user_array() {
       // $this->db->select('CONCAT(lastname," ", firstname) AS user, COUNT(temperatures.id) AS counts');
        $this->db->from('kurzy');
        //$this->db->join('users','temperatures.user = users.id');
        //$this->db->group_by('temperatures.user');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function record_count (){
        return $this->db->count_all("kurzy");
    }

}





