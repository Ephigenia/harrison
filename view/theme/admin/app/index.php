<h1><?php echo Sanitizer::html(sprintf('Willkommen %s!', $Me->get('name'))); ?></h1>
<p class="hint">
	<?php echo nl2br(__('Willkommen in der Administrationsoberfläche von <q>:1!</q>
	Wenn irgendwelche Fragen entstehen sollten, schreiben sie uns: :2',
		AppController::NAME,
		$HTML->email(Registry::get('AdminEmail').'?subject='.AppController::NAME.' Administration', Registry::get('AdminEmail'))
		)); ?>
</p>
<?php

// list newest comments
if (!empty($Comments)) {
	echo $HTML->tag('h2', __('Neue Kommentare'));
	echo $this->renderElement('comments', array('Comments' => $Comments));
	echo $HTML->link(Router::url('adminComment'), __('Alle Kommentare anzeigen')); 
}

// list newest blog posts
if (!empty($BlogPosts)) {
	echo $HTML->tag('h2', __('Neue Blogeinträge'));
	echo $this->renderElement('blogPosts', array('BlogPosts' => $BlogPosts));
	echo $HTML->link(Router::url('adminBlogPost'), __('Alle Blogeinträge anzeigen')); 
}

// list newest files
if (!empty($Files)) {
	echo $HTML->tag('h2', __('Neue Dateien'));
	foreach($Files as $File) echo $this->renderElement('mediaFile', array('MediaFile' => $File));
	echo '<br class="c" />'.LF;
	echo $HTML->link(Router::url('adminMediaFiles'), __('Alle Dateien anzeigen'));
}