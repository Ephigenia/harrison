<h1><?php echo __('Gruppen'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::uri('adminScaffold', array('controller' => $controller)), __('Gruppen & Rechte')); ?></li>
	<li><?php echo __('Gruppe erstellen'); ?></li>
</ul>

<?php echo $AdminUserGroupForm; ?>