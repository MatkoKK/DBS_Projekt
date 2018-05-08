<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurzy extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Kurzy_model');

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

        $data['kurzy'] = $this->Kurzy_model->getRows("");
        $data['title'] = 'Kurzy zoznam';

        $this->load->view('template/header',$data);
        $this->load->view('home',$data);
        $this->load->view('template/footer');
    }

}