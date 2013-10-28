<h1>Edit Approved Speakers</h1>

<a href="../report/approved_speaker_bio_list" target="_bland">export all</a>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<th valign="middle">Name</th>
		<th valign="middle">Bio</th>
		<th valign="middle">简历</th>
	</tr>

	<?php $temp = "DataTableRow01";
	foreach($speakers as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"><?php echo $item['LastName'].", ".$item['FirstName']; ?>
		<br />
		<?php echo $item['cn_FullName']; ?>
		<br />
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack('Edit',<?php echo $item['ID']; ?>)"
					onmouseout="window.status='';return true;">Edit</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		</td>
		<td align="left" valign="middle"><?php echo $item['Bio']; ?></td>
		<td align="left" valign="middle"><?php echo $item['cn_Bio']; ?></td>
	</tr>
	<?php
	if ($temp == "DataTableRow01") {
		$temp = "DataTableRow02";
	} else {
		$temp = "DataTableRow01";
	}
	endforeach; ?>

	<tr class="DataTableFooter">
		<td colspan="3"></td>
	</tr>
</table>
