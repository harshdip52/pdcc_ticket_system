<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function assign_zone_name($zoneid)
    {        
        $this->db->select('zone_id,taluka_id,zone_name,status');
        $this->db->from('tbl_mst_zone');
        $this->db->where_in('zone_id', explode(',', $zoneid));
        $res = $this->db->get();
        return $res->result_array();
    }

    function changePassword($user_id,$newPassword,$confirm_newPassword){
        $updatearray = array('password' =>$newPassword);
        $this->db->where('user_id',$user_id);
        $res = $this->db->update('tbl_mst_users', $updatearray);
        // echo $this->db->last_query();
        // die;
        if($res){
            return true;
        }else{
            return false;
        }
    }

    function foreclosureTicketByAadmin($where,$update){
        $this->db->where($where);
        $res = $this->db->update('tbl_mst_ticket', $update);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function chechDuplicateEmpId($emp_id)
    {
        $this->db->where('emp_id',$emp_id);
        $this->db->select('tbl_mst_users.*');
        return $this->db->get('tbl_mst_users')->row_array();
        // return $this->db->get('tbl_mst_inventory')->result_array();
    }

    function get_branch_by_taluka_id($taluka_id)
    {
        // printData($taluka_id);die;
        $this->db->select('branch_id,taluka_id,zone_id,branch_code,branch_name,status');
        $this->db->from('tbl_mst_branch');
        $this->db->where_in('taluka_id', implode(',', $taluka_id));
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getZoneIdByBranch($branch_id)
    {
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('tbl_mst_branch')->row_array();
    }

    public function getAllTalukas()
    {
        $this->db->select('tbl_mst_taluka.taluka_id,tbl_mst_taluka.taluka_name,tbl_mst_taluka.status');
        return $this->db->get('tbl_mst_taluka')->result_array();
    }

    public function getReminder($user_id)
    {

        $this->db->select('tbl_ticket_reminder.*,
        tbl_mst_ticket.created_on as t_created_date,
        tbl_mst_ticket_title.ticket_title');
        $this->db->join('tbl_mst_ticket', 'tbl_mst_ticket.ticket_id = tbl_ticket_reminder.ticket_id');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->where('tbl_ticket_reminder.user_id', $user_id);
        $this->db->where('tbl_ticket_reminder.status', 'Not view');
        return $this->db->get('tbl_ticket_reminder')->result_array();
    }

    public function getUserRole()
    {
        return $this->db->get("tbl_mst_role")->result_array();
    }

    public function getAllTalukaList()
    {
        return $this->db->get("tbl_mst_taluka")->result_array();
    }
    public function insertTaluka($formdata)
    {
        $this->db->insert('tbl_mst_taluka', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getTalukaById($taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        return $this->db->get('tbl_mst_taluka')->row_array();
    }
    public function updateTaluka($formdata, $taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        return $this->db->update('tbl_mst_taluka', $formdata);
    }

    // master zone start
    public function getAllZoneList()
    {
        return $this->db->get("tbl_mst_zone")->result_array();
    }
    public function getAllZoneByTalukaId($taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        return $this->db->get("tbl_mst_zone")->result_array();
    }
    public function insertZone($formdata)
    {
        $this->db->insert('tbl_mst_zone', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getZoneById($zone_id)
    {
        $this->db->where('zone_id', $zone_id);
        return $this->db->get('tbl_mst_zone')->row_array();
    }
    public function updateZone($formdata, $zone_id)
    {
        $this->db->where('zone_id', $zone_id);
        return $this->db->update('tbl_mst_zone', $formdata);
    }
    // master zone end


    // master Nramch start
    public function getAllBranchList()
    {
        return $this->db->get("tbl_mst_branch")->result_array();
    }
    public function insertBranch($formdata)
    {
        $this->db->insert('tbl_mst_branch', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getBranchById($branch_id)
    {
        $this->db->where('branch_id', $branch_id);
        return $this->db->get('tbl_mst_branch')->row_array();
    }
    public function updateBranch($formdata, $branch_id)
    {
        $this->db->where('branch_id', $branch_id);
        return $this->db->update('tbl_mst_branch', $formdata);
    }

    public function getBranchesById($branches_id)
    {
        $branch_id = explode(",", $branches_id);
        $this->db->from('tbl_mst_branch');
        $this->db->where_in('branch_id', $branch_id);
        $query = $this->db->get();
        $rs = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($rs, $row);
            }
        }
        //  echo json_encode($rs); exit();
        return $rs;
        // print_r($rs);exit;
    }
    // master zone end



    // master Brand start
    public function getAllBrandList()
    {
        return $this->db->get("tbl_mst_brand")->result_array();
    }

    public function insertBrand($formdata)
    {
        $this->db->insert('tbl_mst_brand', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getBrandById($brand_id)
    {
        $this->db->where('brand_id', $brand_id);
        return $this->db->get('tbl_mst_brand')->row_array();
    }
    public function updateBrand($formdata, $brand_id)
    {
        $this->db->where('brand_id', $brand_id);
        return $this->db->update('tbl_mst_brand', $formdata);
    }
    // master Brand end



    // master Category start
    public function getAllCategoryList()
    {
        return $this->db->get("tbl_mst_category")->result_array();
    }
    public function insertCategory($formdata)
    {
        $this->db->insert('tbl_mst_category', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getCategoryById($cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        return $this->db->get('tbl_mst_category')->row_array();
    }
    public function updateCategory($formdata, $cat_id)
    {
        $this->db->where('cat_id', $cat_id);
        return $this->db->update('tbl_mst_category', $formdata);
    }
    // master Category end

    // master Sub Category start
    public function getAllSubCategoryList()
    {
        return $this->db->get("tbl_mst_sub_category")->result_array();
    }
    public function insertSubCategory($formdata)
    {
        $this->db->insert('tbl_mst_sub_category', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getSubCategoryById($sub_cat_id)
    {
        $this->db->where('sub_cat_id', $sub_cat_id);
        return $this->db->get('tbl_mst_sub_category')->row_array();
    }
    public function updateSubCategory($formdata, $sub_cat_id)
    {
        $this->db->where('sub_cat_id', $sub_cat_id);
        return $this->db->update('tbl_mst_sub_category', $formdata);
    }

    // master Category end

    //master user start
    public function insertUsers($formdata)
    {
        $this->db->simple_query('SET SESSION group_concat_max_len=150000');
        $this->db->insert('tbl_mst_users', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    function users_assign_branches($assign_Arr)
    {
        $res = $this->db->insert_batch('users_assign_branches', $assign_Arr);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUsers($formdata, $user_id)
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // echo "model file update";
        // echo $user_id."\n";
        // printData($formdata);die;

        // $this->db->simple_query('SET SESSION group_concat_max_len=150000');
        $this->db->where('user_id', $user_id);
        return $this->db->update('tbl_mst_users', $formdata);
    }


    function getUserDetaildById($user_id)
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $taluka_name = [];
        $branch_name = [];
        $zone_name = [];

        $this->db->select('tbl_mst_users.user_id,tbl_mst_users.name,tbl_mst_users.email,tbl_mst_users.mobile,tbl_mst_users.emp_id,tbl_mst_users.role,tbl_mst_users.taluka_id,tbl_mst_users.zone_id,tbl_mst_users.branch_id,tbl_mst_role.role_name');
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
        // return $this->db->get('tbl_mst_users')->row_array();
    }

    ## for reopen ticket Admin 
    function getQueriedTicketAdmin()
    {
        $this->db->select('tbl_mst_ticket.*,
        tbl_mst_taluka.taluka_name,
        tbl_mst_branch.branch_name,
        tbl_mst_users.name,
        tbl_mst_ticket_title.ticket_title,
        tbl_mst_zone.zone_name');
        // $this->db->where('tbl_mst_ticket.user_id', $user_id);
        $this->db->where('tbl_mst_ticket.status', 'Queried');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.queried_by');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        return $this->db->get('tbl_mst_ticket')->result_array();
    }


    public function getUserDetaildById_prev($user_id)
    {

        // $this->db->select('tbl_mst_users.user_id', $user_id);
        $this->db->select("tbl_mst_users.user_id,tbl_mst_users.name,tbl_mst_users.email,tbl_mst_users.mobile,tbl_mst_users.emp_id,tbl_mst_users.role,tbl_mst_users.taluka_id,tbl_mst_users.zone_id,tbl_mst_users.branch_id,tbl_mst_zone.zone_name,tbl_mst_role.role_name,tbl_mst_zone.zone_name,STRING_AGG(CAST(tbl_mst_taluka.taluka_name AS VARCHAR), ', ') AS taluka_name,STRING_AGG(CAST(tbl_mst_branch.branch_name AS VARCHAR), ', ') AS branch_name,CHARINDEX(CAST( tbl_mst_taluka.taluka_id AS NVARCHAR(200)),taluka_id) AS taluka_id,CHARINDEX(CAST( tbl_mst_branch.branch_id AS NVARCHAR(200)),branch_id) AS branch_id,CHARINDEX(CAST(tbl_mst_zone.zone_id AS NVARCHAR(200)),zone_id) AS zone_id");
        // $this->db->from('tbl_mst_users AS u');

        //,STRING_AGG(CAST(tbl_mst_taluka.taluka_name AS NVARCHAR)),',') AS taluka_name,STRING_AGG(CAST(tbl_mst_branch.branch_name AS NVARCHAR)),',') AS branch_name

        //,STRING_AGG(tbl_mst_taluka.taluka_name,",") as taluka_name,STRING_AGG(tbl_mst_branch.branch_name,",") as branch_name


        //JOIN Table2 t2 ON CHARINDEX(',' + CAST(t2.id AS VARCHAR) + ',', ',' + t1.csv_values + ',') > 0;

        // $this->db->join('tbl_mst_taluka', "CHARINDEX(','+CAST(tbl_mst_taluka.taluka_id AS NVARCHAR )+ ',',','+ tbl_mst_users.taluka_id) > 0");
        // $this->db->join('tbl_mst_branch', "CHARINDEX(','+CAST(tbl_mst_branch.branch_id AS NVARCHAR )+ ',', ','+ tbl_mst_users.branch_id) > 0");

        // $this->db->join('tbl_mst_taluka', "CHARINDEX(',' + CAST(tbl_mst_taluka.taluka_id AS NVARCHAR) + ',', ',' + u.taluka_id + ',') > 0");
        // $this->db->join('tbl_mst_branch', "CHARINDEX(',' + CAST(tbl_mst_branch.branch_id AS NVARCHAR) + ',', ',' + u.branch_id + ',') > 0");
        // $this->db->join('tbl_mst_zone', "CHARINDEX(',' + CAST(tbl_mst_zone.zone_id AS NVARCHAR) + ',', ',' + u.zone_id + ',') > 0", 'left');
        $this->db->from('tbl_mst_users');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_users.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_users.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id');

        // $this->db->join('tbl_mst_taluka', 'FIND_IN_SET(tbl_mst_taluka.taluka_id, tbl_mst_users.taluka_id) != 0');
        // $this->db->join('tbl_mst_branch', 'FIND_IN_SET(tbl_mst_branch.branch_id , tbl_mst_users.branch_id) !=0');
        // $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');

        $this->db->join('tbl_mst_role ', 'tbl_mst_role.role_id = tbl_mst_users.role');
        $this->db->where('tbl_mst_users.user_id', $user_id);
        $this->db->group_by('u.user_id');
        $this->db->get();
        // return $this->db->get()->result_array();
        // $this->db->get();
        echo $this->db->last_query();
        die;
        return $this->db->get('tbl_mst_users as u')->row_array();
    }

    function getUserDetaildById_old($user_id)
    {
        // $this->db->select('tbl_mst_users.user_id', $user_id);
        $this->db->select('tbl_mst_users.user_id,tbl_mst_users.name,tbl_mst_users.email,tbl_mst_users.mobile,tbl_mst_users.emp_id,tbl_mst_users.role,tbl_mst_users.taluka_id,tbl_mst_users.zone_id,tbl_mst_users.branch_id,tbl_mst_zone.zone_name,tbl_mst_role.role_name,tbl_mst_zone.zone_name,tbl_mst_role.role_name,GROUP_CONCAT(tbl_mst_taluka.taluka_name) as taluka_name,GROUP_CONCAT(tbl_mst_branch.branch_name) as branch_name');

        $this->db->join('tbl_mst_taluka', 'FIND_IN_SET(tbl_mst_taluka.taluka_id, tbl_mst_users.taluka_id) != 0');
        $this->db->join('tbl_mst_branch', 'FIND_IN_SET(tbl_mst_branch.branch_id , tbl_mst_users.branch_id) !=0');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_users.zone_id', 'left');
        $this->db->join('tbl_mst_role', 'tbl_mst_role.role_id = tbl_mst_users.role');
        $this->db->where('tbl_mst_users.user_id', $user_id);
        return $this->db->get('tbl_mst_users')->row_array();
    }


    //master user end



    public function insertInventory($formdata)
    {
        $this->db->insert('tbl_mst_inventory', $formdata);
        return $insert_id = $this->db->insert_id();
    }
    public function getAllInventory()
    {
        $this->db->select('tbl_mst_inventory.*,
        	tbl_mst_taluka.taluka_name,
        	tbl_mst_branch.branch_name,
        	tbl_mst_zone.zone_name,
        	tbl_mst_brand.brand,
        	tbl_mst_category.cat_name,
        	tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_inventory.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_inventory.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_inventory.zone_id');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->order_by('tbl_mst_inventory.inventory_id', 'DESC');
        return $this->db->get('tbl_mst_inventory')->result_array();
    }

    public function getInventoryById($inventory_id)
    {
        $this->db->select('tbl_mst_inventory.*, 
            tbl_mst_brand.brand,
            tbl_mst_category.cat_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_inventory.brand_id');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_inventory.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_inventory.sub_cat_id');
        $this->db->where('tbl_mst_inventory.inventory_id', $inventory_id);

        $this->db->order_by('tbl_mst_inventory.inventory_id', 'DESC');
        return $this->db->get('tbl_mst_inventory')->row_array();
    }

    public function updateInventory($formdata, $inventory_id)
    {
        $this->db->where('inventory_id', $inventory_id);
        return $this->db->update('tbl_mst_inventory', $formdata);
    }
    public function insertAssignInventory($formdata)
    {
        // print_r($formdata);
        $this->db->insert('tbl_assign_inventory', $formdata);
        $insert_id = $this->db->insert_id();
    }

    public function updateAssignInventory($inventory_id, $formdata)
    {
        // print_r($inventory_id);
        $this->db->where('inventory_id', $inventory_id['inventory_id']);
        return $this->db->update('tbl_mst_inventory', $formdata);
    }

    // =================================================
    // Ticket support
    // =================================================
    public function insertNewTicket($formdata)
    {
        $this->db->insert('tbl_mst_ticket', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    function addnewTicketAjax($formdata)
    {
        $this->db->insert('tbl_mst_ticket', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    public function getTicketById($ticket_id)
    {

        $this->db->where('ticket_id', $ticket_id);
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_category.cat_name,

            tbl_mst_sub_category.sub_cat_name,
            tbl_mst_category.cat_name,
            tbl_mst_brand.brand_name,
            tbl_inventory_item.item_name,
            tbl_mst_inventory.serial_no, 
            tbl_mst_users.name,
            user.name AS assignto,
            forward1.name as forward1_name,
            forward2.name as forward2_name
            ');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_ticket.cat_id');

        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id');
        $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id', 'left');
        
        // $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_ticket.inventory_id', 'left');
        // $this->db->join('tbl_mst_inventory', 'tbl_mst_inventory.id = tbl_inventory_item.id', 'left');
        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_ticket.inventory_id', 'left');
        $this->db->join('tbl_mst_inventory', 'tbl_mst_inventory.item = tbl_inventory_item.id', 'left');

        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.created_by');
        $this->db->join('tbl_mst_users AS user', 'user.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_users AS forward1', 'forward1.user_id = tbl_mst_ticket.forword_from_1','left');
        $this->db->join('tbl_mst_users AS forward2', 'forward2.user_id = tbl_mst_ticket.forward_from_2','left');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function getTicketById_old($ticket_id)
    {

        $this->db->where('ticket_id', $ticket_id);
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_category.cat_name,

            tbl_mst_sub_category.sub_cat_name,
            tbl_mst_category.cat_name,
            tbl_mst_brand.brand_name,
            tbl_inventory_item.item_name,
            tbl_mst_inventory.serial_no, 
            tbl_mst_users.name,
            user.name AS assignto,
            forward1.name as forward1_name,
            forward2.name as forward2_name
            ');
        $this->db->join('tbl_mst_ticket_title', 'tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka', 'tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch', 'tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone', 'tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_ticket.cat_id');

        // $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id');
        // $this->db->join('tbl_mst_brand', 'tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id', 'left');

        $this->db->join('tbl_inventory_item', 'tbl_inventory_item.id = tbl_mst_ticket.inventory_id', 'left');
        $this->db->join('tbl_mst_inventory', 'tbl_mst_inventory.id = tbl_inventory_item.id', 'left');
        
        $this->db->join('tbl_mst_sub_category','tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id'); 
        $this->db->join('tbl_mst_brand','tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id','left'); 


        $this->db->join('tbl_mst_users', 'tbl_mst_users.user_id = tbl_mst_ticket.created_by');
        $this->db->join('tbl_mst_users AS user', 'user.user_id = tbl_mst_ticket.user_id');
        $this->db->join('tbl_mst_users AS forward1', 'forward1.user_id = tbl_mst_ticket.forword_from_1','left');
        $this->db->join('tbl_mst_users AS forward2', 'forward2.user_id = tbl_mst_ticket.forward_from_2','left');
        
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function totalTq()
    {
        $this->db->select('count(taluka_id) as totalTq');
        return $this->db->get('tbl_mst_taluka')->row_array();
    }
    public function totalZone()
    {
        $this->db->select('count(zone_id) as totalZone');
        return $this->db->get('tbl_mst_zone')->row_array();
    }

    public function totalBr()
    {
        $this->db->select('count(branch_id) as totalBr');
        return $this->db->get('tbl_mst_branch')->row_array();
    }
    public function totalCat()
    {
        $this->db->select('count(cat_id) as totalCat');
        return $this->db->get('tbl_mst_category')->row_array();
    }
    public function totalSubCat()
    {
        $this->db->select('count(sub_cat_id) as totalSubCat');
        return $this->db->get('tbl_mst_sub_category')->row_array();
    }
    public function totalBrnd()
    {
        $this->db->select('count(brand_id) as totalBrnd');
        return $this->db->get('tbl_mst_brand')->row_array();
    }
    public function totalRole()
    {
        $this->db->select('count(*) as totalRole');
        return $this->db->get('tbl_mst_role')->row_array();
    }

    function getAllroles(){
        $this->db->select('role_id,role_name');
        return $this->db->get('tbl_mst_role')->result_array();
    }
    public function totalticket()
    {
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->select('count(*) as totalTicket');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function todaytotalticket()
    {
        $this->db->select('count(*) as todaytotalticket');
        $created_on = date('Y-m-d');
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.created_on', $created_on);
        $this->db->where('tbl_mst_ticket.status', 'New');
        // $this->db->get('tbl_mst_ticket');
        // echo $this->db->last_query();
        // die;
        return $this->db->get('tbl_mst_ticket')->row_array();
    }
    public function Inprogresstotalticket()
    {
        $this->db->select('count(*) as Inprogresstotalticket');
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.status', 'Inprogress');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function Pendingtotalticket()
    {
        $this->db->select('count(*) as Pendingtotalticket');
        $created_on = date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on !=', $created_on);
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.status', 'New');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }
    public function Closetotalticket()
    {
        $this->db->select('count(*) as Closetotalticket');
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.status', 'Resolved');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function updateTicket($ticket_id, $formdata)
    {
        $this->db->where('ticket_id', $ticket_id);
        return $this->db->update('tbl_mst_ticket', $formdata);
    }

    public function Queriedticket()
    {
        $this->db->select('count(*) as Queriedticket');
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.status', 'Queried');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function Forwardedticket()
    {
        $this->db->select('count(*) as Forwardedticket');
        $login_user_role = $this->session->userdata('login_role');
        if($login_user_role == 7 ){
            $this->db->where('user_id',$this->session->userdata('login_user_id'));
            $this->db->or_where('created_by',$this->session->userdata('login_user_id'));
        }
        $this->db->where('tbl_mst_ticket.status', 'Forwarded');
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function getCounter($module_id)
    {
        $this->db->select('counter');
        $this->db->where('module_id', $module_id);
        return $this->db->get('tbl_mst_counter')->row_array();
    }

    public function updateCounter($formdata, $module_id)
    {
        $this->db->where('module_id', $module_id);
        return $this->db->update('tbl_mst_counter', $formdata);
    }

    public function addTicketTitle($formdata)
    {
        $this->db->insert('tbl_mst_ticket_title', $formdata);
        return $insert_id = $this->db->insert_id();
    }

    public function getTicketTitle()
    {
        $this->db->select('tbl_mst_ticket_title.*,
            tbl_mst_category.cat_name,
            tbl_mst_sub_category.sub_cat_name');
        $this->db->join('tbl_mst_category', 'tbl_mst_category.cat_id = tbl_mst_ticket_title.cat_id');
        $this->db->join('tbl_mst_sub_category', 'tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket_title.sub_cat_id');
        return $this->db->get('tbl_mst_ticket_title')->result_array();
    }


    public function getCallLogs()
    {
        return $this->db->get("tbl_mst_call_logs")->result_array();
    }
    public function insertCallLog($formdata)
    {
        $this->db->insert('tbl_mst_call_logs', $formdata);
        return $insert_id = $this->db->insert_id();
    }
}
