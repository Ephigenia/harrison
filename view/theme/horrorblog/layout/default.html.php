<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head>
	<meta charset="utf-8">
	<title><?php echo @$pageTitle ?: '[no title]' ?></title>
	<base href="<?php echo $baseUri ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="google-site-verification" content="x5zdYJJ5VEiOD96ZMMWOmqm2a0WaxR9_ALNt9Y8wI7U" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="fb:page_id" content="115046791864216" />
	<link rel="shortcut icon" href="<?php $baseUri ?>/favicon.ico">
	<link rel="stylesheet" media="screen, projection" href="<?php echo $baseUri ?>/horrorblog/css/screen.css">
	<script src="<?php echo $baseUri ?>/js/min/modernizr-1.6.min.js"></script>
	<script type="text/javascript" src="http://openx.socialad.org/delivery/spcjs.php?id=1&amp;target=_blank&amp;charset=UTF-8"></script>
	<script src="http://wlf.verticalnetwork.de/scripts/wlf_hob/immer_oben.js" type="text/javascript"></script>
</head>
<body>
	<!--
	Welcome to the horrorblog.org source code!
     _                               _     _                              
	| |__   ___  _ __ _ __ ___  _ __| |__ | | ___   __ _   ___  _ __ __ _ 
	| '_ \ / _ \| '__| '__/ _ \| '__| '_ \| |/ _ \ / _` | / _ \| '__/ _` |
	| | | | (_) | |  | | | (_) | |  | |_) | | (_) | (_| || (_) | | | (_| |
	|_| |_|\___/|_|  |_|  \___/|_|  |_.__/|_|\___/ \__, (_)___/|_|  \__, |
	                                               |___/            |___/ 
	-->
	<script src="http://wlf.verticalnetwork.de/scripts/wlf_hob/ivw.js" type="text/javascript"></script>
	<div id="fb-root"></div>
	<div id="app">
		<header>
			<h1><a href="<?php echo $Router->root->uri(); ?>" rel="home">Homepage</a></h1>
		</header>
		<?= $this->view->render('element', 'sidebar'); ?>
		<aside id="content">
			<?= $content ?>
		</aside>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $baseUri ?>/default/js/min/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<!-- javascript includes -->
	<!-- application script -->
	<script src="<?php echo $baseUri ?>/<?php echo $theme; ?>/horrorblog/js/source/app.js"></script>
	<!--[if lt IE 7 ]>
	<script src="<?php echo $baseUri ?>/default/js/libs/dd_belatedpng.js"></script>
	<script>DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>