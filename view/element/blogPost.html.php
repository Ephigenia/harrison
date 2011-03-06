<article class="BlogPost<?php echo $BlogPost->id; ?>">
	<header>
		<h1>
			<a href="#"><?php echo $BlogPost->headline; ?></a>
		</h1>
	</header>
	<?php echo $BlogPost->text; ?>
	<footer>
		<?php echo $this->view->render('element', 'gravatar', array('email' => $BlogPost->user->email, 'size' => 16)); ?>
		<cite><?php echo $BlogPost->user->name; ?></cite> •
		<time datetime="<?php echo $BlogPost->published->format('c'); ?>">
			<?php echo strftime('%F %H:%M', $BlogPost->published->getTimestamp()); ?>
		</time> • <?php echo $BlogPost->comments->count(); ?> Kommentar(e)
	</footer>
</article>