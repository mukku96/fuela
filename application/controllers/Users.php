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

        if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

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

    public function view_user_detail($id){

        $data['title'] = 'Users';

        $data['userDetail'] = $this->UsersModel->getUserDetailById($id);
		$this->load->view('admin/layouts/header', $data);

		$this->load->view('admin/layouts/sidebar');

		$this->load->view('admin/users/view_user_detail');

		$this->load->view('admin/layouts/footer');

    }

    public function credit_amount($user_id){
        $this->output->set_content_type('application/json');
        $data['user_id'] = $user_id;

        $content_wrapper = $this->load->view('admin/users/include/credit-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function do_credit_amount($user_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('intrest', 'Intrest Rate', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
	    $result = $this->UsersModel->do_credit_amount($user_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Updated', 'url' => base_url('users/view-user-detail/'.$user_id)]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return false;
        }
    }

}	