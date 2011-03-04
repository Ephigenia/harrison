<h1><?php __('News vorschlagen'); ?></h1>
<?php if (!empty($success)) { ?>
	<p class="success">
		<?php echo nl2br(__("Deine Nachricht wurde erfolgreich verschickt.\nVielen Dank!"));  ?>
	</p>
<?php } else { ?>
	<p class="hint">
		
	</p>
	<?php
	echo $ContactForm;
}