<?php
if (empty($flashMessage)) return false;

// javascript auto-hide for flash message
if (isset($JavaScript)) $JavaScript->jQuery('
	// Flashmessage auto-hide
	$("#flashMessage").click(function() {
		$(this).fadeOut("fast");
	});
	window.setTimeout("$(\'#flashMessage\').trigger(\'click\');", 10000);
');
?>
<div id="flashMessage" class="<?php echo @$flashMessage['type'] ?>">
	<?php echo @$flashMessage['message'] ?>
</div>