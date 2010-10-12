<h1><?php echo $pageTitle ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo __('Benutzer') ?></li>
</ul>

<?php echo $HTML->link(
	Router::getRoute('adminScaffold', array('controller' => $controller, 'action' => 'create')),
	__('Neuen Benutzer erstellen'),
	array('class' => 'button')
); ?>

<?php echo $AdminSearchForm; ?>
<?php echo $this->element('pagination'); ?>
<table class="Users">
	<thead>
		<tr>
			<th class="name"><?php echo __('Name')?></th>
			<th class="role"><?php echo __('Gruppe') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($Users)) foreach($Users as $User) {
		echo $this->element('user', array('User' => $User));
	} ?>
	</tbody>
</table><br />
<br />
<?php echo $this->element('pagination'); ?>