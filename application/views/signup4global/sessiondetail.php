<table border="0" cellpadding="0" cellspacing="1" width="100%"
	align="left">
	<?php foreach($sessions as $item):?>
	<tr>
		<td align="center" valign="middle" colspan="2" class="DataTableTHDove"><?php if ($isSpeaker) {echo "Cancel"; } else {echo "Sign up";} ?>
		Yourself as the Speaker for Session <?php echo $item['SessionID']; ?></td>
	</tr>
	<tr>
		<td>
		<table border="0" cellpadding="5" cellspacing="0" width="100%"
			class="DataTable">

			<tr class="DataTableRow01Dove">
				<td align="right" valign="middle" colspan="2"><img
					src="/graphics/blank.gif" width="1" height="2" border="0"></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" width="30%"><b>Session ID:</b></td>
				<td valign="middle" width="70%"><?php echo $item['SessionID']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" width="30%"><b>Session Title:</b></td>
				<td valign="middle" width="70%"><?php echo $item['Title']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Track:</b></td>
				<td valign="middle"><?php echo $item['Track']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right"><b>Session Level:</b></td>
				<td valign="middle"><?php echo $item['Level']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right"><b>Session Type:</b></td>
				<td valign="middle"><?php echo $item['Type']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Session Abstract:</b></td>
				<td valign="middle"><?php echo $item['Abstract']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Prerequisites:</b></td>

				<td valign="middle"><?php echo $item['Prerequisites']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Session Owner:</b></td>
				<td valign="middle"><?php echo $item['SessionOwner']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>China Speaker Applicant:</b></td>
				<td valign="middle"><?php foreach($speakers as $item2): ?><a
					href="<?php echo "mailto:".$item2['email']; ?>"><?php echo $item2['lastname'].", ".$item2['firstname']; ?></a>;&nbsp;<?php endforeach; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Translator Applicant:</b></td>
				<td valign="middle"><?php foreach($translators as $item2): ?><a
					href="<?php echo "mailto:".$item2['email']; ?>"><?php echo $item2['lastname'].", ".$item2['firstname']; ?></a>;&nbsp;<?php endforeach; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td colspan="2" align="center">
				<p>&nbsp;</p>
				</td>
			</tr>
			<tr class="DataTableRow02Dove">
				<td align="right" valign="top"><strong>I will deliver session in: </strong>
				<font color="red"><?php echo form_error('language'); ?></font></td>
				<td valign="top"><?php if ($isSpeaker) {
					if ($language ==1) echo '中文/Mandarin'; else echo 'English'; ?>
					<?php } else {?> <input type="radio" name="language" value="1"
					<?php if ($language ==1) echo 'checked="checked"'; ?> />中文/Mandarin<input
					type="radio" name="language" value="2"
					<?php if ($language ==2) echo 'checked="checked"'; ?> />English <?php }?>
				</td>
			</tr>
			<tr class="DataTableRow02Dove">
				<td align="right" valign="top"><strong>Apply for as the slides
				translator: </strong> <font color="red"><?php echo form_error('translator'); ?></font></td>
				<td valign="top"><?php if ($isSpeaker) {
					if ($isTranslator) echo 'Yes'; else echo 'No'; ?> <?php } else {?>
				<input type="radio" name="translator" value="1"
				<?php if ($isTranslator) echo 'checked="checked"'; ?> />Yes<input
					type="radio" name="translator" value="2"
					<?php if (!$isTranslator && ($isTranslator != NULL)) echo 'checked="checked"'; ?> />No<br />
				Speaker is encouraged to translate the slide for quality and better
				understanding. When approved, TechEd team will grant the translator
				a small incentive of 500 RMB / session.<?php }?></td>
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
									href="javascript:__doPostBack('<?php if ($isSpeaker) {echo "Unsign"; } else {echo "SignUp"; }?>',<?php echo $item['SID']; ?>)"
									onmouseout="window.status='';return true;"><?php if ($isSpeaker) {echo "Unsign"; } else {echo "Sign&nbsp;Up"; }?></a></td>
								<td dir="ltr" width="10" height="21"><img
									src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
									width="10" /></td>
							</tr>
						</table>
						</td>
						<?php if ($isSpeaker) { ?>
						<td align="right">
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
						<?php } ?>
					</tr>
				</table>
				</td>
			</tr>

		</table>

		</td>
	</tr>

	<?php endforeach; ?>

</table>
