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

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('home',$data);
        $this->load->view('template/footer');
    }

    // pridanie zaznamu
    public function add(){
        $data = array();
        $postData = array();

        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')){
            //definicia pravidiel validacie
            $this->form_validation->set_rules('nazov_kurzu', 'Nazov kurz', 'required');
            $this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('cena', 'cena', 'required');


            //priprava dat pre vlozenie
            $postData = array(
                'nazov' => $this->input->post('nazov_kurzu'),
                'level' => $this->input->post('level'),
                'cena' => $this->input->post('cena'),

            );

            //validacia zaslanych dat
            if($this->form_validation->run() == true){
                //vlozenie dat
                $insert = $this->Kurzy_model->insert($postData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Temperature has been added successfully.');
                    redirect('/kurzy');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Kurzy_model->get_lektor_dropdown();
        $data['users_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create Temperature';
        $data['action'] = 'Pridaj';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('Kurzy/pridaj-kurz', $data);
        $this->load->view('template/footer');
    }


    public function pridaj_lektora(){
        $data = array();
        $postData = array();


        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')){
            if (isset($_GET['id']))
            {
                $idkurzu = $_GET['id'];

            }


            //priprava dat pre vlozenie
            $postData = array(
                'idLektor' => $this->input->post('idecko'),
                'idKurz' => $idkurzu,
            );



            //vlozenie dat
                $insertLektor = $this->Kurzy_model->insertLektor($postData);

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


    public function odstran_lektora(){


    }

}