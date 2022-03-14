<?php
class Db_model extends CI_Model {

    protected $table = 'sugerencias';
    
	function __construct()
	{
		parent::__construct();
		$this->bd = $this->load->database('default',TRUE);

	}

    /*Inserta los datos enviados desde el controlador a la DB*/
    public function insertData($data){
        $this->db->insert('sugerencias', $data);
    }
    
    /*Obtiene el total de filas en la tabla*/
    public function get_count() {
        //return $this->db->count_all($this->table);
        $this->db->where('estado', '1');
        return $this->db->count_all_results($this->table);
    }

    /*Consulta 10 filas de la tabla*/
    public function get_sugerencias($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->where('estado', '1');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /*Obtiene el "id" del controlador y actualiza el campo "estado" para ser eliminado de la consulta*/
    public function update_sugerencias($id){
        $this->db->where('id', $id);
        $this->db->set('estado',0);
        $this->db->update('sugerencias');
        return;
    }

	function getUserDetails(){
        $response = array();
        $this->db->select('id, sugerencia, fecha');
        $this->db->where('estado', '1');
        $this->db->order_by('id', 'DESC');
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
   }
}

?>