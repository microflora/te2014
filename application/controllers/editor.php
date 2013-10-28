<?php
class Editor extends CI_Controller
{
	function Editor() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'date', 'file', 'teched_db'));
		$this->load->model('account_model');
	}

	function edit_translation() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Editor')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$speakerid = $this->account_model->get_speakerid();
			$defaultview = TRUE;
				
			$data['SelectedSID'] = (int)$event_argument;
				
			switch ($event_target) {
				case "Save":
					$this->form_validation->
					set_rules('title_cn', '中文标题',
						'xss_clean|required|max_length[150]');
						
					$this->form_validation->
					set_rules('abstract_cn', '中文摘要',
						'xss_clean|required|max_length[2000]');
						
					$this->form_validation->
					set_rules('prerequisites_cn', '中文先决条件',
						'xss_clean|max_length[2000]');
									
					$data['sid'] = $event_argument;
					$data['speakerid'] = $speakerid;
					//remove any newline in title
					$data['title_cn'] = str_replace("\r", "", str_replace("\n", "", $this->input->post('title_cn')));
					//remove additional newline
					$data['abstract_cn'] = str_replace("\n\n", "\n", $this->input->post('abstract_cn'));
					$data['prerequisites_cn'] = str_replace("\n\n", "\n", $this->input->post('prerequisites_cn'));
						
					if($this->form_validation->run() == TRUE)
					{
						if (teched_db_update_session_translation($data))
						{
							$data['title']="Success";
							$data['message'] =
								"Thank you! The translation has been updated. Please click "
								. anchor('editor/edit_translation', 'here')." to got back to the list.";
								$this->load->view('account/result', $data);
						} else {
							$data['title']="Fail";
							$data['message'] =
								"There was a problem when updating the translation. Please click "
								. anchor('editor/edit_translation', 'here')." to got back to the list.";
								$this->load->view('account/result', $data);
						}

						$defaultview = FALSE;
					} else {
						$defaultview = TRUE;
					}

					break;
				case "Cancel":
					$data['SelectedSID'] = 0;
					break;
				case "Edit":
					break;
			}
							
			if ($defaultview) {
				$data['activemenu']="Editor_Edit_Translation";
				$data['activesubmenu']="Edit_Translation";
				$data['formaction'] = "../editor/edit_translation.html";
				$data['sessions'] = teched_db_get_all_session_translation();
				$this->load->view('main', $data);
			}
				
		}
		else {
			redirect('account/login');
		}
	}

	function edit_speaker() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Editor')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');

			$speakerid = (int)$event_argument;
			$defaultview = TRUE;
			
			switch ($event_target) {
				case "Edit":
					$data['speakerid'] = $speakerid;
					$data['speaker'] = $this->account_model->get_account_info_by_id($speakerid);
					$data['countries'] = get_teched_db_countries();
					$data['organizations'] = get_teched_db_organizations();
					$data['shirts'] = get_teched_db_shirts();
					$data['activemenu']="Editor_Edit_Speaker";
					$data['activesubmenu']="Edit_Speaker_Edit";
					$data['formaction'] = "../editor/edit_speaker.html";
					$this->load->view('main', $data);
					
					$defaultview = FALSE;
					break;
				case "Save":
					$this->speaker_update($speakerid);
					$defaultview = FALSE;
					break;
				case "Cancel":
					$data['SelectedSID'] = 0;
					break;
			}
				
			if ($defaultview) {
				$data['activemenu']="Editor_Edit_Speaker";
				$data['activesubmenu']="Edit_Speaker";
				$data['formaction'] = "../editor/edit_speaker.html";
				$data['speakers'] = teched_db_get_all_approved_speakers();
				$this->load->view('main', $data);
			}
				
		}
		else {
			redirect('account/login');
		}
	}
	
	private function speaker_update($speakerid) {
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
			
			$data['speakerid'] = $speakerid;
			$data['speaker'] = $speaker;			
			$data['countries'] = get_teched_db_countries();
			$data['organizations'] = get_teched_db_organizations();
			$data['shirts'] = get_teched_db_shirts();
			
			$data['activemenu']="Editor_Edit_Speaker";
			$data['activesubmenu']="Edit_Speaker_Edit";
			$data['formaction'] = "../editor/edit_speaker.html";
			$this->load->view('main', $data);
		}
		else {
			if($this->account_model->update_by_id($speakerid, $speaker) === TRUE) {
				$data['title']="Success";
				$data['message'] =
					"The profile has now been updated! You can get back "
					. anchor('editor/edit_speaker', 'here') . ".";
					$this->load->view('account/result', $data);
			}
			else {
				$data['title']="Fail";
				$data['message'] =
					"There was a problem when updating your profile! You can get back "
					. anchor('editor/edit_speaker', 'here')." to try again.";
				$this->load->view('account/result', $data);
			}
		}
	}
	
	function generate_html() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Editor')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$defaultview = TRUE;

			switch ($event_target) {
				case "Generate":
					if ($this->generate_html_all())
					{
						$data['title']="Success";
						$data['message'] =
							"Thank you! The generation has successfully completed. Please click "
							. anchor('editor/generate_html', 'here')." to got back.";
							$this->load->view('account/result', $data);
					} else {
						$data['title']="Fail";
						$data['message'] =
							"There was a problem when generating the html. Please click "
							. anchor('editor/generate_html', 'here')." to got back .";
							$this->load->view('account/result', $data);
					}

					$defaultview = FALSE;
					break;
			}
				
			if ($defaultview) {
				$data['activemenu']="Editor_Generate_Html";
				$data['activesubmenu']="Generate_Html";
				$data['formaction'] = "../editor/generate_html.html";
				$this->load->view('main', $data);
			}
		}
		else {
			redirect('account/login');
		}
	}

	private function generate_html_all() {
		if (!$this->generate_html_viewall()) {
			return FALSE;
		}

		if (!$this->generate_html_sessions()) {
			return FALSE;
		}

		if (!$this->generate_html_tracks()) {
			return FALSE;
		}
		
		if (!$this->generate_html_speakers()) {
			return FALSE;
		}
		
		if (!$this->generate_html_all_speakers()) {
			return FALSE;
		}
		
		if (!$this->generate_html_schedulings()) {
			return FALSE;
		}
		
		if (!$this->generate_html_vr_sessions()) {
			return FALSE;
		}

		if (!$this->generate_html_each_vr_session()) {
			return FALSE;
		}
		
		return TRUE;
	}

	private function generate_html_viewall() {

		$data['sessions'] = teched_db_generate_viewall();

		$this->load->view('htmltemplate/en/viewall', $data);

		$string = $this->output->get_output();
		write_file('html/en/viewall.asp', $string);

		//Clear the output
		$this->output->set_output('');

		$this->load->view('htmltemplate/cn/viewall', $data);

		$string = $this->output->get_output();
		write_file('html/cn/viewall.asp', $string);

		//Clear the output
		$this->output->set_output('');

		return TRUE;
	}

	private function generate_html_sessions() {

		$sessions = teched_db_generate_sessions();
		
		foreach ($sessions as $session):
		
			$data['item'] = $session;
			$data['keywords'] = teched_db_generate_keywords($session['SID']);
			$data['jobfunctions'] = teched_db_generate_jobfunctions($session['SID']);
			$data['relatedproducts'] = teched_db_generate_relatedproducts($session['SID']);
			$data['speakers'] = teched_db_generate_speakers("sas.speakerapproved = 1 and sas.SID = ".$session['SID']);
			$data['schedulings'] = teched_db_generate_schedulings($session['SID']);
						
			$this->load->view('htmltemplate/en/session', $data);
	
			$string = $this->output->get_output();
			write_file('html/en/'.$session['SessionID'].'.asp', $string);
	
			//Clear the output
			$this->output->set_output('');
	
			$this->load->view('htmltemplate/cn/session', $data);
	
			$string = $this->output->get_output();
			write_file('html/cn/'.$session['SessionID'].'.asp', $string);
				
			//Clear the output
			$this->output->set_output('');

		endforeach;

		return TRUE;
	}

	private function generate_html_tracks() {

		$data['tracks'] = teched_db_generate_tracks();
		$data['sessions'] = teched_db_generate_tracks_sessions();

		$this->load->view('htmltemplate/en/tracks', $data);

		$string = $this->output->get_output();
		write_file('html/en/tracks.asp', $string);

		//Clear the output
		$this->output->set_output('');

		$this->load->view('htmltemplate/cn/tracks', $data);

		$string = $this->output->get_output();
		write_file('html/cn/tracks.asp', $string);

		//Clear the output
		$this->output->set_output('');

		return TRUE;
	}

	private function generate_html_speakers() {

		$data['speakers'] = teched_db_generate_speakers();

		$this->load->view('htmltemplate/en/speakers', $data);

		$string = $this->output->get_output();
		write_file('html/en/speakers.asp', $string);

		//Clear the output
		$this->output->set_output('');

		$this->load->view('htmltemplate/cn/speakers', $data);

		$string = $this->output->get_output();
		write_file('html/cn/speakers.asp', $string);

		//Clear the output
		$this->output->set_output('');

		return TRUE;
	}

	private function generate_html_all_speakers() {

		$speakers = teched_db_generate_speakers();
		
		foreach ($speakers as $speaker):
		
			$data['item'] = $speaker;
			$data['sessions'] = teched_db_generate_speaker_sessions($speaker['SpeakerID']);
			
			$this->load->view('htmltemplate/en/speaker', $data);
	
			$string = $this->output->get_output();
			write_file('html/en/speaker'.$speaker['SpeakerID'].'.asp', $string);
	
			//Clear the output
			$this->output->set_output('');
	
			$this->load->view('htmltemplate/cn/speaker', $data);
	
			$string = $this->output->get_output();
			write_file('html/cn/speaker'.$speaker['SpeakerID'].'.asp', $string);
				
			//Clear the output
			$this->output->set_output('');

		endforeach;

		return TRUE;
	}
	
	private function generate_html_schedulings() {

		$data['schedulings'] = teched_db_generate_all_schedulings();

		$this->load->view('htmltemplate/en/schedulings', $data);

		$string = $this->output->get_output();
		write_file('html/en/schedulings.asp', $string);

		//Clear the output
		$this->output->set_output('');

		$this->load->view('htmltemplate/cn/schedulings', $data);

		$string = $this->output->get_output();
		write_file('html/cn/schedulings.asp', $string);

		//Clear the output
		$this->output->set_output('');

		return TRUE;
	}

	private function generate_html_vr_sessions() {

		$data['vrschedulings'] = teched_db_generate_vr_sessions();

		$this->load->view('htmltemplate/en/vr_sessions', $data);

		$string = $this->output->get_output();
		write_file('html/en/vr_sessions.asp', $string);

		//Clear the output
		$this->output->set_output('');

		$this->load->view('htmltemplate/cn/vr_sessions', $data);

		$string = $this->output->get_output();
		write_file('html/cn/vr_sessions.asp', $string);

		//Clear the output
		$this->output->set_output('');

		return TRUE;
	}
	
	private function generate_html_each_vr_session() {

		$sessions = teched_db_generate_vr_sessions();
		
		foreach ($sessions as $session):
			
			if ($session['SID'] > 0) {
				$data['item'] = $session;
				$data['keywords'] = teched_db_generate_keywords($session['SID']);
				$data['jobfunctions'] = teched_db_generate_jobfunctions($session['SID']);
				$data['relatedproducts'] = teched_db_generate_relatedproducts($session['SID']);
				$data['speakers'] = teched_db_generate_speakers("sas.SID = ".$session['SID']);
							
				$this->load->view('htmltemplate/en/vr_session', $data);
		
				$string = $this->output->get_output();
				write_file('html/en/'.$session['SessionID'].'.asp', $string);
		
				//Clear the output
				$this->output->set_output('');
		
				$this->load->view('htmltemplate/cn/vr_session', $data);
		
				$string = $this->output->get_output();
				write_file('html/cn/'.$session['SessionID'].'.asp', $string);
					
				//Clear the output
				$this->output->set_output('');
			}

		endforeach;

		return TRUE;
	}
	
}