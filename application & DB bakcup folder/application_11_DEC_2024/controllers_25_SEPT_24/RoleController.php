<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RoleController extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('RoleModel');        
        $this->load->library('session');

        $login_role = $this->session->userdata('login_role');
        if (!isset($login_role)) {
            redirect(base_url() . "welcome", 'refresh');
        }
    }

    public function index()
    {
        $data['allusers'] = $this->DashboardModel->getLastFiveStudents();
        $this->load->view("header/Header");
        $this->load->view("sidebar/Sidebar");
        $this->load->view("admin/AddClassView", $data);
    }


    public function addNewRole()
    {
        $array_question = array('role_name'              => $this->input->post('role_name'));
        $savedata = $this->RoleModel->addNewRole($array_question);
        echo json_encode(array("status" => TRUE));
    }

    public function getRoleById($id)
    {
        $arrayMatch = array('role_id'     => $id);
        $data = $this->RoleModel->getRoleById($arrayMatch);
        echo json_encode($data);
    }


    public function updateRole()
    {
        $array_question = array('role_name'              => $this->input->post('role_name'));
        $res_update = $this->RoleModel->updateRole($array_question, array('role_id' => $this->input->post('id')));
        echo json_encode(array("status" => TRUE));
    }

    public function deleteRole($id)
    {
        $arrayMatch = array('role_id'    => $id);
        $res = $this->RoleModel->deleteRole($arrayMatch);
        echo json_encode(array("status" => TRUE));
    }
    /* Datatables Code */
    public function getdata()
    {   
        $data = $this->process_get_data();
        $post = $data['post'];
        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->RoleModel->count_all($post),
            "recordsFiltered" =>  $this->RoleModel->count_filtered($post),
            "data" => $data['data'],
        );
        unset($post);
        unset($data);
        echo json_encode($output);
    }

    function process_get_data()
    {
        $post = $this->get_post_input_data();
        /*$post['where'] = array('cd.date >= ' => date('d-m-Y',strtotime("-365 days")));
     $post['where_in'] = array('status ' => array('active', '1'));*/
        $post['column_order'] = array('role.role_name', 'role.role_id');
        $post['column_search'] = array('role.role_name', 'role.role_id');

        $list = $this->RoleModel->get_order_list($post);
        $data = array();
        $no = $post['start'];

        foreach ($list as $order_list) {
            $no++;
            $row =  $this->order_table_data($order_list, $no);
            $data[] = $row;
        }
        return array(
            'data' => $data,
            'post' => $post
        );
    }

    function get_post_input_data()
    {
        $post['length'] = $this->input->post('length');
        $post['start'] = $this->input->post('start');
        $search = $this->input->post('search');
        $post['search_value'] = $search['value'];
        $post['order'] = $this->input->post('order');
        $post['draw'] = $this->input->post('draw');
        $post['status'] = $this->input->post('status');
        return $post;
    }

    function order_table_data($order_list, $no)
    {
        $row = array();
        $row[] = $order_list->role_id;
        $row[] = $order_list->role_name;
        if($this->isAdminPermission == 1){
            $row[] = "<button title='Edit Role ' onclick='edit_role($order_list->role_id)' class='btn btn-link btn-md'><i class='fa fa-edit' style='color:#1572e8;'></i></button>";
        }else{
            $row[] = '<a type="button" class="btn btn-danger" title = "Action is not allowed">Not Allowed</a>';
        }
             	//   "<button onclick='delete_role($order_list->role_id)' class='btn btn-link btn-md'><i class='fa fa-times' style='color:#f25961;'></i></button>";
        return $row;
    }
}
