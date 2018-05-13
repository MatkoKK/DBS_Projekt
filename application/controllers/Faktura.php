<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktura extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Faktura_model');
        $this->load->library('pagination');
        $this->load->helper('string');

    }




    public function index(){
        $data = array();

        $this->data = $data;
        if($this->session->userdata('succes_msg')){
            $this->data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');

        }

        if($this->session->userdata('error_msg')){
            $this->data['error_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('error_msg');

        }

        $data['faktury'] = $this->Faktura_model->getRows("");
        $data['title'] = 'Faktury zoznam';

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('Faktura/zoznam',$data);
        $this->load->view('template/footer');
    }

    public  function vratFaktury(){
        $data = array();

        $this->data = $data;
        if($this->session->userdata('succes_msg')){
            $this->data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');

        }

        if($this->session->userdata('error_msg')){
            $this->data['error_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('error_msg');

        }

        $data['faktury'] = $this->Faktura_model->VratFaktury();
        $data['title'] = 'Zákazníci zoznam';

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('Zakaznik/ZoznamFaktur',$data);
        $this->load->view('template/footer');

    }


    public function VratPolozky(){

        $data = array();
        if (isset($_GET['id'])){
            $id = $_GET['id'];}

        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $data['polozky'] = $this->Faktura_model->Polozky($id);
        $data['title'] = 'Polozky faktury';

        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('faktura/polozky',$data);
        $this->load->view('template/footer');
        }


    function getdata()
    {
        $data = $this->Faktura_model->getRows();

        $responce= array();
        $responce->cols[] = array(
            "id" => "",
            "label" => "Topping",
            "pattern" => "",
            "type" => "string"
        );
        $responce->cols[] = array(
            "id" => "",
            "label" => "Total",
            "pattern" => "",
            "type" => "number"
        );
        foreach($data as $cd)
        {
            $responce->rows[]["c"] = array(
                array(
                    "v" => "$cd->meno",
                    "f" => null
                ) ,
                array(
                    "v" => (int)$cd->cena,
                    "f" => null
                )
            );
            echo $cd->meno;
        }


        echo json_encode($data);
    }


}