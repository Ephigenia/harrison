<article class="Comment<?php echo $Comment->id; ?>">
	<header>
		<?php echo $this->view->render('element', 'gravatar', array('email' => $Comment->email, 'size' => 32)); ?>
		<?php 
		if ($Comment->url) {
			echo $HTML->link($Comment->url, $Comment->name, array('rel' => 'external nofollow'));
		} else {
			echo $Comment->name;
		}
		?> • <time datetime="<?php echo $Comment->created->format('c'); ?>"><?php
			echo strftime('%F %H:%M', $Comment->created->getTimestamp());
		?></time>
	</header>
	<p>
		<?php echo nl2br($Comment->text) ?>
	</p>
</article>