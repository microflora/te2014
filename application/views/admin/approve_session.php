<script>
$(document).ready(function() {

	var myStatusCell = null,
		myParameters = "";

	function updateStatus(cell, params, status) {
		// alert("approve_session?__EVENTTARGET=" + status + "&__EVENTARGUMENT=" + params);
		$.post("approve_session", {__EVENTTARGET:status, __EVENTARGUMENT:params}, 
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
			"Unknown": function() {
				updateStatus(myStatusCell, myParameters, "Unknown");
				$( this ).dialog( "close" );
			},
			"Selected": function() {
				updateStatus(myStatusCell, myParameters, "Selected");
				$( this ).dialog( "close" );
			},
			"Approved": function() {
				updateStatus(myStatusCell, myParameters, "Approved");
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

<h1>Approve Session</h1>

<table width="98%" border="0" cellspacing="1" cellpadding="6"
	align="left" class="DataTable">

	<tr class="DataTableTH">
		<th valign="middle">ID</th>
		<th valign="middle">Title/Type/Level</th>
		<th valign="middle">Status</th>
	</tr>

	<?php
	$temp = "DataTableRow01";
	foreach($sessions as $item):?>
	<tr class="<?php echo $temp; ?>">
		<td align="left" valign="middle"><?php echo $item['SessionID']; ?></td>
		<td align="left" valign="middle"><?php echo $item['Title']."<br/>".$item['Type']."<br/>".$item['Level']; ?></td>
		<td align="left" valign="middle" class="change-status"
			axis="<?php echo $item['SID']; ?>"><?php echo (isset($item['China']) && !empty($item['China'])) ? $item['China'] : 'Unknown'; ?></td>
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
