<?php
class Main extends CI_Controller
{
	function Main() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form'));
		$this->load->model('account_model');
		$this->_salt = "123456789987654321";
	}

	function index() {
		$this->load->view('redirector');
	}

	function home() {
		if($this->account_model->logged_in()) {
			$data['activemenu']="Speaker_Site_Home";
			$data['firstname'] = $this->account_model->get_firstname();
			$data['photo'] = $this->account_model->get_photo();
			$this->load->view('main', $data);
		}
		else {
			redirect('account/login');
		}
	}

	function guidelines() {
		if($this->account_model->logged_in()) {
			$data['activemenu']="Proposal_and_Speaking_Guidelines";
			$this->load->view('main', $data);
		}
		else {
			redirect('account/login');
		}
	}

//	function signupglobal() {
//		if($this->account_model->logged_in()) {
//			$data['activemenu']="Sign_Up_for_Global_Sessions";
//			$this->load->view('main', $data);
//		}
//		else {
//			redirect('account/login');
//		}
//	}
//	
//	function proposelocal() {
//		if($this->account_model->logged_in()) {
//			$data['activemenu']="Propose_Local_Sessions";
//			$this->load->view('main', $data);
//		}
//		else {
//			redirect('account/login');
//		}
//	}
//	
//	function signuplocal() {
//		if($this->account_model->logged_in()) {
//			$data['activemenu']="Sign_Up_for_Local_Sessions";
//			$this->load->view('main', $data);
//		}
//		else {
//			redirect('account/login');
//		}
//	}
	
	function changepassword() {
		if($this->account_model->logged_in()) {
			$this->form_validation->
			set_rules('opwd', 'Old Password',
				'xss_clean|required|callback_old_password_check');
			$this->form_validation->
			set_rules('upwd1', 'New Password',
				'xss_clean|required|min_length[5]|max_length[15]|matches[upwd2]');
			$this->form_validation->
			set_rules('upwd2', 'New Password Confirmation',
				'xss_clean|required|matches[upwd1]');
			$this->_oldpassword =
			sha1($this->_salt . $this->input->post('opwd'));

			if($this->form_validation->run() == FALSE) {
				$data['activemenu']="Change_My_Password";
				$this->load->view('main', $data);
			}
			else {
				$data['email'] = $this->account_model->get_email();
				$data['password'] =
				sha1($this->_salt . $this->input->post('upwd1'));
					
				if($this->account_model->change_password($data) === TRUE) {
					$data['title']="Success";
					$data['message'] =
						"The password has now been changed! You can login "
						. anchor('account/login', 'here') . ".";
						$this->load->view('account/result', $data);
				}
				else {
					$data['title']="Fail";
					$data['message'] =
						"There was a problem when changing your password.";
					$this->load->view('account/result', $data);
				}
			}

		}
		else {
			redirect('account/login');
		}
	}

	function old_password_check($oldpassword) {

		if ($this->account_model->get_password()== sha1($this->_salt .$oldpassword)) {
			return TRUE;
		}

		$this->form_validation->
		set_message('old_password_check', 'Old password incorrect!');

		return FALSE;
	}

}