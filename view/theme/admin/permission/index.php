<h1><?php echo __('Zugriffsrechte'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => $controller)), __('Zugriffsrechte'))?></li>
</ul>

<?php echo $HTML->link(
	Router::getRoute('adminScaffold', array('controller' => $controller, 'action' => 'create')),
	__('Neues Zugriffsrecht erstellen'),
	array('class' => 'button')
); ?>

<?php if (!empty($Permissions)) { ?>
<table id="Permissions">
	<tbody>
		<?php foreach($Permissions as $Permission) { ?>
		<tr>
			<td><?php echo $Permission->get('name'); ?></td>
			<td><code><?php echo $Permission->get('rule'); ?></code></td>
			<td><?php echo $this->element('permissionMenu', array('Permission' => $Permission)); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } ?>