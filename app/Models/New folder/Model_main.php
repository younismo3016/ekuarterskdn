<?php

class model_main extends CI_Model{

	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	
	//Model ini digunakan dalam SISPICT
	function get_email_pemohon ($id_spict_transaksi)
	{
		$query = $this->db->query("SELECT pengguna.email as email from pengguna
join spict_transaksi on spict_transaksi.id_pemohon=pengguna.id_pengguna
where spict_transaksi.id_spict_transaksi='".$id_spict_transaksi."'");

		foreach ($query->result() as $row)
		{
		   $email = $row->email;
		   
		}
		return $email;
		
	}	
	
	//Model ini digunakan dalam SISPICT
	function get_email_juruteknik ($id_spict_transaksi)
	{
		$query = $this->db->query("SELECT pengguna.email as email from pengguna
join spict_transaksi on spict_transaksi.id_juruteknik=pengguna.id_pengguna
where spict_transaksi.id_spict_transaksi='".$id_spict_transaksi."'");

		foreach ($query->result() as $row)
		{
		   $email = $row->email;
		   
		}
		return $email;
		
	}	
	
	
	
	
	
	function get_email ($key)
	{
		$query = $this->db->query("SELECT pengguna.email as email from pengguna
join transaksi on transaksi.id_pengguna=pengguna.id
where transaksi.id='".$key."'");

		foreach ($query->result() as $row)
		{
		   $email = $row->email;
		   
		}
		return $email;
		
	}	
			
	function check_user ($no_kp, $katalaluan)
	{
		$this->db->where('no_kp',$no_kp);
		$this->db->where('katalaluan',$katalaluan);
		$query=$this->db->get('pengguna');
		
		if ($query->num_rows() > 0)
			{
				return TRUE;
			
			}else
			{
				return FALSE;
			}
		
	}	

	function check_email ($to)
	{
		$this->db->where('email',$to);
		
		$query=$this->db->get('pengguna');
		
		if ($query->num_rows() > 0)
			{
				return TRUE;
			
			}else
			{
				return FALSE;
			}
		
	}		
	

	function senarai_pengguna($perPage,$uri)
	{
		//select * from pengguna
		$this->db->select('*');
		$this->db->from('pengguna');
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}
	
	function senarai_belum_hantar($perPage,$uri)
	{
		$this->db->select('pengguna.nama as nama,pengguna.no_kp as no_kp,pengguna.email as email,transaksi.tarikh_pulang as tarikh_pulang,bahagian.nama_bahagian as nama_bahagian,jenis.jenis as jenis');
		$this->db->from('pengguna');
		$this->db->join('bahagian','pengguna.id_bahagian = bahagian.id','left');
		$this->db->join('transaksi','pengguna.id = transaksi.id_pengguna','left');
		$this->db->join('jenis','jenis.id = transaksi.id_jenis_peralatan','left');
		$this->db->where("tarikh_pulang < CURDATE( ) and status_hantar=''");
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}
	
	
	
	function update_data($table,$key,$data,$field_key)
	{
		//UPDATE pengguna{$table}
		//SET column1=value1,column2=value2,...{$data}
		//WHERE $field_key=$key;
		$this->db->where($field_key,$key);
		$this->db->update($table,$data);
	}
	
	/*
	function update_data($table,$key,$data,$field_key,$data2)
	{
		//UPDATE pengguna{$table}
		//SET column1=value1,column2=value2,...{$data}
		//WHERE $field_key=$key;
		$this->db->where($field_key,$key);
		$this->db->update($table,$data,$data2);
	}
	
	*/
	
	function senarai_peralatan($perPage, $uri)
	{
	
		//select * from peralatan
		$this->db->select('*');
		$this->db->from('peralatan');
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
		
				return $getData->result_array();
			
			else 
		
				return null;

	}
	
	function jenis_peralatan()
	{
	
		//select * from peralatan
		$this->db->select('*');
		$this->db->from('jenis');
		$getData = $this->db->get('');
		
		if($getData->num_rows()>0)
		
				return $getData->result_array();
			
			else 
		
				return null;

	}
	
	function senarai_bahagian($perPage, $uri)
	{
		//select * from bahagian
		$this->db->select('*');
		$this->db->from('bahagian');
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}	
	
	
	function senarai_permohonan($perPage, $uri,$no_kp,$keputusan,$tarikh_mohon,$tarikh_mohon_end,$a)
	{
		//select * from bahagian
		$this->db->select('transaksi.id as id,jenis.jenis as jenis,transaksi.kuantiti as kuantiti,transaksi.id_pengguna as id_pengguna,transaksi.seq_number as seq_number,
		transaksi.keputusan as keputusan,pengguna.nama as nama,transaksi.tujuan_kegunaan as tujuan_kegunaan,
		pengguna.email as email,transaksi.tarikh_mohon as tarikh_mohon,transaksi.tarikh_perlu as tarikh_perlu,transaksi.status_peralatan as status_peralatan,
		transaksi.tarikh_pulang as tarikh_pulang,transaksi.catatan as catatan,transaksi.sebab_tolak as sebab_tolak,pengguna.no_kp as no_kp,transaksi.status_hantar as status_hantar,transaksi.tarikh_hantar as tarikh_hantar');
		$this->db->from('transaksi');
		$this->db->join('pengguna','pengguna.id=transaksi.id_pengguna','left');
		$this->db->join('jenis','jenis.id=transaksi.id_jenis_peralatan','left');
		
		//untuk memboleh user melihat maklumat berkenaan dia shj(filter)
		$level =$this->session->userdata('sess_level');
		$id_pengguna =$this->session->userdata('sess_id');
		if ($level==2){
		$this->db->where('transaksi.id_pengguna',$id_pengguna);
		}
		//
		if(!empty($no_kp)){
            $this->db->like('no_kp',$no_kp);
        }
		
		if($keputusan !='p' && !empty($keputusan )){
		
		
			if($keputusan=='bp'){
			$this->db->where('keputusan','');
			}else{
		
			 $this->db->where('keputusan',$keputusan);
			}
           }
        
		
		
		if($a !='' && $a !='page'){
			
			if($a=='g'){
			$this->db->where('keputusan','');
			}else{
		
			$this->db->where('keputusan',$a);
			}
			
		}
		
		if(!empty($tarikh_mohon)){
		
		$Date = explode("-", $tarikh_mohon);
				$day = $Date[0];
				$month = $Date[1];
				$year = $Date[2];
				$gabung_tarikh_mohon = $year."-".$month."-".$day;
				
		$Date = explode("-", $tarikh_mohon_end);
				$day = $Date[0];
				$month = $Date[1];
				$year = $Date[2];
				$gabung_tarikh_mohon_end = $year."-".$month."-".$day;
				
             $this->db->where('tarikh_mohon >=',$gabung_tarikh_mohon);
			 $this->db->where('tarikh_mohon <=',$gabung_tarikh_mohon_end);
			 
        }
		
		
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}
	
	function senarai_jenis_peralatan($perPage, $uri)
	{
		//select * from jenis
		$this->db->select('*');
		$this->db->from('jenis');
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}

function senarai_jenama_peralatan($perPage, $uri)
	{
		//select * from jenis
		$this->db->select('*');
		$this->db->from('jenama');
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}


function semak_peralatan($perPage, $uri,$jenis,$jenama)
	{
		$this->db->select('jenis,jenama,count(*) as total');
		$this->db->from('peralatan');
		$this->db->join('jenis ','peralatan.id_jenis = jenis.id','left');
		$this->db->join('jenama ','peralatan.id_jenama = jenama.id','left');
		$this->db->group_by('jenis,jenama');
		
		if($jenis !=''){
            $this->db->where('jenis',$jenis);
        }else{
		
		}
		
		if($jenama !=''){
            $this->db->where('jenama',$jenama);
        }else{
		
		}
		
		
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}	

function sum_lewat_hantar()
	{
		
		$query = $this->db->query("select COUNT(*) as sum
FROM pengguna
inner join adm_bahagian on pengguna.id_adm_bahagian = adm_bahagian.id_adm_bahagian
inner join spict_transaksi on pengguna.id_pengguna = spict_transaksi.id_pemohon
WHERE spict_transaksi.tarikh_jangka_pulang < CURDATE( ) and spict_transaksi.status_pemulangan=0");
			
		
		foreach ($query->result() as $row) {
			$sum = $row->sum;
		}
	return $sum;

	}	


	
//Model ini digunakan dalam SISPICT
function sum_gagal()
	{
		//if($this->session->userdata('sess_level') !=1){
			//$id_pemohon=$this->session->userdata('sess_id_pengguna');
			//$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=2 and id_pemohon='$id_pengguna'");
		//}else{
			$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=2");
			
		//}
		foreach ($query->result() as $row) {
			$sum = $row->sum;
		}
	return $sum;

	}	
	
//Model ini digunakan dalam SISPICT	
function sum_lulus()
	{
	
	//if($this->session->userdata('sess_level') !=1){
			//$id_pengguna=$this->session->userdata('sess_id_pengguna');
			//$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=1 and id_pemohon='$id_pengguna'");
		//}else{
		$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=1");
		
		//}
		foreach ($query->result() as $row) {
			$sum = $row->sum;
		}
	return $sum;

	}	
	
//Model ini digunakan dalam SISPICT		
function sum_belum_proses()
	{
	
	//if($this->session->userdata('sess_level') !=1){
			//$id_pengguna=$this->session->userdata('sess_id_pengguna');
			//$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=0 and id_pemohon='$id_pengguna'");
		//}else{
		$query = $this->db->query("select count(id_spict_transaksi) as sum from spict_transaksi where keputusan=0");
		
		//}
		foreach ($query->result() as $row) {
			$sum = $row->sum;
		}
	return $sum;

	}	

	function get_bulan_Jan()
	{
		$query = $this->db->query("select count(id) as sum from transaksi where keputusan=''");
		foreach ($query->result() as $row) {
			$sum = $row->sum;
		}
	return $sum;

	}	

function pengesahan($perPage, $uri,$no_kp,$keputusan,$tarikh_mohon,$tarikh_mohon_end,$a)
	{
		//select * from bahagian
		$this->db->select('transaksi.id as id,jenis.jenis as jenis,transaksi.kuantiti as kuantiti,
		transaksi.keputusan as keputusan,pengguna.nama as nama,transaksi.tujuan_kegunaan as tujuan_kegunaan,
		pengguna.email as email,transaksi.tarikh_mohon as tarikh_mohon,transaksi.tarikh_perlu as tarikh_perlu,
		transaksi.tarikh_pulang as tarikh_pulang,transaksi.catatan as catatan,transaksi.sebab_tolak as sebab_tolak,pengguna.no_kp as no_kp');
		$this->db->from('transaksi');
		$this->db->join('pengguna','pengguna.id=transaksi.id_pengguna','left');
		$this->db->join('jenis','jenis.id=transaksi.id_jenis_peralatan','left');
		$this->db->where('keputusan','');
		if(!empty($no_kp)){
            $this->db->like('no_kp',$no_kp);
        }
		
		if($keputusan !='p' && !empty($keputusan )){
		
		
			if($keputusan=='bp'){
			$this->db->where('keputusan','');
			}else{
		
			 $this->db->where('keputusan',$keputusan);
			}
           }
        
		
		
		if($a !='' && $a !='page'){
			
			if($a=='g'){
			$this->db->where('keputusan','');
			}else{
		
			$this->db->where('keputusan',$a);
			}
			
		}
		
		if(!empty($tarikh_mohon)){
		
		$Date = explode("-", $tarikh_mohon);
				$day = $Date[0];
				$month = $Date[1];
				$year = $Date[2];
				$gabung_tarikh_mohon = $year."-".$month."-".$day;
				
		$Date = explode("-", $tarikh_mohon_end);
				$day = $Date[0];
				$month = $Date[1];
				$year = $Date[2];
				$gabung_tarikh_mohon_end = $year."-".$month."-".$day;
				
             $this->db->where('tarikh_mohon >=',$gabung_tarikh_mohon);
			 $this->db->where('tarikh_mohon <=',$gabung_tarikh_mohon_end);
			 
        }
		
		
		$getData = $this->db->get('',$perPage, $uri);
		
		if($getData->num_rows()>0)
			
				return $getData->result_array();
				
			else 
			
				return null;
	}


	function generatePassword ($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }
	
	function get_last_seq_number()
	{
		
		$query = $this->db->query("select seq_number from transaksi order by seq_number desc limit 1");
			
		
		foreach ($query->result() as $row) {
			$seq_number = $row->seq_number;
		}
	return $seq_number;

	}

function send_auto_email ()
	{
		$query = $this->db->query("SELECT `pengguna`.`nama` as nama, `pengguna`.`no_kp` as no_kp, `pengguna`.`email` as email, 
		`transaksi`.`tarikh_pulang` as tarikh_pulang, `bahagian`.`nama_bahagian` as nama_bahagian
		FROM (`pengguna`)
		LEFT JOIN `bahagian` ON `pengguna`.`id_bahagian` = `bahagian`.`id`
		LEFT JOIN `transaksi` ON `pengguna`.`id` = `transaksi`.`id_pengguna`
		WHERE `tarikh_pulang` < CURDATE( )");

		foreach ($query->result() as $row)
		{
		   $email = $row->email;
		   $nama = $row->nama;
		   $no_kp =  $row->no_kp;
		   
		   
		   
		   $config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'smtp.moha.gov.my',
				  'smtp_port' => 25,
				  'smtp_user' => 'zilaidah@moha.gov.my',
				  'smtp_pass' => 'lala442404',
				);
				
				$this->load->library('email', $config);
				
					//untuk mghntar alert pd admin bla permohonan bru dtrima
					$this->email->set_newline("\r\n");

					$this->email->from('spict@moha.gov.my', 'SPICT');
					$this->email->to($email);

					$this->email->subject(' Peringatan');
					
					
					
					$data = "Sila hantar pinjaman peralatan anda pada tarikh   <br> Nama :".$nama."<br>";
					$data .= "No Ic :".$sess_no_kp."<br>";
					$data .= "peralatan :".$no_kp."<br>";
					
					$this->email->message($data);
					$this->email->set_mailtype("html");
				if (!$this->email->send())//email tdk dpt dhantar
				{
					//show_error($this->email->print_debugger());
					//$this->session->set_flashdata('flash_error','Ralat,email tidak berjaya dihantar !');
					//redirect('main/senarai_permohonan','refresh');	
				}else{
					 
					 
					
					
					$this->session->set_flashdata('flash_success','Your e-mail has been sent!');
				  
					//redirect('main/senarai_permohonan','refresh');	
					//$this->output->enable_profiler(TRUE);
				}			
		}
		
	}		
		
			
}	


