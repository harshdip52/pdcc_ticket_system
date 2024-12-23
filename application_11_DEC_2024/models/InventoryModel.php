<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllTalukaList()
    {
        return $this->db->get("tbl_mst_taluka")->result_array();
    }
    public function getAllBrandList()
    {
        return $this->db->get("tbl_mst_brand")->result_array();
    }
    public function getAllCategoryList()
    {
        return $this->db->get("tbl_mst_category")->result_array();
    }
    public function getAllSubCategoryList()
    {
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }
    public function getallBranches()
    {
        return $this->db->get("tbl_mst_branch")->result_array();
    }

    function getItemNamesList()
    {
        $where = array('cat_id' => 1, 'sub_cat_id' => 1);
        $this->db->select('id,cat_id,sub_cat_id,item_name');
        $this->db->where($where);
        return $this->db->get("tbl_inventory_item")->result_array();
    }
    function getCPUSerialNoList()
    {
        $where = array('cat_id' => 1, 'sub_cat_id' => 1);
        $this->db->select('id,cat_id,sub_cat_id,serial_no');
        $this->db->where($where);
        return $this->db->get("tbl_mst_inventory")->result_array();
    }

    public function insertInventory($formdata)
    {
        $this->db->insert('tbl_mst_inventory', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getAllInventory()
    {
        $this->db->select('tbl_mst_inventory.*, 
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_inventory_item.item_name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id', 'left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id', 'left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id', 'left');

        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        return $this->db->get('tbl_mst_inventory')->result_array();
    }

    public function getInventoryById($id)
    {
        $this->db->select('tbl_mst_inventory.*, 
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_inventory_item.item_name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id', 'left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id', 'left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id', 'left');

        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->where('tbl_mst_inventory.id', $id);
        return $this->db->get('tbl_mst_inventory')->row_array();
    }

    public function updateInventory($formdata, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_mst_inventory', $formdata);
    }
    public function insertAssignInventory($formdata)
    {
        // print_r($formdata);
        $this->db->insert('tbl_assign_inventory', $formdata);
        $insert_id = $this->db->insert_id();
    }

    public function updateAssignInventory($id, $formdata)
    {
        // print_r($id);
        $this->db->where('id', $id['id']);
        return $this->db->update('tbl_mst_inventory', $formdata);
    }
    public function getUsersByRole($role)
    {
        $this->db->where('role', $role);
        return $this->db->get('tbl_mst_users')->result_array();
    }



    public function getBranch($postdata)
    {
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        if ($postdata != '' || $postdata != null) {
            $this->db->where('zone_id', $postdata);
        }
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getBranchInventory($postdata)
    {
        if ($postdata != '' || $postdata != null) {
            $this->db->where('zone_id', $postdata);
        }
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');

        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->result_array();
        // return $this->db->get("tbl_mst_branch")->result_array();
    }



    ////////////////////////////////////////////////////////////////////////////////

    public function createInventory($formdata)
    {
        $this->db->insert('tbl_mst_inventory', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    public function getallitem()
    {
        $this->db->select('tbl_inventory_item.*,
            tbl_mst_category.cat_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_inventory_item.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_inventory_item.sub_cat_id');
        return $this->db->get('tbl_inventory_item')->result_array();
    }
    public function addItem($formdata)
    {
        $this->db->insert('tbl_inventory_item', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    public function getItemById($id)
    {
        $this->db->where('id', $id);
        $this->db->select('tbl_inventory_item.*');

        return $this->db->get('tbl_inventory_item')->row_array();
    }

    public function updateItem($formdata, $id)
    {

        $this->db->where('id', $id);
        return $this->db->update('tbl_inventory_item', $formdata);
    }

    public function getItemBySubCat($sub_cat_id)
    {
        $this->db->where('sub_cat_id', $sub_cat_id);

        return $this->db->get('tbl_inventory_item')->result_array();
    }


    function checkSerialNumberExists($serial_no)
    {
        $this->db->where('serial_no', $serial_no);
        return $this->db->get('tbl_mst_inventory')->result_array();
    }



    public function deleteInventory($id = '')
    {
        $this->db->where('id', $id);
        return $deleted = $this->db->delete('tbl_mst_inventory');
    }


    public function chechDuplicateSerial($serial_no)
    {
        $this->db->where('serial_no', $serial_no);
        $this->db->select('tbl_mst_inventory.*');
        return $this->db->get('tbl_mst_inventory')->row_array();
        // return $this->db->get('tbl_mst_inventory')->result_array();
    }
    public function chechDuplicateIp($ip_address)
    {
        $this->db->where('ip_address', $ip_address);
        $this->db->select('tbl_mst_inventory.*');
        return $this->db->get('tbl_mst_inventory')->row_array();
    }
    public function getSubCategory($cat_id = '')
    {
        $this->db->where('cat_id', $cat_id);
        // $this->db->get("tbl_mst_sub_category");
        // echo $this->db->last_query();
        // die;
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }


    ## added by Harshdeep
    ## on 78 August

    function allusers()
    {
        $this->db->select('user_id,name,email,mobile,emp_id,role,taluka_id,zone_id,branch_id,username,password,status');
        $this->db->from('tbl_mst_users');
        $res = $this->db->get();
        return $res->result_array();
    }

    ## added by harshdeep
    ## only for Software and Network subcategort List

    function onlyeSWNKSUBCategortList()
    {
        $this->db->select('sub_cat_id,cat_id,sub_cat_name,use_for_inventory,use_for_ticket,status');
        $this->db->from('tbl_mst_sub_category');
        $this->db->where_in('cat_id', [2, 5, 6]);
        $res = $this->db->get();
        return $res->result_array();
    }

    public function inventory_movement_log($formdata)
    {
        $this->db->insert('tbl_inventory_movement_log', $formdata);
        $insert_id = $this->db->insert_id();
    }

    public function getInventoryRepairMovementDeadStockLogs($taluka_id, $zone_id, $branch_id,$action_status)
    {
        $this->db->select('tbl_inventory_movement_log.*,
        tbl_mst_taluka.taluka_name,
        tbl_mst_branch.branch_name,
        tbl_mst_zone.zone_name,
        tbl_mst_brand.brand_name,
        tbl_mst_category.cat_name,
        tbl_mst_users.name as supplier_name,
         tbl_inventory_item.item_name,
        tbl_mst_sub_category.sub_cat_name,tbl_mst_inventory.serial_no,tbl_mst_inventory.ip_address,users.name as insertedName');
        $this->db->join('tbl_mst_inventory', 'tbl_inventory_movement_log.inventory_id = tbl_mst_inventory.id', 'left');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_inventory.item', 'left');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_inventory.supplier', 'left');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id','left');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id','left');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id','left');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id', 'left');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->join('tbl_mst_users as users', 'users.user_id = tbl_inventory_movement_log.inserted_by');
        $this->db->order_by('tbl_inventory_movement_log.id', 'DESC');
        //$this->db->where('tbl_inventory_movement_log.status', 7);

        if ($taluka_id != 0 && $taluka_id != null && $taluka_id != '') {
            $this->db->where('tbl_inventory_movement_log.taluka_id', $taluka_id);
        }
        if ($zone_id != 0 && $zone_id != null && $zone_id != '') {
            $this->db->where('tbl_inventory_movement_log.zone_id', $zone_id);
        }
        if ($branch_id != 0 && $branch_id != null && $branch_id != '') {
            $this->db->where('tbl_inventory_movement_log.branch_id', $branch_id);
        }        
        if ($action_status != 0 && $action_status != null && $action_status != '') {
            $this->db->where('tbl_inventory_movement_log.action_status', $action_status);
        }

        return $this->db->get('tbl_inventory_movement_log')->result_array();
    }
}
