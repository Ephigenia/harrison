<h1><?php echo $User->get('name'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?></li>
	<li><?php echo $HTML->link($User->adminDetailPageUri(), $User->get('name')) ?></li>
	<li><?php echo __('Log'); ?></li>
</ul>

<?php echo $this->renderElement('userMenu'); ?>

<?php echo $this->renderElement('logEntries', array('LogEntries' => $LogEntries)); ?>
<?php echo $this->renderElement('pagination'); ?>