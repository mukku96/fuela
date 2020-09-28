<?php
/**
 * Description of Api_model
 *
 * @author Mukesh Yadav
 */
class ApiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }
   
    public function user_registration($image){
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('full_name')),
            'country_code' => $this->security->xss_clean($this->input->post('country_code')),
            'mobile' => $this->security->xss_clean($this->input->post('phone')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'id_type' => $this->security->xss_clean($this->input->post('id_type')),
            'id_number' => $this->security->xss_clean($this->input->post('id_number')),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('create_password'))),
            'image_url' => $this->security->xss_clean($image),
        );
        $this->db->insert('fa_users', $data);
        $user_id =  $this->db->insert_id();
        $this->db->select('*,id as user_id,');
        $this->db->where(['id' => $user_id]);
        $query = $this->db->get('fa_users');
        return $query->row_array();
    }    

    public function updatePersonalDetail(){
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('full_name')),
            'country_code' => $this->security->xss_clean($this->input->post('country_code')),
            'mobile' => $this->security->xss_clean($this->input->post('phone')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'id_type' => $this->security->xss_clean($this->input->post('id_type')),
            'id_number' => $this->security->xss_clean($this->input->post('id_number')),
            'address' => $this->security->xss_clean($this->input->post('address')),
        );
        $this->db->update('fa_users', $data, ['id' => $this->security->xss_clean($this->input->post('user_id'))]);
        $user_id =  $this->db->affected_rows();
        $this->db->select('*,id as user_id,');
        $this->db->where(['id' => $this->input->post('user_id')]);
        $query = $this->db->get('fa_users');
        return $query->row_array();
    }  

    public function checkold(){
        $this->db->select('*');
        $this->db->from('fa_users');
        $this->db->where('password', $this->security->xss_clean(hash('sha256', $this->input->post('old_pass'))));
        $this->db->where('id',$this->input->post('user_id'));
        $sel = $this->db->get();
        return $sel->row_array();
    }

    public function changePass(){
       $user_id = $this->input->post('user_id');
       $new_pass = $this->security->xss_clean(hash('sha256', $this->input->post('new_pass')));
       $this->db->where('id',$user_id);    
       $this->db->update('fa_users',['password'=> $new_pass]);
       return $this->db->affected_rows();       
    }

	public function getPagesData($page_id){
		$query = $this->db->get_where('fa_pages', [strtolower('page_id') => strtolower($page_id)]);
		if($page_id != "faq"){
		    return $query->row_array();
		}else{
		    return $query->result_array();
		}
	}
    
    public function getPersonalDetails($id){
    	$query = $this->db->get_where('fa_users', ['id' => $id]);
	    return $query->row_array();
    }    

    public function getWorkDetails($id){

    	$query = $this->db->get_where('fa_users_workdetails', ['user_id' => $id]);

	    return $query->row_array();

    }    

    public function getIncomeDetails($id){

    	$query = $this->db->get_where('fa_users_incomedetails', ['user_id' => $id]);

	    return $query->row_array();

    }

        

    public function getBankDetails($id){

    	$query = $this->db->get_where('fa_users_bankdetails', ['user_id' => $id]);

	    return $query->row_array();

    }

    

    public function userWorkDetail(){

        $data = array(

            'user_id' => $this->security->xss_clean($this->input->post('user_id')),

            'employer' => $this->security->xss_clean($this->input->post('employer')),

            'Occupation' => $this->security->xss_clean($this->input->post('occupation')),

            'experience_year' => $this->security->xss_clean($this->input->post('experience_year')),

            'experience_month' => $this->security->xss_clean($this->input->post('experience_month')),

            'Address' => $this->security->xss_clean($this->input->post('address')),

            'contact_person' => $this->security->xss_clean($this->input->post('contact_person')),

            'country_code' => $this->security->xss_clean($this->input->post('country_code')),

            'contact_number' => $this->security->xss_clean($this->input->post('contact_number')),
        );

        $this->db->insert('fa_users_workdetails', $data);

        $user_id =  $this->db->insert_id();

        $this->db->where(['id' => $user_id]);

        $query = $this->db->get('fa_users_workdetails');

        return $query->row_array();

    } 

    public function updateUserWorkDetail($id){

        $data = array(

            'employer' => $this->security->xss_clean($this->input->post('employer')),

            'Occupation' => $this->security->xss_clean($this->input->post('occupation')),

            'experience_year' => $this->security->xss_clean($this->input->post('experience_year')),

            'experience_month' => $this->security->xss_clean($this->input->post('experience_month')),

            'Address' => $this->security->xss_clean($this->input->post('address')),

            'contact_person' => $this->security->xss_clean($this->input->post('contact_person')),

            'contact_number' => $this->security->xss_clean($this->input->post('contact_number')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_workdetails', $data, ['id' => $id, 'user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_workdetails', ['id' => $id]);

        return $query->row_array();

    }     

    public function updateUserWorkDetails(){

        $data = array(

            'employer' => $this->security->xss_clean($this->input->post('employer')),

            'Occupation' => $this->security->xss_clean($this->input->post('occupation')),

            'experience_year' => $this->security->xss_clean($this->input->post('experience_year')),

            'experience_month' => $this->security->xss_clean($this->input->post('experience_month')),

            'Address' => $this->security->xss_clean($this->input->post('address')),

            'contact_person' => $this->security->xss_clean($this->input->post('contact_person')),

            'country_code' => $this->security->xss_clean($this->input->post('country_code')),

            'contact_number' => $this->security->xss_clean($this->input->post('contact_number')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_workdetails', $data, ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_workdetails', ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        return $query->row_array();

    }    

    public function usersIncomedetails(){

        $data = array(

            'user_id' => $this->security->xss_clean($this->input->post('user_id')),

            'source_income' => $this->security->xss_clean($this->input->post('source_income')),

            'salary_date' => $this->security->xss_clean($this->input->post('salary_date')),

            'additional_income' => $this->security->xss_clean($this->input->post('additional_income')),

            'total_income' => $this->security->xss_clean($this->input->post('total_income')),

            'total_expenses' => $this->security->xss_clean($this->input->post('total_expenses')),

            'net_income' => $this->security->xss_clean($this->input->post('net_income')),

            'create_at'=>date('Y-m-d')

        );

        $this->db->insert('fa_users_incomedetails', $data);

        $user_id =  $this->db->insert_id();

        $this->db->where(['id' => $user_id]);

        $query = $this->db->get('fa_users_incomedetails');

        return $query->row_array();

    }      

    public function updateUsersIncomedetail(){

        $data = array(

            'source_income' => $this->security->xss_clean($this->input->post('source_income')),

            'salary_date' => $this->security->xss_clean($this->input->post('salary_date')),

            'additional_income' => $this->security->xss_clean($this->input->post('additional_income')),

            'total_income' => $this->security->xss_clean($this->input->post('total_income')),

            'total_expenses' => $this->security->xss_clean($this->input->post('total_expenses')),

            'net_income' => $this->security->xss_clean($this->input->post('net_income')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_incomedetails', $data, ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_incomedetails', ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        return $query->row_array();

    }       

    public function updateUsersIncomedetails(){

        $data = array(

            'source_income' => $this->security->xss_clean($this->input->post('source_income')),

            'salary_date' => $this->security->xss_clean($this->input->post('salary_date')),

            'additional_income' => $this->security->xss_clean($this->input->post('additional_income')),

            'total_income' => $this->security->xss_clean($this->input->post('total_income')),

            'total_expenses' => $this->security->xss_clean($this->input->post('total_expenses')),

            'net_income' => $this->security->xss_clean($this->input->post('net_income')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_incomedetails', $data, ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_incomedetails', ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        return $query->row_array();

    }

    

    public function getDuplicateUserMail($email, $user_id = null){

       if(!empty($user_id)){

            $this->db->where('id !=', $user_id);

       }

       $query = $this->db->get_where('fa_users', ['email' => $email]);

        return $query->row_array(); 

    }   

    public function getDuplicateUserPhone($phone, $user_id = null){

       if(!empty($user_id)){

            $this->db->where('id !=', $user_id);

       }

       $query = $this->db->get_where('fa_users', ['mobile' => $phone]);

        return $query->row_array(); 

    }

    

    public function usersBankdetails(){

        $data = array(

            'user_id' => $this->security->xss_clean($this->input->post('user_id')),

            'account_holder_name' => $this->security->xss_clean($this->input->post('account_holder_name')),

            'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),

            'account_number' => $this->security->xss_clean($this->input->post('account_number')),

            'branch_code' => $this->security->xss_clean($this->input->post('branch_code')),

            'branch_name' => $this->security->xss_clean($this->input->post('branch_name')),

            'created_at'=>date('Y-m-d')

        );

        $this->db->insert('fa_users_bankdetails', $data);

        $user_id =  $this->db->insert_id();

        $this->db->where(['id' => $user_id]);

        $query = $this->db->get('fa_users_bankdetails');

        return $query->row_array();

    }       

    public function updateUsersBankdetails($id){

        $data = array(

            'account_holder_name' => $this->security->xss_clean($this->input->post('account_holder_name')),

            'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),

            'account_number' => $this->security->xss_clean($this->input->post('account_number')),

            'branch_code' => $this->security->xss_clean($this->input->post('branch_code')),

            'branch_name' => $this->security->xss_clean($this->input->post('branch_name')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_bankdetails', $data, ['id' => $id, 'user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $user_id =  $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_bankdetails', ['id' => $id, 'user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        return $query->row_array();

    }           

    public function updateUsersBankdetail(){

        $data = array(

            'account_holder_name' => $this->security->xss_clean($this->input->post('account_holder_name')),

            'bank_name' => $this->security->xss_clean($this->input->post('bank_name')),

            'account_number' => $this->security->xss_clean($this->input->post('account_number')),

            'branch_code' => $this->security->xss_clean($this->input->post('branch_code')),

            'branch_name' => $this->security->xss_clean($this->input->post('branch_name')),

            'updated_at'=>date('Y-m-d H:i:s')

        );

        $this->db->update('fa_users_bankdetails', $data, ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        $user_id =  $this->db->affected_rows();

        $query = $this->db->get_where('fa_users_bankdetails', ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);

        return $query->row_array();

    }    

    public function usersCredit(){

        $data = array(

            'user_id' => $this->security->xss_clean($this->input->post('user_id')),

            'value' => $this->security->xss_clean($this->input->post('value')),

            'create_at'=>date('Y-m-d')

        );

        $this->db->insert('fa_users_credit', $data);

        $user_id =  $this->db->insert_id();

        $this->db->where(['id' => $user_id]);

        $query = $this->db->get('fa_users_credit');

        return $query->row_array();

    }

    

    public function login($email, $password){

        $this->db->select('*, id as user_id');
        $this->db->from('fa_users');
        $this->db->where('deleted_at is NULL', NULL, FALSE);
        $this->db->where(['email' => $email, 'password' => $password]);
        $query = $this->db->get();
        return $query->row_array();

    }    

    public function getWorkDetailByUserId($user_id){

        $query = $this->db->get_where('fa_users_workdetails', ['user_id' => $user_id]);

        return $query->row_array();

    }    

    public function getIncomeDetailByUserId($user_id){

        $query = $this->db->get_where('fa_users_incomedetails', ['user_id' => $user_id]);

        return $query->row_array();

    }    

    public function getBankDetailByUserId($user_id){

        $query = $this->db->get_where('fa_users_bankdetails', ['user_id' => $user_id]);

        return $query->row_array();

    }    

    public function getCreditDetailByUserId($user_id){

        $query = $this->db->get_where('fa_users_credit', ['user_id' => $user_id]);

        return $query->row_array();

    }    

    public function getCurrencyDetail(){

        $query = $this->db->get_where('fa_currency');

        return $query->row_array();

    }

    public function check_email($email)
    {
      $this->db->select('id, name, email');
      $query = $this->db->get_where('fa_users', ['email' => $email]);
      return $query->row_array();
    }
    
    public function insert_user_activationcode($user_id)
    {
        $this->db->update('fa_users', ['is_forgot' => 'Active'], ['id' => $user_id]);
        $this->db->affected_rows();
        
        $query = $this->db->get_where('fa_users',['id'=>$user_id]);
        return $query->row_array();
    }

    public function get_user_data($user_id){
        $query = $this->db->get_where('fa_users',['id'=>$user_id]);
        return $query->row_array();
    }

    public function do_reset_passowrd($user_id)
    {
        $reset_data = array(
        'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $this->db->update('fa_users', $reset_data, ['id' => $user_id, 'is_forgot' => 'Active']);
        $this->db->update('fa_users', ['is_forgot' => 'Null'], ['id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function help_query()
    {
        $query_data = array(
            'user_id' => $this->security->xss_clean($this->input->post('user_id')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'query' => $this->security->xss_clean($this->input->post('query')),
        );
        $this->db->insert('fa_users_helpquery', $query_data);
        return $this->db->insert_id();
    }
    public function account_approval()
    {
        $data = array(
            'user_status' => $this->security->xss_clean($this->input->post('key'))
        );
        $this->db->update('fa_users', $data, ['id' => $this->security->xss_clean($this->input->post('user_id'))]);
        $this->db->affected_rows();
        $query = $this->db->get_where('fa_users', ['id' => $this->security->xss_clean($this->input->post('user_id'))]);
        return $query->row_array();
    }

    public function get_conatct_detail(){
        $query = $this->db->get('fa_contacts');
        return $query->row_array();
    }

    public function delete_user_account(){
        $user_id = $this->security->xss_clean($this->input->post('user_id'));
        $this->db->update('fa_users', ['deleted_at'=>date('Y-m-d H:i:s')], ['id' => $user_id]);
        return $this->db->affected_rows();
    }
    public function getQuationData(){
        $this->db->select('user_id, value as user_demand, admin_value, interest_rate');
        $query = $this->db->get_where('fa_users_credit', ['user_id' => $this->security->xss_clean($this->input->post('user_id'))]);
        return $query->row_array();
    }

    public function change_profile($user_id, $image_url){
        $this->db->update('fa_users', ['image_url' => $image_url], ['id'=>$user_id]);
        return $this->db->affected_rows();
    }

    public function get_profile_date($user_id){
        $this->db->select('*, id as user_id');
        $query = $this->db->get_where('fa_users', ['id' => $user_id]);
        return $query->row_array();
    }
}