<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UsersProfileModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function getAllRoles($roleID){
        $this->db->select('*');
        // $this->db->where('role_id', $roleID);
        $this->db->from('tbl_mst_role');
        return $this->db->get()->result_array();
    }
}
