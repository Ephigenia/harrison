<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<ul class="rounded">
	<?php foreach($WallItems as $WallItem) {
		?>
		<li class="arrow"><?php echo $WallItem->name; ?></li>
		<?php
	} ?>
</ul>