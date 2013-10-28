<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" class="MCPColor">
		<div class="MainContentPanel"><!-- CONTENT PANEL -->
		<div class="Petrol">

		<form name="signupform" method="post"
			action="<?php echo $formaction?>" id="signupform"
			enctype="multipart/form-data"><input type="hidden"
			name="__EVENTTARGET" id="__EVENTTARGET" value="" /> <input
			type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />

		<script type="text/javascript">
			var theForm = document.forms['signupform'];
			if (!theForm) {
			    theForm = document.signupform;
			}
			function __doPostBack(eventTarget, eventArgument) {
			    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
			        theForm.__EVENTTARGET.value = eventTarget;
			        theForm.__EVENTARGUMENT.value = eventArgument;
			        theForm.submit();
			    }
			}
		</script> <?php 
		switch ($activesubmenu) {
			case "List":
				include 'application/views/signup4global/sessionlist.php';
				break;
			case "Detail":
				include 'application/views/signup4global/sessiondetail.php';
				break;
			case "Translation":
				include 'application/views/signup4global/sessiontranslation.php';
				break;
		}
		?></form>
		</div>
		</div>
		</td>

	</tr>
</table>
