<?php
class Profile extends CI_Controller
{
	function Profile() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'teched_db'));
		$this->load->model('account_model');
	}

	function start() {
		if($this->account_model->logged_in()) {
			$data['speaker'] = $this->account_model->get_account_info();
			$data['countries'] = get_teched_db_countries();
			$data['organizations'] = get_teched_db_organizations();
			$data['shirts'] = get_teched_db_shirts();
			$data['activemenu']="Modify_Personal_Information";
			$this->load->view('main', $data);
		}
		else {
			redirect('account/login');
		}
	}
	
	function update() {
		$this->form_validation->
		set_rules('firstname', 'First Name',
			'xss_clean|required|max_length[50]');
		$this->form_validation->
		set_rules('lastname', 'Last Name',
			'xss_clean|required|max_length[50]');
		$this->form_validation->
		set_rules('company', 'Company',
			'xss_clean|required|max_length[50]');
	    $this->form_validation->
		set_rules('jobtitle', 'Job Title',
			'xss_clean|required|max_length[100]');
	    $this->form_validation->
		set_rules('employeenumber', 'Employee Number',
			'xss_clean|max_length[100]');
		$this->form_validation->
		set_rules('phone', 'Phone',
			'xss_clean|required|max_length[30]');		
		$this->form_validation->
		set_rules('cell', 'Cell Phone',
			'xss_clean|required|max_length[30]');	
		$this->form_validation->
		set_rules('ccemail', 'CC Email Address',
			'xss_clean|max_length[100]|valid_email');
	    $this->form_validation->
		set_rules('sdnid', 'SCN User ID',
			'xss_clean|max_length[50]');
	    $this->form_validation->
		set_rules('bio', 'Short Expertise Description',
			'xss_clean|required|max_length[800]');
		
		$this->form_validation->
		set_rules('cn_fullname', '姓名',
			'xss_clean|max_length[50]');
		$this->form_validation->
		set_rules('cn_company', '公司',
			'xss_clean|max_length[50]');
	    $this->form_validation->
		set_rules('cn_jobtitle', '职位',
			'xss_clean|max_length[100]');
		$this->form_validation->
		set_rules('cn_bio', '250字以内的中文简历',
			'xss_clean|max_length[250]');
				
		$speaker['firstname'] = $this->input->post('firstname');
		$speaker['lastname'] = $this->input->post('lastname');
		$speaker['company'] = $this->input->post('company');
		$speaker['jobtitle'] = $this->input->post('jobtitle');
		$speaker['employeenumber'] = $this->input->post('employeenumber');
		$speaker['countryid'] = $this->input->post('countryid');
		$speaker['phone'] = $this->input->post('phone');
		$speaker['cell'] = $this->input->post('cell');
		$speaker['ccemail'] = $this->input->post('ccemail');
		$speaker['sdnid'] = $this->input->post('sdnid');
		$speaker['shirtid'] = $this->input->post('shirtid');
		$speaker['gender'] = $this->input->post('gender');
		$speaker['bio'] = str_replace("\n\n", "\n", $this->input->post('bio'));
		
		$speaker['cn_speaker'] = $this->input->post('cn_speaker');
		$speaker['cn_fullname'] = $this->input->post('cn_fullname');
		$speaker['cn_company'] = $this->input->post('cn_company');
		$speaker['cn_jobtitle'] = $this->input->post('cn_jobtitle');
		$speaker['cn_bio'] = str_replace("\n\n", "\n", $this->input->post('cn_bio'));
		
		if($this->form_validation->run() == FALSE) {
			
			$data['speaker'] = $speaker;			
			$data['countries'] = get_teched_db_countries();
			$data['organizations'] = get_teched_db_organizations();
			$data['shirts'] = get_teched_db_shirts();
			$data['activemenu']="Modify_Personal_Information";
			
			$this->load->view('main', $data);
		}
		else {
			if($this->account_model->update($speaker) === TRUE) {
				$data['title']="Success";
				$data['message'] =
					"The profile has now been updated! You can get back "
					. anchor('profile/start', 'here') . ".";
					$this->load->view('account/result', $data);
			}
			else {
				$data['title']="Fail";
				$data['message'] =
					"There was a problem when updating your profile! You can get back "
					. anchor('profile/start', 'here')." to try again.";
				$this->load->view('account/result', $data);
			}
		}
	}
	
	function shirtsize() {
		if($this->account_model->logged_in()) {
			$this->load->view('Modify_Personal_Information_Shirt_Size');
		}
		else {
			redirect('account/login');
		}
	}	
}