<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemohon extends Model
{
	
	protected $table                = 'pemohon';
	protected $primaryKey           = 'id';
	
	protected $allowedFields        = [
		'nama_pemohon',
		'passport_no',
		'alamat',
	];

	// Dates
	protected $useTimestamps        = true;
	
}
