<?php
/**
 * Description of Settings Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') OR die('Not Allowed');
class Settings extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('SettingsModel');
    }

    public function help(){
        if($this->session->userdata('admin_emailid') == false){
            return redirect('admin/login');
        }
        $data['title'] = 'Help';
        $data['helps'] = $this->SettingsModel->get_helps();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/settings/help-list');
		$this->load->view('admin/layouts/footer');
    }

    public function legal_policy(){
        if($this->session->userdata('admin_emailid') == false){
            return redirect('admin/login');
        }
        
        $data['title'] = 'Legal Policy';
        $key = 'legal';
        $data['page_url']=current_url();
        $data['settings'] = $this->SettingsModel->get_settings($key);
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/settings/legal-policy');
		$this->load->view('admin/layouts/footer');
    }

    public function terms_condition(){
        if($this->session->userdata('admin_emailid') == false){
            return redirect('admin/login');
        }
        $data['title'] = 'Terms and Condition';
        $key = 'term';
        $data['page_url']=current_url();
        $data['settings'] = $this->SettingsModel->get_settings($key);
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/settings/term-condition');
		$this->load->view('admin/layouts/footer');
    }

    public function do_update_settings(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $page_url = $this->input->post('page_url');
        $result = $this->SettingsModel->do_update_settings();
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'updated Successful.', 'url' =>$page_url]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not updated.']));
            return FALSE;
        }
    }

    public function contact_us(){
        if($this->session->userdata('admin_emailid') == false){
            return redirect('admin/login');
        }
        $data['title'] = 'Contact-us';
        $data['contacts'] = $this->SettingsModel->get_contactinfo();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/settings/contact-us');
		$this->load->view('admin/layouts/footer');
    }

    public function do_update_contact($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required');
        $this->form_validation->set_rules('description', 'Contact Details', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->SettingsModel->do_update_contact($id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'updated Successful.', 'url' => base_url('settings/contact-us')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not updated.']));
            return FALSE;
        }
    }
}	