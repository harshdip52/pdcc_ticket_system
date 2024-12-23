<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Ajax extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AjaxModel');
        $this->load->model('InventoryModel');
    }
    public function getBranchAjax($taluka_id)
    { 
        $getBranch=$this->AjaxModel->getBranch($taluka_id); 
        echo json_encode($getBranch);
    }
    public function getZoneAjax($branch_id)
    { 
        $getBranch=$this->AjaxModel->getZone($branch_id); 
        echo json_encode($getBranch);
    }

    public function getSubCategoryAjax($cat_id)
    { 
        $getBranch=$this->AjaxModel->getSubCategory($cat_id); 
        echo json_encode($getBranch);
    }

    public function getInventoryStock()
    {
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id');
        $brand_id=$this->input->post('brand_id');
        $cat_id=$this->input->post('cat_id');
        $sub_cat_id=$this->input->post('sub_cat_id');
        $AllInventory=$this->AjaxModel->getInventoryBySearch($taluka_id, $branch_id, $zone_id, $brand_id, $cat_id, $sub_cat_id); 
        echo json_encode($AllInventory);
        
    }

    public function getInventoryDeadStock()
    {
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id');
        $brand_id=$this->input->post('brand_id');
        $cat_id=$this->input->post('cat_id');
        $sub_cat_id=$this->input->post('sub_cat_id');
        $AllInventory=$this->AjaxModel->getInventoryDeadBySearch($taluka_id, $branch_id, $zone_id, $brand_id, $cat_id, $sub_cat_id); 
        echo json_encode($AllInventory);
        
    }

     public function deadStock()
    {   $inventory_id=$this->input->post('inventory_id');
        $formdata['updated_on'] = date('Y-m-d H:i:s');
        $formdata['dead_stock'] = 1;
        $id = $this->InventoryModel->updateInventory($formdata,$inventory_id);
        if ($id) 
        {
            $vals =  [ 'code'=> true, 'msg'=>'Updated' ];
            echo json_encode($vals);

        }
        else
        {
            $vals =  [ 'code' => false, 'msg' =>'Not Updated' ]; 
            echo json_encode($vals);

        }
        
        
    }
}
