<?php
class SignUp4Global extends CI_Controller
{
	function SignUp4Global() {
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
				case "Detail":
					$this->display_session_detail($event_target, $event_argument, $speakerid, NULL, NULL);
					break;
				case "SignUp":
					$this->form_validation->
					set_rules('language', 'language',
						'xss_clean|required');

					$this->form_validation->
					set_rules('translator', 'translator',
						'xss_clean|required');

					$language = $this->input->post('language');
					$translator = $this->input->post('translator');

					if($this->form_validation->run() == FALSE)
					{
						$this->display_session_detail($event_target, $event_argument, $speakerid, $language, $translator);
					}
					else
					{
						if (teched_db_add_speaker_assignments($event_argument, $speakerid, $language))
						{
							if ($translator == 1)
							{
								if (!teched_db_add_translator_assignments($event_argument, $speakerid))
								{
									$data['title']="Fail";
									$data['message'] =
								"There was a problem when signing up yourself as the translator. Please click "
								. anchor('signup4global/start', 'here')." to try again.";
								$this->load->view('account/result', $data);
								}
							}

							$this->display_session_translation($event_target, $event_argument, $speakerid);
						} else {
							$data['title']="Fail";
							$data['message'] =
								"There was a problem when signing up yourself as the speaker. Please click "
								. anchor('signup4global/start', 'here')." to try again.";
								$this->load->view('account/result', $data);
						}
					}
					break;
				case "Unsign":
					if (teched_db_remove_speaker_assignments($event_argument, $speakerid))
					{
						if (!teched_db_remove_translator_assignments($event_argument, $speakerid))
						{
							$data['title']="Fail";
							$data['message'] =
								"There was a problem when cancelling yourself as the translator. Please click "
								. anchor('signup4global/start', 'here')." to try again.";
								$this->load->view('account/result', $data);
						}

						$this->display_session_list($event_target, $event_argument, $speakerid);
					} else {
						$data['title']="Fail";
						$data['message'] =
							"There was a problem when cancelling yourself as the speaker. Please click "
							. anchor('signup4global/start', 'here')." to try again.";
							$this->load->view('account/result', $data);
					}
					break;
				case "Translation":
					$this->display_session_translation($event_target, $event_argument, $speakerid);
					break;
				case "List":
				default:
					$this->display_session_list($event_target, $event_argument, $speakerid);
					break;
			}
		}
		else {
			redirect('account/login');
		}
	}

	private function display_session_detail($event_target, $event_argument, $speakerid,  $language, $translator) {
		$data['activemenu']="Sign_Up_for_Global_Sessions";
		$data['activesubmenu']="Detail";
		$data['formaction'] = "../signup4global/start.html";
		$data['sessions'] = teched_db_get_session_detail($event_argument);
		$data['speakers'] = teched_db_get_speaker_assignments($event_argument);
		$data['translators'] = teched_db_get_translator_assignments($event_argument);

		$data['myspeakerassignment'] = teched_db_get_my_speaker_assignment($event_argument, $speakerid);
		if ($data['myspeakerassignment']==NULL)
		{
			$data['isSpeaker'] = FALSE;
			$data['language'] = $language;
			$data['translator'] = $translator;
		}
		else
		{
			$data['isSpeaker'] = TRUE;
			$data['language'] = $data['myspeakerassignment'][0]['language'];
		}

		$data['mytranslatorassignment'] = teched_db_get_my_translator_assignment($event_argument, $speakerid);
		if ($data['mytranslatorassignment']==NULL)
		{
			$data['isTranslator'] = FALSE;
		}
		else
		{
			$data['isTranslator'] = TRUE;
		}
		
		$this->load->view('main', $data);
	}
	
	private function display_session_list($event_target, $event_argument, $speakerid) {
		if ($event_target=="List") {
			$data['showchinaapproved'] = $this->input->post('showchinaapproved');
		} else {
			// defaut only list approved sessions
			$data['showchinaapproved'] = FALSE;
		}

		if ($data['showchinaapproved']) {
			$whereclause = "where s.China <> ''";
		} else {
			$whereclause = "";
		}

		$data['activemenu']="Sign_Up_for_Global_Sessions";
		$data['activesubmenu']="List";
		$data['formaction'] = "../signup4global/start.html";
		$data['sessions'] = teched_db_get_session_list($whereclause);
		$data['mysessions'] = teched_db_get_my_session_list_as_speaker("where sas.speakerid=".$speakerid." ");
		$this->load->view('main', $data);
	}

	private function display_session_translation($event_target, $event_argument, $speakerid) {
		$this->form_validation->
		set_rules('title_cn', '中文标题',
			'xss_clean|required|max_length[50]');

		$this->form_validation->
		set_rules('abstract_cn', '中文摘要',
			'xss_clean|required|max_length[200]');

		$this->form_validation->
		set_rules('prerequisites_cn', '中文先决条件',
			'xss_clean|required|max_length[100]');

		$data['activemenu']="Sign_Up_for_Global_Sessions";
		$data['activesubmenu']="Translation";
		$data['formaction'] = "../signup4global/start.html";
		$data['sessions'] = teched_db_get_session_translation($event_argument);

		$data['sid'] = $event_argument;
		$data['speakerid'] = $speakerid;
		$data['title_cn'] = $this->input->post('title_cn');
		$data['abstract_cn'] = str_replace("\n\n", "\n", $this->input->post('abstract_cn'));
		$data['prerequisites_cn'] = str_replace("\n\n", "\n", $this->input->post('prerequisites_cn'));

		//Force "prerequisites_cn" empty if "prerequisites" is empty, avoid textarea whitespace
		if ($data['sessions'][0]['Prerequisites'] == "") $data['prerequisites_cn'] = "";

		if ($data['title_cn']!="") $data['sessions'][0]['Title_cn'] = $data['title_cn'];
		if ($data['abstract_cn']!="") $data['sessions'][0]['Abstract_cn'] = $data['abstract_cn'];
		if ($data['prerequisites_cn']!="") $data['sessions'][0]['Prerequisites_cn'] = $data['prerequisites_cn'];

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('main', $data);
		}
		else
		{
			if (teched_db_update_session_translation($data))
			{
				$data['title']="Success";
				$data['message'] =
					"Thank you! Your translation has been updated. Please click "
					. anchor('signup4global/start', 'here')." to sign up for other sessions.";
					$this->load->view('account/result', $data);
			} else {
				$data['title']="Fail";
				$data['message'] =
					"There was a problem when updating the translation. Please click "
					. anchor('signup4global/start', 'here')." to go back.";
					$this->load->view('account/result', $data);
			}
		}
	}
}