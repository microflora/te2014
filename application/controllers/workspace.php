<?php
class Workspace extends CI_Controller
{
	function Workspace() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'date', 'teched_db'));
		$this->load->model('account_model');
	}

	function start() {
		if($this->account_model->logged_in()) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$speakerid = $this->account_model->get_speakerid();

			switch ($event_target) {
				case "List":
				default:
					$this->display_my_list($event_target, $event_argument, $speakerid);
					break;
			}
		}
		else {
			redirect('account/login');
		}
	}

	private function display_my_list($event_target, $event_argument, $speakerid) {
		if ($event_target=="List") {
			$data['showspeakerapproved'] = $this->input->post('showspeakerapproved');
			$data['showtranslatorapproved'] = $this->input->post('showtranslatorapproved');
		} else {
			// defaut only list approved sessions
			$data['showspeakerapproved'] = TRUE;
			$data['showtranslatorapproved'] = TRUE;
		}

		if ($data['showspeakerapproved']) {
			$speakerwhereclause = "where sas.speakerid=".$speakerid." and sas.speakerapproved =1 ";
		} else {
			$speakerwhereclause = "where sas.speakerid=".$speakerid." ";
		}

		if ($data['showtranslatorapproved']) {
			$translatorwhereclause = "where tas.translatorid=".$speakerid." and tas.translatorapproved =1 ";
		} else {
			$translatorwhereclause = "where tas.translatorid=".$speakerid." ";
		}

		$data['activemenu']="My_Workspace";
		$data['activesubmenu']="List";
		$data['formaction'] = "../workspace/start.html";
		$data['speaker_sessions'] = teched_db_get_my_session_list_as_speaker($speakerwhereclause);
		$data['translator_sessions'] = teched_db_get_my_session_list_as_translator($translatorwhereclause);
		$this->load->view('main', $data);
	}
}