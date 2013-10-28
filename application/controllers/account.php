<?php
class Account extends CI_Controller
{
	function Account() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session', 'email'));
		$this->load->helper(array('url', 'form', 'captcha'));
		$this->load->model('account_model');
		$this->_salt = "123456789987654321";
	}

	function index() {
		$this->load->view('redirector');
	}

	function login() {
		$this->form_validation->
		set_rules('email', 'Email Address',
			'xss_clean|required||max_length[100]|valid_email');
		$this->form_validation->
		set_rules('password', 'Password',
			'xss_clean|required|min_length[5]|max_length[15]|callback_password_check');
		$this->form_validation->
		set_rules('captcha', 'Verification Code',
			'xss_clean|required|callback_captcha_check');
		$this->_email = $this->input->post('email');
		$this->_password =
		sha1($this->_salt . $this->input->post('password'));

		if($this->form_validation->run() == FALSE) {
 			$cap = $this->prepare_captcha();
 			$data['captcha'] = $cap['image'];
 			$this->load->view('account/login',$data);
		}
		else {
			$this->account_model->login();
			redirect('main/home');
		}
	}

	function logout() {
		$this->account_model->logout();
		$data['title']="Logout Successfully";
		$data['message'] =
					"You have successfully logged out! You can login again "
					. anchor('account/login', 'here') . ".";
					$this->load->view('account/result', $data);
	}

	function register() {
		$this->form_validation->
		set_rules('firstname', 'First Name',
			'xss_clean|required|max_length[50]');
		$this->form_validation->
		set_rules('lastname', 'Last Name',
			'xss_clean|required|max_length[50]');
		$this->form_validation->
		set_rules('email', 'Email Address',
			'xss_clean|required||max_length[100]|valid_email|callback_email_not_exists');
		$this->form_validation->
		set_rules('password', 'Password',
			'xss_clean|required|min_length[5]|max_length[15]|matches[password_confirmation]');
		$this->form_validation->
		set_rules('password_confirmation', 'Password Confirmation',
			'xss_clean|required|matches[password]');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('account/register');
		}
		else {
			$data['firstname'] = $this->input->post('firstname');
			$data['lastname'] = $this->input->post('lastname');
			$data['email'] = $this->input->post('email');
			$data['password'] =
			sha1($this->_salt . $this->input->post('password'));
			$data['photo'] = 'unknown.jpg';

			if($this->account_model->create($data) === TRUE) {
				$data['title']="Success";
				$data['message'] =
					"The user account has now been created! You can login "
					. anchor('account/login', 'here') . ".";
					$this->load->view('account/result', $data);
			}
			else {
				$data['title']="Fail";
				$data['message'] =
					"There was a problem when creating your account.";
				$this->load->view('account/result', $data);
			}
		}
	}

	function reset() {
		$this->form_validation->
		set_rules('email', 'Email Address',
			'xss_clean|required||max_length[100]|valid_email|callback_email_exists');
		$this->form_validation->
		set_rules('captcha', 'Verification Code',
			'xss_clean|required|callback_captcha_check');
		$email = $this->input->post('email');
		$password = rand(100000,999999);

		if($this->form_validation->run() == FALSE) {
 			$cap = $this->prepare_captcha();
 			$data['captcha'] = $cap['image'];
			$this->load->view('account/reset', $data);
 		}
		else {
				$data['email'] = $email;
				$data['password'] = sha1($this->_salt . $password);
					
				if($this->account_model->reset_password($data['email'], $data['password']) === TRUE) {

					$this->email->from($email, $email);
					$this->email->to($email);
					$this->email->subject('Password Reset Successfully!');
					$this->email->message('Use the new password:'.$password." to login "
						. anchor('account/login', 'here') . ".");
					
					$this->email->send();
			
					$data['title']="Success";
					$data['message'] =
						"Please get the new password in".$email." and login "
						. anchor('account/login', 'here') . ".";
						$this->load->view('account/result', $data);
				}
				else {
					$data['title']="Fail";
					$data['message'] =
						"There was a problem when resetting your password.";
					$this->load->view('account/result', $data);
				}
		}
	}

	function email_exists($email) {
		if ($this->email_not_exists($email)) {
			$this->form_validation->
			set_message('email_exists',
				'The %s does not registered.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	function email_not_exists($email) {
		$query = $this->db->get_where('speakers', array('email' => $email));
		if($query->num_rows() > 0) {
			$this->form_validation->
			set_message('email_not_exists',
				'The %s already registered, please use a different one.');
			return FALSE;
		}
		$query->free_result();
		return TRUE;
	}

	function password_check() {
		$this->db->where('email', $this->_email);
		$query = $this->db->get('speakers');

		if($query->num_rows() > 0)	{
			$result = $query->row_array();
			if($result['password'] == $this->_password) {
				return TRUE;
			}
		}

		$this->form_validation->
		set_message('password_check', 'Login failed, please try again!');

		return FALSE;
	}

	function prepare_captcha() {
		$vals = array(
			'word' => rand(1000, 9999),
		    'img_path' => './captcha/',
		    'img_url' => '../../captcha/',
		 	'expiration' => 900
		    );

	    $cap = create_captcha($vals);

	    $data = array(
		    'captcha_time' => $cap['time'],
		    'ip_address' => $this->input->ip_address(),
		    'word' => $cap['word']
		    );

	    $query = $this->db->insert_string('captcha', $data);
	    $this->db->query($query);
	     
	    return $cap;
	}

	function captcha_check() {
		// First, delete old captchas
		$expiration = time()-600; // 10min
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count > 0) {
			return TRUE;
		}

		$this->form_validation->
		set_message('captcha_check', 'You must submit the word that appears in the image');
		return FALSE;

	}

}