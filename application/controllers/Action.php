<?php

date_default_timezone_set("America/Mexico_City");

class Action extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Db_model');
    }

    //Vista inicial
    public function index()
    {
        $this->load->view('buzon');
    }

    /*Obtiene los datos del Form y los envia al modelo para insertarlos*/
    public function formData()
    {
        $data = array(
            'sugerencia' => $this->input->post('textarea', true),
            'fecha' => date('Y-m-d H:I:S')
        );
        $this->Db_model->insertData($data);
        $this->load->view('buzon');
    }
}
