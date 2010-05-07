<?php
/**
 * global Google Analytics element
 *	
 * Parameters
 * ==========
 *
 * @since 2009-09-16
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
?>
<!-- google analytics -->
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	try {
		var pageTracker = _gat._getTracker("<?php echo @$id ?>");
		window.google_analytics_uacct = "<?php echo @$id ?>";
		pageTracker._trackPageview(<?php echo coalesce('\''.@$GATrackURL.'\'', ''); ?>);
		<?php		
		if (isset($GATrackEvent) && !empty($GATrackEvent['category']) && !empty($GATrackEvent['action'])) {
			printf ('pageTracker._trackEvent(\'%s\', \'%s\');'.LF, @$GATrackEvent['category'], @$GATrackEvent['action']);
		}
		if (isset($GATrackURL)) {
			printf ('pageTracker._trackURL(\'%s\');'.LF, $GATrackURL);
		}
		?>
	} catch(err) {}
</script>