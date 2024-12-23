<?php 
/**
 * 
 */
class New_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function getAllTalukaList()
	{  
        return $this->db->get("tbl_mst_taluka")->row_array();
	}
}

?>