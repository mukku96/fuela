<?php
/**
 * Description of SettingsModel 
 *
 * @author Mukesh Yadav
 */
class SettingsModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }
  
    public function get_settings($key){
        $query = $this->db->get_where('fa_pages', ['page_id'=> $key]);
        return $query->row_array();
    }

    public function do_update_settings(){
        $key = $this->security->xss_clean($this->input->post('key'));
        $description = $this->input->post('description');
        $this->db->update('fa_pages', ['message' =>$description], ['page_id'=> $key]);
        return $this->db->affected_rows();
    }

    public function get_helps(){
        $query = $this->db->get('fa_users_helpquery');
        return $query->result_array();
    }
 
    public function get_contactinfo(){
        $query = $this->db->get('fa_contacts');
        return $query->row_array();
    }
    
    public function do_update_contact($id){
        $contact_data = array(
            "contact_number" => $this->security->xss_clean($this->input->post('contact_number')),
            "contact_email" => $this->security->xss_clean($this->input->post('contact_email')),
            "description" => $this->security->xss_clean($this->input->post('description')),
        );
        $this->db->update('fa_contacts', $contact_data, ['id'=> $id]);
        return $this->db->affected_rows();
    }
}