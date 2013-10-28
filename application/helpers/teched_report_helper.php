<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('run_sql_return_query'))
{
	function run_sql_return_query($sql) {
		$CI =& get_instance();

		$query = $CI->db->query($sql);

		return $query;
	}
}


if ( ! function_exists('teched_report_session_translation_list'))
{
	function teched_report_session_translation_list($whereclause) {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."s.EditedAbstract as Abstract, s_cn.EditedAbstract_cn as Abstract_cn, "
		."s.EditedPrerequisites as Prerequisites, s_cn.EditedPrerequisites_cn as Prerequisites_cn, "
		."s.SessionOwner as SessionOwner, s.SessionOwnerEmail as SessionOwnerEmail, "
		."spk.FirstName, spk.LastName, spk.email, s.China as Session_Status, "
		."s_cn.SID from g_sessions_cn s_cn "
		."LEFT OUTER JOIN g_sessions s ON s_cn.SID = s.SID "
		."LEFT OUTER JOIN speakers spk ON s_cn.speakerid = spk.id "
		.$whereclause
		." ORDER BY s.SessionID ASC";
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_local_content_list'))
{
	function teched_report_local_content_list($whereclause = "where s.SID > 10000000 ") {
		$sql = "select s.SessionID, s.China as Session_Status, s.EditedTitle as Title, s.EditedAbstract as Abstract, s.EditedPrerequisites as Prerequisites, "
		."s.SessionOwnerEmail as OwerEmail, spk.FirstName as OwnerFirstName, spk.LastName as OwerLastName, "
		."mt.trackname as Track, mst.sessiontypename as Type, msl.sessionlevelname as Level, "
		."s_cn.EditedTitle_cn as Title_cn, s_cn.EditedAbstract_cn as Abstract_cn, s_cn.EditedPrerequisites_cn as Prerequisites_cn, "
		."mt.trackname_cn as Track_cn, mst.sessiontypename_cn as Type_cn, msl.sessionlevelname_cn as Level_cn, "
		."s.SID, spk.id from g_sessions s "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN speakers spk ON s.SessionOwnerEmail = spk.email "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		.$whereclause
		." ORDER BY s.SID ASC";
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_speaker_applicant_list'))
{
	function teched_report_speaker_applicant_session_list() {
		$sql = "select spk.firstname as FirstName, spk.lastname as LastName, spk.email as email, "
		."IF(sas.language = 1,'Chinese',IF(sas.language=2, 'English', 'Unknown')) as SpeakerLanguage, "
		. "s.SessionID, s.EditedTitle as Title, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as SessionLanguage, "
		."s.China, "
		."mt.trackname as Track, mst.sessiontypename as Type, msl.sessionlevelname as Level, "
		."s.SID as SID, spk.id as SpeakerID from g_sessions s "
		."LEFT OUTER JOIN g_speaker_assignments sas ON s.SID = sas.SID "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."where spk.id <>''"
		." ORDER BY s.SessionID ASC";		
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_approved_speaker_session_list'))
{
	function teched_report_approved_speaker_session_list() {
		return teched_report_session_speaker_session_list("s.China = 'Approved' and sas.speakerapproved = 1");
	}
}

if ( ! function_exists('teched_report_session_speaker_session_list'))
{
	function teched_report_session_speaker_session_list($whereclause="s.China = 'Approved'") {
		$sql = "select spk.firstname as FirstName, spk.lastname as LastName, spk.email as email, "
		."IF(sas.language = 1,'Chinese',IF(sas.language=2, 'English', 'Unknown')) as SpeakerLanguage, "
		. "s.SessionID, s.EditedTitle as Title, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as SessionLanguage, "
		."mt.trackname as Track, mst.sessiontypename as Type, msl.sessionlevelname as Level, "
		."s.SID as SID, spk.id as SpeakerID from g_sessions s "
		."LEFT OUTER JOIN g_speaker_assignments sas ON s.SID = sas.SID "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."where ".$whereclause
		." ORDER BY s.SessionID ASC";		
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_speaker_applicant_bio_list'))
{
	function teched_report_speaker_applicant_bio_list() {
		return teched_report_speaker_bio_list();
	}
}

if ( ! function_exists('teched_report_approved_speaker_bio_list'))
{
	function teched_report_approved_speaker_bio_list() {
		return teched_report_speaker_bio_list("s.China = 'Approved' and sas.speakerapproved = 1");
	}
}

if ( ! function_exists('teched_report_speaker_bio_list'))
{
	function teched_report_speaker_bio_list($whereclause="s.China <> ''") {
		$sql = "select spk.id, spk.lastname as LastName, spk.firstname as FirstName, spk.email as email, "
		."spk.employeenumber, spk.bio, spk.cn_fullname, spk.cn_bio, spk.photo, "
		."s.SessionID, s.EditedTitle as Title, mst.sessiontypename as Type, s.SID, s_cn.EditedTitle_cn as Title_cn,"
		."IF(sas.language = 1,'Chinese',IF(sas.language=2, 'English', 'Unknown')) as Language, "
		."IF(sas.speakerapproved = 1,'Approved',IF(sas.speakerapproved = 2, 'Rejected', 'TBD')) as SpeakerStatus "
		."from speakers spk "
		."LEFT OUTER JOIN g_speaker_assignments sas ON spk.id = sas.speakerid "
		."LEFT OUTER JOIN g_sessions s ON sas.SID = s.SID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."where ".$whereclause
		." ORDER BY spk.lastname ASC, spk.firstname ASC";		
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_translator_applicant_bio_list'))
{
	function teched_report_translator_applicant_bio_list() {
		return teched_report_translator_bio_list();
	}
}

if ( ! function_exists('teched_report_approved_translator_bio_list'))
{
	function teched_report_approved_translator_bio_list() {
		return teched_report_translator_bio_list("s.China = 'Approved' and tas.translatorapproved = 1");
	}
}

if ( ! function_exists('teched_report_translator_bio_list'))
{
	function teched_report_translator_bio_list($whereclause="s.China <> ''") {
		$sql = "select spk.id, spk.lastname as LastName, spk.firstname as FirstName, spk.email as email, "
		."spk.employeenumber, spk.bio, spk.cn_fullname, spk.cn_bio, spk.photo, "
		."s.SessionID, s.EditedTitle as Title, mst.sessiontypename as Type, s.SID, s_cn.EditedTitle_cn as Title_cn,"
		."IF(tas.translatorapproved = 1,'Approved',IF(tas.translatorapproved = 2, 'Rejected', 'TBD')) as TranslatorStatus "
		."from speakers spk "
		."LEFT OUTER JOIN g_translator_assignments tas ON spk.id = tas.translatorid "
		."LEFT OUTER JOIN g_sessions s ON tas.SID = s.SID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."where ".$whereclause
		." ORDER BY spk.lastname ASC, spk.firstname ASC";		
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_approved_speaker_logistics_info_list'))
{
	function teched_report_approved_speaker_logistics_info_list() {
		$sql = "select spk.id, spk.lastname as LastName, spk.firstname as FirstName, spk.email as Email, "
		."spk.employeenumber as SAPID, spk.cn_fullname as cn_FullName, mshirt.shirtname as ShirtSize, spk.phone as Phone, spk.cell as Mobile "
		."from speakers spk "
		."LEFT OUTER JOIN m_shirt mshirt ON spk.shirtid = mshirt.shirtid "
		."where spk.id in (select distinct(sas.speakerid) from g_speaker_assignments sas where sas.speakerapproved = 1) "
		."ORDER BY spk.lastname ASC, spk.firstname ASC";		
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_approved_scheduling_it_req_list'))
{
	function teched_report_approved_scheduling_it_req_list() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, mst.sessiontypename as Type, mt.trackname as Track, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as Language, "
		."sss.room, sss.room_cn, sss.sessiondate, sss.starttime, sss.endtime, sss.ITimage, "
		."IF(sss.interpretation = 1,'Yes',IF(sss.interpretation=2, 'No', 'Unknown')) as Interpretation, s.SID "
		."from g_sessions s "
		."LEFT OUTER JOIN g_session_schedulings sss ON s.SID = sss.SID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' "
		." ORDER BY s.SessionID, sss.sessiondate ASC, sss.starttime ASC, sss.endtime ASC, s.SessionID ASC";
				return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_approved_scheduling_speaker_it_req_list'))
{
	function teched_report_approved_scheduling_speaker_it_req_list() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, mst.sessiontypename as Type, mt.trackname as Track, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as Language, "
		."sss.room, sss.room_cn, sss.sessiondate, sss.starttime, sss.endtime, sss.ITimage, "
		."IF(sss.interpretation = 1,'Yes',IF(sss.interpretation=2, 'No', 'Unknown')) as Interpretation, "
		."spk.lastname as LastName, spk.firstname as FirstName, spk.cn_fullname as ChineseName, "
		."spk.email as Email, spk.employeenumber as SAPID, sas.speakerid, s.SID "
		."from g_sessions s "
		."LEFT OUTER JOIN g_session_schedulings sss ON s.SID = sss.SID "
		."LEFT OUTER JOIN g_speaker_assignments sas ON s.SID = sas.SID "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' and sas.speakerapproved = 1 "
		." ORDER BY s.SessionID, sss.sessiondate ASC, sss.starttime ASC, sss.endtime ASC, s.SessionID ASC";
				return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_vr_session_list'))
{
	function teched_report_vr_session_list() {
		$sql = "select vr.SESSIONID, vr.TITLE, vr.TITLE_CN, vr.SESSIONTYPE, vr.SESSIONROOM, vr.SESSIONDATE, vr.STARTTIME, vr.ENDTIME, "
		."mstr.subtrackname as SubTrackName, 'Chinese' as Language, "
		."s.EditedTitle as EditedTitle, s_cn.EditedTitle_cn as EditedTitle_cn, "
		."s.EditedAbstract as EditedAbstract, s_cn.EditedAbstract_cn as EditedAbstract_cn, "
		."s.SessionOwner, s.SessionOwnerEmail, "
		."s.SID "
		."from vr_sessions vr "
		."LEFT OUTER JOIN m_subtrack mstr ON vr.SUBTRACKID = mstr.subtrackid "
		."LEFT OUTER JOIN g_sessions s ON vr.SESSIONID = s.SessionID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		." ORDER BY vr.SESSIONROOM ASC, vr.SESSIONDATE ASC, vr.STARTTIME";
		return run_sql_return_query($sql);
	}
}

if ( ! function_exists('teched_report_vr_session_speaker_bio_list'))
{
	function teched_report_vr_session_speaker_bio_list() {
		return teched_report_speaker_bio_list("s.SessionID like 'VR%'");
	}
}
