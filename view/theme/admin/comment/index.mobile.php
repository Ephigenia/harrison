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
	<ul class="edgetoedge">
	<?php foreach($Comments as $Comment) {
		if (@$lastDate != date('dmy', $Comment->created)) {
			echo $HTML->tag('li', strftime('%x %H:%M', $Comment->created), array('class' => 'sep'));
		}
		?>
		<li class="forward">
			<?php echo $HTML->link($Comment->adminDetailPageUri('edit'), $Comment->get('name')); ?>
		</li>
		<?php
		$lastDate = date('dmy', $Comment->created);
	} ?>
	</ul>
	<?php
}