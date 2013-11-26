<script>
$(document).ready(function() {
	$('a.sessiondetail_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
	$('a.sessiontranslation_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
});
</script>
<h1>Sign Up for Sessions</h1>

<p><font color="red"><strong>IMPORTANT:</strong></font> Please sign up
as a speaker for the sessions listed below. Then, D-Code team will
decide the final session list for China event according to the speaker
availability and the local market requirement. Final speaker assignments
are subject to change, based on D-Code team review.</p>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<td colspan="5">My Sessions (<?php echo count($mysessions); ?>)</td>
	</tr>

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title (Select to view session details)</th>
		<th valign="middle">Track</th>
		<th valign="middle">Level</th>
		<th valign="middle">Type</th>

	</tr>
	<?php $temp = "DataTableRow01";
	foreach($mysessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="top"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="top"><a id="SignUp_lnkList"
			class="sessiondetail_tip"
			href="javascript:__doPostBack('Detail',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
		<?php echo $item['Title']; ?> </a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="javascript:__doPostBack('Detail',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title_cn']; ?> </a></td>
		<td align="left" valign="top"><?php echo $item['Track']; ?></td>
		<td align="left" valign="top"><?php echo $item['Level']; ?></td>
		<td align="left" valign="top"><?php echo $item['Type']; ?></td>
	</tr>
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

	<tr class="DataTableTH">
		<td colspan="2">Sessions for Sign Up (<?php echo count($sessions); ?>)&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td colspan="3"><input name="showchinaapproved" type="checkbox"
			value="TRUE" <?php if ($showchinaapproved) echo "checked";?>
			onclick="javascript:__doPostBack('List','')">Only Show Pre-selected
		Sessionsm</td>
	</tr>

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title (Select to view session details)</th>
		<th valign="middle">Track</th>
		<th valign="middle">Level</th>
		<th valign="middle">Type</th>

	</tr>
	<?php $temp = "DataTableRow01";
	foreach($sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="top"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="top"><a id="SignUp_lnkList" class="sessiondetail_tip"
			href="javascript:__doPostBack('Detail',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title']; ?> </a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="javascript:__doPostBack('Detail',<?php echo $item['SID']; ?>)"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title_cn']; ?> </a></td>
		<td align="left" valign="top"><?php echo $item['Track']; ?></td>
		<td align="left" valign="top"><?php echo $item['Level']; ?></td>
		<td align="left" valign="top"><?php echo $item['Type']; ?></td>
	</tr>
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
