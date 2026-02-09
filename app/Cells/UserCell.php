<?php

namespace App\Cells;

use App\Models\Model_Profil;

class UserCell
{
    // app/Cells/UserCell.php

public function paparkanProfil()
{
    $model = new \App\Models\Model_Profil();
    
    // Gantikan 'id_user' dengan key session anda yang sebenar
    $id_session = session()->get('id_user'); 

    if (!$id_session) {
        // Jika tiada session, jangan hantar apa-apa supaya modal tak muncul
        return ''; 
    }

    $data_user = $model->get_profil_user($id_session);

    return view('cells/user_profil_modal', ['user' => $data_user]);
}

}