<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml"
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
	xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Language" content="en-US" />
<meta name="skin" content="experience" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all"
	href="../../global/ui/css/sapcom.css" />
<link rel="stylesheet" type="text/css" media="all"
	href="../../global/ui/css/events.css" />
<link rel="stylesheet" type="text/css" media="print"
	href="../../global/ui/css/print.css" />
<title>SAP D-Code 2014 Shanghai</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<script type="text/javascript" src="../../global/ui/js/jquery.js"></script>
<!-- Rich Media Scripts -->
<script type="text/javascript" data-main="utils/rm_initializer"
	src="../../global/ui/richmedia/js/require.js"> </script>
<link rel="stylesheet" type="text/css"
	href="../../global/ui/richmedia/css/UMP/rm_UMP_css.css" />
<!-- / Rich Media Scripts -->
<script type="text/javascript" src="../../global/ui/js/common.js"></script>
<script type="text/javascript" src="../../global/js/remote.js"></script>
<script type="text/javascript" src="global/ui/js/trackinghelper.js"></script>
<!-- HBR scripts -->
<script type="text/javascript" src="../../global/ui/js/global.js"></script>
<script type="text/javascript" src="../../global/ui/js/header.js"></script>
<script type="text/javascript" src="../../global/ui/js/footer.js"></script>
<script type="text/javascript" src="../../global/ui/js/news.js"></script>
<!-- / HBR scripts -->
</head>
<body id="secondary">
<div id="page"><!--begin header content--> <!--googleoff: index-->
<div id="headercontent">
<div id="header"><q><a href="../index/home.asp" title="SAP"><img
	src="../../global/ui/images/logos/SAPTECHED_CH2012.png"
	alt="SAP D-Code 2014" /></a></q>
<ul id="nav-utility-singleline">
	<li id="utilitynav-phone"><a href="../../cn/index/home.asp?id=1">中文</a></li>
	<li id="utilitynav-phone"><a href="http://www.sapteched.com/"
		target="_blank">SAP D-Code Global</a></li>
	<li><a href="mailto:saptechedinfo.china@sap.com" title="E-Mail SAP">Contact
	Us</a></li>
	<li><a href="http://www.sap.com" target="_blank">SAP.com</a></li>
</ul>
<!-- END UTILITY NAV BOTTOM --></div>
<!-- END HEADER--></div>
<!--end header content--> <!--googleon: index-->
<div id="page-content">
<div>
<div id="nav-main-standard">
<ul>
	<li><a href="../index/home.asp"><span>SAP D-Code Homepage</span></a></li>
	<li><a href="../reghotel/home.asp"><span>Registration/Hotel</span></a></li>
	<li><a href="../community/home.asp"><span>Get Social</span></a></li>
	<li><a href="../about/home.asp"><span>About</span></a></li>
	<li><a href="home.asp" class="on"><span>Sessions</span></a></li>
	<li><a href="http://www.sapteched.com/online" target="_blank"><span>SAP
	D-Code Online</span></a></li>
	<li><a href="../activities/home.asp"><span>Activities</span></a></li>
	<li><a href="../exhibitors/home.asp"><span>Exhibitors</span></a></li>
	<!--<li><a href="#"><span>Nav Item 9</span></a></li>-->
</ul>
</div>
<!-- END MAIN NAV --></div>


<!--<div id="breadcrumb">
      <ul>
        <li><a href="/"><span>SAP.com</span></a></li>
        <li><a href="#"><span>Events</span></a></li>
        <li><a href="#"><span>[Event Name]</span></a></li>
        <li><span>Keynote Sessions</span></li>
      </ul>
    </div>-->
<div id="sub">
<div id="subtop" class="clearfix">
<ul id="nav-sub" class="clearfix">

	   <li><a href="home.asp" ><span>Overview</span></a></li>
          <li><a href="schedulings.asp"   ><span>D-Code Agenda</span></a></li>
          <li><a href="vr_sessions.asp"  ><span>Value Realization Agenda</span></a></li>
          <li><a href="tracks.asp"  ><span>Tracks</span></a></li>
          <li><a href="speakers.asp" class="on"  ><span>Speakers</span></a></li>
</ul>



<div id="subtop-video-left1">
<h1>Speaker Details</h1>
</div>
</div>



<div id="subbottom" class="clearfix">
<h2 class="no-indent"></h2>
<div style="width: 800px;">
<div style="width: 110px; height: 150px; float: left;"><img
	src="<?php echo "../../photos/".$item['photo']; ?>" width="110"
	height="150" /></div>
<div
	style="height: 150px; width: 650px; padding-left: 25px; float: left;">
<h3><?php echo $item['LastName'].", ".$item['FirstName']; ?></h3>
<br />
<?php echo $item['jobtitle']; ?><br />
<br />
<?php echo $item['bio']; ?> <br />
</div>
<div style="width: 800px; height: 100px; float: left; padding-top: 30px;">
<h3>Related Sessions</h3>
<ul>

<?php foreach($sessions as $item2):?>
	<li><a href="<?php echo $item2['SessionID'].'.asp'; ?>"><?php echo $item2['SessionID']."&nbsp;&nbsp;". $item2['Title']; ?></a>
	<?php if ($item2['TypeID'] == 1) echo '<img src="../../images/1hr_lecture.gif" border="0" alt="1-Hour Lecture" />'; else if  ($item2['TypeID'] == 3) echo '<img src="../../images/2hr_handson.gif" border="0" alt="2-Hours Hands-on" />'; else if  ($item2['TypeID'] == 51) echo '<img src="../../images/0.5hr_lecture.gif" border="0" alt="0.5-Hour Lecture" />'; else if  ($item2['TypeID'] == 201) echo '<img src="../../images/3hr_demobooth.gif" border="0" alt="Demo Booth" />'; else echo $item2['Type']; ?>
	</li>
	<?php endforeach; ?>

</ul>

</div>
</div>

</div>





</div>
<!-- SPACE RESERVED FOR ANALYTICS  -->
<div id="sap-news">
<p class="news-heading rm_newsExpand"><a href="">SAP News</a></p>
<!--#include file="../top.asp"--></div>
<!-- END SAP NEWS --></div>
<!-- END PAGE CONTENT -->
<div id="footer"><!--#include file="../buttom.asp"--></div>
<!-- END FOOTER --></div>
<script type="text/javascript" src="global/ui/js/securelayers.js"></script>
<script type="text/javascript" src="global/ui/js/securedforms.js"></script>
<script type="text/javascript" src="global/ui/js/jquery-ui.js"></script>
</body>
</html>
