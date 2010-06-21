<?php
$CSS->link($elementBaseName);
?>
<article class="<?php echo $elementBaseName; ?>">
	<header>
		<h1><?php echo $HTML->link($BlogPost->detailPageUri(), $BlogPost->get('headline'), array('rel' => 'bookmark')); ?></h1>
	</header>
	<section><?php
		// format blog posts content text
		if ($controller.$action == 'BlogPostindex') {
			$text = $Text->more($BlogPost->text, $BlogPost->detailPageUri(), __('Artikel weiterlesen …'), __('Den kompletten :1 Blogeintrag lesen', $BlogPost->get('headline')));
		} else {
			$text = $BlogPost->text;
		}
		// format rest of the entry
		$text = $BlogPostFormater->format($text);
		// highlight keywords
		if (!empty($q)) {
			$text = $Text->highlight($text, $q);
		}
		echo $text;
		?>
	</section>
	<footer>
		<?php echo $this->element('gravatar', array('email' => $BlogPost->User->get('email'), 'size' => 12)); ?>
		<cite class="author"><?php echo $BlogPost->User->get('name'); ?></cite> • 
		<time datetime="<?php echo date('c', $BlogPost->published); ?>">
			<?php echo strftime('%x %H:%M', $BlogPost->published); ?>
		</time> • <?php
		echo $HTML->link($BlogPost->detailPageUri().'#Comments', __n(':1 Kommentar', ':1 Kommentare', $BlogPost->Comments->count()));
		?>
	</footer>
</article>