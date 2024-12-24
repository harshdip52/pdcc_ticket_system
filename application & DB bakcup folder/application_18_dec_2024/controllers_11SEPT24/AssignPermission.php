<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AssignPermission extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();    
        session_start();    
        $this->load->model('AssignPermissionModel');
        $this->load->model('InventoryModel');
        $this->load->model('ModuleModel');
        $this->load->library('session');

        $login_role = $this->session->userdata('login_role');
        if (!isset($login_role)) {
            redirect(base_url() . "welcome", 'refresh');
        }
    }

    public function index()
    {
        $data['allusers'] = $this->InventoryModel->allusers();        
        $data['getallModules'] = $this->ModuleModel->getallModules();        
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/assign_permission_view',$data);
        $this->load->view('footer/footer');
    }


    public function addNewModule()
    {
        
        $array_data =  array('module_name'          => $this->input->post('module_name'),
                                'module_display_name'   => $this->input->post('module_display_name'),
                                'module_link'           => $this->input->post('module_link'),
                                'module_class_name'     => $this->input->post('module_class_name'),
                                'created_by'            => $this->session->userdata('login_user_id'),
                                'added_by'              => $this->session->userdata('login_name'),
                                'created_at'            => date("Y-m-d H:i:s")
                            );
        $savedata = $this->AssignPermissionModel->addNewModule($array_data);
        echo json_encode(array("status" => TRUE));
    }

    public function getModuleById($id)
    {
        $arrayMatch = array('id'     => $id);
        $data = $this->AssignPermissionModel->getModuleById($arrayMatch);
        echo json_encode($data);
    }


    public function updateModule()
    {
        $array_data =  array('module_name'          => $this->input->post('module_name'),
                            'module_display_name'   => $this->input->post('module_display_name'),
                            'module_link'           => $this->input->post('module_link'),
                            'module_class_name'     => $this->input->post('module_class_name'),
                            'created_by'            => $this->session->userdata('login_user_id'),
                            'added_by'              => $this->session->userdata('login_name'),
                            'created_at'            => date("Y-m-d H:i:s"));

        $res_update = $this->AssignPermissionModel->updateModule($array_data, array('id' => $this->input->post('id')));
        echo json_encode(array("status" => TRUE));
    }

    public function deleteRole($id)
    {
        $arrayMatch = array('role_id'    => $id);
        $res = $this->AssignPermissionModel->deleteRole($arrayMatch);
        echo json_encode(array("status" => TRUE));
    }
    /* Datatables Code */
    public function getdata()
    {
        $data = $this->process_get_data();
        $post = $data['post'];
        $output = array(
            "draw" => $post['draw'],
            "recordsTotal" => $this->AssignPermissionModel->count_all($post),
            "recordsFiltered" =>  $this->AssignPermissionModel->count_filtered($post),
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
        $post['column_order'] = array('id', 'module_name', 'module_display_name', 'module_link', 'module_class_name', 'created_by', 'added_by', 'created_at');
        $post['column_search'] = array('id', 'module_name', 'module_display_name', 'module_link', 'module_class_name', 'created_by', 'added_by', 'created_at');

        $list = $this->AssignPermissionModel->get_order_list($post);
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
        //user.name,module.module_name,module.module_display_name,module.module_link,module.module_class_name
        $row = array();
        $row[] = $order_list->id;
        $row[] = $order_list->name;
        $row[] = $order_list->module_name;
        $row[] = $order_list->can_edit;
        $row[] = $order_list->can_delete;
        $row[] = $order_list->can_view;
        $row[] = $order_list->added_by;
        if ($this->isAdminPermission == 1) {
            $row[] = "<button title='Edit Module ' onclick='edit_module($order_list->id)' class='btn btn-link btn-info'>Edit</button>";
        } else {
            $row[] = '<a type="button" class="btn btn-danger" title = "Action is not allowed">Not Allowed</a>';
        }
        //   "<button onclick='delete_role($order_list->role_id)' class='btn btn-link btn-md'><i class='fa fa-times' style='color:#f25961;'></i></button>";
        return $row;
    }
}
