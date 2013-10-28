<?php
class Account_model extends CI_Model {
	function Account_model() {
		parent::__construct();
		$this->load->database();
	}

	function create($data) {
		if($this->db->insert('speakers', $data))
		{
			return TRUE;
		}
		return FALSE;
	}

	function update($data) {
		$email = $this->get_email();
		if ($email <> "")
		{
			$this->db->where('email', $email);

			if($this->db->update('speakers', $data))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	function update_by_id($speakerid, $data) {
		if ($speakerid > 0)
		{
			$this->db->where('id', $speakerid);

			if($this->db->update('speakers', $data))
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	function reset_password($email, $password) {
		if ($email <> "")
		{
			$this->db->where('email', $email);
			$this->db->set('password', $password);

			if($this->db->update('speakers'))
			{
				$this->logout();
				return TRUE;
			}
		}
		return FALSE;
	}

	function change_password($data) {
		$email = $this->get_email();
		if ($email <> "")
		{
			$this->db->where('email', $email);
			$this->db->set('password', $data['password']);

			if($this->db->update('speakers'))
			{
				$this->logout();
				return TRUE;
			}
		}
		return FALSE;
	}

	function change_photo($photo) {
		$this->db->where('email', $this->get_email());
		$this->db->set('photo', $photo);

		if($this->db->update('speakers'))
		{
			return TRUE;
		}
		return FALSE;
	}

	function login() {
		$email = $this->input->post('email');
		if ($email <> "")
		{
			$roles = "";

			$sql="select spk.id as id, rs.role as role from speakers spk "
			."LEFT OUTER JOIN roles rs ON spk.id = rs.id "
			."WHERE spk.email = '".$email."'";
			$query = $this->db->query($sql);

			if($query->num_rows() > 0)	{
				$result = $query->result_array();
				foreach ($result as $item):
				$roles = $roles.$item['role'].";";
				endforeach;
			}

			$data = array('email' => $email,
							'logged_in' => TRUE,
							'roles'=>$roles);
			$this->session->set_userdata($data);
		}
	}

	function logged_in() {
		if($this->session->userdata('logged_in') == TRUE)
		{
			return TRUE;
		}
		return FALSE;
	}

	function logout() {
		$this->session->sess_destroy();
	}

	function get_email() {
		return $this->session->userdata('email');
	}

	function get_account_info() {
		$email = $this->get_email();
		return $this->get_account_info_by_email($email);
	}

	function get_account_info_by_email($email) {
		if ($email <> "")
		{
			$this->db->where('email', $email);
			$query = $this->db->get('speakers');

			if($query->num_rows() > 0)	{
				$result = $query->row_array();
				return $result;
			}
		}

		return NULL;
	}

	function get_account_info_by_id($id) {
		if ($id > 0)
		{
			$this->db->where('id', $id);
			$query = $this->db->get('speakers');

			if($query->num_rows() > 0)	{
				$result = $query->row_array();
				return $result;
			}
		}

		return NULL;
	}

	function get_speakerid() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return NULL;
		} else {
			return $result['id'];
		}
	}

	function get_fullname() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return '?';
		} else {
			return $result['firstname']." ".$result['lastname'];
		}
	}

	function get_lasttname() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return '?';
		} else {
			return $result['lastname'];
		}
	}

	function get_firstname() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return '?';
		} else {
			return $result['firstname'];
		}
	}

	function get_password() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return '?';
		} else {
			return $result['password'];
		}
	}

	function get_photo() {
		$result = $this->get_account_info();

		if(is_null($result))	{
			return '?';
		} else {
			return $result['photo'];
		}
	}

	function is_role($role)
	{
		$roles = $this->session->userdata('roles');
		$pos = stripos($roles, $role);

		if ($pos !== FALSE) {
			return TRUE;
		}

		return FALSE;
	}
}