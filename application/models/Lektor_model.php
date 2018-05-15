<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Lektor_model extends CI_Model {


    function getRows($id = "")
    {


        if (!empty($id)) {

            $query = $this->db->get_where('lektor', array('idLektor' => $id));
            return $query->result_array();

        } else {
            $query = $this->db->get('lektor');
            return $query->result_array();
        }
    }


    function getRowsStrankovanie($limit,$start){

           $this->db->limit($limit,$start);
           $query = $this->db->get("lektor");
           if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                   $data[] = $row;
               }
               return $data;
           }
           return false;

    }

    public function record_count (){
        return $this->db->count_all("lektor");
    }



    public function insert($data = array()){

        $insert = $this->db->insert('lektor',$data);

        if($insert){
            return  true;}
        else{
            return false;}

    }


    public function update($data,$id){
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('lektor',$data,array('idLektor'=>$id));
            return $update?true:false;

        }
        else{return false;}

    }


    public function delete($id){

        $this->db->delete( 'Lektor_Kurz',array('idLektor'=>$id));
        $delete = $this->db->delete( 'lektor',array('idLektor'=>$id));



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

    function KurzyLektora($id) {
        if(empty($id)){
        $this->db->select('lektor.Meno as meno,lektor.Priezvisko as priezvisko, kurzy.Nazov as kurz')
            ->from('lektor_kurz')
            ->join('lektor','lektor_kurz.idLektor = lektor.idLektor')
            ->join('kurzy','lektor_kurz.idKurz = kurzy.idKurzy');
            $query = $this->db->get();
            return $query->result_array();
        }
        else {
                $this->db->select('lektor.Meno as meno,lektor.Priezvisko as priezvisko, kurzy.Nazov as kurz')
                    ->join('lektor','lektor_kurz.idLektor = lektor.idLektor')
                    ->join('kurzy','lektor_kurz.idKurz = kurzy.idKurzy');
                $query = $this->db->get_where('lektor_kurz', array('lektor.idLektor' => $id));
            return $query->result_array();

                }






    }

}




