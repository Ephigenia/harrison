<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('adminRoot'), __('Frontend'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::uri('adminLogout'), __('Logout'), array('class' => 'button flip'));
	?>
</div>
<div class="info">
	<?php echo nl2br(__('Willkommen in der Administrationsoberfläche von <q>:1!</q>
	Wenn irgendwelche Fragen entstehen sollten, schreiben sie uns: :2',
		AppController::NAME,
		$HTML->email(Registry::get('AdminEmail').'?subject='.AppController::NAME.' Administration', Registry::get('AdminEmail'))
		)); ?>
</div>
<h2><?php echo __('Aktuelles'); ?></h2>
<?php if (empty($WallItems)) {
	echo $HTML->tag('p', __('Es gibt bisher noch keine aktuallen Einträge. Sobald es neue Einträge gibt, werden diese hier chronologisch angezeigt. So bleiben Sie immer auf dem Laufenden!'), array('class' => 'hint'));
} else {
	?>
	<ul class="rounded">
		<?php foreach($WallItems as $WallItem) {
			?>
			<li class="arrow"><?php echo $WallItem->name; ?></li>
			<?php
		} ?>
	</ul>
	<ul class="rounded">
		<li class="forward"><?php echo $HTML->link(Router::url('adminComment'), __('Alle Kommentare anzeigen')); ?></li>
		<li class="forward"><?php echo $HTML->link(Router::url('adminBlogPost'), __('Alle Blogeinträge anzeigen')); ?></li>
		<li class="forward"><?php echo $HTML->link(Router::url('adminMediaFiles'), __('Alle Dateien anzeigen')); ?></li>
	</ul>
	<?php
}