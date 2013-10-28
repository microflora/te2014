<h1>Edit Translation</h1>

<a href="../report/session_translation_list.html" target="_bland">export all</a>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title</th>
		<th valign="middle">Abstract</th>
		<th valign="middle">Prerequisites</th>
	</tr>

	<?php $temp = "DataTableRow01";
	foreach($sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle" rowspan="2"><?php echo $item['SessionID']; ?>
		<br />
		<br />
		<?php if ($SelectedSID == $item['SID']) {?>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack('Save',<?php echo $item['SID']; ?>)"
					onmouseout="window.status='';return true;">Save</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>

		<br />

		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack('Cancel',<?php echo $item['SID']; ?>)"
					onmouseout="window.status='';return true;">Cancel</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		<?php } else {?>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack('Edit',<?php echo $item['SID']; ?>)"
					onmouseout="window.status='';return true;">Edit</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		<?php }?></td>
		<td align="left" valign="middle"><?php echo $item['Title']; ?></td>
		<td align="left" valign="middle"><?php echo $item['Abstract']; ?></td>
		<td align="left" valign="middle"><?php echo $item['Prerequisites']; ?></td>
	</tr>
	<?php if ($SelectedSID == $item['SID']) {?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"><font color="red"><?php echo form_error('title_cn'); ?></font>
		<textarea name="title_cn" cols="15" rows="8"><?php if (isset($title_cn)) echo $title_cn; else echo $item['Title_cn']; ?></textarea></td>
		<td align="left" valign="middle"><font color="red"><?php echo form_error('abstract_cn'); ?></font>
		<textarea name="abstract_cn" cols="40" rows="8"><?php if (isset($abstract_cn)) echo $abstract_cn; else echo $item['Abstract_cn'];?></textarea></td>
		<td align="left" valign="middle"><font color="red"><?php echo form_error('prerequisites_cn'); ?></font>
		<textarea name="prerequisites_cn" cols="15" rows="8"><?php if (isset($prerequisites_cn)) echo $prerequisites_cn; else echo $item['Prerequisites_cn']; ?></textarea></td>
	</tr>
	<?php } else {?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"><?php echo $item['Title_cn']; ?></td>
		<td align="left" valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Abstract_cn']); ?></td>
		<td align="left" valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Prerequisites_cn']); ?></td>
	</tr>
	<?php } ?>
	<?php
	if ($temp == "DataTableRow01") {
		$temp = "DataTableRow02";
	} else {
		$temp = "DataTableRow01";
	}
	endforeach; ?>

	<tr class="DataTableFooter">
		<td colspan="5"></td>
	</tr>
</table>
