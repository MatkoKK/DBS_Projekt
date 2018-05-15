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

    function getRowsStrankovanie($limit,$start){

        $this->db->limit($limit,$start);
        $query = $this->db->get("zakazik");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    public function record_count (){
        return $this->db->count_all("zakazik");
    }


    public function insert($data = array()){

        $insert = $this->db->insert('kurzy',$data);

        if($insert){
            return  true;}
        else{
            return false;}

    }


    public function update($data,$id){
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('zakazik',$data,array('idZakaznik'=>$id));
            return $update?true:false;

        }
        else{return false;}

    }


    public function delete($id){

        $this->db->delete( 'Zakaznik_Kurz',array('idzakaznik'=>$id));
        $delete = $this->db->delete( 'zakazik',array('idZakaznik'=>$id));



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
            return  true;}
        else{
            return false;}

    }
/*Kupenie kurzu pre zakaznika*/
    public function pridanieKurzu($data = array()){

        $insert = $this->db->insert('Zakazik',$data);

        if($insert){
            return  $this->db->insert_id();}
        else{
            return false;}
    }

    public function fakturyZakaznika(){
        if(!empty($id)){
            $this->db->select('zakazik.Firma_Meno as zMeno,faktura.DATUM as datum,kurzy.Nazov as nazovKurz')
                ->join('kurzy','zakaznik_kurz.IDkurz=kurzy.idKurzy')
                ->join('zakazik','zakaznik_kurz.IDzakaznik = zakazik.idZakaznik')
                ->join('faktura','faktura.idFaktura=zakaznik_kurz.IDfaktura');
            $query = $this->db->get_where('zakaznik_kurz', array('zakaznik.idZakaznik' => $id));
            return $query->row_array();
        }else{
            $this->db->select('zakazik.Firma_Meno as zMeno,faktura.DATUM as datum,kurzy.Nazov as nazovKurz')
                ->join('kurzy','zakaznik_kurz.IDkurz=kurzy.idKurzy')
                ->join('zakazik','zakaznik_kurz.IDzakaznik = zakazik.idZakaznik')
                ->join('faktura','faktura.idFaktura=zakaznik_kurz.IDfaktura');
            $query = $this->db->get('zakaznik_kurz');
            return $query->result_array();
        }
    }


    public function kupaKurzu($data = array()){

        $insert = $this->db->insert('zakaznik_kurz',$data);

        if($insert){
            return  true;}
        else{
            return false;}

    }


    public function get_faktura_dropdown($id = ""){
        $this->db->order_by('idFaktura')
                ->select('idFaktura')
            ->from('faktura');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->idFaktura] = $dropdown->idFaktura ;

            }
            $dropdownlist[''] = 'Nova faktura ';
            return $dropdownlist;
        }
    }

    public function get_kurz_dropdown($id = ""){
        $this->db->order_by('zobraz')
            ->select('idKurzy, CONCAT(Nazov," ", Level) AS zobraz')
            ->from('Kurzy');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dropdowns = $query->result();
            foreach ($dropdowns as $dropdown)
            {
                $dropdownlist[$dropdown->idKurzy] = $dropdown->zobraz ;

            }
            $dropdownlist[''] = 'Vyber kurz ... ';
            return $dropdownlist;
        }
    }
}




