<?php
$CSS->link($elementBaseName);
$avatarSize = (isset($avatarSize)) ? $avatarSize : 34;
?>
<li class="<?php echo $elementBaseName; ?>">
	<?php if (isset($truncated)) { ?>
	<h4>
		<?php echo $HTML->link($Comment->BlogPost->detailPageUri().'#Comments', $Comment->BlogPost->get('headline')); ?>
	</h4>
	<?php } ?>
	<h3>
		<?php
		echo $this->element('gravatar', array('email' => $Comment->get('email'), 'size' => $avatarSize));
		echo date(__('d.m.Y H:i'), $Comment->created).'<br />';
		if ($Comment->url) {
			echo $HTML->link('http://'.$Comment->url, $Comment->get('name'), array('rel' => 'external'));
		} else {
			echo $Comment->get('name');
		} ?>
	</h3><br />
	<?php
		$text = $Comment->text;
		$text = Sanitizer::html($text);
		$text = nl2br($text);
		$text = Text::autoURLs($text);
	 	$text = String::wrap($text, 55, true);
		if (isset($truncated)) {
			$text = String::truncate($text, ($truncated !== true) ? $truncated : 120, '…');
		}
		echo Sanitizer::html($text);
	?>
</li>