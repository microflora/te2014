<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'application/views/htmlhead.php'?>
</head>
<body>
<h1><?php echo $tablename; ?></h1>
<h2><a href="<?php echo $action; ?>" target="_bland">export to excel</a></h2>
<div class="MainContentPanel">
<div class="Dove">

<table width="100%" border="0" cellspacing="1" cellpadding="3">

	<tr class="DataTableTH">

	<?php if (count($table)>0) {
		$item = $table[0];

		foreach (array_keys($item) as $item2):?>
		<td align="left" valign="top"><?php echo $item2; ?></td>
		<?php endforeach?>
	</tr>
	<?php $temp = "DataTableRow01";
	foreach($table as $item):?>
	<tr class="<?php echo $temp; ?>">
	<?php foreach (array_keys($item) as $item2):?>
		<td align="left" valign="top"><?php echo str_replace("\r\n", "<br />", $item[$item2]); ?></td>
		<?php endforeach?>
	</tr>
	<?php
	if ($temp == "DataTableRow01") {
		$temp = "DataTableRow02";
	} else {
		$temp = "DataTableRow01";
	}
	endforeach; ?>

	<tr class="DataTableFooter">
		<td colspan="<?php echo count($table[0]); ?>"></td>
	</tr>
	<?php } ?>
</table>
</div>
</div>
</body>
</html>
