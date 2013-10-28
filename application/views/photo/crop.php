<table width="100%" cellspacing="1" cellpadding="3" border="0"
	align="center">
	<tr class="DataTableTH">
		<td valign="middle" align="center" class="DataTableTH">Photo Image
		File</td>
	</tr>
	<tr class="DataTableRow01">
		<td>

		<table cellspacing="0" cellpadding="8" width="100%" border="0">
			<tbody>
				<tr>
					<td><script type="text/javascript" language="Javascript">
					    // Remember to invoke within jQuery(window).load(...)
					    // If you don't, Jcrop may not initialize properly
					    jQuery(window).load(function() {
					        jQuery(".cropbox").Jcrop({
					            onSelect: storeCoords,
					            aspectRatio: .75,
					            boxWidth: 480,
					            boxHeight: 400,
					            setSelect: [0, 0, 111, 150],
					            onLoad: storeCoords
					        });
					    });
					
					    //store Co-ordinates
					    function storeCoords(c) {
					        jQuery('#CropImageX').val(c.x);
					        jQuery('#CropImageY').val(c.y);
					        jQuery('#CropImageW').val(c.w);
					        jQuery('#CropImageH').val(c.h);
					    };
					   
					</script>

					<div id="cropControl">

					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
							<div>
							<div id="CropImage_pnlCrop">

							<h3>Crop Profile Image</h3>
							<br />

							<table cellpadding="5" border="0">
								<tr>
									<td align="center"><img id="CropImage_imgCropBox"
										class="cropbox"
										src="<?php echo "../../photos/temp/".$upload_data['file_name']; ?>"
										style="border-width: 0px; display: none;" /> <br />
									<input type="hidden" name="CropImageX" id="CropImageX"
										value="0" /> <input type="hidden" name="CropImageY"
										id="CropImageY" value="0" /> <input type="hidden"
										name="CropImageW" id="CropImageW" value="75" /> <input
										type="hidden" name="CropImageH" id="CropImageH" value="100" />
									<input type="hidden" name="CropImageFilePath"
										id="CropImageFilePath"
										value="<?php echo $upload_data['file_path']; ?>" /> <input
										type="hidden" name="CropImageFileName" id="CropImageFileName"
										value="<?php echo $upload_data['file_name']; ?>" /></td>
									<td valign="top">
									<h3 style="margin-top: 0px;">Instructions:</h3>
									<p>Move the crop box and drag the corners to the area of the
									photo that will be your profile picture.</p>
									</td>
								</tr>
								<tr>
									<td align="center">

									<table cellpadding="5" border="0">
										<tr>
											<td>
											<table cellspacing="0" cellpadding="0" border="0"
												align="left">
												<tbody>
													<tr>
														<td width="10" height="21"><img width="10" height="21"
															border="0" src="/te_res/ButtonLeftPetrol.gif" alt="" /></td>
														<td nowrap valign="middle" height="21" align="center"
															class="ButtonPetrol"><a id="CropImage_lnkCrop"
															href="javascript:__doPostBack('CropImage$lnkCrop','')">Crop
														Image</a></td>

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
									<td></td>
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
