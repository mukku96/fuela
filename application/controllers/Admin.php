<?php

/**

 * Description of Admin Controller

 *

 * @author Mukesh Yadav

 */

defined('BASEPATH') OR die('Not Allowed');



class Admin extends CI_Controller

{

    /**

     * __construct

     *

     * @return void

     */

    public function __construct() {

        

        parent::__construct();

    }



    /**

	 * index login view here

	 *

	 * @return void

	 */

	public function index()

	{

		return redirect('admin/login');

    }

    

    public function login(){

        if($this->session->userdata('admin_emailid')){

            return redirect('admin/home');

        }

        $data['title'] = 'Fuela App: Login';

		$this->load->view('admin/login', $data);

    }

	

	/**

	 * do_login do login here

	 *

	 * @return void

	 */

	public function do_login(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return FALSE;

        }

        $result = $this->AdminModel->do_login();

        if (!empty($result)) {

            $this->session->set_userdata('admin_id', $result['id']);

            $this->session->set_userdata('admin_emailid', $result['email']);

            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/home'), 'msg' => 'Welcome']));

            return FALSE;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Username And Password.']));

            return FALSE;

        }

    }

        

    /**

     * logout do logout here

     *

     * @return void

     */

    public function logout() {

        $this->output->set_content_type('application/json');

        if($this->session->userdata('admin_emailid')){

           $this->session->unset_userdata('admin_emailid');

           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Successfully Logout!!!']));

            return FALSE;

        }

        else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Successfully Logout!!!']));

            return FALSE;

        }

        

    }

	

	/**

	 * forgot_password forgot password view

	 *

	 * @return void

	 */

	public function forgot_password()

	{

		$data['title'] = 'Fuela App: Forgot Password';

		$this->load->view('admin/forgot-password', $data);

    }

        

    /**

     * email_verify varify email

     *

     * @return void

     */

    public function email_verify(){

    	$this->output->set_content_type('application/json');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() === FALSE) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return FALSE;

        }

        $result = $this->AdminModel->check_emailid();

        if (!empty($result)) {

            $emailid = $this->security->xss_clean($this->input->post('email'));

            $this->load->library('email');

            $this->email->set_mailtype("html");

            $this->email->from('info@fuela.com');

            $this->email->to($emailid);

            $this->email->subject('Reset password');

            $admin_id = $result['id'];

            $htmlContent = "<div style='padding-top:8px;'>Hi Admin, <br><br>Please click below link to create a new password</div>";

            $htmlContent .= "<a href='" . base_url('admin/reset-password/'.$admin_id). "'>Click Here</a>";

            $this->email->message($htmlContent);

            //Send email

            $send = $this->email->send();

            if ($send) {

                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Reset password link sent to your email.!']));

                return true;

            } else {

                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to send']));

                return false;

            }

            

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid your Email Id Try Again...']));

            return FALSE;

        }

    }

	

	/**

	 * reset_password reset password view

	 *

	 * @param  mixed $admin_id

	 * @return void

	 */

	public function reset_password($admin_id)

	{

        $data['admin_id'] = $admin_id;

		$data['title'] = 'Fuela App: Reset Password';

		$this->load->view('admin/reset-password', $data);

    }

        

    /**

     * do_reset_passowrd reset admin password

     *

     * @param  mixed $admin_id

     * @return void

     */

    public function do_reset_passowrd($admin_id){

    	$this->output->set_content_type('application/json');

        $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]');

        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        

        if ($this->form_validation->run() === FALSE) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return FALSE;

        }

        $result = $this->AdminModel->do_reset_passowrd($admin_id);

        if (!empty($result)) {

            $this->AdminModel->change_status($admin_id);

            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Password successfully change.!']));

            return FALSE;

            

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully!']));

            return FALSE;

        }

    }

        

    /** 

     * edit_profile edit profile view

     *

     * @param  mixed $admin_id

     * @return void

     */

    public function edit_profile($admin_id){

        if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

        $data['admin_id'] = $admin_id;

		$data['title'] = 'Edit Profile';

		$this->load->view('admin/layouts/header', $data);

		$this->load->view('admin/layouts/sidebar');

		$this->load->view('admin/edit-profile');

		$this->load->view('admin/layouts/footer');

    }

    

    /**

     * change_password change password view

     *

     * @param  mixed $admin_id

     * @return void

     */

    public function change_password($admin_id){

        if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

        $data['admin_id'] = $admin_id;

		$data['title'] = 'Change Password';

		$this->load->view('admin/layouts/header', $data);

		$this->load->view('admin/layouts/sidebar');

		$this->load->view('admin/change-password');

		$this->load->view('admin/layouts/footer');

    }

    	

	/**

	 * home admin dashboard view here

	 *

	 * @return void

	 */

	public function home(){

        if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

		$data['title'] = 'Home';

		$this->load->view('admin/layouts/header', $data);

		$this->load->view('admin/layouts/sidebar');

		$this->load->view('admin/dashboard');

		$this->load->view('admin/layouts/footer');

	}

	

	public function currency(){

	    if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

		$data['title'] = 'Currency';

		$data['currency'] = $this->AdminModel->getCurrencyData();

		$this->load->view('admin/layouts/header', $data);

		$this->load->view('admin/layouts/sidebar');

		$this->load->view('admin/currency');

		$this->load->view('admin/layouts/footer');

	}

	

	public function do_update_currency(){

	    if($this->session->userdata('admin_emailid') == false){

            return redirect('admin/login');

        }

	    $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('currency_name', 'currency name', 'trim|required');

        $this->form_validation->set_rules('currency_symbol', 'currency symbol', 'trim|required');

        

        if ($this->form_validation->run() === FALSE) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return FALSE;

        }

        $result = $this->AdminModel->do_update_currency();

        if (!empty($result)) {

            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/currency'), 'msg' => 'Currency Updated Successfully']));

            return FALSE;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Chages Were Made']));

            return FALSE;

        }

	}

}	