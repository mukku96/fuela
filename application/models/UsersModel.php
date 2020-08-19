<?php
/**
 * Description of UsersModel 
 *
 * @author Mukesh Yadav
 */
class UsersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function getUsers(){
        $this->db->select('*');
        $this->db->from('fa_users');
        $this->db->where('deleted_at is NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
}