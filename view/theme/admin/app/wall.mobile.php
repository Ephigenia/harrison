<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<ul class="edgetoedge">
	<?php foreach($WallItems as $index => $WallItem) {
		// same stuff for all models
		$url = $WallItem->adminDetailPageUri('edit');
		$timestamp = $WallItem->created;
		// model-specific stuff
		switch(get_class($WallItem)) {
			case 'Comment':
				$label = __('Kommentar von :1', $WallItem->get('name'));
				break;
			case 'User':
				$label = $WallItem->get('name');
				break;
			case 'Node':
			case 'BlogPost':
				$label = $WallItem->get('headline');
				$timestamp = $WallItem->published;;
				break;
			case 'MediaFile':
			case 'MediaImage':
				$label = $WallItem->getText('title', $WallItem->filename);
				$url = $WallItem->adminDetailPageUri('view');
				break;
		}
		// by-date seperated list
		if (@$lastDate != date('dmy', $timestamp)) {
			echo $HTML->tag('li', strftime('%x %H:%M', $timestamp), array('class' => 'sep'));
		}
		?>
		<li class="arrow">
			<a href="<?php echo $url; ?>">
				<?php echo strftime('%H:%M', $timestamp); ?>
				<?php echo $label ?>
			</a>
		</li>
		<?php
		$lastDate = date('dmy', $timestamp);
	} ?>
</ul>