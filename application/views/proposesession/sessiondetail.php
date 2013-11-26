<script type="text/javascript">  
function Title_char_count(){  
	  $('#Title_char_count').html($('#Title').val().length); 
	}  

function Abstract_char_count(){  
	  $('#Abstract_char_count').html($('#Abstract').val().length); 
	}  

function Prerequisites_char_count(){  
  $('#Prerequisites_char_count').html($('#Prerequisites').val().length); 
}  

function Title_cn_char_count(){  
	  $('#Title_cn_char_count').html($('#Title_cn').val().length); 
	}  

function Abstract_cn_char_count(){  
	  $('#Abstract_cn_char_count').html($('#Abstract_cn').val().length); 
	}  

function Prerequisites_cn_char_count(){  
  $('#Prerequisites_cn_char_count').html($('#Prerequisites_cn').val().length); 
}  
</script>
<h1>Propose a Session</h1>
<p></p>
<h3>Important Note</h3>
<ul>
	<li>By submitting this proposal you agree to complete all tasks by
	listed <a href="../main/guidelines.html">deadlines</a>.</li>
	<li>Session proposals and presentations must not include proprietary or
	confidential material. Presentation materials must be original and must
	not infringe upon any copyright, trademark, or other right of any third
	party.</li>
	<li>Proposals and presentations are reviewed and edited for
	consistency, grammar, spelling, and proper use of trademarks and SAP
	offering names.</li>
	<li>By submitting a session proposal, you grant to SAP a non-exclusive,
	and perpetual, worldwide right to publish the presentation materials in
	any and all media, including but not limited to SAP Websites, printed
	conference collateral, Webcasts, and Virtual SAP D-Code.</li>
</ul>

<script>
	var arrTracks = new Array(<?php echo count($subtrack)?>);
		for (var i = 0; i < <?php echo count($subtrack)?>; i++) {
		arrTracks[i] = new Array(3);
	}
		<?php 
			$temp =0;
			foreach($subtrack as $item):
		?>
			arrTracks[<?php echo $temp?>][0] = '<?php echo $track[$item['trackid']]?>';
			arrTracks[<?php echo $temp?>][1] = '<?php echo $item['subtrackid']?>';
			arrTracks[<?php echo $temp?>][2] = '<?php echo $item['trackid']?>';
		<?php
			$temp = $temp + 1;
			endforeach;
		?>


	function getTracks() {
		var trackName = "";
		var trackID = "";
		for(x=0; x < <?php echo count($subtrack)?>; x++) {
			if(arrTracks[x][1] == window.document.forms[0].SubTrackID.value) {
				trackName = arrTracks[x][0];
				trackID = arrTracks[x][2];
				break;
			}
		}
		
		window.document.forms[0].TrackName.value = trackName;
		window.document.forms[0].TrackID.value = trackID;
	} 		
	
</script>

<input
	type="hidden" name="SID" value="<?php echo $mysession['SID'];?>" />

<table cellspacing="1" border="0" cellpadding="3" width="100%"
	class="DataTableDove">
	<tr class="DataTableTHDove">
		<th align="left"><span style="text-transform: uppercase;">Primary
		Session Information</span></th>
	</tr>
	<tr class="DataTableRow01Dove">
		<td valign="top">

		<table border="0" cellpadding="4" cellspacing="0" width="98%">

			<tr>
				<td align="right" width="30%" valign="top"><strong>Session Title:</strong></td>
				<td valign="top" width="70%"><strong>Please limit titles to 75
				characters or less.</strong> Use title case and spell out solution
				names.<br />
				Example: SAP NetWeaver Technology for Custom Development Overview <br />
				<font color="red"><?php echo form_error('Title'); ?></font><input
					id="Title" name="Title" type="Text" size="80" maxlength="100"
					value="<?php echo $mysession['Title']; ?>"
					onfocus="cc=setInterval(Title_char_count,600)"
					onblur="clearInterval(cc)" /><br />
				already inputed <span id="Title_char_count">?</span> characters</td>

			</tr>
			<tr>
				<td align="right" valign="top"><strong>Session Abstract:</strong></td>
				<td valign="top">A good abstract will drive attendance to your
				session, so be detailed, accurate, and clear. The abstract should be
				a short paragraph description of the session that states the purpose
				of the session. Mention if there will be demos, other special
				attractions, or if the content of the session will pertain to
				specific releases of software solutions. List 2-3 bullet points
				describing the specific topics covered in the session. Avoid using
				acronyms. If you do use an acronym, spell out the acronym in the
				abstract. Please double-check your abstracts for grammar, spelling,
				and proper use of trademarks and SAP offering names.<strong>Please
				limit to 500 characters or less</strong><br />
				<font color="red"><?php echo form_error('Abstract'); ?></font> <textarea
					id="Abstract" name="Abstract" cols="60" rows="8"
					onfocus="cc=setInterval(Abstract_char_count,600)"
					onblur="clearInterval(cc)"><?php echo $mysession['Abstract']; ?></textarea><br />
				already inputed <span id="Abstract_char_count">?</span> characters</td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Prerequisites:</strong><br />
				<font size="1">(optional)</font></td>
				<td valign="top">Please list any specific knowledge or experience
				attendees must have in order to understand this session. Be specific
				and clear with your requirements so that you have qualified
				attendees in your session. <strong>Please limit to 200 characters or
				less</strong><br />
				<font color="red"><?php echo form_error('Prerequisites'); ?></font>
				<textarea id="Prerequisites" name="Prerequisites" cols="60" rows="3"
					onfocus="cc=setInterval(Prerequisites_char_count,600)"
					onblur="clearInterval(cc)"><?php echo $mysession['Prerequisites']; ?></textarea><br />
				already inputed <span id="Prerequisites_char_count">?</span>
				characters</td>
			</tr>

			<tr>
				<td align="right" valign="top"><strong>Session Type:</strong></td>
				<td valign="top">Please note: To qualify as a hands-on workshop, the
				session must include exercises for attendees to complete during the
				session.<br />
				<font color="red"><?php echo form_error('SessionTypeID'); ?></font>
				<select name="SessionTypeID" size="1">
				<?php foreach($sessiontype as $item):?>
					<option value="<?php echo $item['sessiontypeid']; ?>"
					<?php if ($item['sessiontypeid'] == $mysession["SessionTypeID"]) {?>
						selected="selected" ;<?php }?>><?php echo $item['sessiontypename'];?></option>
						<?php endforeach; ?>

				</select></td>
			</tr>

			<tr>
				<td align="right" valign="top"><strong>Session Level:</strong></td>

				<td valign="top"><font color="red"><?php echo form_error('SessionLevelID'); ?></font><select
					name="SessionLevelID" size="1">
					<?php foreach($sessionlevel as $item):?>
					<option value="<?php echo $item['sessionlevelid']; ?>"
					<?php if ($item['sessionlevelid'] == $mysession["SessionLevelID"]) {?>
						selected="selected" ;<?php }?>><?php echo $item['sessionlevelname'];?></option>
						<?php endforeach; ?>
				</select></td>

			</tr>

			<tr>
				<td align="right" valign="top"><strong>Sub Track Assignment:</strong></td>
				<td valign="top">Select the sub track under the [track] that most
				closely fits your session. Unsure of which sub track best fits your
				session? Select "Other" in the track that best fits the session.<br />
				<font color="red"><?php echo form_error('SubTrackID'); ?></font> <select
					name="SubTrackID" size="1" onChange="getTracks();">
					<option value="0">Select one...</option>
					<?php $temp = -1; ?>
					<?php foreach($subtrack as $item):?>
					<?php if ($temp <> $item['trackid']) {
						$temp = $item['trackid'];
						?>
					<option value="0">[<?php echo $track[$item['trackid']]?>]</option>
					<?php
					}
					?>
					<option value="<?php echo $item['subtrackid']; ?>"
					<?php if ($item['subtrackid'] == $mysession["SubTrackID"]) {?>
						selected="selected" ;<?php }?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $item['subtrackname'];?></option>
						<?php endforeach; ?>
				</select></td>
			</tr>

			<tr>
				<td align="right" valign="top">Track of the selected sub-track</td>
				<td valign="top"><input readonly name="TrackName" size="60"
					id="TrackName" class="textArea"
					value="<?php echo $mysession['TrackName'];?>" /> <input
					type="hidden" name="TrackID"
					value="<?php echo $mysession['TrackID'];?>" /></td>
			</tr>

			<tr>
				<td align="right" valign="top"><strong>Release timeframe:</strong></td>
				<td valign="top">Select the release timeframe for the product talked
				in your session.<br />
				<font color="red"><?php echo form_error('ReleaseTimeframeID'); ?></font>
				<select name="ReleaseTimeframeID" size="1">
				<?php foreach($releasetime as $item):?>
					<option value="<?php echo $item['releasetimeid']; ?>"
					<?php if ($item['releasetimeid'] == $mysession["ReleaseTimeframeID"]) {?>
						selected="selected" ;<?php }?>><?php echo $item['releasetimename'];?></option>
						<?php endforeach; ?>
				</select></td>
			</tr>


			<tr>
				<td align="right" valign="top"><strong>Job Functions:</strong></td>
				<td valign="top">Carefully select all relevant job functions most
				related to your session. Attendees will be able to view sessions by
				these functions. Choose accurately, since the audiences you attract
				will rate your presentation.<font color="red"><?php echo form_error('JobFunctionIDs'); ?></font></td>
			</tr>
			<tr>
				<td align="right" valign="top"></td>

				<td valign="top">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="70%" valign="top"><?php foreach($jobfunction as $item):?>
						<?php echo form_checkbox('JobFunctionIDs[]', $item['jobfunctionid'], in_array($item['jobfunctionid'], $mysession['JobFunctionIDs'])); ?><?php echo $item['jobfunctionname'];?>
						<br />
						<?php endforeach; ?></td>
						<td width="30%" valign="top">&nbsp;</td>
					</tr>
				</table>
				<br />
				</td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Related Products:</strong></td>
				<td valign="top">Please select the SAP products focused on in your
				session.(Limit to 4)<font color="red"><?php echo form_error('RelatedProductIDs'); ?></font></td>
			</tr>
			<tr>
				<td align="right" valign="top"></td>

				<td valign="top">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="70%" valign="top"><?php foreach($relatedproduct as $item):?>
						<?php echo form_checkbox('RelatedProductIDs[]', $item['relatedproductid'], in_array($item['relatedproductid'], $mysession['RelatedProductIDs'])); ?><?php echo $item['relatedproductname'];?>
						<br />
						<?php endforeach; ?></td>
						<td width="30%" valign="top">&nbsp;<br />
						</td>
					</tr>
				</table>
				<br />
				</td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>Keywords:</strong></td>
				<td valign="top">Please carefully select the most related keywords
				to your session. (Limit to 6)<font color="red"><?php echo form_error('KeywordIDs'); ?></font></td>
			</tr>

			<tr>
				<td align="right" valign="top"></td>
				<td valign="top">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="50%" valign="top"><?php
						$temp = "";
						foreach($keyword as $item):
						$temp1 = ucwords($item['keywordname'][0]);
						if ($temp <> $temp1) {
							$temp = $temp1;
							?>
						<p><font size="2"><b><?php echo $temp; ?></b></font></p>
						<?php
						}
						?> <?php echo form_checkbox('KeywordIDs[]', $item['keywordid'], in_array($item['keywordid'], $mysession['KeywordIDs'])); ?><?php echo $item['keywordname'];?>
						<br />
						<?php endforeach; ?></td>
						<td width="50%" valign="top">&nbsp;<br />
						</td>

					</tr>
				</table>
				<br />
				</td>
			</tr>

			<tr>
				<td colspan="2" align="left"><span
					style="text-transform: uppercase;"><strong>Content Information in
				Chinese / 中文版课程信息</strong></span><br />
				If you know Chinese, please edit the content information in Chinese
				below. /如果你能读写中文，请自助维护以下中文版课程信息。</td>

			</tr>
			<tr>
				<td align="right" width="30%" valign="top"><strong>中文标题：</strong></td>
				<td valign="top" width="70%">标题的中文翻译请保持简洁，字数控制在50字以内<br />
				<font color="red"><?php echo form_error('Title_cn'); ?></font><input
					id="Title_cn" name="Title_cn" type="Text" size="80" maxlength="100"
					value="<?php echo $mysession['Title_cn']; ?>"
					onfocus="cc=setInterval(Title_cn_char_count,600)"
					onblur="clearInterval(cc)" /><br />
				已经输入了<span id="Title_cn_char_count">?</span>个字</td>

			</tr>
			<tr>
				<td align="right" valign="top"><strong>中文摘要：</strong></td>
				<td valign="top">摘要的中文翻译请保持简洁，字数控制在200字以内<br />
				<font color="red"><?php echo form_error('Abstract_cn'); ?></font> <textarea
					id="Abstract_cn" name="Abstract_cn" cols="60" rows="8"
					onfocus="cc=setInterval(Abstract_cn_char_count,600)"
					onblur="clearInterval(cc)"><?php echo $mysession['Abstract_cn']; ?></textarea><br />
				已经输入了<span id="Abstract_cn_char_count">?</span>个字</td>
			</tr>
			<tr>
				<td align="right" valign="top"><strong>中文先决条件：</strong><br />
				
				
				<td valign="top">先决条件的中文翻译请保持简洁，字数控制在100字以内<br />
				<font color="red"><?php echo form_error('Prerequisites_cn'); ?></font>
				<textarea id="Prerequisites_cn" name="Prerequisites_cn" cols="60"
					rows="3" onfocus="cc=setInterval(Prerequisites_cn_char_count,600)"
					onblur="clearInterval(cc)"><?php echo $mysession['Prerequisites_cn']; ?></textarea><br />
				已经输入了<span id="Prerequisites_cn_char_count">?</span>个字</td>
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

						<td align="right">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
									width="10" /></td>
								<td height="21" align="center" valign="middle"
									class="ButtonDove" nowrap="nowrap">&nbsp;<a
									href="javascript:__doPostBack('Save', '<?php echo $mysession['SID']; ?>')"
									onmouseout="window.status='';return true;">Save</a></td>
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
