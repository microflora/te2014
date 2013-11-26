<script>
$(document).ready(function() {

	var myStatusCell = null,
		myParameters = "";

	function updateStatus(cell, params, status) {
		//alert("update_speaker_status?__EVENTTARGET=" + status + "&__EVENTARGUMENT=" + params);
		$.get("update_speaker_status?__EVENTTARGET=" + status + "&__EVENTARGUMENT=" + params, 
			function (data, textStatus) {
				cell.text(data);
			},
			"text");
	}

	$('a.speaker_summary').cluetip({width:'420px', positionBy: 'mouse', showTitle: false});

	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 120,
		width: 400,
		modal: true,
		buttons: {
			Cancel: function() {
				$( this ).dialog( "close" );
			},
			"Approved": function() {
				updateStatus(myStatusCell, myParameters, "Approved");
				$( this ).dialog( "close" );
			},
			"Rejected": function() {
				updateStatus(myStatusCell, myParameters, "Rejected");
				$( this ).dialog( "close" );
			},
			"Unknown": function() {
				updateStatus(myStatusCell, myParameters, "Unknown");
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			
		}
	});

	$( ".change-status" )
	.bind("click", function() {
		myStatusCell = $( this );
		myParameters = $( this ).attr("axis");
		$( "#dialog-form" ).dialog( "open" );
	});
});


</script>

<div id="dialog-form" title="Set Status">
<p>Please set the status</p>
</div>

<h1>Assign Speaker</h1>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title/Type/Level</th>
		<th valign="middle">Speaker</th>
		<th valign="middle">Language</th>
		<th valign="middle">Status</th>
	</tr>

	<?php
	$temp = "DataTableRow01";
	foreach($sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"
			rowspan='<?php echo $item['RowCount']; ?>'><?php echo $item['SessionID']; ?>
		<br />
		<br />
		<?php if ($SelectedSID == $item['SID']) {?> <select name="speakerid"
			size="1">
			<option selected value="0"
			<?php if ($speakerid == 0) echo "selected"; ?>>Select Speaker</option>
			<?php foreach($speakers as $speaker):?>
			<option value="<?php echo $speaker['id']; ?>"
			<?php if ($speakerid == $speaker['id']) echo "selected"; ?>><?php echo $speaker['LastName'].", ".$speaker['FirstName'];?></option>
			<?php endforeach; ?>
		</select> <font color="red"><?php echo form_error('speakerid'); ?></font><br />
		Lang:<input type="radio" name="language" value="1"
		<?php if ($language == 1) echo 'checked="checked"'; ?> /> 中文 <input
			type="radio" name="language" value="2"
			<?php if ($language == 2) echo 'checked="checked"'; ?> /> English <font
			color="red"><?php echo form_error('language'); ?></font><br />
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack('Assign',<?php echo $item['SID']; ?>)"
					onmouseout="window.status='';return true;">Assign</a></td>
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
		<td align="left" valign="middle"
			rowspan='<?php echo $item['RowCount']; ?>'><?php echo $item['Title']."<br/>".$item['Type']."<br/>".$item['Level']; ?></td>
			<?php $count = 0;
			foreach ($item['Speakers'] as $item2):
			$count = $count + 1;
			if ($count == 1) { ?>
		<td align="left" valign="middle"><?php if ($item2['email']<>"") {echo "<a href='mailto:".$item2['email']."' class='speaker_summary' rel='../popup/popup_speaker_translator_summary?__EVENTARGUMENT=".$item2['speakerid']."'>".$item2['LastName'].", ".$item2['FirstName']."</a>"; } else {echo ""; }?>
		<?php if (($SelectedSID == $item['SID']) && ($item2['email']<>"")) {?>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack2('Remove',<?php echo $item['SID']; ?>, <?php echo $item2['speakerid']?>)"
					onmouseout="window.status='';return true;">Remove</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		<?php } ?></td>
		<td align="left" valign="middle"><?php echo $item2['Language']; ?></td>
		<td align="left" valign="middle" class="change-status"
			axis="<?php echo $item['SID']."&__EVENTARGUMENT2=".$item2['speakerid']; ?>"><?php echo $item2['Status']; ?></td>
	</tr>
	<?php } else { ?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"><?php if ($item2['email']<>"") {echo "<a href='mailto:".$item2['email']."' class='speaker_summary' rel='../popup/popup_speaker_translator_summary?__EVENTARGUMENT=".$item2['speakerid']."'>".$item2['LastName'].", ".$item2['FirstName']."</a>"; } else {echo ""; }?>
		<?php if (($SelectedSID == $item['SID']) && ($item2['email']<>"")) {?>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonLeftDove.gif" border="0" alt="" height="21"
					width="10" /></td>
				<td height="21" align="center" valign="middle" class="ButtonDove"
					nowrap="nowrap">&nbsp;<a
					href="javascript:__doPostBack2('Remove',<?php echo $item['SID']; ?>, <?php echo $item2['speakerid']?>)"
					onmouseout="window.status='';return true;">Remove</a></td>
				<td dir="ltr" width="10" height="21"><img
					src="/te_res/ButtonRightDove.gif" border="0" alt="" height="21"
					width="10" /></td>
			</tr>
		</table>
		<?php } ?></td>
		<td align="left" valign="middle"><?php echo $item2['Language']; ?></td>
		<td align="left" valign="middle" class="change-status"
			axis="<?php echo $item['SID']."&__EVENTARGUMENT2=".$item2['speakerid']; ?>"><?php echo $item2['Status']; ?></td>
	</tr>
	<?php }
	endforeach;

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
