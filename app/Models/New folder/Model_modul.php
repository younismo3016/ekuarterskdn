<?php 

class model_modul extends CI_Model{

	function _construct()
	{
		//call the model constructor
		parent::_construct();
		}
		
		function list_modul()
		{
		$this->db->select('*');
		$this->db->from('modul');
		$data['list_modul'] = $this->db->get('');
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
		
		}
}