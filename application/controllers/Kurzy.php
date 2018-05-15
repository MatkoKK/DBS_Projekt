<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurzy extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Kurzy_model');
        $this->load->library('pagination');

    }

    public function index(){
        $data = array();

        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

/*Strankovanie config*/
        $config = array();
        $config["base_url"] = base_url() . "/Kurzy/index";
        $config["total_rows"] = $this->Kurzy_model->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        //  $config['use_page_numbers'] = TRUE;
        //$config['num_links'] = $this->Temperatures_model->record_count();
        $config['cur_tag_open'] = '&nbsp;<a class="page-link">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'ďalšia';
        $config['prev_link'] = 'predchádzajúca';

        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }



        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );



        $data['kurzy'] = $this->Kurzy_model->getRowsStrankovanie($config["per_page"],$page);;
        $data['title'] = 'Kurzy zoznam';

        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('home',$data);
        $this->load->view('template/footer');
    }



    // pridanie zaznamu
    public function add(){
        $data = array();
        $postData = array();

        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

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
                    $this->session->set_userdata('success_msg', 'Kurz bol pridaný.');
                    redirect('/kurzy');
                }else{
                    $data['error_msg'] = 'Problém, skús znovu.';
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



/* Priradenie Lektora ku kurzu*/
    public function pridaj_lektora(){
        $data = array();
        $postData = array();


        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        if($this->input->post('postSubmit')) {

            if (isset($_GET['id'])){
                $idkurzu = $_GET['id'];}




                //definicia pravidiel validacie
                $this->form_validation->set_rules('idecko', 'idecko', 'required');

                //priprava dat pre vlozenie
                $postData = array(
                    'idLektor' => $this->input->post('idecko'),
                    'idKurz' => $idkurzu,
                );


                //vlozenie dat
                if ($this->form_validation->run() == true) {
                    $insertLektor = $this->Kurzy_model->insertLektor($postData);

                    if ($insertLektor) {
                        $this->session->set_userdata('success_msg', 'Lektor priradeny.');
                        redirect('/kurzy');
                    } else {
                        $data['error_msg'] = 'Vyskytol sa problém.';
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
        $this->load->view('template/navigation/index');
        $this->load->view('Kurzy/pridaj-lektora', $data);
        $this->load->view('template/footer');
    }





    public function odstran_lektora(){

        if (isset($_GET['id']) && isset($_GET['idRow']))
        {
            $idKurzu = $_GET['id'];
            $idcko = $_GET['idRow'];

        }

        $this->Kurzy_model->vymazLektora($idcko);


        $this->KurzLektory();


    }


    public function OdstranKurz(){

        if (isset($_GET['id']) )
        {

            $idcko = $_GET['id'];

        }

       $zmazane= $this->Kurzy_model->delete($idcko);

        if ($zmazane) {
            $this->session->set_userdata('success_msg', 'Kurz bol zmazaný.');
            redirect('/Kurzy');
        } else {
            $data['error_msg'] = 'Vyskytol sa problém.';
        }




    }




    public function KurzLektory(){
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
            $data['kurzs'] = $this->Kurzy_model->KurzyLektora();}
        else{$data['kurzs'] = $this->Kurzy_model->KurzyLektora($idkurzu);}
        $data['title'] = 'Lektory v kurze zoznam';

        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('Kurzy/kurzlektory',$data);
        $this->load->view('template/footer');
    }

    public function edit()
    {
        $id=$_GET['id'];
        $data = array();
        //ziskanie dat z tabulky
        $postData = $this->Kurzy_model->getRows($id);

        foreach ($postData as $post)


        //zistenie, ci bola zaslana poziadavka na aktualizaciu
        if ($this->input->post('postSubmit')) {
            //definicia pravidiel validacie
            $this->form_validation->set_rules('nazov_kurzu', 'nazov ', 'required');
            $this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('cena', 'cena', 'required');


            // priprava dat pre aktualizaciu
            $postData = array(
                'Nazov' => $this->input->post('nazov_kurzu'),
                'Level' => $this->input->post('level'),
                'Cena' => $this->input->post('cena'),

            );

            //validacia zaslanych dat
            if ($this->form_validation->run() == true) {
                //aktualizacia dat
                $update = $this->Kurzy_model->update($postData, $id);

                if ($update) {
                    $this->session->set_userdata('success_msg', 'Temperature has been updated successfully.');
                    redirect('/Kurzy');
                } else {
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }



        $data['post'] = $post;
        $data['title'] = 'Update Kurz';
        $data['action'] = 'Edit';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('Kurzy/pridaj-kurz', $data);
        $this->load->view('template/footer');
    }

    public function index_pagination(){
        $data = array();

        //ziskanie sprav zo session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $config = array();
        $config["base_url"] = base_url() . "index.php/kurzy/index_pagination";
        $config["total_rows"] = $this->Kurzy_model->record_count();
        $config["per_page"] = 1;
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



        $data["kurzy"] = $this->Kurzy_model->fetch_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $data['records_per_user'] = $this->Kurzy_model->record_count_per_user();
        $data['json_records_per_user'] = json_encode($this->Kurzy_model->record_count_per_user_array());

        // $data['temperatures'] = $this->Temperatures_model->getRows();
        $data['title'] = 'Temperature List';

        //nahratie zoznamu teplot
        $this->load->view('template/header', $data);
        $this->load->view('Kurzy/strankovanie', $data);
        $this->load->view('template/footer');
    }


    public function Faktura_kurz(){
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
            $insertLektor = $this->Faktury_model->insert($postData);

            if($insertLektor){
                $this->session->set_userdata('success_msg', 'Kurz bol pridaný do faktúry.');
                redirect('/kurzy');
            }else{
                $data['error_msg'] = 'Problem.';
            }

        }

        $data['users'] = $this->Zakaznik_model->get_zakaznik_dropdown();
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
}