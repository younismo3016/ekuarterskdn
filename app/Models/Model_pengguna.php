<?php 

class model_pengguna extends CI_Model{

	function _construct()
	{
		//call the model constructor
		parent::_construct();
		}
		
		function list_pengguna()
		{
		}
		
		function update_data($table,$id,$data,$field_key)
	{
		$this->db->where($field_key,$id);
		$this->db->update($table, $data); 
	}
	
	function convert_date_db($date)//00-00-0000
	{
		$explode_mula = explode("-", $date);
			$d = $explode_mula[0];
			$m = $explode_mula[1];
			$y = $explode_mula[2];
			 //echo $a;
			return  $y."-".$m."-".$d;
		
		
		
	}
		
		function check_user($email,$password) 
	{
		$today=date('Y-m-d');
		//$level=$this->session->userdata('sess_level');
		
		
		$this->db->where('email',$email);
		$this->db->where('kata_laluan',$password);
		
		//if ( $this->session->userdata('sess_level') != '4'){
		//$this->db->where('date_range >=',$today);
		
		//}
		//$this->db->where('status',1);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0) {		
			return TRUE;
		}else {
			return FALSE;
		}
	}

		function get_email_ketua_organisasi($id_user)
        {
                $query = $this->db->query("SELECT user.email as email from user
							where user.id_user='$id_user'");

                foreach ($query->result() as $row)
                {
                   $email = $row->email;
                  
                }
                return $email;
                
        }









}