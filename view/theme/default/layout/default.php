<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo I18n::locale(); ?>">
	<head>
		<title><?php echo $pageTitle ?></title>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
		<base href="<?php echo Router::url('root'); ?>" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2, TAB, 1);
		if (isset($CSS)) {
			$CSS->addFiles('reset', 'app', 'form');
			echo String::indent($CSS->render(), 2, TAB, 1);
		}
		// Favicon
		if (file_exists('./favicon.ico')) {
			echo TAB.TAB.'<link rel="shortcut icon" type="image/ico" href="'.WEBROOT.'favicon.ico" />'.LF;
		}
        ?>
	</head>
	<body class="<?php echo I18n::locale(); ?>">
		<div id="app">
			<h1><?php echo $pageTitle; ?></h1>
			<?php echo $SearchForm ?>
			<div id="content">
				<?php echo @$content ?>
			</div>
		</div>
		<?php
		// Javascript	
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'app',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1).LF;
		}
		?>
	</body>
</html>