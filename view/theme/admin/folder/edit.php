<h1><?php echo __('Kategorie editieren'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')) ?></li>
	<li><?php echo __('Kategorie editieren'); ?></li>
</ul>

<?php echo $AdminFolderForm ?>