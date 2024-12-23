<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class BranchManagerModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function allusers($manager_assign_branch_ids){
       
        $branchIds = explode(',',$manager_assign_branch_ids);
        $result = [];
       

        $this->db->select('user_id,name,email,mobile,emp_id,role,taluka_id,zone_id,branch_id,username,password,status');
        
        // $this->db->where("FIND_IN_SET($manager_assign_branch_ids,'branch_id') > 0");
        // $this->db->where("CONCAT(',',branch_id,',') like '%$manager_assign_branch_ids%'");
        $this->db->where("$manager_assign_branch_ids IN (SELECT $manager_assign_branch_ids FROM STRING_SPLIT(branch_id, ','))", NULL, FALSE);

       
        $this->db->from('tbl_mst_users');
        $res = $this->db->get();
        // echo $this->db->last_query();
        // die;
        return $res->result_array();
    }

    public function getBranch($zone_id)
    {
        if ($zone_id != 0) {
            $this->db->where('zone_id', $zone_id);
        }
        
        $this->db->select('tbl_mst_branch.*');
        $this->db->from('tbl_mst_branch');
        $this->db->join("tbl_mst_users as u","u.branch_id = tbl_mst_branch.branch_id");
        $this->db->where('u.user_id', $_SESSION['login_user_id']);
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }
    public function getBranch_new($zone_id)
    {
        if ($zone_id != 0) {
            $this->db->where('zone_id', $zone_id);
        }
        
        $this->db->select('tbl_mst_branch.branch_id,tbl_mst_branch.taluka_id,.tbl_mst_branch.zone_id,tbl_mst_branch.branch_code,tbl_mst_branch.branch_name,tbl_mst_branch.status');
        $this->db->from('tbl_mst_branch');
        $this->db->where_in('tbl_mst_branch.branch_id', explode(",",$_SESSION['login_branch_id']));
        $result = $this->db->get();
       
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
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
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
    }

    public function getCounter($module_id)
    {
        $this->db->select('counter'); 
        $this->db->where('module_id',$module_id); 
        return $this->db->get('tbl_mst_counter')->row_array();
    }

    function addnewTicketAjax($formdata){
        $this->db->insert('tbl_mst_ticket',$formdata); 
        return $insert_id = $this->db->insert_id();
    }

    public function updateCounter($formdata,$module_id)
    {
        $this->db->where('module_id', $module_id);
        return $this->db->update('tbl_mst_counter', $formdata);
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

    public function getSubCategory($cat_id = '')
    {
        $this->db->where('cat_id', $cat_id);
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }

function getCategoryWiseTitle($catId,$subCatId){
        $this->db->select('id,cat_id,sub_cat_id,ticket_title');
        $this->db->from('tbl_mst_ticket_title');
        $this->db->where('cat_id', $catId);
        $this->db->where('sub_cat_id', $subCatId);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getInventoryDeadBySearch($taluka_id, $zone_id, $branch_id)
    {
        if ($taluka_id == 0 && $zone_id == 0 && $branch_id == 0) {

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
            $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
            $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
            $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
            $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
            $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
            $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
            $this->db->order_by('tbl_mst_inventory.id', 'DESC');
            $this->db->where('tbl_mst_inventory.status', 4);
            return $this->db->get('tbl_mst_inventory')->result_array();
        }
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
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.id', 'DESC');
        $this->db->where('tbl_mst_inventory.status', 4);

        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.zone_id', $zone_id);
        $this->db->where('tbl_mst_inventory.branch_id', $branch_id);
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

    public function getTodaysTicket($user_id)
    { 
        // $created_on =trim(date('Y-m-d'));
        $created_on = new DateTime("now");
        $curr_date = $created_on->format('Y-m-d ');

    	$this->db->select('tbl_mst_ticket.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name');          
        $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        // $this->db->where("DATE('tbl_mst_ticket.created_on')",trim($curr_date)); 
        // $this->db->where('tbl_mst_ticket.created_on >=', $created_on);
        // $this->db->where('tbl_mst_ticket.created_on <=', $created_on);
        $this->db->order_by("tbl_mst_ticket.created_on","DESC");
        $this->db->get("tbl_mst_ticket");
        echo $this->db->last_query();
        die;
        return $this->db->get('tbl_mst_ticket')->result_array();
    }
}