<h1><?php echo $pageTitle ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminLanguage'), __('Sprachen')); ?></li>
	<li><?php echo $Language->get('name'); ?></li>
</ul>

<?php echo $AdminLanguageForm ?>