<?php
if (!empty($BlogPosts)) foreach($BlogPosts as $entry) {
	$text = $BlogPostFormater->format($entry->text);
	$text = trim(strip_tags($text));
	if ($entry->isEmpty('headline')) {
		$headline = String::truncate(strip_tags($text), 60, '…');
	} else {
		$headline = strip_tags($entry->get('headline'));
	}
	$headline = strftime('%F %H:%M', $entry->published).' '.$headline;
	?>
<?php echo $headline.LF ?>
<?php echo str_repeat('=', String::length($headline)).LF; ?>
<?php echo $text.LF.LF ?>
<?php
}