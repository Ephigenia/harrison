<div id="<?php echo Inflector::plural($controller); ?>">
<?php
	// empty message
	if (empty($BlogPosts)) {
		if (!empty($q)) {
			echo $HTML->p(__('Leider wurde nichts gefunden.'), array('class' => 'hint'));
		} else {
			echo $HTML->p(__('In diesem Blog stehen noch keine Einträge.'), array('class' => 'hint'));	
		}
	} else {
		// show blog entries
		foreach($BlogPosts as $index => $BlogPost) {
			echo $this->renderElement('blogPost', array('BlogPost' => $BlogPost));
		}
	}
?>
</div>
<?php echo $this->renderElement('global/pagination'); ?>