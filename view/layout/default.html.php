<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title><?php echo @$pageTitle ?: '[no title]' ?></title>
	<base href="<?php echo $baseUri ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php $baseUri ?>/favicon.ico">
	<link rel="stylesheet" href="<?php echo $baseUri ?>/css/min/screen.css">
	<link rel="profile" href="http://microformats.org/profile/hcard">
	<script src="<?php echo $baseUri ?>/js/min/modernizr-1.6.min.js"></script>
</head>
<body>
	<header>
		<h1><a href="<?php echo $Router->root->uri(); ?>" rel="home">Homepage</a></h1>
	</header>
	<aside id="content">
		<?php echo $content ?>
	</aside>
	<aside id="sidebar">
		<section>
			<h2>About</h2>
			<p>
				This is the example default theme for harrison.
			</p>
		</section>
		<section>
			<h2>Blogroll</h2>
			<ul>
				<li><a href="http://www.marceleichner.de/" rel="external">Marcel Eichner</a></li>
				<li><a href="http://www.codinghorror.com/" rel="external">Coding Horror</a></li>
			</ul>
		</section>
	</aside>
	<footer>
		<a href="http://code.marceleichner.de/project/harrison" rel="external">Harrison</a> Theme (<a href="http://validator.w3.org/check/referer" rel="external" title="Validate this page’s source">Validate Source</a>),
		© 2010 by <a href="http://www.marceleichner.de" rel="external">Ephigenia M. Eichner</a>
	</footer>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $baseUri ?>/js/min/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<!-- javascript includes -->
	
	<!-- application script -->
	<script src="<?php echo $baseUri ?>/js/source/app.js"></script>
	<!--[if lt IE 7 ]>
	<script src="<?php echo $baseUri ?>/js/libs/dd_belatedpng.js"></script>
	<script>DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>