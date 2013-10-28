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
				<td align="right" width="30%"><b>课程编号:</b></td>
				<td valign="middle" width="70%"><?php echo $item['SessionID']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" width="30%"><b>课程标题:</b></td>
				<td valign="middle" width="70%"><?php echo $item['Title_cn']; ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>课程摘要:</b></td>
				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Abstract_cn']); ?></td>
			</tr>
			<tr class="DataTableRow01Dove">
				<td align="right" valign="top"><b>课程先决条件:</b></td>

				<td valign="middle"><?php echo str_replace("\r\n", "<br />", $item['Prerequisites_cn']); ?></td>
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
