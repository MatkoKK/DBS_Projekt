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

        $config = array();
        $config["base_url"] = base_url() . "/faktura/index";
        $config["total_rows"] = $this->Faktura_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        //  $config['use_page_numbers'] = TRUE;
        //$config['num_links'] = $this->Temperatures_model->record_count();
        $config['cur_tag_open'] = '&nbsp;<a class="page-link">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';

        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }



        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $data['faktury'] = $this->Faktura_model->getRowsStrankovanie($config["per_page"],$page);
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


    public function OdstranKurz(){

        if (isset($_GET['id']) && isset($_GET['idfaktura']))
        {


            $idcko = $_GET['id'];
            $idfaktura = $_GET['idfaktura'];


        }
        echo $idfaktura. $idcko;
        $zmazane= $this->Faktura_model->delete($idcko);

        if ($zmazane) {
            $this->session->set_userdata('success_msg', 'Kurz bol odobratý z faktúry s číslom :'.$idfaktura);
            redirect('/faktura/VratPolozky/?id='.$idfaktura);
        } else {
            $data['error_msg'] = 'Vyskytol sa problém.';
        }




    }

}