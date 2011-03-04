<h1><?php echo __('Sprachen'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo __('Sprachen'); ?></li>
</ul>

<?php echo $HTML->link(
	Router::getRoute('adminScaffold', array('controller' => $controller, 'action' => 'create')),
	__('Neue Sprache erstellen'),
	array('class' => 'button')
); ?>

<table id="languageList">
	<thead>
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Locale'); ?></th>
			<th><?php echo __('Name'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($Languages as $Language) { ?>
		<tr class="Language<?php
		if ($Language->status == Status::PENDING) echo ' pending';
		if ($Language->status == Status::DRAFT) echo ' draft';
		?>">
			<td>
				<?php echo $Language->id ?>
			</td>
			<td>
				<?php echo $Language->locale ?>
			</td>
			<td>
				<?php echo $HTML->link($Language->adminDetailPageUri(array('action' => 'edit')), $Language->get('name'))?>
			<td>
		</tr>
	<?php } ?>
	</tbody>
</table>