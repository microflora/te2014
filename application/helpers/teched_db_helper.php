<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_tech_db_table'))
{
	function get_tech_db_table($table) {
		$CI =& get_instance();

		$query = $CI->db->get($table);

		return $query->result_array();
	}

}

if ( ! function_exists('run_tech_db_sql'))
{
	function run_tech_db_sql($sql) {
		$CI =& get_instance();

		$query = $CI->db->query($sql);

		return $query->result_array();
	}
}

if ( ! function_exists('get_teched_db_countries'))
{
	function get_teched_db_countries() {
		return get_tech_db_table('m_country');
	}
}

if ( ! function_exists('get_teched_db_organizations'))
{
	function get_teched_db_organizations(){
		return get_tech_db_table('m_organization');
	}
}

if ( ! function_exists('get_teched_db_shirts'))
{
	function get_teched_db_shirts(){
		return get_tech_db_table('m_shirt');
	}
}

if ( ! function_exists('teched_db_get_session_list'))
{
	function teched_db_get_session_list($whereclause) {
		$sql = "select s.SID, s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, s.China, "
		."mt.trackname as Track, msl.sessionlevelname as Level, mst.sessiontypename as Type from g_sessions s "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		.$whereclause
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_my_session_list_as_speaker'))
{
	function teched_db_get_my_session_list_as_speaker($whereclause) {
		$sql = "select sas.SID, sas.speakerid, sas.speakerapproved, "
		."s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."mt.trackname as Track, msl.sessionlevelname as Level, mst.sessiontypename as Type "
		."from g_speaker_assignments sas "
		."LEFT OUTER JOIN g_sessions s ON sas.SID = s.SID "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		.$whereclause
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_my_session_list_as_translator'))
{
	function teched_db_get_my_session_list_as_translator($whereclause) {
		$sql = "select tas.SID, tas.translatorid, tas.translatorapproved, "
		."s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."mt.trackname as Track, msl.sessionlevelname as Level, mst.sessiontypename as Type "
		."from g_translator_assignments tas "
		."LEFT OUTER JOIN g_sessions s ON tas.SID = s.SID "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		.$whereclause
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_session_detail'))
{
	function teched_db_get_session_detail($sid) {
		$sql = "select s.SID, s.SessionID, s.EditedTitle as Title, s.EditedAbstract as Abstract, "
		."s.SessionOwner, s.EditedPrerequisites as Prerequisites, mt.trackname as Track, "
		."s_cn.EditedTitle_cn as Title_cn, s_cn.EditedAbstract_cn as Abstract_cn, "
		."s_cn.EditedPrerequisites_cn as Prerequisites_cn, "
		."msl.sessionlevelname as Level, mst.sessiontypename as Type from g_sessions s "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."where s.SID = ".$sid;
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_speaker_assignments'))
{
	function teched_db_get_speaker_assignments($sid) {
		$sql = "select sas.SID, spk.firstname, spk.lastname, spk.email "
		." from g_speaker_assignments sas "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."where sas.SID = ".$sid;
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_translator_assignments'))
{
	function teched_db_get_translator_assignments($sid) {
		$sql = "select tas.SID, spk.firstname, spk.lastname, spk.email "
		." from g_translator_assignments tas "
		."LEFT OUTER JOIN speakers spk ON tas.translatorid = spk.id "
		."where tas.SID = ".$sid;
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_add_speaker_assignments'))
{
	function teched_db_add_speaker_assignments($sid, $speakerid, $language) {
		// double check sid and speakerid
		if ($sid == "" or $speakerid == "") {
			return FALSE;
		}

		// check whether exist
		$CI =& get_instance();
		$CI->db->where('SID', $sid);
		$CI->db->where('speakerid', $speakerid);

		$query = $CI->db->get('g_speaker_assignments');

		if ($query->num_rows() > 0)
		{
			return FALSE;
		}

		$CI->db->set('SID', $sid);
		$CI->db->set('speakerid', $speakerid);
		$CI->db->set('language', $language);

		if($CI->db->insert('g_speaker_assignments'))
		{
			return TRUE;
		}
		return FALSE;
	}
}

if ( ! function_exists('teched_db_remove_speaker_assignments'))
{
	function teched_db_remove_speaker_assignments($sid, $speakerid) {
		// double check sid and speakerid
		if ($sid == "" or $speakerid == "") {
			return FALSE;
		}

		$CI =& get_instance();

		$CI->db->where('SID', $sid);
		$CI->db->where('speakerid', $speakerid);

		$query = $CI->db->delete('g_speaker_assignments');

		return TRUE;
	}
}

if ( ! function_exists('teched_db_add_translator_assignments'))
{
	function teched_db_add_translator_assignments($sid, $translatorid) {
		// double check sid and translatorid
		if ($sid == "" or $translatorid == "") {
			return FALSE;
		}

		// check whether exist
		$CI =& get_instance();
		$CI->db->where('SID', $sid);
		$CI->db->where('translatorid', $translatorid);

		$query = $CI->db->get('g_translator_assignments');

		if ($query->num_rows() > 0)
		{
			return FALSE;
		}

		$CI->db->set('SID', $sid);
		$CI->db->set('translatorid', $translatorid);

		if($CI->db->insert('g_translator_assignments'))
		{
			return TRUE;
		}
		return FALSE;
	}
}

if ( ! function_exists('teched_db_remove_translator_assignments'))
{
	function teched_db_remove_translator_assignments($sid, $translatorid) {
		// double check sid and translatorid
		if ($sid == "" or $translatorid == "") {
			return FALSE;
		}

		$CI =& get_instance();

		$CI->db->where('SID', $sid);
		$CI->db->where('translatorid', $translatorid);

		$query = $CI->db->delete('g_translator_assignments');

		return TRUE;
	}
}

if ( ! function_exists('teched_db_get_my_speaker_assignment'))
{
	function teched_db_get_my_speaker_assignment($sid, $speakerid) {

		$CI =& get_instance();

		$CI->db->where('SID', $sid);
		$CI->db->where('speakerid', $speakerid);

		$query = $CI->db->get('g_speaker_assignments');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();;
		}

		return NULL;
	}
}

if ( ! function_exists('teched_db_get_my_translator_assignment'))
{
	function teched_db_get_my_translator_assignment($sid, $translatorid) {

		$CI =& get_instance();

		$CI->db->where('SID', $sid);
		$CI->db->where('translatorid', $translatorid);

		$query = $CI->db->get('g_translator_assignments');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();;
		}

		return NULL;
	}
}

if ( ! function_exists('teched_db_get_session_translation'))
{
	function teched_db_get_session_translation($sid) {
		$sql = "select s.SID, s.SessionID, s.EditedTitle as Title, s.EditedAbstract as Abstract, "
		."s.EditedPrerequisites as Prerequisites, sc.EditedTitle_cn as Title_cn, sc.lastupdatetime as LastUpdateTime, "
		."sc.EditedAbstract_cn as Abstract_cn, sc.EditedPrerequisites_cn as Prerequisites_cn, "
		."spk.firstname as Firstname, spk.lastname as Lastname, spk.email as Email "
		."from g_sessions s LEFT OUTER JOIN g_sessions_cn sc ON s.SID = sc.SID "
		."LEFT OUTER JOIN speakers spk ON sc.speakerid = spk.id "
		."where s.SID = ".$sid;
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_update_session_translation'))
{
	function teched_db_update_session_translation($data) {
		// double check sid
		if ($data['sid'] == "") {
			return FALSE;
		}

		$CI =& get_instance();

		$CI->db->where('SID', $data['sid']);

		$query = $CI->db->get('g_sessions_cn');

		if ($query->num_rows() > 0)
		{
			$CI->db->where('SID', $data['sid']);
			$CI->db->set('EditedTitle_cn', $data['title_cn']);
			$CI->db->set('EditedAbstract_cn', $data['abstract_cn']);
			$CI->db->set('EditedPrerequisites_cn', $data['prerequisites_cn']);
			$CI->db->set('speakerid', $data['speakerid']);
			$CI->db->set('lastupdatetime', gmdate('Y-m-d H:i:s'));

			if($CI->db->update('g_sessions_cn'))
			{
				return TRUE;
			}
		}
		else
		{
			$CI->db->set('SID', $data['sid']);
			$CI->db->set('EditedTitle_cn', $data['title_cn']);
			$CI->db->set('EditedAbstract_cn', $data['abstract_cn']);
			$CI->db->set('EditedPrerequisites_cn', $data['prerequisites_cn']);
			$CI->db->set('speakerid', $data['speakerid']);
			$CI->db->set('lastupdatetime', now());

			if($CI->db->insert('g_sessions_cn'))
			{
				return TRUE;
			}
		}

		return FALSE;
	}
}


if ( ! function_exists('teched_db_get_all_session_translation'))
{
	function teched_db_get_all_session_translation() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."s.EditedAbstract as Abstract, s_cn.EditedAbstract_cn as Abstract_cn, "
		."s.EditedPrerequisites as Prerequisites, s_cn.EditedPrerequisites_cn as Prerequisites_cn, "
		."s.SID from g_sessions s "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."where s.China <> '' "
		."ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_all_approved_speakers'))
{
	function teched_db_get_all_approved_speakers() {
		$sql = "select spk.id as ID, "
		."spk.firstname as FirstName, spk.lastname as LastName, spk.email as email, "
		."spk.photo as Photo, spk.bio as Bio, spk.cn_fullname as cn_FullName, spk.cn_bio as cn_Bio "
		."from speakers spk "
		."where spk.id in (select distinct(sas.speakerid) from g_speaker_assignments sas where sas.speakerapproved = 1) "
		."ORDER BY spk.lastname ASC, spk.firstname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_all_speaker_assignments'))
{
	function teched_db_get_all_speaker_assignments() {
		$sql = "select s.SID, s.SessionID, s.EditedTitle as Title, "
		."mst.sessiontypename as Type, msl.sessionlevelname as Level, "
		."spk.id as speakerid, spk.firstname as FirstName, spk.lastname as LastName, spk.email as email, "
		."IF(sas.language = 1,'Chinese',IF(sas.language=2, 'English', 'Unknown')) as Language, "
		."IF(sas.speakerapproved = 1,'Approved',IF(sas.speakerapproved=2, 'Rejected', 'Unknown')) as Status "
		."from g_sessions s "
		."LEFT OUTER JOIN g_speaker_assignments sas ON s.SID = sas.SID "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."where s.China <>'' "
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_all_translator_assignments'))
{
	function teched_db_get_all_translator_assignments() {
		$sql = "select s.SID, s.SessionID, s.EditedTitle as Title, "
		."mst.sessiontypename as Type, msl.sessionlevelname as Level, "
		."spk.id as speakerid, spk.firstname as FirstName, spk.lastname as LastName, spk.email as email, "
		."IF(tas.translatorapproved = 1,'Approved',IF(tas.translatorapproved=2, 'Rejected', 'Unknown')) as Status "
		."from g_sessions s "
		."LEFT OUTER JOIN g_translator_assignments tas ON s.SID = tas.SID "
		."LEFT OUTER JOIN speakers spk ON tas.translatorid = spk.id "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."where s.China <>'' "
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}


if ( ! function_exists('teched_db_get_all_speakers'))
{
	function teched_db_get_all_speakers() {
		$sql = "select spk.id, "
		."spk.firstname as FirstName, spk.lastname as LastName, spk.email as email "
		."from speakers spk "
		."ORDER BY spk.lastname ASC, spk.firstname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_viewall'))
{
	function teched_db_generate_viewall() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."s.EditedAbstract as Abstract, s_cn.EditedAbstract_cn as Abstract_cn, "
		."msl.sessionlevelname as Level, msl.sessionlevelname_cn as Level_cn, "
		."mst.sessiontypename as Type, mst.sessiontypename_cn as Type_cn, "
		."s.SessionTypeID as TypeID, s.SessionLanguage as Language, s.SID from g_sessions s "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."where s.China = 'Approved' "
		."ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_sessions'))
{
	function teched_db_generate_sessions() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."s.EditedAbstract as Abstract, s_cn.EditedAbstract_cn as Abstract_cn, "
		."msl.sessionlevelname as Level, msl.sessionlevelname_cn as Level_cn, "
		."mst.sessiontypename as Type, mst.sessiontypename_cn as Type_cn, "
		."mt.trackname as Track, mt.trackname_cn as Track_cn, "
		."s.SessionTypeID as TypeID, s.SessionLanguage as Language, s.SID from g_sessions s "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' "
		."ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_keywords'))
{
	function teched_db_generate_keywords($SID) {
		$sql = "select mkw.keywordid, mkw.keywordname, mkw.keywordname_cn from m_keyword mkw "
		."LEFT OUTER JOIN g_keywords gkw ON gkw.KeywordID = mkw.keywordid "
		."where gkw.SID = '".$SID."' "
		."ORDER BY mkw.keywordname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_keywords'))
{
	function teched_db_generate_keywords($SID) {
		$sql = "select mkw.keywordid, mkw.keywordname, mkw.keywordname_cn from m_keyword mkw "
		."LEFT OUTER JOIN g_keywords gkw ON gkw.KeywordID = mkw.keywordid "
		."where gkw.SID = '".$SID."' "
		."ORDER BY mkw.keywordname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_jobfunctions'))
{
	function teched_db_generate_jobfunctions($SID) {
		$sql = "select mjf.jobfunctionid, mjf.jobfunctionname, mjf.jobfunctionname_cn from m_jobfunction mjf "
		."LEFT OUTER JOIN g_jobfunctions gjf ON gjf.JobFunctionID = mjf.jobfunctionid "
		."where gjf.SID = '".$SID."' "
		."ORDER BY mjf.jobfunctionname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_relatedproducts'))
{
	function teched_db_generate_relatedproducts($SID) {
		$sql = "select mrp.relatedproductid, mrp.relatedproductname, mrp.relatedproductname_cn from m_relatedproduct mrp "
		."LEFT OUTER JOIN g_relatedproducts grp ON grp.RelatedProductID = mrp.relatedproductid "
		."where grp.SID = '".$SID."' "
		."ORDER BY mrp.relatedproductname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_tracks'))
{
	function teched_db_generate_tracks() {
		$sql = "select s.TrackID, mt.trackid as TrackID, mt.trackname as Track, mt.trackname_cn as Track_cn, "
		."count(s.TrackID) as SessionCount from g_sessions s "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' "
		."GROUP BY s.TrackID "
		."ORDER BY mt.trackname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_tracks_sessions'))
{
	function teched_db_generate_tracks_sessions() {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."mst.sessiontypename as Type, mst.sessiontypename_cn as Type_cn, "
		."mt.trackid as TrackID, mt.trackname as Track, mt.trackname_cn as Track_cn, "
		."s.SessionTypeID as TypeID, s.SessionLanguage as Language, s.SID from g_sessions s "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' "
		."ORDER BY mt.trackname ASC, s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_speakers'))
{
	function teched_db_generate_speakers($whereclause="sas.speakerapproved = 1") {
		$sql = "select distinct(sas.speakerid) as SpeakerID, spk.lastname as LastName, spk.firstname as FirstName, "
		."spk.bio, spk.jobtitle, spk.cn_fullname, spk.cn_bio, spk.cn_jobtitle, spk.photo, sas.speakerapproved "
		."from g_speaker_assignments sas "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."where ".$whereclause
		." ORDER BY spk.lastname ASC, spk.firstname ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_speaker_sessions'))
{
	function teched_db_generate_speaker_sessions($speakerid) {
		$sql = "select s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."mst.sessiontypename as Type, mst.sessiontypename_cn as Type_cn, "
		."mt.trackid as TrackID, mt.trackname as Track, mt.trackname_cn as Track_cn, "
		."s.SessionTypeID as TypeID, s.SessionLanguage as Language, "
		."sas.speakerid as SpeakerId, sas.SID from g_speaker_assignments sas "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."LEFT OUTER JOIN g_sessions s ON sas.SID = s.SID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where sas.speakerapproved = 1 and sas.speakerid = ".$speakerid
		." ORDER BY mt.trackname ASC, s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_all_schedulings'))
{
	function teched_db_generate_all_schedulings() {
		$sql = "select sss.SID, sss.room, sss.room_cn, sss.sessiondate, sss.starttime, sss.endtime, sss.ITimage, sss.interpretation, "
		."s.SessionID, s.EditedTitle as Title, s_cn.EditedTitle_cn as Title_cn, "
		."mst.sessiontypename as Type, mst.sessiontypename_cn as Type_cn, "
		."mt.trackid as TrackID, mt.trackname as Track, mt.trackname_cn as Track_cn, "
		."s.SessionTypeID as TypeID, s.SessionLanguage as Language "
		."from g_session_schedulings sss "
		."LEFT OUTER JOIN g_sessions s ON sss.SID = s.SID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessiontype mst ON s.SessionTypeID = mst.sessiontypeid "
		."LEFT OUTER JOIN m_track mt ON s.TrackID = mt.trackid "
		."where s.China = 'Approved' "
		." ORDER BY sss.sessiondate ASC, sss.starttime ASC, sss.endtime ASC, s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_schedulings'))
{
	function teched_db_generate_schedulings($SID) {
		$sql = "select sss.SID, sss.room, sss.room_cn, sss.sessiondate, sss.starttime, sss.endtime, sss.ITimage, "
		."sss.interpretation "
		."from g_session_schedulings sss "
		."where sss.SID = ".$SID
		." ORDER BY sss.sessiondate ASC, sss.starttime ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_generate_vr_sessions'))
{
	function teched_db_generate_vr_sessions() {
		$sql = "select vr.SESSIONID as SessionID, vr.TITLE as Title, vr.TITLE_CN as Title_cn, "
		."vr.SESSIONROOM as room, vr.SESSIONROOM_CN as room_cn, "
		."vr.SESSIONDATE as sessiondate, vr.STARTTIME as starttime, vr.ENDTIME as endtime, "
		."IF(vr.SESSIONTYPE = 'Lecture',1,IF(vr.SESSIONTYPE='Hands-on', 3, 0)) as TypeID, "
		."msl.sessionlevelname as Level, msl.sessionlevelname_cn as Level_cn, "
		."mstr.subtrackname as Track, mstr.subtrackname_cn as Track_cn, 1 as Language, "
		."s.EditedTitle as EditedTitle, s_cn.EditedTitle_cn as EditedTitle_cn, "
		."s.EditedAbstract as EditedAbstract, s_cn.EditedAbstract_cn as EditedAbstract_cn, "
		."s.SID "
		."from vr_sessions vr "
		."LEFT OUTER JOIN m_subtrack mstr ON vr.SUBTRACKID = mstr.subtrackid "
		."LEFT OUTER JOIN g_sessions s ON vr.SESSIONID = s.SessionID "
		."LEFT OUTER JOIN g_sessions_cn s_cn ON s.SID = s_cn.SID "
		."LEFT OUTER JOIN m_sessionlevel msl ON s.SessionLevelID = msl.sessionlevelid "
		." ORDER BY vr.SESSIONROOM ASC, vr.SESSIONDATE ASC, vr.STARTTIME";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_save_session'))
{
	function teched_db_save_session($mysession) {

		$SID = $mysession['SID'];

		$CI =& get_instance();
		$CI->db->trans_start();

		if ($SID == '') { // insert

			//Find out the new SID
			$result = $CI->db->query("select max(SID) as SID from g_sessions")->result_array();
			$SID = $result[0]['SID'];

			if ($SID < 10000001) {
				$SID = 10000001;
			} else {
				$SID = $SID + 1;
			}

				
			$data = array(
			   'SID' => $SID ,
			   'Title' => $mysession['Title'] ,
			   'EditedTitle' => $mysession['Title'] ,
			   'Abstract' => $mysession['Abstract'] ,
			   'EditedAbstract' => $mysession['Abstract'] ,
			   'Prerequisites' => $mysession['Prerequisites'] ,
			   'EditedPrerequisites' => $mysession['Prerequisites'] ,
			   'SessionTypeID' => $mysession['SessionTypeID'] ,
			   'SessionLevelID' => $mysession['SessionLevelID'] ,
			   'SubTrackID' => $mysession['SubTrackID'] ,
			   'TrackID' => $mysession['TrackID'] ,
			   'ReleaseTimeframeID' => $mysession['ReleaseTimeframeID'] ,
			   'SessionOwner' => $mysession['SessionOwner'] ,
			   'SessionOwnerEmail' => $mysession['SessionOwnerEmail'] ,
			   'EntryDate' => gmdate('Y-m-d H:i:s') ,
			   'ModifyDate' => gmdate('Y-m-d H:i:s') ,
			   'China' => 'Pre-selected'
			);

			$CI->db->insert('g_sessions', $data);

		} else {  //update

			$CI->db->where('SID', $SID);
			$CI->db->set('Title', $mysession['Title']);
			$CI->db->set('EditedTitle', $mysession['Title']);
			$CI->db->set('Abstract', $mysession['Abstract']);
			$CI->db->set('EditedAbstract', $mysession['Abstract']);
			$CI->db->set('Prerequisites', $mysession['Prerequisites']);
			$CI->db->set('EditedPrerequisites', $mysession['Prerequisites']);
			$CI->db->set('SessionTypeID', $mysession['SessionTypeID']);
			$CI->db->set('SessionLevelID', $mysession['SessionLevelID']);
			$CI->db->set('SubTrackID', $mysession['SubTrackID']);
			$CI->db->set('TrackID', $mysession['TrackID']);
			$CI->db->set('ReleaseTimeframeID', $mysession['ReleaseTimeframeID']);
			$CI->db->set('SessionOwner', $mysession['SessionOwner']);
			$CI->db->set('SessionOwnerEmail', $mysession['SessionOwnerEmail']);
			$CI->db->set('ModifyDate', gmdate('Y-m-d H:i:s'));

			if($CI->db->update('g_sessions'));

			// remove existing mapping

			$sql = "DELETE FROM g_jobfunctions WHERE SID = ".$SID;
			$CI->db->query($sql);
			$sql = "DELETE FROM g_relatedproducts WHERE SID = ".$SID;
			$CI->db->query($sql);
			$sql = "DELETE FROM g_keywords WHERE SID = ".$SID;
			$CI->db->query($sql);

			// remove existing translation
			$sql = "DELETE FROM g_sessions_cn WHERE SID = ".$SID;
			$CI->db->query($sql);

		}

		// insert updated mapping
		foreach ($mysession['JobFunctionIDs'] as $item) {
			$sql = "INSERT INTO g_jobfunctions (SID, JobFunctionID) VALUES "
			."(".$SID.", ".$item.")";
			$CI->db->query($sql);
		}

		foreach ($mysession['RelatedProductIDs'] as $item) {
			$sql = "INSERT INTO g_relatedproducts (SID, RelatedProductID) VALUES "
			."(".$SID.", ".$item.")";
			$CI->db->query($sql);
		}

		foreach ($mysession['KeywordIDs'] as $item) {
			$sql = "INSERT INTO g_keywords (SID, KeywordID) VALUES "
			."(".$SID.", ".$item.")";
			$CI->db->query($sql);
		}

		// insert new translation

		$data = array(
		   'SID' => $SID ,
		   'EditedTitle_cn' => $mysession['Title_cn'] ,
		   'EditedAbstract_cn' => $mysession['Abstract_cn'] ,
		   'EditedPrerequisites_cn' => $mysession['Prerequisites_cn'] ,
		   'speakerid' =>$mysession['SessionOwnerId'] ,
		   'lastupdatetime' => gmdate('Y-m-d H:i:s')
		);

		$CI->db->insert('g_sessions_cn', $data);
	
		$CI->db->trans_complete();

		return $CI->db->trans_status();

	}
}

if ( ! function_exists('teched_db_get_speaker_summary'))
{
	function teched_db_get_speaker_summary($speakerid) {
		$sql = "select s.SessionID, s.EditedTitle as Title, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as SessionLanguage, "
		."IF(sas.language = 1,'Chinese',IF(sas.language=2, 'English', 'Unknown')) as SpeakerLanguage, "
		."IF(sas.speakerapproved = 1,'Approved',IF(sas.speakerapproved=2, 'Declined', 'Unknown')) as SpeakerApproved "
		."from g_speaker_assignments sas "
		."LEFT OUTER JOIN g_sessions s ON sas.SID = s.SID "
		."LEFT OUTER JOIN speakers spk ON sas.speakerid = spk.id "
		."where sas.speakerid = ".$speakerid
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_get_translator_summary'))
{
	function teched_db_get_translator_summary($speakerid) {
		$sql = "select s.SessionID, s.EditedTitle as Title, "
		."IF(s.SessionLanguage = 1,'Chinese',IF(s.SessionLanguage=2, 'English', 'Unknown')) as SessionLanguage, "
		."IF(tas.translatorapproved = 1,'Approved',IF(tas.translatorapproved=2, 'Declined', 'Unknown')) as TranslatorApproved "
		."from g_translator_assignments tas "
		."LEFT OUTER JOIN g_sessions s ON tas.SID = s.SID "
		."LEFT OUTER JOIN speakers spk ON tas.translatorid = spk.id "
		."where tas.translatorid = ".$speakerid
		." ORDER BY s.SessionID ASC";
		return run_tech_db_sql($sql);
	}
}

if ( ! function_exists('teched_db_update_speaker_assignment_status'))
{
	function teched_db_update_speaker_assignment_status($SID, $speakerid, $status) {
		$CI =& get_instance();

		$CI->db->where('SID', $SID);
		$CI->db->where('speakerid', $speakerid);
		$CI->db->set('speakerapproved', $status);

		if($CI->db->update('g_speaker_assignments'))
		{
			return TRUE;
		}

		return FALSE;
	}
}

if ( ! function_exists('teched_db_update_translator_assignment_status'))
{
	function teched_db_update_translator_assignment_status($SID, $speakerid, $status) {
		$CI =& get_instance();

		$CI->db->where('SID', $SID);
		$CI->db->where('translatorid', $speakerid);
		$CI->db->set('translatorapproved', $status);

		if($CI->db->update('g_translator_assignments'))
		{
			return TRUE;
		}

		return FALSE;
	}
}

/* End of file sql_helper.php */
/* Location: ./application/helpers/sql_helper.php */