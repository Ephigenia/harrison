<article class="BlogPost-<?php echo $BlogPost->id; ?>">
	<header>
		<h1>
			<a href="<?php echo $Router->BlogPost(array('uri' => $BlogPost->uri)); ?>" rel="bookmark"><?php echo $BlogPost; ?></a>
		</h1>
	</header>
	<?php
		if ($action !== 'view') {
			$text = $Text->more($BlogPost->text, $Router->BlogPost(array('uri' => $BlogPost->uri)), 'Artikel weiterlesen …');
		} else {
			$text = $BlogPost->text;
		}
		echo $BlogPostFormater->format($text);
	?>
	<footer>
		<?php echo $this->view->render('element', 'gravatar', array('email' => $BlogPost->user->email, 'size' => 16)); ?>
		<cite><?php echo $BlogPost->user->name; ?></cite> •
		<time datetime="<?php echo $BlogPost->published->format('c'); ?>"><?php
			echo strftime('%F %H:%M', $BlogPost->published->getTimestamp());
		?></time> • 
		<a href="<?php echo $Router->BlogPost(array('uri' => $BlogPost->uri)); ?>#Comments"><?php echo $BlogPost->comments->count(); ?> Kommentar(e)</a>
		<?php if (!empty($BlogPost->tags)) {?>
		<ul class="tags">
		<?php foreach ($BlogPost->tags as $Tag) { ?>
			<li><?php echo $HTML->link($Router->search(array('q' => $Tag)), $Tag, array('rel' => 'tag')); ?></li>
		<?php } ?>
		</ul>
		<?php } ?>
	</footer>
</article>