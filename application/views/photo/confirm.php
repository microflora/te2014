
<table width="100%" cellspacing="1" cellpadding="3" border="0"
	align="center">
	<tr class="DataTableTH">
		<td valign="middle" align="center" class="DataTableTH">Speaker Profile
		Image</td>
	</tr>
	<tr class="DataTableRow01">
		<td>

		<table cellspacing="0" cellpadding="8" width="100%" border="0">
			<tbody>
				<tr>
					<td>
					<div id="cropControl">

					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
							<div>

							<div id="CropImage_pnlCropped">

							<table cellpadding="0" width="100%" border="0">
								<tr>
									<td align="center" valign="top">
									<table cellpadding="5" border="0">

										<tr>
											<td align="center"><input type="hidden"
												name="CropImageFilePath" id="CropImageFilePath"
												value="<?php echo $file_path; ?>" /> <input type="hidden"
												name="CropImageFileName" id="CropImageFileName"
												value="<?php echo $file_name; ?>" /> <img
												id="CropImage_imgCropped"
												src="<?php echo "../../photos/".$file_name ?>" width="111"
												height="150" style="border-width: 0px;" /> <?php echo $error; ?><br />
											<table border="0" cellpadding="10" cellspacing="0">
												<tr>
													<td>
													<table cellspacing="0" cellpadding="0" border="0"
														align="left">
														<tbody>

															<tr>
																<td width="10" height="21"><img width="10" height="21"
																	border="0" src="/te_res/ButtonLeftPetrol.gif" alt="" /></td>
																<td nowrap valign="middle" height="21" align="center"
																	class="ButtonPetrol"><a id="CropImage_lnkSave"
																	href="javascript:__doPostBack('CropImage$lnkSave','')">Save</a></td>
																<td width="10" height="21"><img width="10" height="21"
																	border="0" src="/te_res/ButtonRightPetrol.gif" alt="" /></td>
															</tr>
														</tbody>
													</table>
													</td>

													<td>
													<table cellspacing="0" cellpadding="0" border="0"
														align="left">
														<tbody>
															<tr>
																<td width="10" height="21"><img width="10" height="21"
																	border="0" src="/te_res/ButtonLeftPetrol.gif" alt="" /></td>
																<td nowrap valign="middle" height="21" align="center"
																	class="ButtonPetrol"><a id="CropImage_lnkCancel"
																	href="javascript:__doPostBack('CropImage$lnkCancel','')">Cancel</a></td>
																<td width="10" height="21"><img width="10" height="21"
																	border="0" src="/te_res/ButtonRightPetrol.gif" alt="" /></td>
															</tr>
														</tbody>
													</table>
													</td>
												</tr>
											</table>
											</td>
										</tr>
									</table>
									</td>

								</tr>
							</table>

							</div>
							</div>
							</td>
						</tr>
					</table>
					</div>


					</td>

				</tr>
			</tbody>
		</table>
		</td>
	</tr>
	<tr class="DataTableFooter">
		<td>&nbsp;</td>

	</tr>
</table>
