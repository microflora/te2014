
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
	src="../../global/ui/images/logos/SAPTECHED_CH2012CN.png"
	alt="SAP Teched" /></a></q>
<ul id="nav-utility-singleline">
	<li id="utilitynav-phone"><a href="../../en/index/home.asp?id=1">English</a></li>
	<li id="utilitynav-phone"><a href="http://www.sapteched.com/"
		target="_blank">SAP D-Code 全球网站</a></li>
	<li><a href="mailto:saptechedinfo.china@sap.com" title="E-Mail SAP">联系我们</a></li>
	<li><a href="http://www.sap.com" target="_blank">SAP 网站</a></li>
</ul>
<!-- END UTILITY NAV BOTTOM --></div>
<!-- END HEADER--></div>
<!--end header content--> <!--googleon: index-->
<div id="page-content">
<div>
<div id="nav-main-standard">
<ul>
	<li><a href="../index/home.asp"><span>主页</span></a></li>
	<li><a href="../reghotel/home.asp"><span>注册/酒店</span></a></li>
	<li><a href="../community/home.asp"><span>社区</span></a></li>
	<li><a href="../about/home.asp"><span>关于大会</span></a></li>
	<li><a href="../sessions/home.asp" class="on"><span>大会内容</span></a></li>
	<li><a href="http://www.sapteched.com/online" target="_blank"><span>SAP
	全球技术研发者大会虚拟版</span></a></li>
	<li><a href="../activities/home.asp"><span>大会日程</span></a></li>
	<li><a href="../exhibitors/home.asp"><span>参展商</span></a></li>
	<!--<li><a href="#"><span>Nav Item 9</span></a></li>-->
</ul>
</div>
<!-- END MAIN NAV --></div>

<div id="sub">
<div id="subtop" class="clearfix">
<ul id="nav-sub" class="clearfix">
	      <li><a href="home.asp" ><span>内容概要</span></a></li>
          <li><a href="schedulings.asp"  ><span>D-Code日程</span></a></li>
          <li><a href="vr_sessions.asp"   ><span>价值实现区日程</span></a></li>
          <li><a href="tracks.asp"   ><span>课题大类</span></a></li>
          <li><a href="speakers.asp" class="on" ><span>大会讲师</span></a></li>
</ul>

<div id="subtop-video-left1">
<h1>演讲者详情</h1>

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
<h3><?php echo $item['cn_fullname']; ?></h3>
<br />
<br />

<?php echo $item['cn_jobtitle']; ?><br />
<br />
<?php echo $item['cn_bio']; ?> <br />
</div>
<div style="width: 800px; height: 100px; float: left; padding-top: 30px;">
<h3>相关课程</h3>
<ul>

<?php foreach($sessions as $item2): ?>
	<li><a href="<?php echo $item2['SessionID'].'.asp'; ?>"><?php echo $item2['SessionID']."&nbsp;&nbsp;".$item2['Title_cn']; ?></a>
	<?php if ($item2['TypeID'] == 1) echo '<img src="../../images/1hr_lecture.gif" border="0" alt="1小时讲座" />'; else if  ($item2['TypeID'] == 3) echo '<img src="../../images/2hr_handson.gif" border="0" alt="2小时实践操作" />';  else if  ($item2['TypeID'] == 51) echo '<img src="../../images/0.5hr_lecture.gif" border="0" alt="半小时讲座" />'; else if  ($item2['TypeID'] == 201) echo '<img src="../../images/3hr_demobooth.gif" border="0" alt="演示展台" />'; else echo $item2['Type_cn']; ?>
	</li>
	<?php endforeach; ?>

</ul>

</div>
</div>

</div>

</div>
<!-- SPACE RESERVED FOR ANALYTICS  -->
<div id="sap-news">
<p class="news-heading rm_newsExpand"><a href="">SAP 全球技术研发者大会新闻</a></p>
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
