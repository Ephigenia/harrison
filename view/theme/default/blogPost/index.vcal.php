<?php
foreach($BlogPosts as $entry) {
	if ($entry->isEmpty('headline')) {
		$headline = String::truncate(strip_tags($text), 60, '…');
	} else {
		$headline = $entry->get('headline');
	}	
	?>
BEGIN:VEVENT
UID:<?php echo md5($entry->id.SALT).LF ?>
SUMMARY:<?php echo $headline.LF ?>
LOCATION:Berlin/Germany
CLASS:PUBLIC
DTSTART:<?php echo date('Ymd\THi00\Z', $entry->created - HOUR * 2).LF ?>
DTEND:<?php echo date('Ymd\THi00\Z', $entry->created + HOUR * 3).LF ?>
DESCRIPTION:<?php
	$text = $entry->get('text');
	$text = strip_tags($text);
	$text = preg_replace('@[\r\n]+@', '', $text);
	echo substr($text, 0, 200).LF;
?>
SEQUENCE:0
DTSTAMP:<?php echo date('Ymd\THi00\Z', $entry->created + HOUR * 3).LF ?>
END:VEVENT
<?php
}