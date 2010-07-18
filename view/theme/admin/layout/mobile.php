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
				'reset.css',
				'jqtouch.min.css',
				'mobile.css',
			));
			echo String::indent($CSS->render(), 2, TAB, 1);	
		}
        ?>
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT; ?>static/theme/jqt/theme.min.css" media="screen" />
	</head>
	<body class="<?php echo I18n::locale(); ?>">
		<?php echo $this->element('flashMessage'); ?>
		<div id="<?php echo $controller.$action; ?>" class="current">
			<?php echo $content; ?>
        </div>
		<div id="Configuration">
			<div class="toolbar">
				<?php
				echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
				echo $HTML->tag('h1', __('Einstellungen'));
				?>
			</div>
			<ul class="rounded">
				<li class="arrow">
					<?php echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => 'UserGroup')), __('Gruppen')); ?>
				</li>
				<li class="arrow">
					<?php echo $HTML->link('#Languages', __('Sprachen')) ?>
				</li>
			</ul>
		</div>
		<div id="Languages">
			<div class="toolbar">
				<?php
				echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
				echo $HTML->tag('h1', __('Sprachen'));
				echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => 'Language', 'action' => 'create')), '+', array('class' => 'button'));
				?>
			</div>
			<ul class="rounded">
				<?php foreach($Languages as $Language) { ?>
				<li class="arrow">
					<?php echo $HTML->link($Language->adminDetailPageUri('edit'), $Language->get('name')); ?>
				</li>
				<?php } ?>
			</ul>
		</div>
		<?php
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'jqtouch.js',
				'mobile.js',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1);
		} ?>
	</body>
</html>