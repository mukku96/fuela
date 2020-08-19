<?php
/**
 * Description of Api Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Api extends CI_Controller
{
   /**
   * __construct
   *
   * @return void
   */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ApiModel']);
    }

    public function index()
    {
        echo "Hey Mukku"; exit;
    }

    public function user_registration()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('is_unique', 'The %s is already taken');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone No', 'trim|required');
        $this->form_validation->set_rules('id_type', 'ID Type', 'trim|required');
        $this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('create_password', 'Create Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[6]|matches[create_password]');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $chk_duplicate = $this->ApiModel->getDuplicateUserMail($this->input->post('email'));
        if($chk_duplicate){
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'The Email ID is already taken.', 'data' => null]));
            return false;
        }
        $chk_duplicate_phone = $this->ApiModel->getDuplicateUserPhone($this->input->post('phone'));
        if($chk_duplicate_phone){
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'The Mobile No is already taken.', 'data' => null]));
            return false;
        }

        $image = $this->doUploadImage('image_url');
        $results = $this->ApiModel->user_registration($image);
        if ($results) {
            unset($results['id']);
            if(!empty($results['image_url'])){
                $results['image_url'] = base_url('uploads/users/'.$results['image_url']);
            }
            $results['confirm_password'] = $this->input->post('confirm_password');
            $results['step'] = "2";
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step1 Registration Successfull.', 'data' => $results]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));
            return false;
        }
    }

    private function doUploadImage($file){
        $file1 = $_FILES[$file]['name'];
        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '0';
        // $config['file_name'] = rand(1111, 9999);
        $config['remove_spaces' ] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $upload_data = $this->upload->data();
        return $upload_data['file_name'];
    }

    public function userWorkDetail(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
        $this->form_validation->set_rules('employer', 'employer', 'trim|required');
        $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
        $this->form_validation->set_rules('experience_year', 'Experience Year', 'trim|required');
        $this->form_validation->set_rules('experience_month', 'Experience Month', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
        $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
        $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }

        $chk_work = $this->ApiModel->getWorkDetailByUserId($this->input->post('user_id'));
        if($chk_work){
            $results = $this->ApiModel->updateUserWorkDetail($chk_work['id']);
        }else{
            $results = $this->ApiModel->userWorkDetail();
        }

        if ($results) {
            $results['step'] = "3";   
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step2 Registration Successfull.', 'data' => $results]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));
            return false;
        }
    }    

    public function changePassword(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');  
        $this->form_validation->set_rules('old_pass', 'Old password', 'trim|required|min_length[6]|max_length[15]');  
        $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[6]|max_length[15]');  
        $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|matches[new_pass]');  
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        } 
        $checkold = $this->ApiModel->checkold();
        if($checkold){
            if($this->input->post('old_pass') == $this->input->post('new_pass')){
             $this->output->set_output(json_encode(['result' => -1, 'msg' =>'New password should not be same as old password' , 'data' => null]));   
            }else{               
                $changePass = $this->ApiModel->changePass();
                if($changePass){
                        $this->output->set_output(json_encode(['result' => 1, 'msg' =>'Password changed successfully' , 'data' => 'Password changed successfully']));
                    }else{
                        $this->output->set_output(json_encode(['result' => 0, 'msg' =>'Updation Failed' , 'data' => null]));
                    }
            }  
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' =>'Incorrect old password' , 'data' => null]));
        }
    }

    public function updatePersonalDetail(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone No', 'trim|required');
        $this->form_validation->set_rules('id_type', 'ID Type', 'trim|required');
        $this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $chk_duplicate = $this->ApiModel->getDuplicateUserMail($this->input->post('email'), $this->input->post('user_id'));
        if($chk_duplicate){
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'The Email ID is already taken.', 'data' => null]));
            return false;
        }
        $chk_duplicate_phone = $this->ApiModel->getDuplicateUserPhone($this->input->post('phone'), $this->input->post('user_id'));
        if($chk_duplicate_phone){
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'The Mobile No is already taken.', 'data' => null]));
            return false;
        }
        $results = $this->ApiModel->updatePersonalDetail();
        if ($results) {
            if (!empty($results['image_url'])) {
                $results['image_url'] = base_url('uploads/users/' . $results['image_url']);
            } else {
                $results['image_url'] = null;
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Personal Details Updated Successfull.', 'data' => $results]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));
            return false;
        }
    }   

    public function updateUserWorkDetail(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

        $this->form_validation->set_rules('employer', 'employer', 'trim|required');

        $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');

        $this->form_validation->set_rules('experience_year', 'Experience Year', 'trim|required');

        $this->form_validation->set_rules('experience_month', 'Experience Month', 'trim|required');

        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        $this->form_validation->set_rules('country_code', 'country code', 'trim|required');

        $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');

        $this->form_validation->set_rules('contact_number', 'Contact number', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $results = $this->ApiModel->updateUserWorkDetails();

        if ($results) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Work Details Updated Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    public function updateUsersIncomedetails(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

        $this->form_validation->set_rules('source_income', 'source income', 'trim|required');

        $this->form_validation->set_rules('salary_date', 'salary date', 'trim|required');

        $this->form_validation->set_rules('additional_income', 'additional income', 'trim|required');

        $this->form_validation->set_rules('total_income', 'total income', 'trim|required');

        $this->form_validation->set_rules('total_expenses', 'total expenses', 'trim|required');

        $this->form_validation->set_rules('net_income', 'net income', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $results = $this->ApiModel->updateUsersIncomedetail();

        if ($results) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Income Details Updated Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    public function usersIncomedetails(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

        $this->form_validation->set_rules('source_income', 'source income', 'trim|required');

        $this->form_validation->set_rules('salary_date', 'salary date', 'trim|required');

        $this->form_validation->set_rules('additional_income', 'additional income', 'trim|required');

        $this->form_validation->set_rules('total_income', 'total income', 'trim|required');

        $this->form_validation->set_rules('total_expenses', 'total expenses', 'trim|required');

        $this->form_validation->set_rules('net_income', 'net income', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $chk_income = $this->ApiModel->getIncomeDetailByUserId($this->input->post('user_id'));

        if($chk_income){

            $results = $this->ApiModel->updateUsersIncomedetails($chk_income['id']);

        }else{

           $results = $this->ApiModel->usersIncomedetails(); 

        }

        if ($results) {

            $results['step'] = "4";

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step3 Registration Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    // public function updateUsersIncomedetails(){

    //     $this->output->set_content_type('application/json');

    //     $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

    //     $this->form_validation->set_rules('source_income', 'source income', 'trim|required');

    //     $this->form_validation->set_rules('salary_date', 'salary date', 'trim|required');

    //     $this->form_validation->set_rules('additional_income', 'additional income', 'trim|required');

    //     $this->form_validation->set_rules('total_income', 'total income', 'trim|required');

    //     $this->form_validation->set_rules('total_expenses', 'total expenses', 'trim|required');

    //     $this->form_validation->set_rules('net_income', 'net income', 'trim|required');

    //     if ($this->form_validation->run() === false) {

    //         $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

    //         return false;

    //     }

    //     $results = $this->ApiModel->updateUsersIncomedetail();

    //     if ($results) {

    //         $results['step'] = "4";

    //         $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step3 Registration Successfull.', 'data' => $results]));

    //         return false;

    //     } else {

    //         $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

    //         return false;

    //     }

    // }

    public function usersBankdetails(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

        $this->form_validation->set_rules('account_holder_name', 'account holder name', 'trim|required');

        $this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');

        $this->form_validation->set_rules('account_number', 'account number', 'trim|required');

        $this->form_validation->set_rules('branch_code', 'branch code', 'trim|required');

        $this->form_validation->set_rules('branch_name', 'branch name', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $chk_bank = $this->ApiModel->getBankDetailByUserId($this->input->post('user_id'));

        if($chk_bank){

            $results = $this->ApiModel->updateUsersBankdetails($chk_bank['id']);    

        }else{

            $results = $this->ApiModel->usersBankdetails();    

        }

        if ($results) {

            $results['step'] = "5";

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step4 Registration Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    public function updateUsersBankdetail(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');

        $this->form_validation->set_rules('account_holder_name', 'account holder name', 'trim|required');

        $this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');

        $this->form_validation->set_rules('account_number', 'account number', 'trim|required');

        $this->form_validation->set_rules('branch_code', 'branch code', 'trim|required');

        $this->form_validation->set_rules('branch_name', 'branch name', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $results = $this->ApiModel->updateUsersBankdetail();    

        if ($results) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Bank Details Updated Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    public function usersCredit(){

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|is_unique[fa_users_credit.user_id]');

        $this->form_validation->set_rules('value', 'value', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $results = $this->ApiModel->usersCredit();

        if ($results) {

            $results['step'] = "6";

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Step5 Registration Successfull.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong.', 'data' => null]));

            return false;

        }

    }

    // public function login()

    // {

    //     $this->output->set_content_type('application/json');

    //     $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');

    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');

    //     $this->form_validation->set_rules('token_id', 'Token Id', 'trim');

        

    //     if ($this->form_validation->run() === false) {

    //         $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

    //         return false;

    //     }

    //     $email = $this->security->xss_clean($this->input->post('email'));

    //     $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));

    //     $token_id = $this->security->xss_clean($this->input->post('token_id'));



    //     $results = $this->ApiModel->login($email, $password);

    //     if ($results) {

    //         $this->send_tokenid($results['id'], $token_id);

    //         if (!empty($results['image_url'])) {

    //             $results['image_url'] = base_url('uploads/users/' . $results['image_url']);

    //         } else {

    //             $results['image_url'] = null;

    //         }

    //         $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

    //         return false;

    //     } else {

    //         $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email ID or Password is not correct.', 'data' => 'Email ID or Password is not correct.']));

    //         return false;

    //     }

    // }

    public function login()

    {

        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

        $email = $this->security->xss_clean($this->input->post('email'));

        $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));



        $results = $this->ApiModel->login($email, $password);

        if ($results) {

            if($results['is_block'] == "Blocked"){

                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'This Email Id is blocked.', 'data' => 'This Email Id is blocked.']));

                return false;

            }

            $chk_work = $this->ApiModel->getWorkDetailByUserId($results['user_id']);

            $results['step'] = null;

            if(empty($chk_work)){

                if (!empty($results['image_url'])) {

                    $results['image_url'] = base_url('uploads/users/' . $results['image_url']);

                } else {

                    $results['image_url'] = null;

                }   

                $results['step'] = "2";

                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

                return false;

            }

            $chk_income = $this->ApiModel->getIncomeDetailByUserId($results['user_id']);

            if(empty($chk_income)){

                $results = [];

                $results = $chk_work;

                $results['step'] = "3";

                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

                return false;

            }

            $chk_bank = $this->ApiModel->getBankDetailByUserId($results['user_id']);

            if(empty($chk_bank)){

               $results = [];

               $results = $chk_income;

               $results['step'] = "4";

               $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

                return false;

            }

            $chk_credit = $this->ApiModel->getCreditDetailByUserId($results['user_id']);

            if(empty($chk_credit)){

               $results = [];

               $results = $chk_bank;

               $results['step'] = "5";

               $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

                return false;

            }

            if (!empty($results['image_url'])) {

                $results['image_url'] = base_url('uploads/users/' . $results['image_url']);

            } else {

                $results['image_url'] = null;

            }

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login in Successful.', 'data' => $results]));

            return false;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email ID or Password is not correct.', 'data' => 'Email ID or Password is not correct.']));

            return false;

        }

    }



    public function send_tokenid($user_id, $tokenid)

    {

        $this->output->set_content_type('application/json');

        $already = $this->ApiModel->check_alreadyexist($user_id, $tokenid);

        if (!empty($already > 0)) {

            $token_info = array(

                'token_id' => $tokenid,

                'status' => 'Active'

            );

            $results = $this->ApiModel->update_tokenid($already['id'], $token_info);

            if ($results) {

                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data successfully updated', 'data' => 'Data successfully updated.']));

                return true;

            } else {

                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data did not successfully updated.', 'data' => 'Data did not successfully updated.']));

                return false;

            }

        } 

        else {

            $token_info = array(

                'user_id' => $user_id,

                'token_id' => $tokenid,

                'status' => 'Active'

            );

            $results = $this->ApiModel->insert_tokenid($token_info);

            if ($results) {

                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data successfully Added', 'data' => 'Data successfully Added.']));

                return true;

            } else {

                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data did not successfully Added.', 'data' => 'Data did not successfully Added.']));

                return false;

            }

        }

    }

    

      

//     public function privacy_policy(){

// 		$data['title'] = "Privacy Policy";

// 		$data['api'] = true;

// 		$data['page_data'] = $this->ApiModel->getPagesData('privacy');

// 		$this->load->view('pages',$data);

// 	}

	

	public function legal(){

	    $this->output->set_content_type('application/json');

		$data['title'] = "Legal";

		$data['api'] = true;

		$result = $data['page_data'] = $this->ApiModel->getPagesData('legal');

// 		$this->load->view('pages',$data);

	    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Legal Data', 'data' => $result]));

        return true;

	}

	

	public function faq(){

	    $this->output->set_content_type('application/json');

		$result = $this->ApiModel->getPagesData('faq');

		$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Faq Data', 'data' => $result]));

        return true;

	}

	

	public function term_condition(){

	    $this->output->set_content_type('application/json');

		$data['title'] = "Terms & Conditions";

		$data['api'] = true;

		$result = $data['page_data'] = $this->ApiModel->getPagesData('term');

// 		$this->load->view('pages',$data);

        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term Condition Data', 'data' => $result]));

        return true;

	}	

	public function getPersonalDetails(){

	    $this->output->set_content_type('application/json');

	    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

		$result = $this->ApiModel->getPersonalDetails($this->input->post('user_id'));

        if ($result) {

            if(!empty($result['image_url'])){

                $result['image_url'] = base_url('uploads/users/'.$result['image_url']);

            }else{

                $result['image_url'] = null;

            }

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data Found', 'data' => $result]));

            return true;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));

            return false;

        }

	}	

	public function getBankDetails(){

	    $this->output->set_content_type('application/json');

	    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

		$result = $this->ApiModel->getBankDetails($this->input->post('user_id'));

        if ($result) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data Found', 'data' => $result]));

            return true;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));

            return false;

        }

	}	

	public function getWorkDetails(){

	    $this->output->set_content_type('application/json');

	    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

		$result = $this->ApiModel->getWorkDetails($this->input->post('user_id'));

        if ($result) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data Found', 'data' => $result]));

            return true;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));

            return false;

        }

	}	

	public function getIncomeDetails(){

	    $this->output->set_content_type('application/json');

	    $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');

        if ($this->form_validation->run() === false) {

            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));

            return false;

        }

		$result = $this->ApiModel->getIncomeDetails($this->input->post('user_id'));

        if ($result) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data Found', 'data' => $result]));

            return true;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));

            return false;

        }

	}

	

	public function getCurrencyDetail(){

	    $this->output->set_content_type('application/json');

	    $result = $this->ApiModel->getCurrencyDetail();

        if ($result) {

            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data Found', 'data' => $result]));

            return true;

        } else {

            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));

            return false;

        }

	}

    

    public function downloadPdf()

	{

	    $data['title'] = "PDF";

		$this->load->view('admin/downloadPdf', $data);

// 		$html = $this->output->get_output();

//         $this->load->library('pdf');

//         $this->dompdf->loadHtml($html);

//         $this->dompdf->setPaper('A4', 'portrait');

//         $this->dompdf->render();

//         $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));

    }
    

    public function forgot_password()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
        }
        $email = $this->security->xss_clean($this->input->post('email'));
        $results = $this->ApiModel->check_email($email);
        if ($results) {
        $this->send_forgot_password_link($results);
        $this->output->set_output(json_encode(['result' => 1,'msg' => 'Reset password link sent to your email.', 'data' => $results]));
        return true;
        } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email ID is not correct.', 'data' => 'Email ID is not correct.']));
        return false;
        }
    }


    public function send_forgot_password_link($results)
    {
        $this->load->library('email');
        $getEmailResponse = $this->ApiModel->insert_user_activationcode($results['id']);
        $htmlContent = "<h3>Hi " . $results['name']. ",</h3>";
        $htmlContent .= "<div style='padding-top:8px;'>Please click below link to create a new password <br></div>";
        $htmlContent .= "<a href='" . base_url('api/reset-password/' . $results['id'].'/'.$getEmailResponse['is_forgot']) . "'>Click Here</a>";

        $from = "info@fuela.com";
        $to = $results['email'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        $subject = "Reset password";
        mail($to, $subject, $htmlContent, $headers);
        return true;
    }

    public function reset_password($user_id)
    {
        $data['user_id'] = $user_id;
        $data['title'] = 'Reset Password';
        $data['user'] =  $this->ApiModel->get_user_data($user_id);
        $this->load->view('admin/users/password-reset', $data);
    }

    public function do_reset_passowrd($user_id)
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return FALSE;
        }
        $results = $this->ApiModel->do_reset_passowrd($user_id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changed successfully.']));
            return FALSE;
            } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully.']));
            return FALSE;
        }
    }

    public function help_query()
    {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('query', 'Your Query', 'trim|required');
        if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
        }
        $results = $this->ApiModel->help_query();
        if ($results) {
        $this->output->set_output(json_encode(['result' => 1,'msg' => 'Your query sumbit successful. contact you soon..']));
        return true;
        } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not submitted']));
        return false;
        }
    }

    public function get_conatct_detail(){
	    $this->output->set_content_type('application/json');
	    $result = $this->ApiModel->get_conatct_detail();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded', 'data' => $result]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found.', 'data' => 'Data Not Found.']));
            return false;
        }
    }
    
    public function delete_user_account(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
	    $result = $this->ApiModel->delete_user_account();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Data deleted']));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not deleted.']));
            return false;
        }
	}
}