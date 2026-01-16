<?php
if (! function_exists('convert_date_formattodb'))
{
	function convert_date_formattodb($value)
	{
		$Date = explode("/", $value);
				$m = $Date[0];
				$d = $Date[1];
				$year = $Date[2];
				$gabung = $year."-".$m."-".$d;
				return $gabung;
	}
}

if (! function_exists('convert_date_formattodb2'))
{
	function convert_date_formattodb2($value)
	{
		$Date = explode("-", $value);
				$d = $Date[0];
				$m = $Date[1];
				$year = $Date[2];
				$gabung = $d."-".$m."-".$year;
				return $gabung;
	}
}

//helper ini tidak digunakan dalam sistem ini

function get_email_pengesah($email_pegawai)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT email from pengguna
						WHERE id_user='$email_pegawai'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$email_pegawai = $row->email;
					 
			}
			return $email_pegawai;
	}

	function get_random_password($n)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
	}

	function get_random_ticket($n)
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
	}

function get_nama_pemohon($id_pemohon)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT nama_pemohon from pemohon_cr
						WHERE id_pemohon='$id_pemohon'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_pemohon = $row->nama_pemohon;
					 
			}
			return $id_pemohon;
	}

	function get_phone_pemohon($id_pemohon)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT phone_pemohon from pemohon_cr
						WHERE id_pemohon='$id_pemohon'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_pemohon = $row->phone_pemohon;
					 
			}
			return $id_pemohon;
	}

	function get_nama_sistem($id_nama_sistem)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT nama_sistem,singkatan_sistem from tbl_nama_sistem
						WHERE id_nama_sistem='$id_nama_sistem'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_nama_sistem = $row->singkatan_sistem;
					 
			}
			return $id_nama_sistem;
	}

	function get_nama_pengesah_cr($id_user)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT nama_penuh from pengguna
						WHERE id_user='$id_user'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_user = $row->nama_penuh;
					 
			}
			return $id_user;
	}


	function get_bahagian($id_bahagian)
	{
		$CI = & get_instance();
		$query = $CI->db->query("SELECT nama_bahagian from tbl_bahagian
						WHERE id_bahagian='$id_bahagian'");
			$query->num_rows();
			
			foreach($query->result() as $row)
			{
					//return $row->id_juruteknik;
					$id_bahagian = $row->nama_bahagian;
					 
			}
			return $id_bahagian;
	}

function get_status_cr($value){
	if($value == 1){
		$value =  "Baru";
	}else if($value == 2){
		$value =  "Selesai";
	}else if($value == 3){
		$value =  "Tutup";
	}else if($value == 4){
		$value =  "Dalam Tindakan";
	}else if($value == 5){
		$value =  "Lulus CR";
	}else if($value == 6){
		$value =  "Tidak Lulus Permohonan";
	}
	else{
		$value =  "Dalam Proses";
	}
	
	return $value;
    
}

function get_progres_cr($value){
	if($value == 1){
		$value =  "5";
	}else if($value == 2){
		$value =  "90";
	}else if($value == 3){
		$value =  "100";
	}else if($value == 4){
		$value =  "70";
	}else if($value == 5){
		$value =  "40";
	}else if($value == 6){
		$value =  "0";
	}
	else{
		$value =  "Ralat";
	}
	
	return $value;
    
}


function get_button($value){
	if($value == Rendah){
		$value =  "success";
	}else if($value == Sederhana){
		$value =  "info";
	}else if($value == Tinggi){
		$value =  "warning";
	}
	else{
		$value =  "danger";
	}
	
	return $value;
    
}

function get_status_sah_cr($value){
	if($value == 1){
		$value =  "Disahkan";
	}else if($value == 2){
		$value =  "Belum Sah";
	}else if($value == 5){
		$value =  "Lulus";
	}else if($value == 6){
		$value =  "Tidak Lulus";
	}else if($value == 3){
		$value =  "Kemaskini Semula";
	}
	else{
		$value =  "Ralat";
	}
	
	return $value;
    
}

function get_status_sah_button($value){
	if($value == 1){
		$value =  "primary";
	}else if($value == 2){
		$value =  "danger";
	}else if($value == 3){
		$value =  "warning";
	}
	else{
		$value =  "danger";
	}
	
	return $value;
    
}



function get_kategori($value){
	if($value == 1){
		$value =  "Pindaan Data";
	}else if($value == 2){
		$value =  "Penambahbaikan Sistem";
	}else if($value == 3){
		$value =  "Modul Baru";
	}
	else{
		$value =  "Ralat";
	}
	
	return $value;
    
}

function get_negeri($value){
	if($value == 1){
		$value =  "JOHOR";
	}else if($value == 2){
		$value =  "KEDAH";
	}else if($value == 3){
		$value =  "KELANTAN";
	}else if($value == 4){
		$value =  "MELAKA";
	}else if($value == 5){
		$value =  "NEGERI SEMBILAN";
	}else if($value == 6){
		$value =  "PAHANG";
	}else if($value == 7){
		$value =  "PULAU PINANG";
	}else if($value == 8){
		$value =  "PERAK";
	}else if($value == 9){
		$value =  "PERLIS";
	}else if($value == 10){
		$value =  "SELANGOR";
	}else if($value == 11){
		$value =  "SABAH";
	}else if($value == 12){
		$value =  "SARAWAK";
	}else if($value == 13){
		$value =  "TERENGGANU";
	}else if($value == 14){
		$value =  "WILAYAH PERSEKUTUAN";
	}
	else{
		$value =  "WILAYAH PERSEKUTUAN PUTRAJAYA";
	}
	
	return $value;
    
}



function get_status_sah($value){
	if($value == 2){
		$value =  "Disahkan";
	}else if($value == 3){
		$value =  "Resit tidak Sah"; //tidak digunakan
	}else{
		$value =  "Belum disahkan";
	}
	
	return $value;
    
}

function get_status_aktif($value){
	if($value == 2){
		$value =  "Tidak Aktif";
	}else{
		$value =  "Aktif";
	}
	
	return $value;
    
}

function get_jabatan($value){
	if($value == 1){
		$value =  "Polis Diraja Malaysia";
	}else if($value == 2){
		$value =  "Jabatan Imigresen Malaysia";
	}else if($value == 3){
		$value =  "Jabatan Pendaftaran Pertubuhan";
	}else if($value == 4){
		$value =  "Jabatan Pendaftaran Negara";
	}else if($value == 5){
		$value =  "Jabatan Penjara Malaysia";
	}else if($value == 6){
		$value =  "Kementerian Dalam Negeri";
	}else if($value == 7){
		$value =  "Agensi Anti Dadah Kebangsaan";
	}else if($value == 8){
		$value =  "Jabatan Pertahanan Awam";
	}else{
		$value =  "Jabatan Sukarelawan Malaysia";
	}
	
	return $value;
    
}

	

function get_status_peranan($value){
	if($value == 1){
		$value =  "Administrator";
	}else if($value == 2){
		$value =  "Penyelaras";
	}else if($value == 3){
		$value =  "Ketua Unit";
	}else if($value == 4){
		$value =  "Pengurus Sistem";
	}else if($value == 5){
		$value =  "Ketua Pasukan";
	}else if($value == 6){
		$value =  "Ahli Pasukan";
	}else if($value == 7){
		$value =  "Pegawai Pengesahan Pemohon";
	}else if($value == 8){
		$value =  "Pemohon";
	}

	else{
		$value =  "Tiada";
	}
	
	return $value;
    
}

function get_status_kategori($value){
	if($value == 1){
		$value =  "PINDAAN DATA";
	}else if($value == 2){
		$value =  "PENAMBAHBAIKAN SISTEM";
	}else if($value == 3){
		$value =  "PENAMBAHAN MODUL BAHARU";
	}else if($value == 4){
		$value =  "PERMOHONAN ID";
	}else{
		$value =  "Kategori";
	}
	
	return $value;
    
}

function get_jumlah_character($value)
{
	$jumlah_character = strlen($value);
	
	return $value;
    
}

//untuk convert dari number ke perkataan..utk bulan
if (! function_exists('covert_bulan_to_ejaan'))
{
	function convert_bulan_to_ejaan($value)
	{
		if ($value==1){
			echo "JAN";
		}else if ($value==2){
		 	echo "FEB";
			}else if ($value==3){
		 	echo "MAC";
			}else if ($value==4){
		 	echo "APRIL";
			}else if ($value==5){
		 	echo "MEI";
			}else if ($value==6){
		 	echo "JUN";
			}else if ($value==7){
		 	echo "JUL";
			}else if ($value==8){
		 	echo "OGOS";
			}else if ($value==9){
		 	echo "SEPT";
			}else if ($value==10){
		 	echo "OKT";
			}else if ($value==11){
		 	echo "NOV";
			}else if ($value==12){
		 	echo "DEC";
		}
	}
}

