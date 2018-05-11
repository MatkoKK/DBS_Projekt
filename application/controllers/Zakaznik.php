<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zakaznik extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Zakaznik_model');

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

        $data['zakaznici'] = $this->Zakaznik_model->getRows("");
        $data['title'] = 'Zákazníci zoznam';

        $this->load->view('template/header');
        $this->load->view('Zakaznik/zoznam-zakaznikov',$data);
        $this->load->view('template/footer');
    }

    // pridanie zaznamu
    public function add(){
        $data = array();
        $postData = array();

        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')){
            //definicia pravidiel validacie
            $this->form_validation->set_rules('meno', 'meno', 'required');



            //priprava dat pre vlozenie
            $postData = array(
                'meno' => $this->input->post('meno'),
                'priezvisko' => $this->input->post('priezvisko'),
                'ico' => $this->input->post('ico'),

            );

            //validacia zaslanych dat
            if($this->form_validation->run() == true){
                //vlozenie dat
                $insert = $this->Temperatures_model->insert($postData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Temperature has been added successfully.');
                    redirect('/temperatures');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        $data['users'] = $this->Kurzy_model->get_users_dropdown();
        $data['users_selected'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Create Temperature';
        $data['action'] = 'Add';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('templates/header', $data);
        $this->load->view('Kurzy/add-edit', $data);
        $this->load->view('templates/footer');
    }

    public function pridaj_zakaznika(){
        $data = array();
        $postData = array();

        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')){
            //definicia pravidiel validacie
            $this->form_validation->set_rules('meno', 'meno', 'required');


            //priprava dat pre vlozenie
            if($this->input->post('jefirma')=="")
            $postData = array(
                'firma_meno' => $this->input->post('meno'),
                'priezvisko' => $this->input->post('priezvisko'),
                'ICO' => $this->input->post('ico'),
                'JeFirma' => "0");


            else
            $postData = array(
                'firma_meno' => $this->input->post('meno'),
                'priezvisko' => $this->input->post('priezvisko'),
                'ICO' => $this->input->post('ico'),
                'JeFirma' => $this->input->post('jefirma'),

            );



            //validacia zaslanych dat
            if($this->form_validation->run() == true){
                //vlozenie dat
                $insert = $this->Zakaznik_model->pridaj_zakaznika($postData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Temperature has been added successfully.');
                    redirect('/Zakaznik/pridaj_zakaznika');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }


        $data['post'] = $postData;
        $data['title'] = 'Create Temperature';
        $data['action'] = 'Add';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('Zakaznik/pridaj-zkaznika', $data);
        $this->load->view('template/footer');
    }

}