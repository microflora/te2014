<?php
class Report extends CI_Controller
{
	function Report() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url', 'form', 'date', 'download', 'teched_db', 'teched_report'));
		$this->load->model('account_model');
		$this->load->dbutil();
	}

	function index() {
		if($this->account_model->logged_in() && $this->account_model->is_role('Editor')) {
			$data['action'] = "all_report_list";
			$data['tablename'] = "all_report_list";
			$data['table'] = array(
			array("Report"=>anchor('report/session_translation_list', 'Translated Session List'),
								"Description"=>"List the English / Chinese title, abstract, and prerequisite of all session with translation available."),
			array("Report"=>anchor('report/local_content_list', 'Local Content Proposal List'),
								"Description"=>"List all local content proposal."),
			array("Report"=>anchor('report/approved_session_translation_list', 'Approved Session List with Translation'),
								"Description"=>"List the English / Chinese title, abstract, and prerequisite of all approved session with translation."),
			array("Report"=>anchor('report/speaker_applicant_session_list', 'Speaker Applicants for Each Session'),
								"Description"=>"List the speaker applicants for each session."),
			array("Report"=>anchor('report/approved_speaker_session_list', 'Approved Speaker for Each Session'),
								"Description"=>"List approved speaker against each approved session."),
			array("Report"=>anchor('report/speaker_applicant_bio_list', 'Speaker Appliant w/ bio and applied sessions'),
								"Description"=>"List speaker applicants with their bio and the sessions they applied."),
			array("Report"=>anchor('report/approved_speaker_bio_list', 'Approved Speaker w/ bio and assigned sessions'),
								"Description"=>"List approved speakers with their bio and the sessions assigned."),
			array("Report"=>anchor('report/translator_applicant_bio_list', 'Translator Appliant w/ bio and applied sessions'),
								"Description"=>"List translator applicants with their bio and the sessions they applied."),
			array("Report"=>anchor('report/approved_translator_bio_list', 'Approved translator w/ bio and assigned sessions'),
								"Description"=>"List approved translators with their bio and the sessions assigned."),
			array("Report"=>anchor('report/approved_speaker_logistics_info_list', 'Logistics information of for all approved speaker'),
								"Description"=>"Logistics information for all approved speakers."),
			array("Report"=>anchor('report/approved_scheduling_it_req_list', 'Scheduling and IT requirement for all approved sessions'),
								"Description"=>"Scheduling and IT requirement for all sessions."),
			array("Report"=>anchor('report/approved_scheduling_speaker_it_req_list', 'Scheduling, Speaker and IT requirement for all approved sessions'),
								"Description"=>"Scheduling, Speaker and IT requirement for all approved sessions."),
			array("Report"=>anchor('report/vr_session_list', 'All sessions in Value Realization Zone'),
								"Description"=>"All sessions in Value Realization Zone."),
			array("Report"=>anchor('report/vr_session_speaker_bio_list', ' Speaker w/ bio and assigned vr sessions'),
								"Description"=>"List  speakers with their bio and the vr sessions assigned."),
			);
			$this->load->view('report/tableview', $data);
		}
		else {
			redirect('account/login');
		}

	}

	function session_translation_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_session_translation_list($whereclause="");
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("session_translation.csv", $query);
				break;
			default:
				$data['action'] = "session_translation_list?action=csv";
				$data['tablename'] = "session_translation_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function local_content_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_local_content_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("local_content_list.csv", $query);
				break;
			default:
				$data['action'] = "local_content_list?action=csv";
				$data['tablename'] = "local_content_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function approved_session_translation_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_session_translation_list($whereclause="where s.China = 'Approved'");
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_session_translation.csv", $query);
				break;
			default:
				$data['action'] = "approved_session_translation_list?action=csv";
				$data['tablename'] = "approved_session_translation_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function speaker_applicant_session_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_speaker_applicant_session_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("speaker_applicant_session_list.csv", $query);
				break;
			default:
				$data['action'] = "speaker_applicant_session_list?action=csv";
				$data['tablename'] = "speaker_applicant_session_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function approved_speaker_session_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_speaker_session_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_speaker_session_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_speaker_session_list?action=csv";
				$data['tablename'] = "approved_speaker_session_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function speaker_applicant_bio_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_speaker_applicant_bio_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("speaker_applicant_bio_list.csv", $query);
				break;
			default:
				$data['action'] = "speaker_applicant_bio_list?action=csv";
				$data['tablename'] = "speaker_applicant_bio_list";
				$data['table'] = $this->prepare_speaker_bio_list($query ->result_array());
				$this->load->view('report/speakerview', $data);
				break;
		}
	}

	function approved_speaker_bio_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_speaker_bio_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_speaker_bio_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_speaker_bio_list?action=csv";
				$data['tablename'] = "approved_speaker_bio_list";
				$data['table'] = $this->prepare_speaker_bio_list($query ->result_array());
				$this->load->view('report/speakerview', $data);
				break;
		}
	}

	function translator_applicant_bio_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_translator_applicant_bio_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("translator_applicant_bio_list.csv", $query);
				break;
			default:
				$data['action'] = "translator_applicant_bio_list?action=csv";
				$data['tablename'] = "translator_applicant_bio_list";
				$data['table'] = $this->prepare_translator_bio_list($query ->result_array());
				$this->load->view('report/translatorview', $data);
				break;
		}
	}

	function approved_translator_bio_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_translator_bio_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_translator_bio_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_translator_bio_list?action=csv";
				$data['tablename'] = "approved_translator_bio_list";
				$data['table'] = $this->prepare_translator_bio_list($query ->result_array());
				$this->load->view('report/translatorview', $data);
				break;
		}
	}


	function approved_speaker_logistics_info_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_speaker_logistics_info_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_speaker_logistics_info_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_speaker_logistics_info_list?action=csv";
				$data['tablename'] = "approved_speaker_logistics_info_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function approved_scheduling_it_req_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_scheduling_it_req_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_scheduling_it_req_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_scheduling_it_req_list?action=csv";
				$data['tablename'] = "approved_scheduling_it_req_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}
	
	function approved_scheduling_speaker_it_req_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_approved_scheduling_speaker_it_req_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("approved_scheduling_speaker_it_req_list.csv", $query);
				break;
			default:
				$data['action'] = "approved_scheduling_speaker_it_req_list?action=csv";
				$data['tablename'] = "approved_scheduling_speaker_it_req_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function vr_session_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_vr_session_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("vr_session_list.csv", $query);
				break;
			default:
				$data['action'] = "vr_session_list?action=csv";
				$data['tablename'] = "vr_session_list";
				$data['table'] = $query ->result_array();
				$this->load->view('report/tableview', $data);
				break;
		}
	}

	function vr_session_speaker_bio_list() {
		$action = $this->input->get("action");
			
		$query = teched_report_vr_session_speaker_bio_list();
			
		switch ($action) {
			case "csv":
				$this->prepare_csv_download("vr_session_speaker_bio_list.csv", $query);
				break;
			default:
				$data['action'] = "vr_session_speaker_bio_list?action=csv";
				$data['tablename'] = "vr_session_speaker_bio_list";
				$data['table'] = $this->prepare_speaker_bio_list($query ->result_array());
				$this->load->view('report/speakerview', $data);
				break;
		}
	}
	
	private function prepare_csv_download($filename, $query) {
		force_download($filename, "\xEF\xBB\xBF".$this->dbutil->csv_from_result($query, ",","\r\n"));
	}

	private function prepare_speaker_bio_list($raw) {
		$result = array();

		if (count($raw) > 0) {

			reset($raw);
			$item = current($raw);
			$point = 0;
			$point2 = 0;

			$cur_speaker_id = $item['id'];
			$tmp= array($point=>array('id'=>$item['id'],
						'LastName'=>$item['LastName'],
						'FirstName'=>$item['FirstName'],
						'email'=>$item['email'],
						'employeenumber'=>$item['employeenumber'],
						'bio'=>$item['bio'],
						'cn_fullname'=>$item['cn_fullname'],
						'cn_bio'=>$item['cn_bio'],
						'photo'=>$item['photo'],
						'RowCount'=>1,
						'Sessions'=>array($point2=>array("SessionID"=>$item['SessionID'],
									"Title"=> $item['Title'],
									"Title_cn"=> $item['Title_cn'],
									"Type"=> $item['Type'],
									"SID"=> $item['SID'],
									"Language"=> $item['Language'],
			//									"TranslatorStatus"=> $item['TranslatorStatus'],
									"SpeakerStatus"=> $item['SpeakerStatus']))));

			while (($item = next($raw)) != FALSE) {
				if ($cur_speaker_id <> $item['id']){
					$tmp[$point]['RowCount'] = count($tmp[$point]['Sessions']);
					$result = $result + $tmp;
					$point = $point + 1;
					$point2 = 0;

					$cur_speaker_id = $item['id'];

					$tmp= array($point=>array('id'=>$item['id'],
								'LastName'=>$item['LastName'],
								'FirstName'=>$item['FirstName'],
								'email'=>$item['email'],
								'employeenumber'=>$item['employeenumber'],
								'bio'=>$item['bio'],
								'cn_fullname'=>$item['cn_fullname'],
								'cn_bio'=>$item['cn_bio'],
								'photo'=>$item['photo'],
								'RowCount'=>1,
								'Sessions'=>array($point2=>array("SessionID"=>$item['SessionID'],
											"Title"=> $item['Title'],
											"Title_cn"=> $item['Title_cn'],
											"Type"=> $item['Type'],
											"SID"=> $item['SID'],
											"Language"=> $item['Language'],
					//											"TranslatorStatus"=> $item['TranslatorStatus'],
											"SpeakerStatus"=> $item['SpeakerStatus']))));

				} else {
					$point2 = $point2 + 1;
					$tmp[$point]['Sessions'] = $tmp[$point]['Sessions'] + array($point2=>array("SessionID"=>$item['SessionID'],
											"Title"=> $item['Title'],
											"Title_cn"=> $item['Title_cn'],
											"Type"=> $item['Type'],
											"SID"=> $item['SID'],
											"Language"=> $item['Language'],
					//											"TranslatorStatus"=> $item['TranslatorStatus'],
											"SpeakerStatus"=> $item['SpeakerStatus']));
				}
			}

			$tmp[$point]['RowCount'] = count($tmp[$point]['Sessions']);
			$result = $result + $tmp;

		}

		return $result;
	}

	private function prepare_translator_bio_list($raw) {
		$result = array();

		if (count($raw) > 0) {

			reset($raw);
			$item = current($raw);
			$point = 0;
			$point2 = 0;

			$cur_speaker_id = $item['id'];
			$tmp= array($point=>array('id'=>$item['id'],
						'LastName'=>$item['LastName'],
						'FirstName'=>$item['FirstName'],
						'email'=>$item['email'],
						'employeenumber'=>$item['employeenumber'],
						'bio'=>$item['bio'],
						'cn_fullname'=>$item['cn_fullname'],
						'cn_bio'=>$item['cn_bio'],
						'photo'=>$item['photo'],
						'RowCount'=>1,
						'Sessions'=>array($point2=>array("SessionID"=>$item['SessionID'],
									"Title"=> $item['Title'],
									"Title_cn"=> $item['Title_cn'],
									"Type"=> $item['Type'],
									"SID"=> $item['SID'],
									"TranslatorStatus"=> $item['TranslatorStatus']))));

			while (($item = next($raw)) != FALSE) {
				if ($cur_speaker_id <> $item['id']){
					$tmp[$point]['RowCount'] = count($tmp[$point]['Sessions']);
					$result = $result + $tmp;
					$point = $point + 1;
					$point2 = 0;

					$cur_speaker_id = $item['id'];

					$tmp= array($point=>array('id'=>$item['id'],
								'LastName'=>$item['LastName'],
								'FirstName'=>$item['FirstName'],
								'email'=>$item['email'],
								'employeenumber'=>$item['employeenumber'],
								'bio'=>$item['bio'],
								'cn_fullname'=>$item['cn_fullname'],
								'cn_bio'=>$item['cn_bio'],
								'photo'=>$item['photo'],
								'RowCount'=>1,
								'Sessions'=>array($point2=>array("SessionID"=>$item['SessionID'],
											"Title"=> $item['Title'],
											"Title_cn"=> $item['Title_cn'],
											"Type"=> $item['Type'],
											"SID"=> $item['SID'],
											"TranslatorStatus"=> $item['TranslatorStatus']))));

				} else {
					$point2 = $point2 + 1;
					$tmp[$point]['Sessions'] = $tmp[$point]['Sessions'] + array($point2=>array("SessionID"=>$item['SessionID'],
											"Title"=> $item['Title'],
											"Title_cn"=> $item['Title_cn'],
											"Type"=> $item['Type'],
											"SID"=> $item['SID'],
											"TranslatorStatus"=> $item['TranslatorStatus']));
				}
			}

			$tmp[$point]['RowCount'] = count($tmp[$point]['Sessions']);
			$result = $result + $tmp;

		}

		return $result;
	}
}