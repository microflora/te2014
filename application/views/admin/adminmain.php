<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" class="MCPColor">
		<div class="MainContentPanel"><!-- CONTENT PANEL -->
		<div class="Petrol">

		<form name="signupform" method="post"
			action="<?php echo $formaction?>" id="aspnetForm"
			enctype="multipart/form-data"><input type="hidden"
			name="__EVENTTARGET" id="__EVENTTARGET" value="" /> <input
			type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
			<input type="hidden" name="__EVENTARGUMENT2" id="__EVENTARGUMENT2" value="" />
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
			function __doPostBack2(eventTarget, eventArgument, eventArgument2) {
			    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
			        theForm.__EVENTTARGET.value = eventTarget;
			        theForm.__EVENTARGUMENT.value = eventArgument;
			        theForm.__EVENTARGUMENT2.value = eventArgument2;
			        theForm.submit();
			    }
			}
		</script> <?php 
		switch ($activesubmenu) {
			case "Assign_Speaker":
				include 'application/views/admin/assign_speaker.php';
				break;
			case "Assign_Translator":
				include 'application/views/admin/assign_translator.php';
				break;
		}
		?></form>
		</div>
		</div>
		</td>

	</tr>
</table>
