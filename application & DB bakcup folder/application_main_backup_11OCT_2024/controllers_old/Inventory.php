<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Inventory extends  CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InventoryModel');
        $this->load->library('form_validation');
        $this->load->library('session');

    }
    public function index()
    { 
        $this->load->view('header/header'); 
        $this->load->view('inventory/inventory_dashboard'); 
        $this->load->view('footer/footer');

        
    }

    public function new_item_list()
    { 
        $data['AllTaluka']=$this->InventoryModel->getAllTalukaList();
        $data['getAllBrand']=$this->InventoryModel->getAllBrandList();
        $data['getAllCategory']=$this->InventoryModel->getAllCategoryList();

        if ($this->form_validation->run('new_item_list') == FALSE) 
        {
            $this->load->view('header/header'); 
            $this->load->view('inventory/new_item_list',$data);
            $this->load->view('footer/footer'); 
        }
        else
        {
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['branch_id'] = $this->input->post('branch_id');
            $formdata['zone_id'] = $this->input->post('zone_id');
            $formdata['item_name'] = $this->input->post('item_name');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['optional_1'] = $this->input->post('optional_1');
            $formdata['optional_2'] = $this->input->post('optional_2');   
            $formdata['inserted_on'] = date('Y-m-d H:i:s');  
            $id = $this->InventoryModel->insertInventory($formdata);
            if ($id)
            {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                redirect(base_url() . "Inventory/new_itemList_view", 'refresh');
            }
            else
            {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                redirect(base_url() . "Inventory/new_item_list", 'refresh');
            }
        }
    }
    public function new_itemList_view()
    {
        $data['AllInventory']=$this->InventoryModel->getAllInventory();

        $data['AllTaluka']=$this->InventoryModel->getAllTalukaList();
        $data['getAllBrand']=$this->InventoryModel->getAllBrandList();
        $data['getAllCategory']=$this->InventoryModel->getAllCategoryList();

        $this->load->view('header/header'); 
        $this->load->view('inventory/new_itemList_view',$data); 
        $this->load->view('footer/footer'); 

    }

    public function new_item_view($inventory_id)
    {
        $data['AllInventory']=$this->InventoryModel->getInventoryById($inventory_id);

        $this->load->view('header/header'); 
        $this->load->view('inventory/new_item_view',$data); 
        $this->load->view('footer/footer'); 

    }

    public function new_item_edit($inventory_id='')
    { 
        $data['AllTaluka']=$this->InventoryModel->getAllTalukaList();
        $data['getAllBrand']=$this->InventoryModel->getAllBrandList();
        $data['getAllCategory']=$this->InventoryModel->getAllCategoryList();
        $data['AllInventory']=$this->InventoryModel->getInventoryById($inventory_id);


        if ($this->form_validation->run('new_item_list') == FALSE) 
        {
            $this->load->view('header/header'); 
            $this->load->view('inventory/new_item_edit',$data);
            $this->load->view('footer/footer'); 
        }
        else
        {
            $inventory_id= $this->input->post('inventory_id');
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['branch_id'] = $this->input->post('branch_id');
            $formdata['zone_id'] = $this->input->post('zone_id');
            $formdata['item_name'] = $this->input->post('item_name');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['optional_1'] = $this->input->post('optional_1');
            $formdata['optional_2'] = $this->input->post('optional_2');   
            $formdata['updated_on'] = date('Y-m-d H:i:s');  
            $id = $this->InventoryModel->updateInventory($formdata,$inventory_id);
            if ($id)
            {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                redirect(base_url() . "Inventory/new_itemList_view", 'refresh');
            }
            else
            {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                redirect(base_url() . "Inventory/new_item_list", 'refresh');
            }
        }
    }

    public function dead_stock_list()
    {
        $data['AllInventory']=$this->InventoryModel->getAllInventory();

        $data['AllTaluka']=$this->InventoryModel->getAllTalukaList();
        $data['getAllBrand']=$this->InventoryModel->getAllBrandList();
        $data['getAllCategory']=$this->InventoryModel->getAllCategoryList();

        $this->load->view('header/header'); 
        $this->load->view('inventory/dead_stock_list',$data); 
        $this->load->view('footer/footer'); 

    }


     
}
