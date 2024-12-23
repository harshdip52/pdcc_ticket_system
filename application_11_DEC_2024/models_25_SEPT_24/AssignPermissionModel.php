<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AssignPermissionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table_name = "users_permission_details";

    public function addNewModule($array_question)
    {
        $res = $this->db->insert($this->table_name, $array_question);
        if ($res) {
            //return $this->db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function getallClass()
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function updateModule($data, $where)
    {
        $this->db->update($this->table_name, $data, $where);
        return $this->db->affected_rows();
    }

    public function updateSubTopicDetails($saveSubTopicdata, $arrayMatch)
    {
        $this->db->update("users_permission_details", $saveSubTopicdata, $arrayMatch);
        return $this->db->affected_rows();
    }
    public function deleteRole($arrayMatch)
    {
        $this->db->where($arrayMatch);
        $this->db->delete($this->table_name,);
    }

    public function getModuleById($arrayMatch)
    {
        $this->db->select("*");
        $this->db->from("users_permission_details");
        $this->db->where($arrayMatch);
        $query = $this->db->get();
        return $query->row();
    }


    /*DataTables Code from here */
    public function get_order_list($post)
    {
        $this->_get_order_list_query($post);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function _get_order_list_query($post)
    {
        $this->db->select('users_permission_details.*,user.name,module.module_name,module.module_display_name,module.module_link,module.module_class_name');
        $this->db->from('users_permission_details');
        $this->db->join("tbl_mst_users as user","user.user_id = users_permission_details.user_id");
        $this->db->join("tbl_mst_module as module","module.id = users_permission_details.module_id");
        $this->db->order_by('id', 'asc');

        /*  if(!empty($post['where'])){
        $this->db->where($post['where']);
    }

    foreach ($post['where_in'] as $index => $value){
       
        $this->db->where_in($index, $value);
    }
*/
        if (!empty($post['search_value'])) {
            $like = "";
            foreach ($post['column_search'] as $key => $item) { // loop column 
                if ($key === 0) { // first loop
                    $like .= "( " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                } else {
                    $like .= " OR " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                }
            }
            $like .= ") ";

            $this->db->where($like, null, false);
        }

        if (!empty($post['order'])) { // here order processing            
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all($post)
    {
        $this->_count_all_bb_order($post);
        $query = $this->db->count_all_results();
        return $query;
    }

    public function _count_all_bb_order($post)
    {
        $this->db->select('users_permission_details.*,user.name,module.module_name,module.module_display_name,module.module_link,module.module_class_name');
        $this->db->from('users_permission_details');
        $this->db->join("tbl_mst_users as user","user.user_id = users_permission_details.user_id");
        $this->db->join("tbl_mst_module as module","module.id = users_permission_details.module_id");
        $this->db->order_by('id', 'asc');
    }

    public function count_filtered($post)
    {
        $this->_get_order_list_query($post);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
