<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'application/views/htmlhead.php'?>
</head>
<body>
<script>
$(document).ready(function() {
	$('a.sessiondetail_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
	$('a.sessiontranslation_tip').cluetip({width:'520px', positionBy: 'mouse', showTitle: false});
});
</script>
<h1><?php echo $tablename; ?></h1>
<h2><a href="<?php echo $action; ?>" target="_bland">export to excel</a></h2>
<div class="MainContentPanel">
<div class="Dove">

<table width="100%" border="0" cellspacing="1" cellpadding="3">

	<tr class="DataTableTH">
		<th valign="middle">SessionID</th>
		<th valign="middle">Session Title</th>
		<th valign="middle">Session Type</th>
		<th valign="middle">Translator Status</th>
		<th valign="middle">Photo</th>
		<th valign="middle">LastName, FirstName</th>
		<th valign="middle">Bio</th>
	</tr>

	<?php $temp = "DataTableRow01";
	foreach($table as $item):?>
	<tr class="<?php echo $temp; ?>">
	<?php $count = 0;
	foreach ($item['Sessions'] as $item2):
	$count = $count + 1;
	if ($count == 1) { ?>
		<td><?php echo $item2['SessionID']; ?></td>
		<td><a id="SignUp_lnkList" class="sessiondetail_tip"
			href="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"
			target="_blank"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"><?php echo $item2['Title']; ?>
		</a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"><?php echo $item2['Title_cn']; ?>
		</a></td>
		<td><?php echo $item2['Type']; ?></td>
		<td><?php echo $item2['TranslatorStatus']; ?></td>

		<td align="center" rowspan="<?php echo $item['RowCount']; ?>"><img
			src="<?php echo "../../photos/".$item['photo']; ?>" width="110"
			height="150" border="0" /><br />
		</td>
		<td rowspan="<?php echo $item['RowCount']; ?>"><a
			href="mailto:<?php echo $item['email']; ?>"><?php echo $item['LastName'].", ".$item['FirstName']."<br/><br/>".$item['cn_fullname']; ?></a></td>
		<td rowspan="<?php echo $item['RowCount']; ?>"><?php echo str_replace("\r\n", "<br />", $item['bio'])."<br/><br/>".str_replace("\r\n", "<br />", $item['cn_bio']); ?></td>
	</tr>
	<?php } else { ?>
	<tr class="<?php echo $temp; ?>">
		<td><?php echo $item2['SessionID']; ?></td>
		<td><a id="SignUp_lnkList" class="sessiondetail_tip"
			href="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"
			target="_blank"
			rel="../popup/popup_session_detail?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"><?php echo $item2['Title']; ?>
		</a><br />
		<a id="SignUp_lnkList_cn" class="sessiontranslation_tip"
			href="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"
			rel="../popup/popup_session_translation?__EVENTARGUMENT=<?php echo $item2['SID']; ?>"><?php echo $item2['Title_cn']; ?>
		</a></td>
		<td><?php echo $item2['Type']; ?></td>
		<td><?php echo $item2['TranslatorStatus']; ?></td>
	</tr>
	<?php }
	endforeach;

	if ($temp == "DataTableRow01") {
		$temp = "DataTableRow02";
	} else {
		$temp = "DataTableRow01";
	}
	endforeach; ?>

	<?php if (count($table)>0) {?>
	<tr class="DataTableFooter">
		<td colspan="<?php echo count($table[0]); ?>"></td>
	</tr>
	<?php } ?>
</table>
</div>
</div>
</body>
</html>
