
<div id="tooltip"></div>
<script
	language="javascript" type="text/javascript" src="/te_res/ddtooltip.js"></script>
<script>
	function isBlank(s) {
		for (var i = 0; i < s.length; i++) {
			var c = s.charAt(i);
			if ((c != ' ') && (c != '\n') && (c != '\t'))
				return false;
		}
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
		if (isBlank(f.opwd.value)) {
			ok = 0;
			blank = true;
			msg2 += "\tOld Password\n";
		}
		if (isBlank(f.upwd1.value)) {
			ok = 0;
			blank = true;
			msg2 += "\tNew Password\n";
		}
		if (isBlank(f.upwd2.value)) {
			ok = 0;
			blank = true;
			msg2 += "\tConfirm Password\n";
		}
		if (ok == 1) {
			if (f.upwd1.value.length < 5 || f.upwd1.value.length > 15) {
				ok = 0;
				msg2 += "\n\n- New password should be 5-15 characters long\n";
			}
			if (f.upwd1.value != f.upwd2.value) {
				ok = 0;
				msg2 += "\n\n- Password you've confirmed is different then the new password\n";
			}
		}
		if (ok == 1) {
			f.submit();
		} else {
			if (blank){
				msg += "\n\n- The following field(s) are blank and require a value:\n";
			}
			msg = msg + msg2
			alert(msg);
		}
	}
	</script>

<p></p>
<h1>Change my password</h1>

<p><b class="red">All fields are required.</b></p>
<form action="../main/changepassword.html" method="POST"><input type="Hidden"
	name="action" value="pwdUpdate" />
<table cellspacing="1" cellpadding="3" width="100%"
	class="DataTableDove">
	<tr class="DataTableTHDove">
		<th align="left">Login Information</th>

	</tr>
	<tr class="DataTableRow01Dove">
		<td valign="top">
		<table border="0" cellpadding="4" cellspacing="0" width="95%">
			<tr>
				<td align="right" valign="top"><b>Old Password:</b></td>
				<td valign="middle"><input type="password" name="opwd" size="30"
					maxlength="15" /><?php echo form_error('opwd'); ?></td>
			</tr>

			<tr>
				<td align="right" valign="top"><b>New Password:</b></td>
				<td valign="middle"><input type="password" name="upwd1" size="30"
					maxlength="15" /><?php echo form_error('upwd1'); ?></td>
			</tr>
			<tr>
				<td align="right" valign="top"><b>Confirm Password:</b></td>
				<td valign="middle"><input type="password" name="upwd2" size="30"
					maxlength="15" /><?php echo form_error('upwd2'); ?></td>
			</tr>

			<tr>
				<td colspan="2">
				<p>Please enter a <b>password</b> that you can remember easily.<br/><strong>Note:</strong>
				Your password should be 5-15 characters long, and is case-sensitive.</p>
				<table border="0" cellspacing="0" cellpadding="2">
					<tr>

						<td align="left">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
									width="10" /></td>
								<td height="21" align="center" valign="middle"
									class="ButtonDove" nowrap="nowrap">&nbsp;<a
									href="javascript:history.back();"
									onmouseout="window.status='';return true;">&laquo;&nbsp;Back</a></td>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
									width="10" /></td>
							</tr>
						</table>

						</td>
						<td align="center">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
									width="10" /></td>
								<td height="21" align="center" valign="middle"
									class="ButtonDove" nowrap="nowrap">&nbsp;<a
									href="javascript:checkForm();"
									onmouseout="window.status='';return true;">Change</a></td>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
									width="10" /></td>
							</tr>

						</table>
						</td>
						<td align="right">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
									width="10" /></td>
								<td height="21" align="center" valign="middle"
									class="ButtonDove" nowrap="nowrap">&nbsp;<a href="../main/home.html"
									onmouseout="window.status='';return true;">Cancel</a></td>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
									width="10" /></td>

							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>

</table>
</form>
