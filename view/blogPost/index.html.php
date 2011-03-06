<?php
if (empty($BlogPosts)) {
	if (!empty($q)) {
		echo $HTML->p('Leider wurde nichts gefunden.', array('class' => 'hint'));
	} else {
		echo $HTML->p('In diesem Blog stehen noch keine Einträge.', array('class' => 'hint'));	
	}
} else {
	// show blog entries
	foreach($BlogPosts as $index => $BlogPost) {
		echo $this->view->render('element', 'blogPost', array('BlogPost' => $BlogPost));
	}
}