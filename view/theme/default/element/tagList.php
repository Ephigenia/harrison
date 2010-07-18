<?php if (empty($tags)) return false; ?>
<ul class="tags"><?php
foreach($tags as $tag) {
	$attributes = array(
		'title' => __('Weitere Blogeinträge mit dem Tag %s finden', $tag->get('name')),
	);
	if (!empty($keyword) && $tag->get('name') == $keyword) {
		$atts['class'] = 'keyword';
	}
	?>
	<li>
		<?php echo $HTML->link(
				Router::url('blogSearch', array('q' => urlencode($tag->get('name')))),
				$tag->get('name'),
				$attribute
			); ?>
	</li>
	<?php
} ?>
</ul>