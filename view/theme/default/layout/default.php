<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo I18n::$language; ?>">
<head>
	<title><?php echo $pageTitle ?></title>
	<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
	<base href="<?php echo Router::url('root'); ?>">
	<?php
	if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2, TAB, 1);
	if (isset($CSS)) {
		$CSS->addFiles(array(
			'reset',
			'app',
			'form',
			'debug',
		));
		echo String::indent($CSS->render(), 2, TAB, 1);
	}
	?>
	<link rel="shortcut icon" type="image/ico" href="<?php echo WEBROOT; ?>favicon.ico" />
	<link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
</head>
<body class="<?php echo I18n::locale(); ?> no-js">
	<div id="app">
		<header>
			<h1><?php echo $HTML->link(WEBROOT, AppController::NAME, array('rel' => 'home')); ?></h1>
		</header>
		<aside id="content">
			<?php echo @$content ?>
		</aside>
		<aside id="sidebar">
			<?php echo $SearchForm ?>
			<section>
				<h2>About</h2>
				<p>
					This is the example default theme for <?php echo $HTML->link('http://code.marceleichner.de/project/harrison', 'Harrison'); ?>.
					You can modify it by editing all view files and elements in <pre>/view/theme/default</pre> directory.
				</p>
			</section>
			<section>
				<h2>Blogroll</h2>
				<ul>
					<li><?php echo $HTML->link('http://www.marceleichner.de/', 'Marcel Eichner', array('rel' => 'external')); ?></li>
					<li><?php echo $HTML->link('http://www.codinghorror.com/', 'Coding Horror', array('rel' => 'external')); ?></li>
				</ul>
			</section>
		</aside>
		<footer>
			<q><?php echo $theme ?></q> HTML5 <?php echo $HTML->link('http://code.marceleichner.de/project/harrison', 'Harrison'); ?> Theme (<a href="http://validator.w3.org/check/referer" rel="external" title="Validate this page’s source">Validate Source</a>), © 2010 by <?php echo $HTML->link('http://www.marceleichner.de', 'Ephigenia M. Eichner'); ?>
		</footer>
	</div>
	<?php
	// Javascript	
	if (isset($JavaScript)) {
		$JavaScript->addFiles(array(
			'http://html5shiv.googlecode.com/svn/trunk/html5.js', // enabling HTML5 code on IE
			'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
			'app',
		));
		echo String::indent($JavaScript->render(), 2, TAB, 1).LF;
	}
	echo $this->element('debug/dump');
	?>
	<!-- <?php echo ephFrame::compileTime(4) ?> -->
</body>
</html>