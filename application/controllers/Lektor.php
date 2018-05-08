<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lektor extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Lektor_model');

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

        $data['lektors'] = $this->Lektor_model->getRows("");
        $data['title'] = 'Lektory zoznam';

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('lektor/zobrazenie',$data);
        $this->load->view('template/footer');
    }

    // pridanie zaznamu



    public function PridajLektora(){
        $data = array();
        $postData = array();


        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')){
            if (isset($_GET['id']))
            {
                $idkurzu = $_GET['id'];
                echo $idkurzu;
            }

            //priprava dat pre vlozenie
            $postData = array(
                'idLektor' => $this->input->post('idlektor'),
                'idKurz' => $idkurzu,
            );

            //validacia zaslanych dat
            //vlozenie dat
            $insertLektor = $this->Kurzy_model->insert($postData);

            if($insertLektor){
                $this->session->set_userdata('success_msg', 'Temperature has been added successfully.');
                redirect('/kurzy');
            }else{
                $data['error_msg'] = 'Some problems occurred, please try again.';
            }

        }

        $data['users'] = $this->Kurzy_model->get_lektor_dropdown();
        $data['users_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create Temperature';
        $data['action'] = 'Pridaj';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation/index');
        $this->load->view('Kurzy/pridaj-lektora', $data);
        $this->load->view('template/footer');
    }

    public function LektorKurz(){
        $data = array();


            if (isset($_GET['id']))
            {
                $idkurzu = $_GET['id'];
                echo $idkurzu;
            }


        $this->data = $data;
        if($this->session->userdata('succes_msg')){
            $this->data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');

        }

        if($this->session->userdata('error_msg')){
            $this->data['error_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('error_msg');

        }
        if(empty($idkurzu)){
        $data['kurzs'] = $this->Lektor_model->KurzyLektora();}
        else{$data['kurzs'] = $this->Lektor_model->KurzyLektora($idkurzu);}
        $data['title'] = 'Lektory zoznam';

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('Lektor/kurzy_lektora',$data);
        $this->load->view('template/footer');
    }



}