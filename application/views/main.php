<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'application/views/htmlhead.php'?>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" align="center"
	width="978">
	<tr>
		<td width="2"
			style="background-image: url(/te_res/StageShadowLeftBgRepeat.jpg); background-repeat: repeat-y"></td>
		<td width="972" class="Stage">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<?php include 'application/views/header.php'?>

			<tr>

				<td width="208" valign="top" class="MainLeftPanelBgRepeat">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td height="303"
							style="background-image: url(/te_res/MainLeftPanelBg.jpg); background-repeat: no-repeat;"
							valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td valign="top"><img src="/te_res/Spacer.gif"
									width="8" height="210" alt="" border="0" /></td>
								<td valign="top">

								<?php include 'application/views/leftnavigation.php'?>

								</td>
							</tr>
						</table>
						</td>
					</tr>

				</table>
				</td>
				<td width="732" height="400" align="left" valign="top"
					class="MCPColor">
				<div class="MainContentPanel">
				<div class="Dove">

				<?php
					if (strncmp($activemenu, "Editor", strlen("Editor")) == 0) {
						include 'application/views/editor/editormain.php';
					} elseif (strncmp($activemenu, "Admin", strlen("Admin")) == 0) {
						include 'application/views/admin/adminmain.php';
					} else {
						switch ($activemenu) {
						    case "Speaker_Site_Home":
						        include 'application/views/Speaker_Site_Home.php';
						        break;
							case "Proposal_and_Speaking_Guidelines":
						        include 'application/views/Proposal_and_Speaking_Guidelines.php';
						        break;
							case "Sign_Up_for_Global_Sessions":
						        include 'application/views/signup4global/Sign_Up_for_Global_Sessions.php';
						        break;
							case "Propose_Local_Sessions":
						        include 'application/views/proposesession/Propose_Session.php';
						        break;
	//						case "Sign_Up_for_Local_Sessions":
	//					        include 'application/views/Sign_Up_for_Local_Sessions.php';
	//					        break;
							case "My_Workspace":
						        include 'application/views/workspace/main.php';
						        break;
						    case "Modify_Personal_Information":
						        include 'application/views/Modify_Personal_Information.php';
						        break;
							case "Change_My_Password":
						        include 'application/views/Change_My_Password.php';
						        break;
							case "Upload_Photo":
								include 'application/views/photo/photo.php';
						        break;
						}
					}	
				?>

				</div>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="3" height="16"><img src="/te_res/Spacer.gif"
					width="1" height="16" alt="" border="0" /></td>
			</tr>
		</table>
		</td>

		<td width="4"
			style="background-image: url(/te_res/StageShadowRightBgRepeat.jpg); background-repeat: repeat-y"></td>
	</tr>
	<tr>
		<td width="2" height="4"><img
			src="/te_res/StageShadowLeftCorner.jpg" width="2" height="4"
			alt="" border="0" /></td>
		<td width="972" height="4"
			style="background-image: url(/te_res/StageShadowBottomBgRepeat.jpg); background-repeat: repeat-x"></td>
		<td width="4" height="4"><img
			src="/te_res/StageShadowRightCorner.jpg" width="4"
			height="4" alt="" border="0" /></td>
	</tr>

	<?php include 'application/views/footer.php'?>

</table>

</body>
</html>
