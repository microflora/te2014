<script type="text/javascript">  
function title_cn_char_count(){
	$('#title_cn_char_count').html($('#title_cn').val().length); 
}  

function abstract_cn_char_count(){
	$('#abstract_cn_char_count').html($('#abstract_cn').val().length); 
}  

function prerequisites_cn_char_count(){
	$('#prerequisites_cn_char_count').html($('#prerequisites_cn').val().length); 
}  
</script>

<table border="0" cellpadding="0" cellspacing="1" width="100%"
	align="left">
	<?php foreach($sessions as $item):?>
	<tr>
		<td align="center" valign="middle" colspan="2" class="DataTableTHDove">Review
		the Translation for Session <?php echo $item['SessionID']; ?></td>
	</tr>
	<tr>
		<td>
		<table border="0" cellpadding="5" cellspacing="0" width="100%"
			class="DataTable">

			<tr class="DataTableRow01Dove">
				<td align="left" valign="middle" colspan="2"><img
					src="/graphics/blank.gif" width="1" height="2" border="0">Thank you
				for sign up as the speaker. If you know Chinese, please reivew
				and/or <strong>update the translation</strong> below. Or <strong>just
				ignore</strong>.</td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="middle" colspan="2"><img
					src="/graphics/blank.gif" width="1" height="2" border="0"></td>
			</tr>

			<tr class="DataTableRow01Dove">
				<td align="right" width="30%"><b>Session Title:</b></td>
				<td valign="middle" width="70%"><?php echo $item['Title']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>中文标题</b></td>
				<td valign="middle">标题的中文翻译请保持简洁，字数控制在50字以内<br />
				<font color="red"><?php echo form_error('title_cn'); ?></font> <input
					id="title_cn" name="title_cn" type="Text" size="80" maxlength="100"
					value="<?php echo $item['Title_cn']; ?>"
					onfocus="cc=setInterval(title_cn_char_count,600)"
					onblur="clearInterval(cc)"><br />
				已经输入了<span id="title_cn_char_count">?</span>个字</td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Session Abstract:</b></td>
				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Abstract']); ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>中文摘要</b></td>
				<td valign="middle">摘要的中文翻译请保持简洁，字数控制在200字左右<br />
				<font color="red"><?php echo form_error('abstract_cn'); ?></font> <textarea
					id="abstract_cn" name="abstract_cn" cols="60" rows="8"
					onfocus="cc=setInterval(abstract_cn_char_count,600)"
					onblur="clearInterval(cc)"><?php echo str_replace("\r\n", "<br />", $item['Abstract_cn']); ?></textarea><br />
				已经输入了<span id="abstract_cn_char_count">?</span>个字</td>
			</tr>
			<?php if ($item['Prerequisites']!="") {?>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Prerequisites:</b></td>
				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Prerequisites']); ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>中文先决条件</b></td>
				<td valign="middle">先决条件的中文翻译请保持简洁，字数控制在100字左右<br />
				<font color="red"><?php echo form_error('prerequisites_cn'); ?></font>
				<textarea id="prerequisites_cn" name="prerequisites_cn" cols="60"
					rows="5" onfocus="cc=setInterval(prerequisites_cn_char_count,600)"
					onblur="clearInterval(cc)"><?php echo str_replace("\r\n", "<br />", $item['Prerequisites_cn']); ?></textarea><br />
				已经输入了<span id="prerequisites_cn_char_count">?</span>个字</td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td colspan="2" align="center">
				<p>&nbsp;</p>
				</td>
			</tr>
			<?php } else { ?>
			<tr class="DataTableRow01Dove">
				<td colspan="2" align="center"><input name="prerequisites_cn"
					type="hidden" value="&nbsp;"></td>
			</tr>

			<?php } ?>

			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Last Updated by:</b></td>
				<td valign="middle"><?php if ($item['Email']!="") {?><a
					href="<?php echo "mailto:".$item['Email']; ?>"> <?php echo $item['Lastname'].", ".$item['Firstname']; ?></a>&nbsp;(<?php echo $item['LastUpdateTime']." GMT"; ?>)&nbsp;
					<?php } else { echo "N/A"; }?></td>
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
									href="javascript:__doPostBack('Translation',<?php echo $item['SID']; ?>)"
									onmouseout="window.status='';return true;">Update&nbsp;Translation</a></td>
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
									href="../signup4global/start.html"
									onmouseout="window.status='';return true;">Just&nbsp;Ignore</a></td>
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

	<?php endforeach; ?>

</table>
