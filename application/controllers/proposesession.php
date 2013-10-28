<?php
class ProposeSession extends CI_Controller
{
	function ProposeSession() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('url', 'form', 'date', 'teched_db'));
		$this->load->model('account_model');
	}

	function start() {
		if($this->account_model->logged_in()) {
			$event_target = $this->input->post('__EVENTTARGET');
			$event_argument = $this->input->post('__EVENTARGUMENT');

			switch ($event_target) {
				case "Add":
					$mysession['SID'] = '';
					$mysession['Title'] = '';
					$mysession['Abstract'] = '';
					$mysession['Prerequisites'] = '';
					$mysession['SessionTypeID'] = '';
					$mysession['SessionLevelID'] = '';
					$mysession['SubTrackID'] = '';
					$mysession['TrackID'] = '';
					$mysession['TrackName'] = '';
					$mysession['ReleaseTimeframeID'] ='';
					$mysession['JobFunctionIDs'] = array();
					$mysession['RelatedProductIDs'] = array();
					$mysession['KeywordIDs'] = array();
					$mysession['Title_cn'] = '';
					$mysession['Abstract_cn'] = '';
					$mysession['Prerequisites_cn'] = '';

					$this->display_session_detail($mysession);
					break;
				case "Update":

					$result = run_tech_db_sql("SELECT * FROM g_sessions WHERE SID = ".$event_argument);

					if (count($result)>0) {
						$mysession['SID'] = $result[0]['SID'];
						$mysession['Title'] = $result[0]['EditedTitle'];
						$mysession['Abstract'] = $result[0]['EditedAbstract'];
						$mysession['Prerequisites'] = $result[0]['EditedPrerequisites'];
						$mysession['SessionTypeID'] = $result[0]['SessionTypeID'];
						$mysession['SessionLevelID'] = $result[0]['SessionLevelID'];
						$mysession['SubTrackID'] = $result[0]['SubTrackID'];
						$mysession['TrackID'] = $result[0]['TrackID'];
						$mysession['ReleaseTimeframeID'] =$result[0]['ReleaseTimeframeID'];

						$result = run_tech_db_sql("SELECT trackname FROM m_track WHERE trackid = ".$mysession['TrackID']);
						if (count($result)>0) {
							$mysession['TrackName'] = $result[0]['trackname'];
						} else {

							$mysession['TrackName'] = '';
						}

						$result = run_tech_db_sql("SELECT jobfunctionid FROM g_jobfunctions WHERE SID = ".$event_argument);
						if (count($result)>0) {
							$mysession['JobFunctionIDs'] = array(count($result));
							$i = 0;
							foreach ($result as $item) {
								$mysession['JobFunctionIDs'][$i] = $item['jobfunctionid'];
								$i++;
							}
						} else {
							$mysession['JobFunctionIDs'] = array(0);
						}

						$result = run_tech_db_sql("SELECT relatedproductid FROM g_relatedproducts WHERE SID = ".$event_argument);
						if (count($result)>0) {
							$mysession['RelatedProductIDs'] = array(count($result));
							$i = 0;
							foreach ($result as $item) {
								$mysession['RelatedProductIDs'][$i] = $item['relatedproductid'];
								$i++;
							}
						} else {
							$mysession['RelatedProductIDs'] = array(0);
						}

						$result = run_tech_db_sql("SELECT keywordid FROM g_keywords WHERE SID = ".$event_argument);
						if (count($result)>0) {
							$mysession['KeywordIDs'] = array(count($result));
							$i = 0;
							foreach ($result as $item) {
								$mysession['KeywordIDs'][$i] = $item['keywordid'];
								$i++;
							}
						} else {
							$mysession['KeywordIDs'] = array(0);
						}

						$result = run_tech_db_sql("SELECT * FROM g_sessions_cn WHERE SID = ".$event_argument);
						if (count($result)>0) {
							$mysession['Title_cn'] = $result[0]['EditedTitle_cn'];
							$mysession['Abstract_cn'] = $result[0]['EditedAbstract_cn'];
							$mysession['Prerequisites_cn'] = $result[0]['EditedPrerequisites_cn'];
						} else {
							$mysession['Title_cn'] = '';
							$mysession['Abstract_cn'] = '';
							$mysession['Prerequisites_cn'] = '';
						}


					}

					$this->display_session_detail($mysession);
					break;
				case "Save":
					$this->update_session_detail($event_target, $event_argument);
					break;
				case "List":
				default:
					$this->display_session_list($event_target, $event_argument);
					break;
			}
		}
		else {
			redirect('account/login');
		}
	}

	private function display_session_list($event_target, $event_argument) {
		if ($event_target=="List") {
			$data['showchinaapproved'] = $this->input->post('showchinaapproved');
		} else {
			// defaut list all sessions
			$data['showchinaapproved'] = FALSE;
		}

		$speakeremail = $this->account_model->get_email();

		if ($data['showchinaapproved']) {
			$whereclause = "where s.China <> '' and s.SessionOwnerEmail = '".$speakeremail."'";
		} else {
			$whereclause = "where s.SessionOwnerEmail = '".$speakeremail."'";
		}

		$data['activemenu']="Propose_Local_Sessions";
		$data['activesubmenu']="List";
		$data['formaction'] = "../proposesession/start.html";
		$data['sessions'] = teched_db_get_session_list($whereclause);
		$this->load->view('main', $data);
	}

	private function display_session_detail($mysession) {
		$data['mysession'] = $mysession;

		// prepare master data
		$data['jobfunction'] = $this->get_jobfunction();
		$data['keyword'] = $this->get_keyword();
		$data['relatedproduct'] = $this->get_relatedproduct();
		$data['releasetime'] = $this->get_releasetime();
		$data['sessionlevel'] = $this->get_sessionlevel();
		$data['sessiontype'] = $this->get_sessiontype();
		foreach ($this->get_track() as $item):
		$data['track'][$item['trackid']] =$item['trackname'];
		endforeach;
		$data['subtrack'] = $this->get_subtrack();

		$data['activemenu']="Propose_Local_Sessions";
		$data['activesubmenu']="Detail";
		$data['formaction'] = "../proposesession/start.html";
		$this->load->view('main', $data);
	}

	private function update_session_detail($event_target, $event_argument) {

		$this->form_validation->
		set_rules('Title', 'Title',
			'xss_clean|required|max_length[75]');
		$this->form_validation->
		set_rules('Abstract', 'Abstract',
			'xss_clean|required|max_length[500]');
		$this->form_validation->
		set_rules('Prerequisites', 'Prerequisites',
			'xss_clean|max_length[200]');
		$this->form_validation->
		set_rules('SessionTypeID', 'Session Type',
			'xss_clean|required|callback_ensure_ID_selected');
		$this->form_validation->
		set_rules('SessionLevelID', 'Session Level',
			'xss_clean|required|callback_ensure_ID_selected');
		$this->form_validation->
		set_rules('SubTrackID', 'Sub-track',
			'xss_clean|required|callback_ensure_ID_selected');
		$this->form_validation->
		set_rules('ReleaseTimeframeID', 'Release Time',
			'xss_clean|required|callback_ensure_ID_selected');
		$this->form_validation->
		set_rules('JobFunctionIDs', 'Job Functions',
			'xss_clean|required');
		$this->form_validation->
		set_rules('RelatedProductIDs', 'Related Products',
			'xss_clean|required|callback_no_more_than_four');
		$this->form_validation->
		set_rules('KeywordIDs', 'Keywords',
			'xss_clean|required|callback_no_more_than_six');
		$this->form_validation->
		set_rules('Title_cn', '课程标题',
			'xss_clean|max_length[50]');
		$this->form_validation->
		set_rules('Abstract_cn', '课程摘要',
			'xss_clean|max_length[200]');
		$this->form_validation->
		set_rules('Prerequisites_cn', '中文先决条件',
			'xss_clean|max_length[100]');

		$mysession['SID'] = $this->input->post('SID');
		$mysession['Title'] = $this->input->post('Title');
		$mysession['Abstract'] = str_replace("\n\n", "\n", $this->input->post('Abstract'));
		$mysession['Prerequisites'] = str_replace("\n\n", "\n", $this->input->post('Prerequisites'));
		$mysession['SessionTypeID'] = $this->input->post('SessionTypeID');
		$mysession['SessionLevelID'] = $this->input->post('SessionLevelID');
		$mysession['SubTrackID'] = $this->input->post('SubTrackID');
		$mysession['TrackID'] = $this->input->post('TrackID');
		$mysession['TrackName'] = $this->input->post('TrackName');
		$mysession['ReleaseTimeframeID'] = $this->input->post('ReleaseTimeframeID');
		$mysession['JobFunctionIDs'] = $this->input->post('JobFunctionIDs');
		$mysession['RelatedProductIDs'] = $this->input->post('RelatedProductIDs');
		$mysession['KeywordIDs'] = $this->input->post('KeywordIDs');
		$mysession['Title_cn'] = $this->input->post('Title_cn');
		$mysession['Abstract_cn'] = str_replace("\n\n", "\n", $this->input->post('Abstract_cn'));
		$mysession['Prerequisites_cn'] = str_replace("\n\n", "\n", $this->input->post('Prerequisites_cn'));

		$mysession['SessionOwnerId'] = $this->account_model->get_speakerid();
		$mysession['SessionOwner'] = $this->account_model->get_fullname();
		$mysession['SessionOwnerEmail'] = $this->account_model->get_email();

		if($this->form_validation->run() == FALSE) {
			$this->display_session_detail($mysession);
		}
		else {
			if(teched_db_save_session($mysession) === TRUE) {
				$data['title']="Success";
				$data['message'] =
					"The session has now been saved! You can get back "
					. anchor('proposesession/start', 'here') . ".";
					$this->load->view('account/result', $data);
			}
			else {
				$data['title']="Fail";
				$data['message'] =
					"There was a problem when saving the session! You can get back "
					. anchor('proposesession/start', 'here')." to try again.";
					$this->load->view('account/result', $data);
			}
		}
	}

	function ensure_ID_selected($str) {
		if ($str == "0") {
			$this->form_validation->
			set_message('ensure_ID_selected',
				'Please select %s.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	function no_more_than_four($str_array) {
		if (count($str_array)>4) {
			$this->form_validation->
			set_message('no_more_than_four',
				'Please select max 4 %s.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	function no_more_than_six($str_array) {
		if (count($str_array)>6) {
			$this->form_validation->
			set_message('no_more_than_six',
				'Please select max 6 %s.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	function get_jobfunction() {
		return $this->get_list('m_jobfunction');
	}

	function get_keyword() {
		return $this->get_list('m_keyword');
	}

	function get_relatedproduct() {
		return $this->get_list('m_relatedproduct');
	}

	function get_releasetime() {
		return $this->get_list('m_releasetime');
	}

	function get_sessionlevel() {
		return $this->get_list('m_sessionlevel');
	}

	function get_sessiontype() {
		return $this->get_list('m_sessiontype');
	}

	function get_track() {
		return $this->get_list('m_track');
	}

	function get_subtrack() {
		return $this->get_list('m_subtrack');
	}

	function get_list($table) {
		$query = $this->db->get($table);

		return $query->result_array();
	}
}