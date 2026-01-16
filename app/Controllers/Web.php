<?php

namespace App\Controllers;
use App\Models\Model_Auth;
use App\Libraries\Hash;

class Web extends BaseController
{
	public function __construct()
	{
        helper('form');
        $this->Model_Auth= new Model_Auth;
    }
	public function index()
	{
		$data = array(
			'title' => 'Web', 
		);
		return view('v_login2',$data);
	}
}