<div id="tooltip"></div>
<script
	language="javascript" type="text/javascript" src="/te_res/ddtooltip.js"></script>

<script type="text/javascript">  
function countChar_en_bio(){  
  $('#en_bio_char_count').html($('#bio').val().length); 
}  

function countChar_cn_bio(){  
  $('#cn_bio_char_count').html($('#cn_bio').val().length); 
}  
</script>


<h1>Modify Personal Information</h1>

<script>
function isBlank(s) {
	for (var i = 0; i < s.length; i++) {
		var c = s.charAt(i);
		if ((c != ' ') && (c != '\n') && (c != '\t'))
			return false;
	}
	return true;
}

function wordCount(s) {
	var formcontent = s;
	formcontent = formcontent.split(" ");
	return formcontent.length;
}

function isValidEmailAddr(str) { 
	if (str.indexOf(' ') != -1) return false;
	var a = str.split("@");
	if (a.length < 2 || str.charAt(str.length-1) == '@') return false;
	if (str.charAt(str.length-1) == '@') return false;		
	var b = a[1].split(".");
	if (b.length < 2) return false;
	return true;
}

function RadioChecked(obj) {
	for (i=0; i < obj.length; i++) {
		if (obj[i].checked) 
			return true;
	}
	return false;   
}

function checkForm() {
	var f = window.document.editSpeaker;
	var msg = "";
	var msg2 = "";
	var ok = 1;
	var blank = false;
	msg += "The form could not be submitted due to the following errors.\n";
	msg += "Please correct and re-submit.";
	if (isBlank(f.firstname.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tFirst Name\n";
	}
	
	if (isBlank(f.lastname.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tLast Name\n";
	}

	if (isBlank(f.company.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tCompany\n";
	}
	
	if (isBlank(f.jobtitle.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tJob Title\n";
	}
	
	if(f.employeenumber.value==0){
		ok = 0;
		blank = true;
		msg2 += "\tEmployee Number\n";
	}

	if (f.countryid.value == 0) {
		ok = 0;
		blank = true;
		msg2 += "\tCountry\n";
	}
	
	if (isBlank(f.phone.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tPhone Number\n";
	}

	if (isBlank(f.cell.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tCell Phone Number\n";
	}

	if (f.shirtid.value == 0) {
		ok = 0;
		blank = true;
		msg2 += "\tShirt Size\n";
	}
	if (!checkboxChecked(f.gender)) {
			ok = 0;
			blank = true;
			msg2 += "\tGender\n";
	}
	
	if (isBlank(f.bio.value)) {
		ok = 0;
		blank = true;
		msg2 += "\tShort expertise description\n";
	}
	
	if (!checkboxChecked(f.cn_speaker)) {
		ok = 0;
		blank = true;
		msg2 += "\tNative Chinese Speaker\n";
	}
	
	if (!isBlank(f.ccemail.value)) {
		if (!isValidEmailAddr(f.ccemail.value)) {
			ok = 0;
			msg2 += "\n\n- CC Email Address is not valid\n";
		}
	}

	if (f.bio.value.length > 800) {
		ok = 0;
		msg2 += "\n\n- Please limit your English bio: to 800 characters or less\n";
	}		

	if (f.cn_bio.value.length > 250) {
		ok = 0;
		msg2 += "\n\n- Please limit your Chinese bio: to 250 characters or less\n";
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


	function checkboxChecked(obj) {
		for (i=0; i < obj.length; i++) {
			if (obj[i].checked)
			return true;
		}
		return false;   
	}	

</script>

<ul>
	<li>All fields are required unless noted.</li>
	<?php echo validation_errors(); ?>
</ul>
<form action="../profile/update.html" name="editSpeaker" method="POST">
<table cellspacing="1" cellpadding="3" width="100%"
	class="DataTableDove">
	<tr class="DataTableTHDove">

		<th align="left"><span style="text-transform: uppercase;">Primary
		Speaker Information</span></th>
	</tr>
	<tr class="DataTableRow01Dove">
		<td valign="top">
		<table border="0" cellpadding="4" cellspacing="0" width="95%">
			<!-- ATTENTION: This file is used on the CFP and the admin sites -->
			<!-- Any changes to this file will affect both sites -->
			<tr>
				<td width="35%" align="right" valign="top"><strong>Speaker's First
				Name:</strong></td>

				<td width="65%" valign="top"><input type="Text" name="firstname"
					value="<?php echo $speaker['firstname']; ?>" size="50"
					maxlength="50"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Speaker's Last Name:</strong></td>
				<td valign="top"><input type="Text" name="lastname"
					value="<?php echo $speaker['lastname']; ?>" size="50"
					maxlength="50"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Company:</strong></td>

				<td valign="top"><input type="Text" name="company"
					value="<?php echo $speaker['company']; ?>" size="50" maxlength="50"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Job Title:</strong></td>
				<td valign="top"><input type="Text" name="jobtitle"
					value="<?php echo $speaker['jobtitle']; ?>" size="50"
					maxlength="100"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Employee Number:</strong></td>

				<td valign="top"><input type="Text" name="employeenumber"
					value="<?php echo $speaker['employeenumber']; ?>" size="50"
					maxlength="30"></td>
			</tr>

			<tr>

				<td align="right" valign="top"><strong>Country:</strong></td>
				<td valign="top"><select name="countryid" size="1">
				<?php foreach($countries as $item):?>
					<option
					<?php if ($item['countryid']==$speaker['countryid']) echo 'selected'; ?>
						value="<?php echo $item['countryid']; ?>"><?php echo $item['countryname'];?></option>
						<?php endforeach; ?>
				</select></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Phone Number:</strong></td>

				<td valign="top"><input type="Text" name="phone"
					value="<?php echo $speaker['phone']; ?>" size="50" maxlength="30"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Cell Phone Number:</strong></td>
				<td valign="top"><input type="Text" name="cell" size="50"
					maxlength="30" value="<?php echo $speaker['cell']; ?>"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>CC Email Address:</strong> <small>(optional)</small></td>
				<td valign="top">Enter an email address you'd like us to copy when
				sending critical email correspondence.<br>
				<input type="Text" name="ccemail" size="50" maxlength="100"
					value="<?php echo $speaker['ccemail']; ?>"></td>

			</tr>
			<tr>
				<td align="right" valign="top" nowrap><strong><a
					href="https://www.sdn.sap.com" target="_blank">SAP Community
				Network (SCN)</a> User ID:</strong><small>(optional)</small></td>
				<td valign="top">SCN User ID is required to receive contribution
				points.<br>

				For SAP employees, your SCN User ID is your D/I/C number.<br>


				<input type="Text" name="sdnid"
					value="<?php echo $speaker['sdnid']; ?>" size="50" maxlength="50"></td>
			</tr>

			<tr>
				<td align="right" valign="top"><strong>Shirt Size:</strong></td>
				<td valign="top">Shirts will be distributed based on availability at
				the time of registration check-in.<br>
				<select name="shirtid" size="1">
				<?php foreach($shirts as $item):?>
					<option
					<?php if ($item['shirtid']==$speaker['shirtid']) echo 'selected'; ?>
						value="<?php echo $item['shirtid']; ?>"><?php echo $item['shirtname'];?></option>
						<?php endforeach; ?>
				</select>&nbsp;<a href="shirtsize.html" target="_blank">click for
				detail</a></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Gender:</strong></td>
				<td valign="top"><input type="radio" name="gender" value="1"
				<?php if ($speaker['gender']==1) echo 'checked="checked"'; ?> />Male<input
					type="radio" name="gender" value="2"
					<?php if ($speaker['gender']==2) echo 'checked="checked"'; ?> />Female</td>

			</tr>
			<tr>
				<td align="right" valign="top"><strong>Short expertise description:</strong></td>
				<td valign="top">Provide a short description of your area of
				expertise or interest. 800 character limit. (Example: John Doe is
				responsible for the rollout of SAP NetWeaver MDM in the US.) <br />
				<strong>Please proofread and spell check since this will not be
				edited before publishing.</strong> <!--<strong>Please limit to 100 words or less.</strong>--><br>

				<textarea id="bio" name="bio" cols="50" rows="5"
					onfocus="cc=setInterval(countChar_en_bio,600)"
					onblur="clearInterval(cc)"><?php echo $speaker['bio']; ?></textarea>
				already inputed <span id="en_bio_char_count">?</span> characters</td>
			</tr>

			<tr>
				<td align="right" valign="top"><strong>Native Chinese Speaker:</strong></td>
				<td valign="top"><input type="radio" name="cn_speaker" value="1"
				<?php if ($speaker['cn_speaker']==1) echo 'checked="checked"'; ?> />Yes<input
					type="radio" name="cn_speaker" value="2"
					<?php if ($speaker['cn_speaker']==2) echo 'checked="checked"'; ?> />No</td>

			</tr>

			<tr>
				<td colspan="2" align="left"><span
					style="text-transform: uppercase;"><strong>Speaker Information in
				Chinese / 中文版讲师信息</strong></span><br />
				If you know Chinese, please edit the personal information in Chinese
				below. /如果你能读写中文，请自助维护以下中文版讲师信息。</td>

			</tr>

			<tr>
				<td width="35%" align="right" valign="top"><strong>姓名:</strong></td>

				<td width="65%" valign="top"><input type="Text" name="cn_fullname"
					value="<?php echo $speaker['cn_fullname']; ?>" size="50"
					maxlength="50"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>公司:</strong></td>

				<td valign="top"><input type="Text" name="cn_company"
					value="<?php echo $speaker['cn_company']; ?>" size="50"
					maxlength="50"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>职位:</strong></td>
				<td valign="top"><input type="Text" name="cn_jobtitle"
					value="<?php echo $speaker['cn_jobtitle']; ?>" size="50"
					maxlength="100"></td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>个人介绍:</strong></td>
				<td valign="top">请提供250字以内的个人介绍。（例如：李四是SAP中国研究院的产品经理，负责中小企业解决方案财务模块的研发）
				<br />
				<strong>以下内容将直接对外发布，请务必仔细检查。</strong> <!--<strong>Please limit to 100 words or less.</strong>--><br>

				<textarea id="cn_bio" name="cn_bio" cols="50" rows="5"
					onfocus="cc=setInterval(countChar_cn_bio,600)"
					onblur="clearInterval(cc)"><?php echo $speaker['cn_bio']; ?></textarea>
				已经输入了<span id="cn_bio_char_count">?</span>个字</td>
			</tr>

			<tr>
				<td colspan="2">
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
									onmouseout="window.status='';return true;">Update</a></td>
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
									class="ButtonDove" nowrap="nowrap">&nbsp;<a
									href="../main/home.html"
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
	<tr class="DataTableFooterDove">

		<td></td>
	</tr>
</table>
</form>
<p>&nbsp;</p>
