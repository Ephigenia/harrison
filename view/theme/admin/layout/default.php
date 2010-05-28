<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo @$pageTitle ?></title>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
		<base href="<?php echo Router::url('admin'); ?>" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2, TAB, 1);
		if (isset($CSS)) {
			$CSS->addFiles(array(
				'reset',
				'simplePreview',
				'mainMenu',
				'admin',
				'form',
				'login',
				'dialog',
				'table',
				'debug',
				'mediaFile',
			));
			echo String::indent($CSS->render(), 2, TAB, 1);	
		}
		// admin favicon
		if (file_exists('./faviconAdmin.ico')) {
			echo '<link rel="shortcut icon" type="image/ico" href="'.WEBROOT.'faviconAdmin.ico" />'.LF;
		// normal favicon
		} elseif (file_exists('./favicon.ico')) {
			echo '<link rel="shortcut icon" type="image/ico" href="'.WEBROOT.'favicon.ico" />'.LF;
		}
		// iPod-Touch/iPhone Icons
		if (file_exists('./apple-touch-icon.png')) {
			echo '<link rel="apple-touch-icon" type="image/x-icon" href="'.WEBROOT.'apple-touch-icon.png" />'.LF;
		}
        ?>
	</head>
	<body class="<?php echo I18n::locale(); ?>">
		<div id="app" class="<?php echo String::ucFirst($controller) ?> <?php echo String::ucFirst($action) ?>">
			<?php
			if (isset($Me) && $action !== 'login') {
				echo $this->renderElement('header');
				echo $this->renderElement('mainMenu'); 
			}
			echo $this->renderElement('flashMessage') ?>
			<div id="content">
				<?php echo @$content ?>
			</div>
			<?php if (!in_array($action, array('login', 'lostpass'))) {
				echo $this->renderElement('footer');
			} ?>
		</div>
		<?php
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js',
				'js.class.core',
				'php.custom.min',
				'swfobject.js',
				'jquery.plugin.fieldselection',
				'jquery.plugin.dialog',
				'jquery.plugin.simplePreview',
				'jquery.uploadify.v2.1.0.min.js', // uploadify
				'admin',
				'tabs',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1);
		} ?>
	</body>
</html>