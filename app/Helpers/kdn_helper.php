<?php

function get_field_error($key, $label = null) {

    $error_message = '';

    if (isset( $_SESSION['_ci_validation_errors'])) {
        $_ci_validation_errors = $_SESSION['_ci_validation_errors'];

        if (isset($_ci_validation_errors)) {
            $unserializedArray = unserialize($_ci_validation_errors);

            if (isset($unserializedArray[$key])) {

                $error_message = $unserializedArray[$key]; 

                if ($label) {
                    return str_replace($key, $label, $error_message);
                }

                return $error_message;
            }
        }

    }

    return $error_message;
    
}


    if (!function_exists('get_kategori_pemohon')) {
        function get_kategori_pemohon($value)
            {
                $db = \Config\Database::connect(); // Get the database connection
                    
                    $query = $db->table('adm_kategori_pemohon')
                                ->select('kategori_pemohon')
                                ->where('id_kategori_pemohon', $value)
                                ->get();
                    
                    if ($query->getNumRows() > 0) {
                                $row = $query->getRow();
                                return $row->kategori_pemohon;
                        }
                    
                            return null; // Return null if no results are found
            }
    }

    if (!function_exists('get_bahagian')) {
        function get_bahagian($value)
            {
                $db = \Config\Database::connect(); // Get the database connection
                    
                    $query = $db->table('tbl_bahagian')
                                ->select('nama_bahagian')
                                ->where('id_bahagian', $value)
                                ->get();
                    
                    if ($query->getNumRows() > 0) {
                                $row = $query->getRow();
                                return $row->nama_bahagian;
                        }
                    
                            return null; // Return null if no results are found
            }
    }
    if (!function_exists('get_sistem')) {
        function get_sistem($value)
            {
                $db = \Config\Database::connect(); // Get the database connection
                    
                    $query = $db->table('tbl_nama_sistem')
                                ->select('singkatan_sistem')
                                ->where('id_nama_sistem', $value)
                                ->get();
                    
                    if ($query->getNumRows() > 0) {
                                $row = $query->getRow();
                                return $row->singkatan_sistem;
                        }
                    
                            return null; // Return null if no results are found
            }
    }
    if (!function_exists('get_nama')) {
        function get_nama($value)
            {
                $db = \Config\Database::connect(); // Get the database connection
                    
                    $query = $db->table('tbl_user')
                                ->select('nama_penuh')
                                ->where('id_user', $value)
                                ->get();
                    
                    if ($query->getNumRows() > 0) {
                                $row = $query->getRow();
                                return $row->nama_penuh;
                        }
                    
                            return null; // Return null if no results are found
            }
    }

    if (!function_exists('get_agensi')) {
        function get_agensi($value)
            {
                $db = \Config\Database::connect(); // Get the database connection
                    
                    $query = $db->table('table_main_agency')
                                ->select('nama_agensi_induk')
                                ->where('id_agensi_induk', $value)
                                ->get();
                    
                    if ($query->getNumRows() > 0) {
                                $row = $query->getRow();
                                return $row->nama_agensi_induk;
                        }
                    
                            return null; // Return null if no results are found
            }
    }

    if (!function_exists('get_random_ticket')) {
    function get_random_ticket($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('get_status_cr')) {
    function get_status_cr($value) {
        switch ($value) {
            case 1: return "Baru";
            case 2: return "Selesai PPTM";
            case 3: return "Tutup";
            case 4: return "Dalam Tindakan";
            case 5: return "Lulus CR";
            case 6: return "Tidak Lulus Permohonan";
            case 7: return "Disahkan";
            case 8: return "Belum Sah";
            case 9: return "Kemaskini Semula";
            case 10: return "Tutup Pemohon";
           
        }
    }
}

if (!function_exists('get_progress_cr')) {
    function get_progress_cr($status) {
        switch ($status) {
            case 1: return 20;    // Baru
            case 4: return 60;   // Dalam Tindakan
            case 2: return 85;   // Dalam Proses
            case 5: return 50;   // Lulus CR
            case 9: return 25;   //Kemaskini semula
            case 3: // Tutup
            case 10:// Tutup
            case 6: return 100;
            default: return 10;  // Dalam Proses
        }
    }
}

if (!function_exists('get_progress_class')) {
    function get_progress_class($status) {
        switch ($status) {
            case 5: return 'bg-success';
            case 3: return 'bg-success';
            case 10:
            case 6: return 'bg-danger';
            case 2: return 'bg-primary';
            case 4: return 'bg-warning';
            default: return 'bg-info';
        }
    }
}


function get_kategori_surat($value){
    if($value == 1){
        $value =  "Rayuan Baru";
    
    }else if($value == 2){
        $value =  "Maklumbalas Dalam Tindakan";
    }else if($value ==3){
        $value =  "Maklumbalas Tidak Lengkap";
    }else if($value == 4){
        $value =  "Maklumbalas Sabah";
    }
    
    else{
        $value =  "Lain-lain";
    }
    
    return $value;
    
}

function get_peranan($value){
    if($value == 1){
        $value =  "Pentadbir Sistem";
    
    }else if($value == 2){
        $value =  "Pengurus Rekod";
    }else if($value ==3){
        $value =  "Pemohon";
    }else if($value == 4){
        $value =  "Penyemak";
    }
    else if($value == 6){
        $value =  "Pelaksana(PPTM)";
    }
    else if($value == 7){
        $value =  "Pegawai Pengesah";
    }
    else if($value == 8){
        $value =  "Pemohon";
    }
    
    else{
        $value =  "Lain-lain";
    }
    
    return $value;
    
}

function get_status_rayuan($value){
    if($value == 1){
        $value =  "Dalam Semakan";
    
    }else if($value == 2){
        $value =  "Selesai Markah";
    }else if($value ==3){
        $value =  "Selesai Perakuan";
    }else if($value == 4){
        $value =  "Selesai";
    }else if($value ==5){
        $value =  "Pembatalan";
    }
    
    else{
        $value =  "Baru";
    }
    
    return $value;
    
}

function get_status_surat($value){
    if($value == 1){
        $value =  "SELESAI CETAK TOLAK";
    
    }else if($value == 2){
        $value =  "SELESAI CETAK SYOR";
    }else if($value ==3){
        $value =  "SELESAI CETAK LULUS";
    }
    
    else{
        $value =  "-";
    }
    
    return $value;
    
}

