<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AjaxModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllUsers()
    {
        $this->db->select('tbl_mst_users.*, 
            tbl_mst_role.role_name');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        return $this->db->get('tbl_mst_users')->result_array();
    }



    public function getStatus()
    {
        return $this->db->get("tbl_mst_status")->result_array();
    }
    public function getAllInventryList()
    {
        return $this->db->get("tbl_inventory")->result_array();
    }

    public function getAllbrandList()
    {
        return $this->db->get("tbl_mst_brand")->result_array();
    }
    public function getAllCategoryList()
    {
        return $this->db->get("tbl_mst_category")->result_array();
    }

    public function getAllSubCategoryList()
    {
        $this->db->select('tbl_mst_sub_category.*, 
            tbl_mst_category.cat_name ');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_sub_category.cat_id');
        return $this->db->get('tbl_mst_sub_category')->result_array();
    }

    public function getAllZoneList()
    {
        $this->db->select('tbl_mst_zone.*, 
            tbl_mst_taluka.taluka_name ');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_zone.taluka_id');
        $this->db->order_by('tbl_mst_zone.zone_id', 'DESC');
        return $this->db->get('tbl_mst_zone')->result_array();
    }

    public function getAllBranchList()
    {
        $this->db->select('tbl_mst_branch.*, 
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name');

        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_branch.zone_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_zone.taluka_id');
        $this->db->order_by('tbl_mst_branch.branch_id', 'DESC');
        return $this->db->get('tbl_mst_branch')->result_array();
    }

    public function getBranchAdmin()
    {
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        $result = $this->db->get();
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }
    public function getBranch($postdata)
    {
        // print_r($postdata);

        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        if (!empty($postdata)) {
            $this->db->where_in('zone_id', $postdata);
        }
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }
    public function getBranchFotTicketDashboard($postdata)
    {
        // print_r($postdata);

        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        if (!empty($postdata)) {
            $this->db->where_in('zone_id', $postdata);
        }
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }

    public function getBranchSupport($postdata)
    {
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        if ($postdata != '' && $postdata != null) {
            $this->db->where('zone_id', $postdata);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getBranchAjaxUsersAdd($postdata)
    {
        if (in_array('All', $postdata)) {
        } else {
            if (!empty($postdata)) {
                $this->db->where_in('taluka_id', $postdata);
            }
        }
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        // if (!empty($postdata)) {
        //     $this->db->where_in('taluka_id', $postdata);
        // }
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getBranchEditUser($postdata)
    {
        if (!empty($postdata)) {
            if (in_array('ALL', $postdata['taluka_id'])) {
            } else {
                if (!empty($postdata['zone_id'])) {
                    $this->db->where_in('zone_id', $postdata['zone_id']);
                }
                if (!empty($postdata['taluka_id'])) {
                    $this->db->where_in('taluka_id', $postdata['taluka_id']);
                }
            }

            $this->db->select('*');
            $this->db->from('tbl_mst_branch');
            $result = $this->db->get();
            return $result->result_array();
        } else {
            return [];
        }
    }
    public function getBranchEditUser_old($postdata)
    {

        if (!empty($postdata['zone_id'])) {
            $this->db->where_in('zone_id', $postdata['zone_id']);
        }
        if (!empty($postdata['taluka_id'])) {
            $this->db->where_in('taluka_id', $postdata['taluka_id']);
        }
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        $result = $this->db->get();
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }
    public function getBranchUsers($zone_id)
    {


        if (in_array($_SESSION['login_role'], create_ticket_not_all_branch_access())) {
            if ($zone_id != 0) {
                $this->db->where('zone_id', $zone_id);
                $this->db->select('tbl_mst_branch.*');
                $this->db->from('tbl_mst_branch');
                $this->db->join('tbl_mst_users as u', 'u.branch_id = tbl_mst_branch.branch_id');
                $this->db->group_by('tbl_mst_branch.branch_id');
            }
        } else {
            $this->db->select('*');
            $this->db->from('tbl_mst_branch');
            // $this->db->group_by('tbl_mst_branch.branch_id');   //if gettin gduplicate values uncomment this condition in ms sql server
        }



        // $this->db->where('u.user_id', $_SESSION['login_user_id']);
        // $this->db->where('u.branch_id', $_SESSION['login_branch_id']);

        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }

    public function getBranchAjaxByUser()
    {
        $branch_id = $this->session->userdata('login_branch_id');


        // $this->db->where_in('branch_id',$branchIdsFormatted);
        // return $this->db->get("tbl_mst_branch")->result_array();

        $myQuery = "SELECT * FROM `tbl_mst_branch` WHERE branch_id in($branch_id)";
        $query = $this->db->query($myQuery);
        // echo $this->db->last_query;
        // die;
        return  $result = $query->result_array();
    }

    public function getZoneAdmin($taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        $this->db->get("tbl_mst_zone");
        return $this->db->get("tbl_mst_zone")->result_array();
    }
    public function getZone($taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        // $this->db->get("tbl_mst_zone");
        return $this->db->get("tbl_mst_zone")->result_array();
    }
    public function getZoneEditUser($postdata)
    {
        // printData($postdata);die;
        // $this->db->where('taluka_id', $taluka_id);
        // $this->db->where_in('taluka_id',explode(",",$postdata['taluka_id']));

        // $this->db->where_in('taluka_id',$postdata['taluka_id']);
        if (in_array("ALL", $postdata['taluka_id'])) {
        } else {
            $this->db->where_in('taluka_id', $postdata['taluka_id']);
        }
        // $this->db->get("tbl_mst_zone");
        // echo $this->db->last_query();die;
        return $this->db->get("tbl_mst_zone")->result_array();
    }
    public function getZoneNewOLD($postdata)
    {
        if (count($postdata) > 0) {
            $this->db->where_in('taluka_id', $postdata['taluka_id']);
            return $this->db->get("tbl_mst_zone")->result_array();
        }
    }
    public function getZoneNew($postdata)
    {
        if (in_array("All", $postdata['taluka_id'])) {
        } else {
            $this->db->where_in('taluka_id', $postdata['taluka_id']);
        }
        if (count($postdata) > 0) {
            return $this->db->get("tbl_mst_zone")->result_array();
        }
    }
    public function getSubCategoryForInventory($cat_id = '')
    {
        $this->db->where('cat_id', $cat_id);
        $this->db->where('use_for_inventory', 'Yes');
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }

    public function getSubCategoryForTicket($cat_id = '')
    {
        $this->db->where('cat_id', $cat_id);
        $this->db->where('use_for_ticket', 'Yes');
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }

    public function getSubCategory($cat_id = '')
    {
        $this->db->where('cat_id', $cat_id);
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }

    function moveToHo($update,$updateWhere){
        $updatearray = array('password' =>$newPassword);
        $this->db->where($updateWhere);
        $res = $this->db->update('tbl_mst_inventory', $update);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function getInventoryForAssign($cat_id,$sub_cat_id)
    {
        $this->db->select('tbl_mst_inventory.*, 
            tbl_mst_status.status_name,
            tbl_mst_users.name as supplier_name,
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_inventory_item.item_name,
             tbl_inventory_item.item_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_status', 'tbl_mst_status.id = tbl_mst_inventory.status');
        // $this->db->where_in('tbl_mst_inventory.status', [1,3,7]);
        $this->db->where_in('tbl_mst_inventory.status', [1, 3]);
        if($cat_id != '' && $cat_id != null){
            $this->db->where('tbl_mst_inventory.cat_id', $cat_id);
        }
        if($sub_cat_id != '' && $sub_cat_id != null){
            $this->db->where('tbl_mst_inventory.sub_cat_id', $sub_cat_id);
        }
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');
        return $this->db->get('tbl_mst_inventory')->result_array();
    }

    public function getInventoryBySearch($taluka_id, $zone_id, $branch_id)
    {
        // printData($_SESSION);die;
        $this->db->select('tbl_mst_inventory.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_mst_users.branch_id as user_branch_id,
             tbl_inventory_item.item_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');

        $this->db->where('tbl_mst_inventory.status', 2);

        /*if ($zone_id !=0) {
            $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
        }
        if ($taluka_id !=0) {
            $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        } */

        if ($branch_id != 0) {
            $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
        }

        // if (!in_array($_SESSION['login_branch_id'],allBranchAccessIds())) {
        //     $this->db->where("tbl_mst_users.branch_id",$_SESSION['login_branch_id']);
        // }

        // $this->db->get("tbl_mst_inventory");
        // echo $this->db->last_query();die;
        return $this->db->get('tbl_mst_inventory')->result_array();
    }
    public function getInventoryBySearchAdmin($branch_id, $taluka_id, $cat_id, $sub_cat_id)
    {
        $this->db->select('tbl_mst_inventory.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_mst_users.branch_id as user_branch_id,
             tbl_inventory_item.item_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');

        $this->db->where('tbl_mst_inventory.status', 2);

        /*if ($zone_id !=0) {
            $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
        }
        if ($taluka_id !=0) {
            $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        } */

        if ($branch_id != 0 && $branch_id != '') {
            $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
        }
        if ($taluka_id != 0 && $taluka_id != '') {
            $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        }
        if ($cat_id != 0 && $cat_id != '') {
            $this->db->where('tbl_mst_inventory.cat_id', $cat_id);
        }
        if ($sub_cat_id != 0 && $sub_cat_id != '') {
            $this->db->where('tbl_mst_inventory.sub_cat_id', $sub_cat_id);
        }

        // if (!in_array($_SESSION['login_branch_id'],allBranchAccessIds())) {
        //     $this->db->where("tbl_mst_users.branch_id",$_SESSION['login_branch_id']);
        // }

        // $this->db->get("tbl_mst_inventory");
        // echo $this->db->last_query();die;
        return $this->db->get('tbl_mst_inventory')->result_array();
    }
    public function getInventoryBySearchUsers($taluka_id, $zone_id, $branch_id)
    {
        // printData($_SESSION);die;
        $this->db->select('tbl_mst_inventory.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_mst_users.branch_id as user_branch_id,
            tbl_inventory_item.item_name,
            tbl_mst_sub_category.sub_cat_name');

        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = CAST(tbl_mst_inventory.item AS nvarchar(250))', 'left');
        // $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.branch_id = CAST(tbl_mst_inventory.branch_id AS nvarchar(250))', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = CAST(tbl_mst_inventory.taluka_id AS nvarchar(250))');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = CAST(tbl_mst_inventory.branch_id AS nvarchar(250))');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = CAST(tbl_mst_inventory.zone_id AS nvarchar(250))');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = CAST(tbl_mst_inventory.brand_id AS nvarchar(250))', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = CAST(tbl_mst_inventory.cat_id AS nvarchar(250))');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = CAST(tbl_mst_inventory.sub_cat_id AS nvarchar(250))');

        // $this->db->join('tbl_mst_users', 'tbl_mst_users.branch_id = tbl_mst_inventory.branch_id', 'left');
        // $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
        // $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
        // $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
        // $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        // $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        // $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');

        $this->db->where('tbl_mst_inventory.status', 2);

        // $this->db->where('tbl_mst_inventory.branch_id', $_SESSION['login_branch_id']);  // just removed

        /*if ($zone_id !=0) {
            $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
            }
            if ($taluka_id !=0) {
                $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        } */

        // if ($branch_id != 0) {
        //     $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
        // }
        if ($_SESSION['login_role'] == 4) {
            if ($branch_id != 0) {
                $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
            }
        }

        // if (!in_array($_SESSION['login_branch_id'],allBranchAccessIds())) {
        //     $this->db->where("tbl_mst_users.branch_id",$_SESSION['login_branch_id']);
        // }

        // $this->db->where("tbl_mst_users.branch_id",$_SESSION['login_branch_id']);
        // $this->db->where("tbl_mst_users.user_id",$_SESSION['login_user_id']);

        // $this->db->group_by("tbl_mst_inventory.id,tbl_mst_inventory.taluka_id,tbl_mst_inventory.zone_id,tbl_mst_inventory.branch_id");  // gettting wrong data then removed this comment 
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');
        // $this->db->get("tbl_mst_inventory");
        // echo $this->db->last_query();die;
        return $this->db->get('tbl_mst_inventory')->result_array();
    }

    ## Added by Harshdeep 
    ## on 7Th August 2024
    ## for getting taluka and zone details by Branch

    function getTalukaByBranch($talukaId, $zoneId)
    {
        // echo "model file ".$talukaId.$zoneId;die;
        $this->db->select("zone.zone_id,zone.zone_name,taluka.taluka_id,taluka.taluka_name");
        $this->db->from("tbl_mst_zone as zone");
        $this->db->join("tbl_mst_taluka as taluka", "taluka.taluka_id = zone.taluka_id");
        $this->db->where("taluka.taluka_id", $talukaId);
        $this->db->where("zone.zone_id", $zoneId);
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
    }
    function getTalukaByBranchUsers_old($talukaId, $zoneId)
    {
        // echo "model file ".$talukaId.$zoneId;die;
        $this->db->select("zone.zone_id,zone.zone_name,taluka.taluka_id,taluka.taluka_name");
        $this->db->from("tbl_mst_zone as zone");
        $this->db->join("tbl_mst_taluka as taluka", "taluka.taluka_id = zone.taluka_id");
        if ($talukaId != '' && $talukaId != null) {
            $this->db->where("taluka.taluka_id", $talukaId);
        }
        if ($zoneId != '' && $zoneId != null) {
            $this->db->where("zone.zone_id", $zoneId);
        }
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
    }
    function getTalukaByBranchUsers($talukaId, $zoneId)
    {
        $this->db->select("zone.zone_id,zone.zone_name,taluka.taluka_id,taluka.taluka_name");
        $this->db->from("tbl_mst_zone as zone");
        $this->db->join("tbl_mst_taluka as taluka", "taluka.taluka_id = zone.taluka_id");
        if ($talukaId != '' && $talukaId != null) {
            $this->db->where("taluka.taluka_id", $talukaId);
        }
        if ($zoneId != '' && $zoneId != null) {
            $this->db->where("zone.zone_id", $zoneId);
        }
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
    }

    function getDetails($postdata)
    {
        $this->db->select("tbl_mst_ticket.*,c.cat_name,sc.sub_cat_name");
        $this->db->from('tbl_mst_ticket');
        $this->db->join("tbl_mst_category as c", "c.cat_id = tbl_mst_ticket.cat_id");
        $this->db->join("tbl_mst_sub_category as sc", "sc.sub_cat_id = tbl_mst_ticket.sub_cat_id");
        $this->db->where("tbl_mst_ticket.branch_id", $postdata['branch_id']);
        $this->db->where("tbl_mst_ticket.taluka_id", $postdata['taluka_id_data']);
        $this->db->where("tbl_mst_ticket.zone_id", $postdata['zone_id_id_data']);
        $result = $this->db->get();
        return $result->result_array();
    }
    function getDetailsAdmin($postdata)
    {
        $this->db->select("tbl_mst_ticket.*,c.cat_name,sc.sub_cat_name");
        $this->db->from('tbl_mst_ticket');
        $this->db->join("tbl_mst_category as c", "c.cat_id = tbl_mst_ticket.cat_id");
        $this->db->join("tbl_mst_sub_category as sc", "sc.sub_cat_id = tbl_mst_ticket.sub_cat_id");
        $this->db->where("tbl_mst_ticket.branch_id", $postdata['branch_id']);
        $this->db->where("tbl_mst_ticket.taluka_id", $postdata['taluka_id_data']);
        $this->db->where("tbl_mst_ticket.zone_id", $postdata['zone_id_id_data']);
        $result = $this->db->get();
        return $result->result_array();
    }

    function getVrabdLsitByCatSubCat($postdata)
    {
        $this->db->select("tbl_mst_inventory.*,c.cat_name,sc.sub_cat_name,brand.brand_id,brand.brand_name");
        $this->db->from('tbl_mst_inventory');
        $this->db->join("tbl_mst_category as c", "c.cat_id = tbl_mst_inventory.cat_id");
        $this->db->join("tbl_mst_sub_category as sc", "sc.sub_cat_id = tbl_mst_inventory.sub_cat_id");
        $this->db->join("tbl_mst_brand as brand", "brand.brand_id = tbl_mst_inventory.brand_id");

        $this->db->where("c.cat_id", $postdata['cat_id']);
        $this->db->where("sc.sub_cat_id", $postdata['sw_sub_cat_id']);
        $result = $this->db->get();
        // echo $this->db->last_query();
        die;
        return $result->result_array();
    }
    function getTicketTitle($postdata)
    {

        $this->db->select('*');
        $this->db->from('tbl_mst_ticket_title');
        if ($postdata['cat_id'] != '' ||  $postdata['cat_id'] != null) {
            $this->db->where('cat_id', $postdata['cat_id']);
        }
        if ($postdata['sub_cat_id'] != '' ||  $postdata['sub_cat_id'] != null) {
            $this->db->where('sub_cat_id', $postdata['sub_cat_id']);
        }
        $this->db->order_by('ticket_title', 'asc');
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
    }


    public function getInventoryDeadBySearch($taluka_id, $zone_id, $branch_id)
    {
        $this->db->select('tbl_mst_inventory.*,
        tbl_mst_taluka.taluka_name,
        tbl_mst_branch.branch_name,
        tbl_mst_zone.zone_name,
        tbl_mst_brand.brand_name,
        tbl_mst_category.cat_name,
        tbl_mst_users.name as supplier_name,
         tbl_inventory_item.item_name,
        tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id','left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id','left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id','left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');
        $this->db->where('tbl_mst_inventory.status', 4);

        if ($taluka_id != 0 && $taluka_id != null && $taluka_id != '') {
            $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        }
        if ($zone_id != 0 && $zone_id != null && $zone_id != '') {
            $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
        }
        if ($branch_id != 0 && $branch_id != null && $branch_id != '') {
            $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
        }
        return $this->db->get('tbl_mst_inventory')->result_array();
    }
    public function getInventoryRepairStock($taluka_id, $zone_id, $branch_id)
    {
        $this->db->select('tbl_mst_inventory.*,
        tbl_mst_taluka.taluka_name,
        tbl_mst_branch.branch_name,
        tbl_mst_zone.zone_name,
        tbl_mst_brand.brand_name,
        tbl_mst_category.cat_name,
        tbl_mst_users.name as supplier_name,
         tbl_inventory_item.item_name,
        tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id','left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id','left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id','left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');
        $this->db->where('tbl_mst_inventory.status', 7);

        if ($taluka_id != 0 && $taluka_id != null && $taluka_id != '') {
            $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        }
        if ($zone_id != 0 && $zone_id != null && $zone_id != '') {
            $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
        }
        if ($branch_id != 0 && $branch_id != null && $branch_id != '') {
            $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
        }
        return $this->db->get('tbl_mst_inventory')->result_array();
    }

    function getUserDetailedById($user_id)
    {
        $taluka_name = [];
        $branch_name = [];
        $zone_name = [];

        $this->db->select('tbl_mst_users.user_id,tbl_mst_users.name,tbl_mst_users.email,tbl_mst_users.mobile,tbl_mst_users.emp_id,tbl_mst_users.role,tbl_mst_users.taluka_id,tbl_mst_users.zone_id,tbl_mst_users.branch_id,tbl_mst_users.status,tbl_mst_role.role_name');
        //,tbl_mst_zone.zone_name,tbl_mst_role.role_name,tbl_mst_zone.zone_name,tbl_mst_role.role_name,GROUP_CONCAT(tbl_mst_taluka.taluka_name) as taluka_name,GROUP_CONCAT(tbl_mst_branch.branch_name) as branch_name

        // $this->db->join('tbl_mst_taluka', 'FIND_IN_SET(tbl_mst_taluka.taluka_id, tbl_mst_users.taluka_id) != 0');
        // $this->db->join('tbl_mst_branch', 'FIND_IN_SET(tbl_mst_branch.branch_id , tbl_mst_users.branch_id) !=0');
        // $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        $this->db->where('tbl_mst_users.user_id', $user_id);
        $result = $this->db->get('tbl_mst_users')->row_array();

        if ($result['taluka_id'] != '' && $result['taluka_id'] != null) {
            $comma_sep_taluka = $result['taluka_id'];
            $this->db->select('tbl_mst_taluka.taluka_id,tbl_mst_taluka.taluka_name');
            $this->db->from('tbl_mst_taluka');
            $this->db->where_in('taluka_id', explode(',', $comma_sep_taluka));
            $taluka_name_data = $this->db->get()->result_array();
            $result['taluka_name'] =  implode(",", array_column($taluka_name_data, "taluka_name"));
        }
        if ($result['branch_id'] != '' && $result['branch_id'] != null) {
            $comma_sep_branch_id = $result['branch_id'];
            $this->db->select('tbl_mst_branch.branch_id,tbl_mst_branch.branch_name');
            $this->db->from('tbl_mst_branch');
            $this->db->where_in('branch_id', explode(',', $comma_sep_branch_id));
            $branch_name_data = $this->db->get()->result_array();
            $result['branch_name'] = implode(",", array_column($branch_name_data, "branch_name"));
        }

        if ($result['zone_id'] != '' && $result['zone_id'] != null) {
            $comma_sep_zone_id = $result['zone_id'];
            $this->db->select('tbl_mst_zone.zone_id,tbl_mst_zone.zone_name');
            $this->db->from('tbl_mst_zone');
            $this->db->where_in('zone_id', explode(',', $comma_sep_zone_id));
            $zone_name_data = $this->db->get()->result_array();
            $result['zone_name'] = implode(",", array_column($zone_name_data, "zone_name"));
        }

        return $result;
    }

    public function getUserDetailedById_old($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->select('tbl_mst_users.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_role.role_name');
        //  CAST(tbl_mst_branch.branch_name AS VARCHAR), ', ')
        // CAST(tbl_mst_users.taluka_id AS varchar(255))

        $this->db->join('tbl_mst_taluka', 'CAST(tbl_mst_taluka.taluka_id AS nvarchar(250) = tbl_mst_users.taluka_id)', 'left');
        $this->db->join('tbl_mst_branch', 'CAST(tbl_mst_branch.branch_id AS nvarchar(250)) = tbl_mst_users.branch_id', 'left');
        $this->db->join('tbl_mst_zone', 'CAST(tbl_mst_branch.branch_id AS nvarchar(250)) = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');

        // $this->db->get('tbl_mst_users');
        // echo $this->db->last_query();die;
        return $this->db->get('tbl_mst_users')->row_array();
    }


    // =============================================
    // Ticket
    // =============================================


    public function getTicketListwithIds($taluka_id, $zone_id, $branch_id, $sel_date)
    {

        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        if (!empty($sel_date)) {
            $this->db->where('tbl_mst_ticket.created_on', $sel_date);
        }

        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'CAST(tbl_mst_ticket_title.id AS nvarchar(250)) = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'CAST(tbl_mst_taluka.taluka_id AS nvarchar(250)) = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'CAST(tbl_mst_branch.branch_id AS nvarchar(250)) = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'CAST(tbl_mst_zone.zone_id AS nvarchar(250)) = tbl_mst_ticket.zone_id');
        // $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        // $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        // $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        // $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        // $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');

        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    function getTicketListwithIdsNew($taluka_id, $status)
    {

        if ($taluka_id != '' && $status != '') {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.status', $status);
        }
        if ($taluka_id != '') {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        if ($status != '') {
            $this->db->where('tbl_mst_ticket.status', $status);
        }

        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'CAST(tbl_mst_ticket_title.id AS nvarchar(250)) = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'CAST(tbl_mst_taluka.taluka_id AS nvarchar(250)) = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'CAST(tbl_mst_branch.branch_id AS nvarchar(250)) = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'CAST(tbl_mst_zone.zone_id AS nvarchar(250)) = tbl_mst_ticket.zone_id');
        // $this->db->limit(100);
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function todaysTickets($taluka_id, $zone_id, $branch_id)
    {
        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        $created_on = date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on', $created_on);
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function InprogressTickets($taluka_id, $zone_id, $branch_id)
    {
        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        $this->db->where('tbl_mst_ticket.status', 'Inprogress');
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function PendingTickets($taluka_id, $zone_id, $branch_id)
    {
        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        $created_on = date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on !=', $created_on);
        $this->db->where('tbl_mst_ticket.status', 'New');
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }
    public function ClosedTickets($taluka_id, $zone_id, $branch_id)
    {
        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }

        $this->db->where('tbl_mst_ticket.status', 'Resolved');
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function ForwardedTickets($taluka_id, $zone_id, $branch_id)
    {
        if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }

        $this->db->where('tbl_mst_ticket.status', 'Forwarded');
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_users.name,
            u.name as forward_from_name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_users as u', 'u.user_id = tbl_mst_ticket.forword_from_1');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getUsers($branch_id)
    {
        // $myQuery = "SELECT * FROM `tbl_mst_users` WHERE branch_id LIKE '%,$branch_id,%' OR branch_id LIKE '%,$branch_id' OR branch_id LIKE '$branch_id,%' OR branch_id='$branch_id';";
        $myQuery = "SELECT * FROM `tbl_mst_users` WHERE role=5 and find_in_set('$branch_id',branch_id);";
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();
    }
    public function getUsersByRole($role)
    {
        $this->db->where('role', $role);
        return $this->db->get('tbl_mst_users')->result_array();
    }
    public function getAssignInventryList($branch_id, $cat_id, $sub_cat_id, $brand_id)
    {
        $this->db->where('branch_id', $branch_id);
        $this->db->where('cat_id', $cat_id);
        $this->db->where('sub_cat_id', $sub_cat_id);
        $this->db->where('brand_id', $brand_id);
        return $this->db->get("tbl_inventory")->result_array();
    }

    public function getTicketTitleBySubCatId($sub_cat_id = '')
    {
        $this->db->where('sub_cat_id', $sub_cat_id);
        return $this->db->get("tbl_mst_ticket_title")->result_array();
    }


    public function getTicketNo($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->select('ticket_no,user_id');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function insertReminder($formdata)
    {
        $this->db->insert('tbl_ticket_reminder', $formdata);
        return $insert_id = $this->db->insert_id();
    }
}
