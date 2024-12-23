<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
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

	public function insertInventory($formdata)
    {
        $this->db->insert('tbl_inventory',$formdata); 
        return $insert_id = $this->db->insert_id();
    }
    public function getAllInventory()
    {
        $this->db->select('tbl_inventory.*,
        	tbl_mst_taluka.taluka_name,
        	tbl_mst_branch.branch_name,
        	tbl_mst_zone.zone_name,
        	tbl_mst_brand.brand,
        	tbl_mst_category.cat_name,
        	tbl_mst_sub_category.sub_cat_name');  
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_inventory.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_inventory.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_inventory.zone_id');
        $this->db->join('tbl_mst_brand','tbl_mst_brand.brand_id = tbl_inventory.brand_id');
        $this->db->join('tbl_mst_category','tbl_mst_category.cat_id = tbl_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category','tbl_mst_sub_category.sub_cat_id = tbl_inventory.sub_cat_id'); 
        $this->db->order_by('tbl_inventory.inventory_id', 'DESC');
        return $this->db->get('tbl_inventory')->result_array();
    }

    public function getInventoryById($inventory_id)
    {
        $this->db->select('tbl_inventory.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_brand.brand,
            tbl_mst_category.cat_name,
            tbl_mst_sub_category.sub_cat_name');  
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_inventory.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_inventory.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_inventory.zone_id');
        $this->db->join('tbl_mst_brand','tbl_mst_brand.brand_id = tbl_inventory.brand_id');
        $this->db->join('tbl_mst_category','tbl_mst_category.cat_id = tbl_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category','tbl_mst_sub_category.sub_cat_id = tbl_inventory.sub_cat_id');
        $this->db->where('tbl_inventory.inventory_id',$inventory_id);

        $this->db->order_by('tbl_inventory.inventory_id', 'DESC');
        return $this->db->get('tbl_inventory')->row_array();
    }

    public function updateInventory($formdata,$inventory_id)
    {
        $this->db->where('inventory_id', $inventory_id);
        return $this->db->update('tbl_inventory', $formdata);
    }
	
}

?>