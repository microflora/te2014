<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Language" content="en-US" />
<meta name="skin" content="experience" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="../../global/ui/css/sapcom.css" />
<link rel="stylesheet" type="text/css" media="all" href="../../global/ui/css/events.css" />
<link rel="stylesheet" type="text/css" media="print" href="../../global/ui/css/print.css" />
<title>SAP TechEd 2014 Shanghai</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<script type="text/javascript" src="../../global/ui/js/jquery.js"></script>
<!-- Rich Media Scripts -->
<script language="javascript" type="text/javascript" data-main="utils/rm_initializer" src="../../global/ui/richmedia/js/require.js"> </script>
<link rel="stylesheet" type="text/css" href="../../global/ui/richmedia/css/UMP/rm_UMP_css.css" />
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
<div id="page">
  <!--begin header content-->
  <!--googleoff: index-->
 <div id="headercontent">
    <div id="header">
      <q><a href="../index/home.asp" title="SAP"><img src="../../global/ui/images/logos/SAPTECHED_CH2012CN.png" alt="SAP Teched"></a></q>
        <ul id="nav-utility-singleline">
      <li id="utilitynav-phone"><a href="../../en/index/home.asp?id=1">English</a></li>
        <li id="utilitynav-phone"><a href="http://www.sapteched.com/" target="_blank">SAP TechEd 全球网站</a></li>
        <li><a href="mailto:saptechedinfo.china@sap.com" title="E-Mail SAP">联系我们</a></li>
        <li><a href="http://www.sap.com" target="_blank">SAP 网站</a></li>
      </ul>
      <!-- END UTILITY NAV BOTTOM -->
    </div>
    <!-- END HEADER-->
  </div>
  <!--end header content-->
  <!--googleon: index-->
  <div id="page-content">
    <div>
      <div id="nav-main-standard">
        <ul>
         <li><a href="../index/home.asp" ><span>主页</span></a></li>
          <li><a href="../reghotel/home.asp" ><span>注册/酒店</span></a></li>
          <li><a href="../community/home.asp"><span>社区</span></a></li>
          <li><a href="../about/home.asp" ><span>关于大会</span></a></li>
          <li><a href="../sessions/home.asp" class="on"><span>大会内容</span></a></li>
          <li><a href="http://www.sapteched.com/online" target="_blank"><span>SAP 全球技术研发者大会虚拟版</span></a></li>
          <li><a href="../activities/home.asp" ><span>大会日程</span></a></li>
          <li><a href="../exhibitors/home.asp"><span>参展商</span></a></li>
          <!--<li><a href="#"><span>Nav Item 9</span></a></li>-->
        </ul>
      </div>
      <!-- END MAIN NAV -->
    </div>
    
    
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
          <li><a href="home.asp" ><span>内容概要</span></a></li>
          <li><a href="schedulings.asp"  ><span>TechEd日程</span></a></li>
          <li><a href="vr_sessions.asp" class="on"  ><span>价值实现区日程</span></a></li>
          <li><a href="tracks.asp"   ><span>课题大类</span></a></li>
          <li><a href="speakers.asp"  ><span>大会讲师</span></a></li>
        </ul>
        
        <div id="subtop-video-left1">
          <h1>大会日程</h1>
         
       
          
        </div>
      </div>
      <div id="subbottom" class="clearfix">
       <div style="float:left; width:900px; overflow:hidden;">
        
      <div id="dayAgendas" class="agenda-wrapper">
          <div class="show"> 
            
           
          
            <table width="900" class=" agenda3">
            
              <thead>
                <tr>
                  <th width="100" >日期/时间</th>
                    <th width="536" >课题</th>
                      <th width="79" >类型</th>
                        <th width="72" >语言</th>
                          <th width="106" >地点</th>
				 
                 
                </tr>
              </thead>
             
             
              <?php 
					$tempdate = "";
					$tempstart = "";
					$tempend = "";
					$needTR = FALSE;

					foreach($vrschedulings as $item):
					if ($tempdate != $item["sessiondate"]) {

						if ($needTR) { ?>
                          </table>
					</td>
				</tr>

              
              	<?php $needTR = FALSE;
						} ?>


              
              <tr>
              	<td colspan="5" class="agenda5"><?php echo date_format(date_create($item["sessiondate"]), "m月d日")."&nbsp;&nbsp;&nbsp;专题：".$item["Track_cn"]; ?></td>
              </tr>
              
                
              <?php
					$tempdate = $item["sessiondate"];
					}

					if (($tempstart != $item["starttime"]) || ($tempend != $item["endtime"])) {

						if ($needTR) { ?>
             </table>
					</td>
				</tr>
					
              
              <?php $needTR = FALSE;
						} ?>

            
              
              <!--begin-->
              <tr>
                <td width="100"><?php echo date_format(date_create($item["starttime"]), "H:i")."-".date_format(date_create($item["endtime"]), "H:i"); ?></td>
				<td  colspan="4">
					<table width="800" class="agenda4">
						<tr>
                   			<td width="560">
                   			<?php if ($item['SID']>0) {?>
                   			<a href="<?php echo $item['SessionID'].'.asp'; ?>"><?php echo $item['SessionID']."&nbsp;".$item['EditedTitle_cn']; ?></a>
                   			<?php } else {?>
                   			<?php echo $item['SessionID']."&nbsp;".$item['Title_cn']; ?>
                   			<?php }?>
                   			</td>
                			<td width="80" > <?php if ($item['TypeID'] == 1) echo '<img src="../../images/1hr_lecture.gif" border="0" alt="1小时讲座" />'; else if  ($item['TypeID'] == 3) echo '<img src="../../images/2hr_handson.gif" border="0" alt="2小时实践操作" />';  else if  ($item['TypeID'] == 51) echo '<img src="../../images/0.5hr_lecture.gif" border="0" alt="半小时讲座" />'; else if  ($item['TypeID'] == 201) echo '<img src="../../images/3hr_demobooth.gif" border="0" alt="演示展台" />'; else echo $item['Type_cn']; ?></td>
                			<td width="70" ><?php if ($item['Language'] == 1) echo "中文"; else if  ($item['Language'] == 2) echo "英文"; else echo "未知"; ?></td>
                			<td width="100" ><?php if ($item['room_cn'] <> "") echo $item['room_cn'];?></td>
              			</tr>
          
              
               	<?php
					 	$needTR = TRUE;
					 	$tempstart = $item["starttime"];
					 	$tempend = $item["endtime"];
					} else {
						?>
              
            			<tr>
                   			<td width="560">
                   			<?php if ($item['SID']>0) {?>
                   			<a href="<?php echo $item['SessionID'].'.asp'; ?>"><?php echo $item['SessionID']."&nbsp;".$item['EditedTitle_cn']; ?></a>
                   			<?php } else {?>
                   			<?php echo $item['SessionID']."&nbsp;".$item['Title_cn']; ?>
                   			<?php }?>
                   			</td>
                    		<td width="80"><?php if ($item['TypeID'] == 1) echo '<img src="../../images/1hr_lecture.gif" border="0" alt="1小时讲座" />'; else if  ($item['TypeID'] == 3) echo '<img src="../../images/2hr_handson.gif" border="0" alt="2小时实践操作" />';  else if  ($item['TypeID'] == 51) echo '<img src="../../images/0.5hr_lecture.gif" border="0" alt="半小时讲座" />'; else if  ($item['TypeID'] == 201) echo '<img src="../../images/3hr_demobooth.gif" border="0" alt="演示展台" />'; else echo $item['Type_cn']; ?></td>
                    		<td width="70"><?php if ($item['Language'] == 1) echo "中文"; else if  ($item['Language'] == 2) echo "英文"; else echo "未知"; ?></td>
                   			<td width="100"><?php if ($item['room_cn'] <> "") echo $item['room_cn'];?></td>
						</tr>
              
             
          
            	<?php
					}

					endforeach;

					if ($needTR) { ?>
            	
            	
                	</table>
               </td>
               </tr>
						
              
           
                 	<?php $needTR = FALSE;
					} ?>
              
        
              
                    
                    	           
            </table>
            

          </div>
          
        </div>
       
          
        </div>
       
       
       
       
       
       
       
       
       
       
       
       
        
      </div>
     
      
      
    </div>
    <!-- SPACE RESERVED FOR ANALYTICS  -->
    <div id="sap-news">
     <p class="news-heading rm_newsExpand"><a href="">SAP 全球技术研发者大会新闻</a></p>
     <!--#include file="../top.asp"-->
    </div>
    <!-- END SAP NEWS -->
  </div>
  <!-- END PAGE CONTENT -->
  <div id="footer">
  <!--#include file="../buttom.asp"-->
  </div>
  <!-- END FOOTER -->
</div>


</body>
</html>