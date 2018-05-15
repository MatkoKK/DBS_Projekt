<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zakaznik extends CI_Controller {



    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Zakaznik_model');
        $this->load->model('Faktura_model');
        $this->load->library('pagination');

    }

    public function index(){
        $data = array();


        $this->data = $data;

        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $config = array();
        $config["base_url"] = base_url() . "/zakaznik/index";
        $config["total_rows"] = $this->Zakaznik_model->record_count();
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

        $data['zakaznici'] = $this->Zakaznik_model->getRowsStrankovanie($config["per_page"],$page);
        $data['title'] = 'Zákazníci zoznam';

        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Zakaznik/zoznam-zakaznikov',$data);
        $this->load->view('template/footer');
    }


    // pridanie zaznamu
    public function pridaj_zakaznika(){
       /* $data = array();
        $postData = array();
        $firma=$_GET['firma'];
        if(firma==1){
            $Meno='Konatel';
            $Firma='Nazov firmy';
            $Ico='ICO';
            }
            else{
                $Meno='Meno';
                $Firma='Priezvisko';
                $Ico='ICO';
            }
*/

        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        $postData ='';
        if($this->input->post('postSubmit')){
            //definicia pravidiel validacie
            $this->form_validation->set_rules('meno', 'meno', 'required');


            //priprava dat pre vlozenie
            if($this->input->post('jefirma')=="")
            $postData = array(
                'Firma_Meno' => $this->input->post('meno'),
                'firma_priezvisko' => $this->input->post('priezvisko'),
                'ICO' => $this->input->post('ico'),
                'JeFirma' => "0");


            else
            $postData = array(
                'firma_meno' => $this->input->post('meno'),
                'firma_priezvisko' => $this->input->post('priezvisko'),
                'ICO' => $this->input->post('ico'),
                'JeFirma' => $this->input->post('jefirma'),

            );



            //validacia zaslanych dat
            if($this->form_validation->run() == true){
                //vlozenie dat
                $insert = $this->Zakaznik_model->pridaj_zakaznika($postData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Zákazník bol pridaný.');
                    redirect('Zakaznik');
                }else{
                    $data['error_msg'] = 'Problém, skús znovu.';
                }
            }
        }


        $data['post'] = $postData;
        $data['title'] = 'Pridaj zakaznika';
        $data['action'] = 'Pridaj';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('Zakaznik/pridaj-zkaznika', $data);
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

        $data['faktury'] = $this->Zakaznik_model->fakturyZakaznika();
        $data['title'] = 'Zákazníci zoznam';

        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Zakaznik/ZoznamFaktur',$data);
        $this->load->view('template/footer');

    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = array();
        //ziskanie dat z tabulky
        $postData = $this->Zakaznik_model->getRows($id);

        foreach ($postData as $post)


            //zistenie, ci bola zaslana poziadavka na aktualizaciu
            if ($this->input->post('postSubmit')) {
                //definicia pravidiel validacie
                $this->form_validation->set_rules('meno', 'meno', 'required');
                $this->form_validation->set_rules('priezvisko', 'priezvisko', 'required');


                // priprava dat pre aktualizaciu
                $postData = array(
                    'Firma_Meno' => $this->input->post('meno'),
                    'firma_priezvisko' => $this->input->post('priezvisko'),
                    'ICO' => $this->input->post('ico'),
                    'JeFirma' => $this->input->post('jefirma'),


                );

                //validacia zaslanych dat
                if ($this->form_validation->run() == true) {
                    //aktualizacia dat
                    $update = $this->Zakaznik_model->update($postData, $id);

                    if ($update) {
                        $this->session->set_userdata('success_msg', 'Zakaznik upravený.');
                        redirect('/Zakaznik');
                    } else {
                        $data['error_msg'] = 'Problém pri úprave , skús neskôr.';
                    }
                }
            }

        $data['post'] = $post;
        $data['title'] = 'Uprava Zakaznika';
        $data['action'] = 'Editovanie';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header', $data);
        $this->load->view('Zakaznik/pridaj-zkaznika', $data);
        $this->load->view('template/footer');
    }


    public function OdstranZakaznika(){

        if (isset($_GET['id']) )
        {

            $idcko = $_GET['id'];

        }

        $zmazane= $this->Zakaznik_model->delete($idcko);

        if ($zmazane) {
            $this->session->set_userdata('success_msg', 'Zakaznik bol zmazaný.');
            redirect('/Zakaznik');
        } else {
            $data['error_msg'] = 'Vyskytol sa problém.';
        }




    }


    public function kupaKurzu(){
        //zistenie, ci bola zaslana poziadavka na pridanie zazanmu
        $postData ='';

        if (isset($_GET['id']) )
        {

            $idcko = $_GET['id'];

        }
        if($this->input->post('postSubmit')){

            //priprava dat pre vlozenie

                $postData = array(
                    'IDkurz' => $this->input->post('idkurz'),
                    'IDzakaznik' => $idcko,
            'IDfaktura' => $this->input->post('idfaktura'));






            //validacia zaslanych dat

                //vlozenie dat
            if(!$this->input->post('idfaktura')=='' && !$this->input->post('idkurz')==''){
                $insert = $this->Zakaznik_model->kupaKurzu($postData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Kurz pre zakaznika bol kupeny. A priadaný na faktúru s čislom: '.$postData['IDfaktura']);
                    redirect('Zakaznik');
                }else{
                    $data['error_msg'] = 'Problém, skús znovu.';
                }
            }

                else{
                if(!$this->input->post('idkurz')==''){
                    $date = date('Y-m-d H:i:s');
                    $data= array(
                        'DATUM' => $date,
                        'Zakaznik' => $idcko
                        );

                    $idFaktury=$this->Faktura_model->NovaFaktura($data);
                    $postData['IDfaktura']=$idFaktury;
                    $this->Zakaznik_model->kupaKurzu($postData);
                     $data['success_msg']=( 'Kurz pre zakaznika bol kupeny.A evidovaný v novej faktúre s číslom :'.$idFaktury);}
            else  $data['error_msg'] = 'Nebol vybratý žiadny kurz';}


        }
        $data['kurzy'] = $this->Zakaznik_model->get_kurz_dropdown();
        $data['kurzOznaceny'] = '';
        $data['faktury'] = $this->Zakaznik_model->get_faktura_dropdown();
        $data['novaFaktura'] = '';
        $data['post'] = $postData;
        $data['title'] = 'Kupa kurzu';
        $data['action'] = 'Kupa';

        //zobrazenie formulara pre vlozenie a editaciu dat
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Zakaznik/kupKurz', $data);
        $this->load->view('template/footer');
    }

}