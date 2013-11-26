<script>
$(document).ready(function() {
	$('a.sessiondetail_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
	$('a.sessiontranslation_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
});
</script>
<h1>My Sessions</h1>

<p><font color="red"><strong>IMPORTANT:</strong></font> Below, please
get the list of all the sessions you've involved as the speaker and/or
the translator. It is subject to change, based on D-Code team review and
update. The final decision may be communicated via email.</p>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<td colspan="2">My Sessions as the speaker (<?php echo count($speaker_sessions); ?>)&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td colspan="3"><input name="showspeakerapproved" type="checkbox"
			value="TRUE" <?php if ($showspeakerapproved) echo "checked";?>
			onclick="javascript:__doPostBack('List','')">Only Show Approved</td>
	</tr>

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title (Select to view session details)</th>
		<th valign="middle">Status</th>
		<th valign="middle">Level</th>
		<th valign="middle">Type</th>

	</tr>
	<?php $temp = "DataTableRow01";
	foreach($speaker_sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="top"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="top"><a id="SignUp_lnkList"
			class="sessiondetail_tip" href="../signup4global/start.html"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title']; ?> </a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="../signup4global/start.html"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title_cn']; ?> </a></td>
		<td align="left" valign="top"><?php if ($item['speakerapproved'] == 1) echo "Approved"; else if  ($item['speakerapproved'] == 2) echo "Rejected"; else echo "TBD"; ?></td>
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
		<td colspan="2">My Sessions as the translator (<?php echo count($translator_sessions); ?>)&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td colspan="3"><input name="showtranslatorapproved" type="checkbox"
			value="TRUE" <?php if ($showtranslatorapproved) echo "checked";?>
			onclick="javascript:__doPostBack('List','')">Only Show Approved</td>
	</tr>

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title (Select to view session details)</th>
		<th valign="middle">Status</th>
		<th valign="middle">Level</th>
		<th valign="middle">Type</th>

	</tr>
	<?php $temp = "DataTableRow01";
	foreach($translator_sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="top"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="top"><a id="SignUp_lnkList"
			class="sessiondetail_tip" href="../signup4global/start.html"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title']; ?> </a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="../signup4global/start.html"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item['SID']; ?>">
			<?php echo $item['Title_cn']; ?> </a></td>
		<td align="left" valign="top"><?php if ($item['translatorapproved'] == 1) echo "Approved"; else if  ($item['translatorapproved'] == 2) echo "Rejected"; else echo "TBD"; ?></td>
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
