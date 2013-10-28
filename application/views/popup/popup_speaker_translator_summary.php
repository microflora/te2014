<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'application/views/htmlhead.php'?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="1" width="400"
	align="left">
	<tr>
		<td>
		<table border="1" cellpadding="2" cellspacing="0" width="100%"
			class="DataTable">

			<tr class="DataTableRow01Dove">
				<td align="center" valign="middle" colspan="5"><b>Speaker Summary</b></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="center"><b>Session ID</b></td>
				<td align="center"><b>Session Title</b></td>
				<td align="center"><b>Session Language</b></td>
				<td align="center"><b>Speaker language</b></td>
				<td align="center"><b>Speaker Approved</b></td>
			</tr>

			<?php foreach($speaker_summary as $item):?>
			<tr class="DataTableRow01Dove">
				<td><?php echo $item['SessionID']; ?></td>
				<td><?php echo $item['Title']; ?></td>
				<td><?php echo $item['SessionLanguage']; ?></td>
				<td><?php echo $item['SpeakerLanguage']; ?></td>
				<td><?php echo $item['SpeakerApproved']; ?></td>
			</tr>
			<?php endforeach; ?>

			<tr class="DataTableRow01Dove">
				<td colspan="5" align="center">
				<p>&nbsp;</p>
				</td>
			</tr>

		</table>

		</td>
	</tr>

	<tr>
		<td>
		<table border="1" cellpadding="2" cellspacing="0" width="100%"
			class="DataTable">

			<tr class="DataTableRow01Dove">
				<td align="center" valign="middle" colspan="4"><b>Translator Summary</b></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="center"><b>Session ID</b></td>
				<td align="center"><b>Session Title</b></td>
				<td align="center"><b>Session Language</b></td>
				<td align="center"><b>Translator Approved</b></td>
			</tr>

			<?php foreach($translator_summary as $item):?>
			<tr class="DataTableRow01Dove">
				<td><?php echo $item['SessionID']; ?></td>
				<td><?php echo $item['Title']; ?></td>
				<td><?php echo $item['SessionLanguage']; ?></td>
				<td><?php echo $item['TranslatorApproved']; ?></td>
			</tr>
			<?php endforeach; ?>

			<tr class="DataTableRow01Dove">
				<td colspan="4" align="center">
				<p>&nbsp;</p>
				</td>
			</tr>

		</table>

		</td>
	</tr>

</table>

</body>
</html>
