<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Faktura_model extends CI_Model {





    function getRows($id = "")
    {
        if (!empty($id)) {
            $this->db->select('zakazik.Firma_Meno,faktura.DATUM')
                ->from('zakaznik_kurz')
                ->join('zakazik ','zakazik.idZakaznik=zakaznik_kurz.IDzakaznik')
                ->join('faktura ','zakaznik_kurz.IDfaktura='.$id);
            $query = $this->db->get();
            return $query->result_array();

        } else {
            $this->db->select('faktura.idFaktura as id,zakazik.Firma_Meno as meno,faktura.DATUM as datum ,SUM(kurzy.Cena) as cena')
                ->from('zakaznik_kurz')
                ->join('kurzy ','zakaznik_kurz.IDkurz=kurzy.idKurzy')
                ->join('zakazik ','zakazik.idZakaznik=zakaznik_kurz.IDzakaznik')
                ->join('faktura ','faktura.idFaktura=zakaznik_kurz.IDfaktura')
               ->group_by('faktura.idFaktura');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    function getRowsStrankovanie($limit,$start){

        $this->db->select('faktura.idFaktura as id,zakazik.Firma_Meno as meno,faktura.DATUM as datum ,SUM(kurzy.Cena) as cena')
            ->from('zakaznik_kurz')
            ->join('kurzy ','zakaznik_kurz.IDkurz=kurzy.idKurzy')
            ->join('zakazik ','zakazik.idZakaznik=zakaznik_kurz.IDzakaznik')
            ->join('faktura ','faktura.idFaktura=zakaznik_kurz.IDfaktura')
            ->group_by('faktura.idFaktura');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    public function record_count (){
        return $this->db->count_all("faktura");
    }


    public function NovaFaktura($data = array()){

        $insert = $this->db->insert('faktura',$data);

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
        $delete = $this->db->delete('zakaznik_kurz',array('id'=>$id));
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

    public function VratFaktury() {
        $this->db->select('SUM(kurzy.Cena) as cena');
        $this->db->from('zakaznik_kurz')
        ->join('kurzy','zakaznik_kurz.IDkurz=kurzy.idKurzy')
            ->join('zakazik','zakaznik_kurz.IDzakaznik = zakazik.idZakaznik')
            ->join('faktura','faktura.idFaktura=zakaznik_kurz.IDfaktura');
        $this->db->group_by('faktura.idFaktura');
        return $this->db->get();
    }


    function Polozky($id)
    {
        $this->db->select('zakaznik_kurz.id as idcko,kurzy.Nazov as nazov,kurzy.Cena as cena,zakaznik_kurz.IDfaktura as idfaktura,kurzy.Level as lvl')
                ->from('zakaznik_kurz')
                ->join('kurzy ','kurzy.idKurzy=zakaznik_kurz.IDkurz')
                ->join('faktura ','zakaznik_kurz.IDfaktura=faktura.idFaktura');
        $query = $this->db->get_where('', array('faktura.idFaktura' => $id));
            return $query->result_array();


    }



}




