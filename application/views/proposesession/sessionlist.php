<script>
$(document).ready(function() {
	$('a.sessiondetail_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
	$('a.sessiontranslation_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
});
</script>
<h1>Propose Local for Sessions</h1>
<p><font color="red"><strong>IMPORTANT:</strong></font> Please propose
the sessions. Then, TechEd team will decide the final session list for
China event according to the speaker availability and the local market
requirement. Final speaker assignments are subject to change, based on
TechEd team review.</p>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">


	<tr class="DataTableTH">
		<td colspan="2">My Owned Sessions (<?php echo count($sessions); ?>)&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td valign="middle">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a href="javascript:__doPostBack('Add', '')"
					onmouseout="window.status='';return true;">Add</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		</td>
		<td colspan="3"><input name="showchinaapproved" type="checkbox"
			value="TRUE" <?php if ($showchinaapproved) echo "checked";?>
			onclick="javascript:__doPostBack('List','')">Only Show Approved
		Sessions</td>
	</tr>

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title (Select to view session details)</th>
		<th valign="middle">Track</th>
		<th valign="middle">Level</th>
		<th valign="middle">Type</th>
		<th valign="middle">Status</th>

	</tr>
	<?php $temp = "DataTableRow01";
	foreach($sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="top"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="top"><a id="SignUp_lnkList"
			class="sessiondetail_tip"
			href="javascript:__doPostBack('Update',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item['SID']; ?>"><?php echo $item['Title']; ?>
		</a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="javascript:__doPostBack('Update',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item['SID']; ?>"><?php echo $item['Title_cn']; ?>
		</a></td>
		<td align="left" valign="top"><?php echo $item['Track']; ?></td>
		<td align="left" valign="top"><?php echo $item['Level']; ?></td>
		<td align="left" valign="top"><?php echo $item['Type']; ?></td>
		<td align="left" valign="top"><?php echo $item['China']; ?></td>
	</tr>
	<?php
	if ($temp == "DataTableRow01") {
		$temp = "DataTableRow02";
	} else {
		$temp = "DataTableRow01";
	}
	endforeach; ?>

	<tr class="DataTableFooter">
		<td colspan="6"></td>
	</tr>
</table>
