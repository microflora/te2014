<?php 
function is_role($role)
{	
	$CI =& get_instance();
	$roles = $CI->session->userdata('roles');
	$pos = stripos($roles, $role);
	
	if ($pos !== FALSE) {
	    return TRUE;
	} 
	
	return FALSE;
}
?>

<div class="LeftNavigation">

<div
	class="<?php if (($activemenu == "Speaker_Site_Home") or ($activemenu == "Upload_Photo")) echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../main/home.html"
	onfocus="this.blur()" title="Speaker Site Home"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Speaker Site Home" /></a></div>
<p class="LeftNavLevel01"><a href="../main/home.html"
	title="Speaker Site Home">Speaker Site Home</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Proposal_and_Speaking_Guidelines") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../main/guidelines.html"
	onfocus="this.blur()" title="Speaker Guidelines"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Speaker Guidelines" /></a></div>
<p class="LeftNavLevel01"><a href="../main/guidelines.html"
	title="Speaker Guidelines">Speaker Guidelines</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Sign_Up_for_Global_Sessions") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../signup4global/start.html"
	onfocus="this.blur()" title="Sign Up As Speaker"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Sign Up As Speaker" /></a></div>
<p class="LeftNavLevel01"><a href="../signup4global/start.html"
	title="Sign Up As Speaker">Sign Up As Speaker</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Propose_Local_Sessions") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../proposesession/start.html"
	onfocus="this.blur()" title="Propose Local Sessions"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Propose Local Sessions" /></a></div>
<p class="LeftNavLevel01"><a href="../proposesession/start.html"
	title="Propose Local Sessions">Propose Local Sessions</a></p>
</div>
</div>

<!--
<div
	class="<?php if ($activemenu == "Sign_Up_for_Local_Sessions") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../main/signuplocal.html"
	onfocus="this.blur()" title="Sign Up for Local Sessions"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Sign Up for Local Sessions" /></a></div>
<p class="LeftNavLevel01"><a href="../main/signuplocal.html"
	title="Sign Up for Local Sessions">Sign Up for Local Sessions</a></p>
</div>
</div>
-->
<!--
<div
	class="<?php if ($activemenu == "Session_Evaluations") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../main/eval.html"
	onfocus="this.blur()" title="Session Evaluations"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Session Evaluations" /></a></div>
<p class="LeftNavLevel01"><a href="../main/eval.html"
	title="Session Evaluations">Session Evaluations</a></p>
</div>
</div>
 -->
 
<div
	class="<?php if ($activemenu == "My_Workspace") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../workspace/start.html"
	onfocus="this.blur()" title="My Sessions"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="My Sessions" /></a></div>
<p class="LeftNavLevel01"><a href="../workspace/start.html"
	title="My Sessions">My Sessions</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Modify_Personal_Information") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../profile/start.html"
	onfocus="this.blur()" title="Modify Personal Information"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Modify Personal Information" /></a></div>
<p class="LeftNavLevel01"><a href="../profile/start.html"
	title="Modify Personal Information">Modify Personal Information</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Change_My_Password") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../main/changepassword.html"
	onfocus="this.blur()" title="Change My Password"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Change My Password" /></a></div>
<p class="LeftNavLevel01"><a href="../main/changepassword.html"
	title="Change My Password">Change My Password</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Log_Out") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../account/logout.html"
	onfocus="this.blur()" title="Log Out"><img src="/te_res/spacer.gif"
	width="200" height="40" border="0" alt="Log Out" /></a></div>
<p class="LeftNavLevel01"><a href="../account/logout.html"
	title="Log Out">Log Out</a></p>
</div>
</div>

<?php if (is_role('Editor')) {?> 
<!-- Start the block for Editor role -->
<strong>Editor's menu</strong><br/>

<div
	class="<?php if ($activemenu == "Editor_Edit_Translation") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../editor/edit_translation.html"
	onfocus="this.blur()" title="Edit Translation"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Edit Translation" /></a></div>
<p class="LeftNavLevel01"><a href="../editor/edit_translation.html"
	title="Edit Translation">Edit Translation</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Editor_Edit_Speaker") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../editor/edit_speaker.html"
	onfocus="this.blur()" title="Edit Speaker"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Edit Speaker" /></a></div>
<p class="LeftNavLevel01"><a href="../editor/edit_speaker.html"
	title="Edit Speaker">Edit Speaker</a></p>
</div>
</div>

<div
	class="<?php if ($activemenu == "Editor_Generate_Html") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../editor/generate_html.html"
	onfocus="this.blur()" title="Generate HTML"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Generate HTML" /></a></div>
<p class="LeftNavLevel01"><a href="../editor/generate_html.html"
	title="Generate HTML">Generate HTML</a></p>
</div>
</div>
<!-- End the block for Editor role -->
<?php } ?>

<?php if (is_role('Administrator')) {?> 
<!-- Start the block for Administrator role -->
<strong>Administrator's menu</strong><br/>
<div
	class="<?php if ($activemenu == "Admin_Assign_Speaker") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../admin/assign_speaker.html"
	onfocus="this.blur()" title="Assign Speaker"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Assign Speaker" /></a></div>
<p class="LeftNavLevel01"><a href="../admin/assign_speaker.html"
	title="Assign Speaker">Assign Speaker</a></p>
</div>
</div>
<div
	class="<?php if ($activemenu == "Admin_Assign_Translator") echo "LeftNavActiveBg"; else echo "LeftNavMediumBg"; ?>">
<div class="LeftNavArrowDn">
<div class="LeftNavItem"><a href="../admin/assign_translator.html"
	onfocus="this.blur()" title="Assign Translator"><img
	src="/te_res/spacer.gif" width="200" height="40" border="0"
	alt="Assign Translator" /></a></div>
<p class="LeftNavLevel01"><a href="../admin/assign_translator.html"
	title="Assign Translator">Assign Translator</a></p>
</div>
</div>
<!-- End the block for Editor role -->
<?php } ?>

</div>