
<script type="text/javascript">
        $('.cropbox').load(function() {
            //Handler for .load() called.
            //alert($('.cropbox').height());
        });

        $(window).load(function() {
            var iheight = $(document.body).height();
            //alert(iheight);                        
            var iwidth = 600;
            var imageheight = $('.cropbox').height();

            if (imageheight > 0 & iheight < 300) {
               iheight = iheight + imageheight;
            }
            if (iheight > 400) {
                iheight = eval(iheight + 60);
            }
            else if (iheight < 250) {
                iheight = 250;
            }
            else {
                iheight = iheight + 20;
            }
            //alert(iheight);

            parent.$.nyroModalSettings({
                width: iwidth,
                height: iheight
            });
        });          
</script>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" class="MCPColor">
		<div class="MainContentPanel"><!-- CONTENT PANEL -->
		<div class="Petrol">

		<form name="photoform" method="post" action="<?php echo $formaction?>"
			id="aspnetForm" enctype="multipart/form-data"><input type="hidden"
			name="__EVENTTARGET" id="__EVENTTARGET" value="" /> <input
			type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />

		<script type="text/javascript">
			var theForm = document.forms['photoform'];
			if (!theForm) {
			    theForm = document.photoform;
			}
			function __doPostBack(eventTarget, eventArgument) {
			    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
			        theForm.__EVENTTARGET.value = eventTarget;
			        theForm.__EVENTARGUMENT.value = eventArgument;
			        theForm.submit();
			    }
			}
		</script>

				<?php 
					switch ($activesubmenu) {
					    case "Upload":
					        include 'application/views/photo/upload.php';
					        break;
						case "Crop":
					        include 'application/views/photo/crop.php';
					        break;
						case "Confirm":
					        include 'application/views/photo/confirm.php';
					        break;
					}
				?>
		
		</form>
		</div>
		</div>
		</td>

	</tr>
</table>
