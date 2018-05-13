<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lektor extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Lektor_model');
        $this->load->library('pagination');

    }

    public function index(){
        $data = array();
        //echo $this->input->post('insertLektor');
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $config = array();
        $config["base_url"] = base_url() . "/lektor/index";
        $config["total_rows"] = $this->Lektor_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        //  $config['use_page_numbers'] = TRUE;
        //$config['num_links'] = $this->Temperatures_model->record_count();
        $config['cur_tag_open'] = '&nbsp;<a class="page-link">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }



        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $data['lektors'] = $this->Lektor_model->getRowsStrankovanie($config["per_page"],$page);
        $data['title'] = 'Lektory zoznam';

        $this->load->view('template/header',$data);
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
                'Meno' => $this->input->post('Meno'),
                'Priezvisko' => $this->input->post('Priezvisko'),
            );

            //validacia zaslanych dat
            //vlozenie dat
            $insertLektor = $this->Lektor_model->insert($postData);

            if($insertLektor){
                $this->session->set_userdata('success_msg', 'Lektor pridaný.');
                redirect('/Lektor',$insertLektor);
            }else{
                $data['error_msg'] = 'Vyskytol sa problém skús znovu.';
            }

        }

        $data['post'] = $postData;
        $data['title'] = 'Nový lektor';
        $data['action'] = 'Pridaj';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation/index');
        $this->load->view('Lektor/pridaj-lektora', $data);
        $this->load->view('template/footer');
    }

    public function LektorKurz(){
        $data = array();


            if (isset($_GET['id']))
            {
                $idkurzu = $_GET['id'];

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

        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Lektor/kurzy_lektora',$data);
        $this->load->view('template/footer');
    }





    public function edit()
    {
        $id = $_GET['id'];
        $data = array();
        //ziskanie dat z tabulky
        $postData = $this->Lektor_model->getRows($id);

        foreach ($postData as $post)


            //zistenie, ci bola zaslana poziadavka na aktualizaciu
            if ($this->input->post('postSubmit')) {
                //definicia pravidiel validacie
                $this->form_validation->set_rules('Meno', 'Meno', 'required');
                $this->form_validation->set_rules('Priezvisko', 'Priezvisko', 'required');


                // priprava dat pre aktualizaciu
                $postData = array(
                    'Meno' => $this->input->post('Meno'),
                    'Priezvisko' => $this->input->post('Priezvisko'),


                );

                //validacia zaslanych dat
                if ($this->form_validation->run() == true) {
                    //aktualizacia dat
                    $update = $this->Lektor_model->update($postData, $id);

                    if ($update) {
                        $this->session->set_userdata('success_msg', 'Lektor upravený.');
                        redirect('/Lektor');
                    } else {
                        $data['error_msg'] = 'Problém pri úprave , skús neskôr.';
                    }
                }
            }

        $data['post'] = $post;
        $data['title'] = 'Uprava lektora';
        $data['action'] = 'Editovanie';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('Lektor/pridaj-lektora', $data);
        $this->load->view('template/footer');
    }


    public function OdstranLektora(){

        if (isset($_GET['id']) )
        {

            $idcko = $_GET['id'];

        }

        $zmazane= $this->Lektor_model->delete($idcko);

        if ($zmazane) {
            $this->session->set_userdata('success_msg', 'Lektor bol zmazaný.');
            redirect('/Lektor');
        } else {
            $data['error_msg'] = 'Vyskytol sa problém.';
        }




    }



}