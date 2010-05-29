<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('admin'), __('back'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<?php if (empty($Comments)) { 
	echo $HTML->tag('div', __('Es sind noch keine Kommentare vorhanden.'), array('class' => 'info'));
} else {
	?>
	<ul class="rounded">
		<?php foreach($Comments as $Comment) { ?>
			<li class="forward">
				<?php echo $Comment->get('name'); ?>
			</li>
		<?php } ?>
	</ul>
	<?php
}