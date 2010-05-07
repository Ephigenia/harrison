<h1><?php echo __('Benutzer'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo __('Benutzer')?></li>
</ul>

<?php echo $HTML->link(
	Router::getRoute('adminScaffold', array('controller' => $controller, 'action' => 'create')),
	__('Neuen Benutzer erstellen'),
	array('class' => 'button')
); ?>

<?php echo $AdminSearchForm; ?>
<?php echo $this->renderElement('pagination'); ?>
<table class="Users">
	<thead>
		<tr>
			<th class="name"><?php echo __('Name')?></th>
			<th class="role"><?php echo __('Gruppe') ?></th>
			<th class="lastlogin"><?php echo __('Letzter Login'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($Users)) foreach($Users as $User) { ?>
		<tr id="User-<?php echo $User->id; ?>" class="user">
			<td class="name">
				<?php echo $this->renderElement('gravatar', array('User' => $User))?>
				<?php echo $HTML->link($User->adminDetailPageUri(), $User->get('name')); ?>
			</td>
			<td class="userRole">
				<?php echo $User->UserGroup->get('name'); ?>
			</td>
			<td class="lastlogin">
				<?php
				if (!$User->lastlogin) {
					echo 'noch nie';
				} else {
					echo Time::timeAgoInWords($User->get('lastlogin'));
					if ($User->get('lastlogin') > (time() - WEEK * 4)) {
						echo ' ('.strftime('%x %H:%M', $User->get('lastlogin')).')';
					}
				}
				?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table><br />
<br />
<?php echo $this->renderElement('pagination'); ?>