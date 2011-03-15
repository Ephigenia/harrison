<ul class="tags">
<?php foreach ($tags as $Tag) {
	$attributes = array('rel' => 'tag');
	if ($Tag->name == @$q) {
		$attributes['class'][] = 'selected';
	}
	?>
	<li><?php echo $HTML->link($Router->search(array('q' => $Tag)), $Tag, $attributes); ?></li>
<?php } ?>
</ul>