<?php
/**
 * Description of AdminModel 
 *
 * @author Mukesh Yadav
 */
class AdminModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function do_login() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $result = $this->db->get_where('fa_admin', $data);
        return $result->row_array();
    }

    public function get_admin($email){
        $query = $this->db->get_where('fa_admin',['email'=>$email]);
        return $query->row_array();
    }
    
    public function do_check_oldpassword($admin_id){
        
        $oldpassword = $this->security->xss_clean(hash('sha256', $this->input->post('oldpassword')));
        $query = $this->db->get_where('fa_admin', ['id'=>$admin_id, 'password'=>$oldpassword]);
        return $query->row_array();
    }

    public function do_reset_passowrd($admin_id){
        $query = $this->db->get_where('fa_admin', ['id'=>$admin_id, 'is_forgot'=>'Active']);
        $admin =$query->row_array();
        if(!empty($admin == true)){
            $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
            $this->db->update('fa_admin', ['password'=>$newpassword], ['id'=>$admin_id]);
            return $this->db->affected_rows();
        }
        else{
            return false;
        }
    }

    public function change_status($admin_id){
        $this->db->update('fa_admin', ['is_forgot' =>'Inactive'], ['id'=>$admin_id]);
        return $this->db->affected_rows();
    }

    public function check_emailid(){
        $email = $this->security->xss_clean($this->input->post('email'));
        $query = $this->db->get_where('fa_admin',['email'=>$email]);
        $admin = $query->row_array();
        if(!empty($admin == true)){
            $id = $admin['id'];
            $this->db->update('fa_admin', ['is_forgot' =>'Active'], ['id'=>$id]);
            if($this->db->affected_rows()){
                $query = $this->db->get_where('fa_admin',['id'=>$id]);
                return $query->row_array();
            }
        }else{
            return false;
        }
    }

    public function do_edit_profile($admin_id,$image_url){
        $admin_name = $this->security->xss_clean($this->input->post('admin_name'));
        // $gender = $this->security->xss_clean($this->input->post('gender'));
        $profile_data = array(
            'admin_name' => $admin_name,
            // 'gender' => $gender,
            'image_url' => $image_url,
            'updated_at' => date('Y-m-d H:i:s') 
        );
        $this->db->update('fa_admin', $profile_data, ['id'=>$admin_id]);
        return $this->db->affected_rows();
    }
    public function do_update_currency(){
        $data = array(
            'currency_name' => $this->security->xss_clean($this->input->post('currency_name')),
            'currency_symbol' => $this->security->xss_clean($this->input->post('currency_symbol'))
        );
        $this->db->update('fa_currency', $data);
        return $this->db->affected_rows();
    }

    public function get_numbersof_users(){
        $this->db->from('fa_users');
        return $this->db->count_all_results();
    }

    public function get_numbersof_newusers(){
        $this->db->from('fa_users');
        $this->db->where('created_at >= DATE(NOW()) - INTERVAL 7 DAY');
        return $this->db->count_all_results();
    }
    
    public function getCurrencyData(){
        $query = $this->db->get_where('fa_currency');
        return $query->row_array();
    }
}