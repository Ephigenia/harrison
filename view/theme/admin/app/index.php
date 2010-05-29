<h1><?php echo Sanitizer::html(sprintf('Willkommen %s!', $Me->get('name'))); ?></h1>
<p class="hint">
	<?php echo nl2br(__('Willkommen im Admin von <q>:1</q>!
	Wenn irgendwelche Fragen entstehen sollten, schreiben sie an: :2',
		AppController::NAME,
		$HTML->email(Registry::get('AdminEmail').'?subject='.AppController::NAME.' Administration', Registry::get('AdminEmail'))
		)); ?>
</p>
<h2><?php echo __('Aktuelles'); ?></h2>
<?php if (empty($WallItems)) {
	echo $HTML->tag('p', __('Es gibt bisher noch keine aktuallen Einträge. Sobald es neue Einträge gibt, werden diese hier chronologisch angezeigt. So bleiben Sie immer auf dem Laufenden!'), array('class' => 'hint'));
} else {
	?>
	<table>
		<tbody>
			<?php foreach($WallItems as $WallItem) { 
				$elementName = get_class($WallItem);
				echo $this->element($elementName, array($elementName => $WallItem));
			} ?>
		</tbody>
	</table>
	<ul>
		<li><?php echo $HTML->link(Router::url('adminComment'), __('Alle Kommentare anzeigen')); ?></li>
		<li><?php echo $HTML->link(Router::url('adminBlogPost'), __('Alle Blogeinträge anzeigen')); ?></li>
		<li><?php echo $HTML->link(Router::url('adminMediaFiles'), __('Alle Dateien anzeigen')); ?></li>
	</ul>
	<?php
}