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
        $this->db->select('u.*');
        $this->db->from('fa_users u');
        $this->db->join('fa_users_bankdetails ub', 'u.id = ub.user_id');
        $this->db->join('fa_users_incomedetails ui', 'ub.user_id = ui.user_id');
        $this->db->join('fa_users_workdetails uw', 'ui.user_id = uw.user_id');
        $this->db->join('fa_users_credit uc', 'uw.user_id = uc.user_id');
        $this->db->order_by('u.id', 'desc');
        $this->db->where('u.deleted_at is NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getUserDetailById($id){
        $this->db->select('ub.*, ui.*, uw.*, uc.*, u.*, uw.Address as work_address');
        $this->db->from('fa_users u');
        $this->db->join('fa_users_bankdetails ub', 'u.id = ub.user_id');
        $this->db->join('fa_users_incomedetails ui', 'ub.user_id = ui.user_id');
        $this->db->join('fa_users_workdetails uw', 'ui.user_id = uw.user_id');
        $this->db->join('fa_users_credit uc', 'uw.user_id = uc.user_id');
        $this->db->where('u.id', $id);
        $this->db->order_by('u.id', 'desc');
        $this->db->where('u.deleted_at is NULL', NULL, FALSE);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function do_credit_amount($user_id){
        $credit_info = array(
            'admin_value' => $this->security->xss_clean($this->input->post('amount')),
            'interest_rate' => $this->security->xss_clean($this->input->post('intrest'))
        );
        $this->db->update('fa_users_credit', $credit_info, ['user_id' =>$user_id]);
        return $this->db->affected_rows();
    }
}