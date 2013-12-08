<?php
class Admin extends CI_Controller
{
	function Admin() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'date', 'teched_db'));
		$this->load->model('account_model');
	}

	function approve_session() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Administrator')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$event_argument2 = $this->input->post('__EVENTARGUMENT2');
			
			$SID = (int)$event_argument;
			$status = $event_target;
			$newSessionId = $event_argument2;
				
			switch ($event_target) {
				case "Unknown":
					$status = '';
				case "Selected":
				case "Approved":
					if(teched_db_update_session_status($SID, $status)) {
						$this->output->set_output($event_target);
					} else {
						$this->output->set_output("ERROR");
					}
					break;
				case "Update_Session_ID":
					if(teched_db_update_session_Id($SID, $newSessionId)) {
						$this->output->set_output($newSessionId);
					} else {
						$this->output->set_output("ERROR");
					}
					break;
				default:
					$data['activemenu']="Admin_Approve_Session";
					$data['activesubmenu']="Approve_Session";
					$data['formaction'] = "../admin/approve_session.html";
					$data['sessions'] = teched_db_get_session_list('');
					$this->load->view('main', $data);
					break;
			}
				
		}
		else {
			redirect('account/login');
		}
	}
	
	function assign_speaker() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Administrator')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$event_argument2 = $this->input->post('__EVENTARGUMENT2');
			$defaultview = TRUE;

			$data['SelectedSID'] = (int)$event_argument;
			
			switch ($event_target) {
				case "Assign":
					$this->form_validation->
					set_rules('speakerid', 'Speaker',
						'is_natural_no_zero|xss_clean|required');
					
					$this->form_validation->
					set_rules('language', 'Language',
						'xss_clean|required');

					$speakerid = $this->input->post('speakerid');;
					$language = $this->input->post('language');

					$data['speakers'] = teched_db_get_all_speakers();
					$data['speakerid'] = (int)$speakerid;
					$data['language'] = (int)$language;
					
					if($this->form_validation->run() == TRUE)
					{
						if ( teched_db_add_speaker_assignments($event_argument, $speakerid, $language))
						{
							$data['title']="Success";
							$data['message'] =
								"Thank you! The speaker list has been updated. Please click "
								. anchor('admin/assign_speaker', 'here')." to got back.";
								$this->load->view('account/result', $data);
						} else {
							$data['title']="Fail";
							$data['message'] =
								"There was a problem when updating the speaker list. Please click "
								. anchor('admin/assign_speaker', 'here')." to got back.";
								$this->load->view('account/result', $data);
						}
		
						$defaultview = FALSE;
					}
					
					break;
				case "Remove":
					if ( teched_db_remove_speaker_assignments($event_argument, $event_argument2))
					{
						$data['title']="Success";
						$data['message'] =
							"Thank you! The speaker list has been updated. Please click "
							. anchor('admin/assign_speaker', 'here')." to got back.";
							$this->load->view('account/result', $data);
					} else {
						$data['title']="Fail";
						$data['message'] =
							"There was a problem when updating the speaker list. Please click "
							. anchor('admin/assign_speaker', 'here')." to got back.";
							$this->load->view('account/result', $data);
					}
					
					$defaultview = FALSE;
					break;
				case "Cancel":
					$data['SelectedSID'] = 0;
					break;
				case "Edit":
					$data['speakers'] = teched_db_get_all_speakers();
					$data['speakerid'] = 0;
					$data['language'] = 0;
					$data['translator'] = 0;
					break;
			}
			
			if ($defaultview) {
				$data['activemenu']="Admin_Assign_Speaker";
				$data['activesubmenu']="Assign_Speaker";
				$data['formaction'] = "../admin/assign_speaker.html";
				$data['sessions'] = $this->prepare_speaker_assignment_list(teched_db_get_all_speaker_assignments());
				$this->load->view('main', $data);
			}
		}
		else {
			redirect('account/login');
		}
	}
	
	function update_speaker_status() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Administrator')) {
			$event_target = $this->input->get('__EVENTTARGET');
			$event_argument = $this->input->get('__EVENTARGUMENT');
			$event_argument2 = $this->input->get('__EVENTARGUMENT2');
			
			$SID = (int)$event_argument;
			$speakerid = (int)$event_argument2;
			$status = 0;
			
			switch ($event_target) {
				case "Approved":
					$status = 1;
					break;
				case "Rejected":
					$status = 2;
					break;
			}
			
			if(teched_db_update_speaker_assignment_status($SID, $speakerid, $status)) {
				$this->output->set_output($event_target);
			} else {
				$this->output->set_output("ERROR");
			}
			
		}
		else {
			redirect('account/login');
		}
	}
	
	private function prepare_speaker_assignment_list($raw) {
		$result = array();

		if (count($raw) > 0) {
			
			reset($raw);
			$item = current($raw);
			$point = 0;
			$point2 = 0;
			
			$cur_session_id = $item['SessionID'];
			$tmp= array($point=>array('SID'=>$item['SID'],
						'SessionID'=>$item['SessionID'],
						'Title'=>$item['Title'],
						'Type'=>$item['Type'],
						'Level'=>$item['Level'],
						'RowCount'=>1,
						'Speakers'=>array($point2=>array("speakerid"=>$item['speakerid'],
									"FirstName"=> $item['FirstName'],
									"LastName"=> $item['LastName'],
									"email"=> $item['email'],
									"Language"=> $item['Language'],
									"Status"=> $item['Status']))));
						
			while (($item = next($raw)) != FALSE) {
				if ($cur_session_id <> $item['SessionID']){
					$tmp[$point]['RowCount'] = count($tmp[$point]['Speakers']);
					$result = $result + $tmp;
					$point = $point + 1;
					$point2 = 0;
					
					$cur_session_id = $item['SessionID'];
					$tmp= array($point=>array('SID'=>$item['SID'],
								'SessionID'=>$item['SessionID'],
								'Title'=>$item['Title'],
								'Type'=>$item['Type'],
								'Level'=>$item['Level'],
								'RowCount'=>1,
								'Speakers'=>array(array("speakerid"=>$item['speakerid'],
											"FirstName"=> $item['FirstName'],
											"LastName"=> $item['LastName'],
											"email"=> $item['email'],
											"Language"=> $item['Language'],
											"Status"=> $item['Status']))));
					
				} else {
					$point2 = $point2 + 1;
					$tmp[$point]['Speakers'] = $tmp[$point]['Speakers'] + array($point2=>array("speakerid"=>$item['speakerid'],
											"FirstName"=> $item['FirstName'],
											"LastName"=> $item['LastName'],
											"email"=> $item['email'],
											"Language"=> $item['Language'],
											"Status"=> $item['Status']));
				}
			}
			
			$tmp[$point]['RowCount'] = count($tmp[$point]['Speakers']);
			$result = $result + $tmp;
			
		}
		
		return $result;
	} 


	function assign_translator() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Administrator')) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');
			$event_argument2 = $this->input->post('__EVENTARGUMENT2');
			$defaultview = TRUE;

			$data['SelectedSID'] = (int)$event_argument;
			
			switch ($event_target) {
				case "Assign":
					$this->form_validation->
					set_rules('speakerid', 'Translator',
						'is_natural_no_zero|xss_clean|required');
					
					$speakerid = $this->input->post('speakerid');;

					$data['speakers'] = teched_db_get_all_speakers();
					$data['translatorid'] = (int)$speakerid;
					
					if($this->form_validation->run() == TRUE)
					{
						if ( teched_db_add_translator_assignments($event_argument, $speakerid))
						{
							$data['title']="Success";
							$data['message'] =
								"Thank you! The translator list has been updated. Please click "
								. anchor('admin/assign_translator', 'here')." to got back.";
								$this->load->view('account/result', $data);
						} else {
							$data['title']="Fail";
							$data['message'] =
								"There was a problem when updating the translator list. Please click "
								. anchor('admin/assign_translator', 'here')." to got back.";
								$this->load->view('account/result', $data);
						}
		
						$defaultview = FALSE;
					}
					
					break;
				case "Remove":
					if ( teched_db_remove_translator_assignments($event_argument, $event_argument2))
					{
						$data['title']="Success";
						$data['message'] =
							"Thank you! The translator list has been updated. Please click "
							. anchor('admin/assign_translator', 'here')." to got back.";
							$this->load->view('account/result', $data);
					} else {
						$data['title']="Fail";
						$data['message'] =
							"There was a problem when updating the translator list. Please click "
							. anchor('admin/assign_translator', 'here')." to got back.";
							$this->load->view('account/result', $data);
					}
					
					$defaultview = FALSE;
					break;
				case "Cancel":
					$data['SelectedSID'] = 0;
					break;
				case "Edit":
					$data['speakers'] = teched_db_get_all_speakers();
					$data['translatorid'] = 0;					
					break;
			}
			
			if ($defaultview) {
				$data['activemenu']="Admin_Assign_Translator";
				$data['activesubmenu']="Assign_Translator";
				$data['formaction'] = "../admin/assign_translator.html";
				$data['sessions'] = $this->prepare_translator_assignment_list(teched_db_get_all_translator_assignments());
				$this->load->view('main', $data);
			}
		}
		else {
			redirect('account/login');
		}
	}
	
	function update_translator_status() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Administrator')) {
			$event_target = $this->input->get('__EVENTTARGET');
			$event_argument = $this->input->get('__EVENTARGUMENT');
			$event_argument2 = $this->input->get('__EVENTARGUMENT2');
			
			$SID = (int)$event_argument;
			$speakerid = (int)$event_argument2;
			$status = 0;
			
			switch ($event_target) {
				case "Approved":
					$status = 1;
					break;
				case "Rejected":
					$status = 2;
					break;
			}
			
			if(teched_db_update_translator_assignment_status($SID, $speakerid, $status)) {
				$this->output->set_output($event_target);
			} else {
				$this->output->set_output("ERROR");
			}
			
		}
		else {
			redirect('account/login');
		}
	}
	
	private function prepare_translator_assignment_list($raw) {
		$result = array();

		if (count($raw) > 0) {
			
			reset($raw);
			$item = current($raw);
			$point = 0;
			$point2 = 0;
			
			$cur_session_id = $item['SessionID'];
			$tmp= array($point=>array('SID'=>$item['SID'],
						'SessionID'=>$item['SessionID'],
						'Title'=>$item['Title'],
						'Type'=>$item['Type'],
						'Level'=>$item['Level'],
						'RowCount'=>1,
						'Translators'=>array($point2=>array("speakerid"=>$item['speakerid'],
									"FirstName"=> $item['FirstName'],
									"LastName"=> $item['LastName'],
									"email"=> $item['email'],
									"Status"=> $item['Status']))));
						
			while (($item = next($raw)) != FALSE) {
				if ($cur_session_id <> $item['SessionID']){
					$tmp[$point]['RowCount'] = count($tmp[$point]['Translators']);
					$result = $result + $tmp;
					$point = $point + 1;
					$point2 = 0;
					
					$cur_session_id = $item['SessionID'];
					$tmp= array($point=>array('SID'=>$item['SID'],
								'SessionID'=>$item['SessionID'],
								'Title'=>$item['Title'],
								'Type'=>$item['Type'],
								'Level'=>$item['Level'],
								'RowCount'=>1,
								'Translators'=>array(array("speakerid"=>$item['speakerid'],
											"FirstName"=> $item['FirstName'],
											"LastName"=> $item['LastName'],
											"email"=> $item['email'],
											"Status"=> $item['Status']))));
					
				} else {
					$point2 = $point2 + 1;
					$tmp[$point]['Translators'] = $tmp[$point]['Translators'] + array($point2=>array("speakerid"=>$item['speakerid'],
											"FirstName"=> $item['FirstName'],
											"LastName"=> $item['LastName'],
											"email"=> $item['email'],
											"Status"=> $item['Status']));
				}
			}
			
			$tmp[$point]['RowCount'] = count($tmp[$point]['Translators']);
			$result = $result + $tmp;
			
		}
		
		return $result;
	} 
}