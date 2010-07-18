<?php
if (!isset($url)) {
	$url = Registry::get('WEBROOT_URL').trim($_SERVER['REQUEST_URI'], '/');
}
?>
<a href="http://addthis.com/bookmark.php?v=250&amp;username=<?php echo $username; ?>" class="addthis_button" addthis:url="<?php $url ?>" addthis:title="<?php echo coalesce(@$title, @$pageTitle); ?>">Share</a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=<?php echo $username; ?>"></script>