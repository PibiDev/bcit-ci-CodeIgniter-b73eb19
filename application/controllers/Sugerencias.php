<?php

class Sugerencias extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('Db_model');
            $this->load->library('pagination');
    }
    
    /*Inicializa la configuracion de la tabla de consultas y pagina la consulta de 10 en 10*/
    public function index(){
        $config = array();
        $config["base_url"] = base_url() . "index.php/Sugerencias/index";
        $config["total_rows"] = $this->Db_model->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        //======================
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link" id="act">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        //======================

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['sugerencias'] = $this->Db_model->get_sugerencias($config["per_page"], $page);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('consulta', $data);
    }

    /*Recibe el id de un campo seleccionado de la tabla de consultas, lo elimina y recarga la tabla de consultas*/
    public function formData($id){
        $this->Db_model->update_sugerencias($id);
        
        $config = array();
        $config["base_url"] = base_url() . "index.php/Sugerencias/index";
        $config["total_rows"] = $this->Db_model->get_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;

        //======================
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link" id="act">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        //======================

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data['sugerencias'] = $this->Db_model->get_sugerencias($config["per_page"], $page);

        $data["pagination"] = $this->pagination->create_links();

        $this->load->view('consulta', $data);
    }

    //funcion para exportar los datos de la tabla a .xls
    public function export(){ 

        $data= $this->Db_model->getUserDetails();
        
        function filterData(&$str){ 
            $str = preg_replace("/\t/", "\\t", $str); 
            $str = preg_replace("/\r?\n/", "\\n", $str); 
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        }

        $fileName = "Sugerencias" . date('Ymd') . ".xls"; 

        header('Content-Encoding: UTF-8');
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
        header("Content-type: application/vnd.ms-excel; charset=UTF-8");
        //echo "\xEF\xBB\xBF"; // UTF-8 BOM

        $flag = false; 
        foreach($data as $row) {
            if(!$flag) {    
                echo implode("\t", array_keys($row)) . "\n"; 
                $flag = true; 
            }   
            array_walk($row, 'filterData');
            $result = implode("\t", array_values($row)) . "\n"; 
            echo mb_convert_encoding($result, 'UTF-16LE', 'UTF-8');
        } 
        exit;
	}

}
