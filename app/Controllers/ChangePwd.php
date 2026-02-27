<?php

namespace App\Controllers;

use App\Models\Model_ChangePwd;

class ChangePwd extends BaseController
{
    protected $Model_ChangePwd;

    public function __construct()
    {
        $this->Model_ChangePwd = new Model_ChangePwd();
    }

  public function update()
{
    // 1. Set Peraturan Validation
    $rules = [
        'old_password'     => 'required',
        'new_password'     => 'required|min_length[8]',
        'confirm_password' => 'required|matches[new_password]',
    ];

    $messages = [
        'new_password' => [
            'min_length' => 'Katalaluan baru mestilah sekurang-kurangnya 8 aksara.'
        ],
        'confirm_password' => [
            'matches' => 'Sahkan katalaluan tidak sama dengan katalaluan baru.'
        ]
    ];

    if (!$this->validate($rules, $messages)) {
        session()->setFlashdata('errors', $this->validator->getErrors());
        return redirect()->back()->withInput();
    }

    $id_user = session()->get('id_user');
    $old_pwd = $this->request->getPost('old_password');
    $new_pwd = $this->request->getPost('new_password');

    // 2. Ambil data user dari model
    $user = $this->Model_ChangePwd->getUser($id_user);

    // 3. Semak katalaluan lama (Guna password_verify)
    // $user['password'] mestilah hash yang dijana oleh password_hash()
    if (!password_verify($old_pwd, $user['password'])) {
        session()->setFlashdata('errors', ['Katalaluan lama anda tidak tepat!']);
        return redirect()->back();
    }

    // 4. Update jika semua OK (Guna password_hash)
    $data = [
        'password' => password_hash($new_pwd, PASSWORD_DEFAULT)
    ];

    $this->Model_ChangePwd->updatePassword($id_user, $data);

    session()->setFlashdata('pesan', 'Katalaluan berjaya ditukar!');
    return redirect()->back();
}

}