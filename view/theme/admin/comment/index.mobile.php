<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('adminRoot'), __('back'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<?php if (empty($Comments)) { 
	echo $HTML->div(__('Es sind noch keine Kommentare vorhanden.'), array('class' => 'info'));
} else {
	?>
	<ul class="rounded">
		<?php foreach($Comments as $Comment) { ?>
			<li class="arrow">
				<?php echo $Comment->get('name'); ?>
			</li>
		<?php } ?>
	</ul>
}