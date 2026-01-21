<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Libraries\Hash;
use App\Models\Model_Auth;

class Auth extends BaseController
{
    public function __construct()
	{
        helper('form');
        $this->Model_Auth= new Model_Auth;
    }
    
    public function register()
	{
        $data = array(
            'title' => 'Register' , 
        );
        return view('v_register',$data);
    }
    
    public function save_register()
	{
        if ($this->validate([
            'name_user'=>[
                'label'=> 'Nama User',
                'rules'=> 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'email'=>[
                'label'=> 'Email',
                'rules'=> 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'no_hp'=>[
                'label'=> 'No Handphone',
                'rules'=> 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'password'=>[
                'label'=> 'Password',
                'rules'=> 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'repassword'=>[
                'label'=> 'Retype Password',
                'rules'=> 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!',
                    'matches' => '{field} Password Tidak Sama !!'
                ]
            ]
        ])) {
            //jika valid
            $nama_user = $this->request->getPost('name_user');
            $email = $this->request->getPost('email');
            $no_hp = $this->request->getPost('no_hp');
            $password = $this->request->getPost('password');

            $data = [
                'name_user' => $nama_user, 
                'email' => $email,
                'no_hp' => $no_hp,
                'password' => Hash::make($password),
                'level' => 3,
            ];

            $this->Model_Auth->save_register($data);
            session()->setFlashdata('pesan', 'Register Berjaya !!');
            return redirect()->to(site_url('Auth/register'));
        }else{
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(site_url('Auth/register'));
        }
    }
    
    public function login()
	{
        $data = array(
            'title' => 'Login' , 
        );
        return view('v_login2',$data);
    }

    public function check_login() 
{
    if ($this->validate([
        'email'=>[
            'label'=> 'Email',
            'rules'=> 'required|valid_email',
            'errors' => [
                'required' => '{field} Wajib Diisi !!',
                'valid_email' => '{field} Masukkan email sama !!'
            ]
        ],
        'password'=>[
            'label'=> 'Password',
            'rules'=> 'required|min_length[5]|max_length[12]',
            'errors' => [
                'required' => '{field} Wajib Diisi !!',
                'min_length' => '{field} Password must have atleast 5 character in length',
                'max_length' => '{field} Password must not more than 12 character in length!'
            ]
        ], 
    ])) {
        // jika valid
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));

        $check = $this->Model_Auth->login($email, $password); 
        if ($check) {
            // simpan dalam session
            session()->set('log', true);
            session()->set('nama_penuh', $check['nama_penuh']);
            session()->set('email', $check['email']);
            session()->set('level', $check['level']);
            session()->set('id_bahagian', $check['id_bahagian']);
            session()->set('id_agensi_induk', $check['id_agensi_induk']);
            session()->set('id_user', $check['id_user']);
            session()->set('photo_user', $check['photo_user']);
            session()->setFlashdata('pesan', 'Login Berjaya !!, Selamat Datang Ke sistem');

             // Arahkan ikut level
            if ($check['level'] == 1) {
                return redirect()->to(site_url('admin'));
            } elseif ($check['level'] == 2) {
                return redirect()->to(site_url('agensi'));
            }elseif ($check['level'] == 3) {
                return redirect()->to(site_url('admin'));
            }elseif ($check['level'] == 4) {
                return redirect()->to(site_url('admin'));
            }elseif ($check['level'] == 5) {
                return redirect()->to(site_url('admin'));
            }elseif ($check['level'] == 6) {
                return redirect()->to(site_url('admin'));
               
            } else {
                return redirect()->to(site_url('home'));
            }

        } else {
            session()->setFlashdata('pesan', 'Login Gagal !!, Log masuk sistem tidak sah');
            return redirect()->to(site_url('auth/login'));
        }
    } else {
        // jika tidak valid
        session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        return redirect()->to(site_url('auth/login')); 
    }
}

    public function logout()
	{
        session()->remove('log');
        session()->remove('name_user');
        session()->remove('email');
        session()->remove('level');
        session()->remove('photo_user');
        session()->setFlashdata('pesan', 'Logout Berjaya !!');
        return redirect()->to(site_url('auth/login'));
    }

}