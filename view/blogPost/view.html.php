<?php echo $this->view->render('element', 'blogPost', array('BlogPost' => $BlogPost)) ?>

<section id="Comments">
	<?php if ($BlogPost->comments->count() > 0) { ?>
	<header>
		<h2><?php echo $BlogPost->comments->count(); ?> Kommentare</h2>
	</header>
	<?php foreach($BlogPost->comments as $Comment) {
		echo $this->view->render('element', 'comment', array('Comment' => $Comment));
	} ?>
	<?php } ?>
</section>
