<h1><?php echo $pageTitle; ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?></li>
	<li><?php echo $HTML->link($User->adminDetailPageUri(), $User->get('name')) ?></li>
	<li><?php echo __('editieren'); ?></li>
</ul>
<?php echo $AdminUserForm ?>