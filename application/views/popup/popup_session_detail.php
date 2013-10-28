<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'application/views/htmlhead.php'?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="1" width="500"
	align="left">
	<?php foreach($sessions as $item):?>
	<tr>
		<td>
		<table border="0" cellpadding="5" cellspacing="0" width="100%"
			class="DataTable">

			<tr class="DataTableRow01Dove">
				<td align="right" valign="middle" colspan="2"><img
					src="/graphics/blank.gif" width="1" height="2" border="0" /></td>
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
				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Abstract']); ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>Prerequisites:</b></td>

				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Prerequisites']); ?></td>
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

		</table>

		</td>
	</tr>

	<?php endforeach; ?>

</table>

</body>
</html>
