<?php
/**
 * Description of Users Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') OR die('Not Allowed');

class Users extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->model('UsersModel');
    }
    
    public function index(){
        if($this->session->userdata('admin_emailid') == false){
            return redirect('admin/login');
        }
        $data['title'] = 'Users';
        $data['users'] = $this->UsersModel->getUsers();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/users/users-list');
		$this->load->view('admin/layouts/footer');
    }
}	