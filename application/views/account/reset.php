<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include 'application/views/htmlhead.php'?>

</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" align="center"
	width="978">
	<tr>
		<td width="2"
			style="background-image: url(/te_res/StageShadowLeftBgRepeat.jpg); background-repeat: repeat-y"></td>
		<td width="972" class="Stage">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<?php include 'application/views/header.php'?>

			<tr>

				<td width="208" valign="top" class="MainLeftPanelBgRepeat">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td height="303"
							style="background-image: url(/te_res/MainLeftPanelBg.jpg); background-repeat: no-repeat;"
							valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td valign="top"><img src="/te_res/Spacer.gif"
									width="8" height="210" alt="" border="0" /></td>
								<td valign="top">


								<div class="LeftNavigation">

								<div class="LeftNavActiveBg">
								<div class="LeftNavArrowDn">
								<div class="LeftNavItem"><a href="login.html"
									onfocus="this.blur()" title="Speaker Site Home"><img
									src="/te_res/spacer.gif" width="200" height="40"
									border="0" alt="Speaker Site Home" /></a></div>
								<p class="LeftNavLevel01"><a href="login.html"
									title="Speaker Site Home">Speaker Site Home</a></p>
								</div>

								</div>

								</div>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>

				</td>
				<td width="732" height="400" align="left" valign="top"
					class="MCPColor">
				<div class="MainContentPanel">
				<div class="Dove">

				<div id="tooltip"></div>
				<script language="javascript" type="text/javascript"
					src="/te_res/ddtooltip.js"></script> <script>
function isBlank(s) {
	for (var i = 0; i < s.length; i++) {
		var c = s.charAt(i);
		if ((c != ' ') && (c != '\n') && (c != '\t'))
			return false;
	}
	return true;
}
function isValidEmailAddr(str) {
	if (str.indexOf(' ') != -1) return false;
	var a = str.split("@");
	if (a.length != 2 || str.charAt(str.length-1) == '@') return false;
	var b = a[1].split(".");
	if (b.length < 2) return false;
	return true;
}

function checkForm() {
	var f = window.document.forms[0];
	var msg = "";
	var msg2 = "";
	var ok = 1;
	var blank = false;
	msg += "The form could not be submitted due to the following errors.\n";
	msg += "Please correct and re-submit.";

	if (isBlank(f.email.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tEmail\n";
	}
	if (isBlank(f.captcha.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tVerification Code\n";
	}
	if (ok == 1) {
		if (!isValidEmailAddr(f.email.value)) {
			ok = 0;
			msg2 += "\n\n- Email Address is not valid\n";
		}
	}
	if (ok == 1) {
		f.submit();
	} else {
		if (blank){
			msg += "\n\n- The following field(s) are blank and require a value:\n";
		}
		msg = msg + msg2;
		alert(msg);
	}
}
</script>

				<h1>SAP TechEd 2014 &ndash; SAP Speaker Site</h1>


				<h2>Request a new password</h2>

				<form action="reset.html" method="post" name="login">
				<table cellspacing="1" cellpadding="3" width="475"
					class="DataTableDove">
					<tr class="DataTableTHDove">
						<th align="left">Returning Visitors</th>
					</tr>

					<tr class="DataTableRow01Dove">
						<td valign="top">
						<table border="0" cellpadding="4" cellspacing="0" width="450">
							<tr>
								<td align="right" valign="middle"><label for="email">Email
								Address<br/>(as provided originally):</label></td>
								<td valign="middle"><input type="text" name="email"
									value="<?php echo set_value('email'); ?>" size="30"
									maxlength="100" id="email" /><?php echo form_error('email'); ?></td>
							</tr>
							<tr>
								<td align="right" valign="top"><?php echo $captcha; ?></td>
								<td valign="middle"><input type="text" name="captcha"
									value="<?php echo set_value('captcha'); ?>" size="4"
									maxlength="4" id="captcha" style="width: 60px" /><?php echo form_error('captcha'); ?></td>
							</tr>
							<tr>
								<td colspan="2">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td dir="ltr" width="10" height="21"><img
											src="/te_res/ButtonLeftDove.gif" border="0" alt=""
											height="21" width="10" /></td>
										<td height="21" align="center" valign="middle"
											class="ButtonDove" nowrap="nowrap">&nbsp;<a
											href="javascript:checkForm();"
											onmouseout="window.status='';return true;">Reset Password</a></td>
										<td dir="ltr" width="10" height="21"><img
											src="/te_res/ButtonRightDove.gif" border="0" alt=""
											height="21" width="10" /></td>
									</tr>
								</table>

								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</form>
				</div>
				</div>

				</td>
			</tr>
			<tr>
				<td colspan="3" height="16"><img src="/te_res/Spacer.gif"
					width="1" height="16" alt="" border="0" /></td>
			</tr>
		</table>
		</td>
		<td width="4"
			style="background-image: url(/te_res/StageShadowRightBgRepeat.jpg); background-repeat: repeat-y"></td>
	</tr>

	<?php include 'application/views/footer.php'?>

</table>

</body>
</html>
