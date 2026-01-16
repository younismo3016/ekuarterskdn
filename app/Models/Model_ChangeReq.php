<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_ChangeReq extends Model
{
    protected $table      = 'change_req';
    protected $primaryKey = 'id_cr';
    protected $allowedFields = [
        'status_cr', 
        'status_lulus_kpsu', 
        'no_hp', 
        'level',
        'photo_user',
    ];

    public function get_all_data()
    {
        return $this->db->table('change_req')->orderBy('id_cr', 'DESC')->get()->getResultArray();
    }
    public function get_cr($id_user)
    {
        
        $builder=$this->select('*');
        $builder->where('id_cr', $id_user);
        return $builder->get()->getResultArray(); 
        //return $this->db->table('tbl_surat_masuk')->get()->getResultArray();
    }
    function carian_cr($tiket_cr,$status_cr)
    {

        
        $builder = $this->db->table('change_req'); // Initialize the query builder for the tbl_user table
        $builder->orderBy('id_cr', 'DESC');

        if($tiket_cr){
            $builder->like('tiket_cr',$tiket_cr,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }
    function carian_cr_data_pemohon($ticket_id,$status_cr,$id_user)
    {

        
        $builder = $this->db->table('change_req'); // Initialize the query builder for the tbl_user table
        $builder->where('id_pemohon', $id_user);
        $builder->orderBy('id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }
        $builder->where('jenis_penambahbaikan', 'PusatData');

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_cr_data_psu($ticket_id,$status_cr,$id_user)
    {

        
        $builder = $this->db->table('change_req'); // Initialize the query builder for the tbl_user table
        $builder->where('id_pegawai_pengesah', $id_user);
        $builder->groupStart()
        ->where('kategori_cr !=', '')             // bukan kosong
        ->where('kategori_cr IS NOT NULL')        // bukan NULL
        ->groupEnd();
        $builder->orderBy('id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }
        $builder->where('jenis_penambahbaikan', 'PusatData');

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

     function carian_cr_data_tindakan($tiket_cr,$status_cr,$id_user)
    {

        
        $builder = $this->db->table('change_req'); // Initialize the query builder for the tbl_user table
        $builder->groupStart()
        ->where('kategori_cr !=', '')             // bukan kosong
        ->where('kategori_cr IS NOT NULL')        // bukan NULL
        ->groupEnd();
       

        if($tiket_cr){
            $builder->like('tiket_cr',$tiket_cr,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }
        $builder->where('jenis_penambahbaikan', 'PusatData');
       
        $builder->orderBy("FIELD(id_psu, '{$id_user}') DESC", '', false);
         $builder->orderBy('id_cr', 'DESC');

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_cr_data_pptm($tiket_cr,$status_cr,$id_user)
    {

        
        $builder = $this->db->table('change_req'); // Initialize the query builder for the tbl_user table
        $builder->groupStart()
        ->where('kategori_cr !=', '')             // bukan kosong
        ->where('kategori_cr IS NOT NULL')        // bukan NULL
        ->groupEnd();
    
        if($tiket_cr){
            $builder->like('tiket_cr',$tiket_cr,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }
        $builder->where('jenis_penambahbaikan', 'PusatData');
        $builder->orderBy("FIELD(id_pptm, '{$id_user}') DESC", '', false);
        $builder->orderBy('id_cr', 'DESC');

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_cr_kpsu($ticket_id,$status_cr)

    {
         $id_seksyen = session()->get('id_seksyen');
        
        $builder = $this->db->table('change_req');
        $builder->join('tbl_nama_sistem', 'tbl_nama_sistem.id_nama_sistem = change_req.id_nama_sistem');
        $builder->where('tbl_nama_sistem.id_seksyen', $id_seksyen); // filter ikut seksyen dari tbl_nama_sistem
        $builder->orderBy('change_req.id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }

        $builder->limit(15); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_cr_psu($ticket_id,$status_cr)

    {

        $id_seksyen = session()->get('id_seksyen');
        
        $builder = $this->db->table('change_req');
        $builder->join('tbl_nama_sistem', 'tbl_nama_sistem.id_nama_sistem = change_req.id_nama_sistem');
        $builder->where('tbl_nama_sistem.id_seksyen', $id_seksyen); // filter ikut seksyen dari tbl_nama_sistem
        $builder->orderBy('change_req.id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }

        

        $builder->limit(15); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

     function carian_cr_pptm($ticket_id,$status_cr)

    {

          $id_user = session()->get('id_user');
        
        $builder = $this->db->table('change_req'); 
        $builder->where('id_pptm', $id_user); // Initialize the query builder for the tbl_user table
        $builder->orderBy('id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        if($status_cr){
            $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        }
        

        $builder->limit(15); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

     function carian_cr_pengesah($ticket_id)

    {

         $id_user = session()->get('id_user');

        $builder = $this->db->table('change_req'); 
        $builder->where('id_pegawai_pengesah', $id_user);     // Initialize the query builder for the tbl_user table
        $builder->orderBy('id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

    function carian_cr_pemohon($ticket_id)
    {
         $id_user = session()->get('id_user');
        
        $builder = $this->db->table('change_req');
         // Filter ikut id_user
        $builder->where('id_pemohon', $id_user); // Initialize the query builder for the tbl_user table
        $builder->orderBy('id_cr', 'DESC');

        if($ticket_id){
            $builder->like('ticket_id',$ticket_id,'both'); //'%match%' 
        }
        // if($status_cr){
        //     $builder->like('status_cr',$status_cr,'both'); //'%match%' 
        // }

        $builder->limit(10); // ✅ Hadkan kepada 15 rekod
     
        //dah pakai paginate tak payah pakai get()->getResult() dah
        return $builder->get()->getResultArray();
      

    }

   public function getSummaryByLevel ($level, $id_user, $id_bahagian, $id_seksyen)
    {
        $db = \Config\Database::connect();
        //$builder = $db->query(''); // kosong dulu

        if ($level == 8 || $level == 7) {
            $sql = "SELECT 
                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '7' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS baru,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '4' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS dalam_tindakan,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '3'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS tutup,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '5' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS lulus_cr";

            return $db->query($sql, [ $id_seksyen, $id_seksyen, $id_seksyen, $id_seksyen])->getRow();
        } else if ($level == 6) { //6
            $sql = "SELECT 
                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_pptm = ? AND id_seksyen = ?  AND status_cr = '7' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS baru,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_pptm = ? AND id_seksyen = ?  AND status_cr = '4'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS dalam_tindakan,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_pptm = ? AND id_seksyen = ?  AND status_cr = '3'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS tutup,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_pptm = ? AND id_seksyen = ?  AND status_cr = '5' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS lulus_cr";

            return $db->query($sql, [$id_user,$id_seksyen,$id_user, $id_seksyen,$id_user, $id_seksyen,$id_user,$id_seksyen])->getRow();

        } else if ($level == 5) { //psu
            $sql = "SELECT 
                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '7' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS baru,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '4' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS dalam_tindakan,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '3'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS tutup,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '5' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS lulus_cr";

                                    return $db->query($sql, [ $id_seksyen, $id_seksyen, $id_seksyen, $id_seksyen])->getRow();

            
        } else if ($level == 3) { //kpsu
            $sql = "SELECT 
                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '7' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS baru,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '4' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS dalam_tindakan,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '3'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS tutup,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '5' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS lulus_cr";

            return $db->query($sql, [ $id_seksyen, $id_seksyen, $id_seksyen, $id_seksyen])->getRow();
        } else {
            $sql = "SELECT 
                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '7' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS baru,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '4' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS dalam_tindakan,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '3'
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS tutup,

                        (SELECT COUNT(DISTINCT id_cr) 
                        FROM change_req 
                        JOIN tbl_nama_sistem USING(id_nama_sistem) 
                        WHERE id_seksyen = ? AND status_cr = '5' 
                        AND YEAR(tarikh_mohon) = YEAR(CURDATE())) AS lulus_cr";

            return $db->query($sql, [ $id_seksyen, $id_seksyen, $id_seksyen, $id_seksyen])->getRow();
            // return $builder->get()->getResultArray();
        }
    }

    public function add_cr($data)
    {
        $this->db->table('change_req')->insert($data);
    }

    public function update_cr($data, $id_cr)
    {
        $this->db->table('change_req')->update($data, array('id_cr' => $id_cr));
    }

    public function delete_user($id_user)
    {
        $this->db->table('tbl_user')->delete(array('id_user' => $id_user));
    }

}