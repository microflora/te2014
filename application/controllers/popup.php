<?php
class Popup extends CI_Controller
{
	function Popup() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'date', 'teched_db'));
		$this->load->model('account_model');
	}

	function popup_session_detail() {
		$sid = $this->input->get('__EVENTARGUMENT');

		$data['sessions'] = teched_db_get_session_detail($sid);
		$data['speakers'] = teched_db_get_speaker_assignments($sid);
		$data['translators'] = teched_db_get_translator_assignments($sid);

		$this->load->view('popup/popup_session_detail', $data);
	}

	function popup_session_translation() {
		$sid = $this->input->get('__EVENTARGUMENT');

		$data['sessions'] = teched_db_get_session_detail($sid);

		$this->load->view('popup/popup_session_translation', $data);
	}

	function popup_speaker_translator_summary() {
		$speakerid = $this->input->get('__EVENTARGUMENT');

		$data['speaker_summary'] = teched_db_get_speaker_summary($speakerid);
		$data['translator_summary'] = teched_db_get_translator_summary($speakerid);
		
		$this->load->view('popup/popup_speaker_translator_summary', $data);
	}
	
}