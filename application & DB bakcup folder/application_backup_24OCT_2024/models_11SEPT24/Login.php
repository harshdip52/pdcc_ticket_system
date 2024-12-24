<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Model
{
    public function ckeckLogin($username, $password)
    {
        // $this->db->where('username',$username);  
        // $this->db->where('password',$password);  
        // $this->db->select('tbl_mst_users.*,tbl_mst_taluka.taluka_name,tbl_mst_branch.branch_name,tbl_mst_zone.zone_name,tbl_mst_role.role_name');  
        // $this->db->join('tbl_mst_taluka','CAST(tbl_mst_taluka.taluka_id AS NVARCHAR) = tbl_mst_users.taluka_id','left');
        // $this->db->join('tbl_mst_branch','CAST(tbl_mst_branch.branch_id AS NVARCHAR) = tbl_mst_users.branch_id','left');
        // $this->db->join('tbl_mst_zone','CAST(tbl_mst_zone.zone_id AS NVARCHAR) = tbl_mst_users.zone_id','left');
        // $this->db->join('tbl_mst_role','tbl_mst_role.role_id = tbl_mst_users.role'); 
        // return $this->db->get('tbl_mst_users')->row_array();

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->select('tbl_mst_users.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_role.role_name');
        $this->db->join('tbl_mst_taluka', 'CAST(tbl_mst_taluka.taluka_id AS nvarchar(250)) = tbl_mst_users.taluka_id', 'left');
        $this->db->join('tbl_mst_branch', 'CAST(tbl_mst_branch.branch_id AS nvarchar(250)) = tbl_mst_users.branch_id', 'left');
        $this->db->join('tbl_mst_zone', 'CAST(tbl_mst_zone.zone_id AS nvarchar(250)) = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'CAST(tbl_mst_role.role_id AS nvarchar(250)) = tbl_mst_users.role');
        //$this->db->get('tbl_mst_users');
        
        // $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_users.taluka_id', 'left');
        // $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_users.branch_id', 'left');
        // $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');
        // $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        return $this->db->get('tbl_mst_users')->row_array();
    }
    public function ckeckLogin_old($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->select('tbl_mst_users.*,tbl_mst_taluka.taluka_name,tbl_mst_branch.branch_name,tbl_mst_zone.zone_name,tbl_mst_role.role_name');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_users.taluka_id', 'left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_users.branch_id', 'left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        return $this->db->get('tbl_mst_users')->row_array();
    }
    public function ckeckLogin_new($username, $password)
    {
        $this->db->select('tbl_mst_users.user_id,tbl_mst_users.name,tbl_mst_users.email,tbl_mst_users.mobile,tbl_mst_users.emp_id,tbl_mst_users.role,tbl_mst_users.taluka_id,tbl_mst_users.zone_id,tbl_mst_users.branch_id,tbl_mst_users.username,tbl_mst_users.password,tbl_mst_users.status,tbl_mst_zone.zone_name,tbl_mst_role.role_name,GROUP_CONCAT(tbl_mst_taluka.taluka_name,",") as taluka_name,GROUP_CONCAT(tbl_mst_branch.branch_name,",") as branch_name');
        $this->db->join('tbl_mst_taluka', 'FIND_IN_SET(tbl_mst_taluka.taluka_id, tbl_mst_users.taluka_id) != 0');
        $this->db->join('tbl_mst_branch', 'FIND_IN_SET(tbl_mst_branch.branch_id, tbl_mst_users.branch_id) != 0');

        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->group_by('tbl_mst_users.taluka_id');
        $this->db->group_by('tbl_mst_users.branch_id');
        // $this->db->get();
        // echo $this->db->last_query();die;

        return $this->db->get('tbl_mst_users')->row_array();
    }

    function getallTalukaList()
    {
        $this->db->select('taluka_id,taluka_name,status');
        $this->db->from("tbl_mst_taluka");
        $res = $this->db->get();
        return $res->result_array();
    }
    function getBranchList()
    {
        $this->db->select('branch_id,taluka_id,zone_id,branch_code,branch_name,status');
        $this->db->from("tbl_mst_branch");
        $res = $this->db->get();
        return $res->result_array();
    }
}
