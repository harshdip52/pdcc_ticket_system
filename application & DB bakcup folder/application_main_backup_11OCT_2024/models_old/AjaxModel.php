<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AjaxModel extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getBranch($taluka_id='')
	{   
		$this->db->where('taluka_id',$taluka_id);
        return $this->db->get("tbl_mst_branch")->result_array();
	}

	public function getZone($branch_id='')
	{   
		$this->db->where('branch_id',$branch_id);
        return $this->db->get("tbl_mst_zone")->result_array();
	}
	public function getSubCategory($cat_id='')
	{   
		$this->db->where('cat_id',$cat_id);
        return $this->db->get("tbl_mst_sub_category")->result_array();
	}

	 
    public function getInventoryBySearch($taluka_id, $branch_id, $zone_id, $brand_id, $cat_id, $sub_cat_id)
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
        $this->db->where('tbl_inventory.dead_stock',0);
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        { 
        	$this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        { 
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.branch_id',$branch_id);   
            return $this->db->get('tbl_inventory')->result_array();
        }

        // if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        // {   
        //     $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
        //     $this->db->where('tbl_inventory.brand_id',$brand_id);  
        //     $this->db->where('tbl_inventory.branch_id',$branch_id);   
        //     $this->db->where('tbl_inventory.zone_id',$zone_id);   
        //     return $this->db->get('tbl_inventory')->result_array();
        // }

    }



    public function getInventoryDeadBySearch($taluka_id, $branch_id, $zone_id, $brand_id, $cat_id, $sub_cat_id)
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
        $this->db->where('tbl_inventory.dead_stock',1);
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id==0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id==0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.branch_id',$branch_id); 
            $this->db->where('tbl_inventory.zone_id',$zone_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id); 
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id); 
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.taluka_id',$taluka_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        {
            $this->db->where('tbl_inventory.cat_id',$cat_id); 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id==0)
        { 
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        { 
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id==0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }
        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id==0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id==0 and $zone_id==0 and $brand_id!=0 and $cat_id!=0 and $sub_cat_id!=0)
        {   
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.cat_id',$cat_id);  
            $this->db->where('tbl_inventory.sub_cat_id',$sub_cat_id);  
            return $this->db->get('tbl_inventory')->result_array();
        }

        if ($taluka_id!=0 and $branch_id!=0 and $zone_id==0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        {   
            $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
            $this->db->where('tbl_inventory.brand_id',$brand_id);  
            $this->db->where('tbl_inventory.branch_id',$branch_id);   
            return $this->db->get('tbl_inventory')->result_array();
        }

        // if ($taluka_id!=0 and $branch_id!=0 and $zone_id!=0 and $brand_id!=0 and $cat_id==0 and $sub_cat_id==0)
        // {   
        //     $this->db->where('tbl_inventory.taluka_id',$taluka_id);  
        //     $this->db->where('tbl_inventory.brand_id',$brand_id);  
        //     $this->db->where('tbl_inventory.branch_id',$branch_id);   
        //     $this->db->where('tbl_inventory.zone_id',$zone_id);   
        //     return $this->db->get('tbl_inventory')->result_array();
        // }

    }




    
}

?>