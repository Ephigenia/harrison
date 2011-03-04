<h1><?php echo $pageTitle ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo __('Gruppen'); ?></li>
</ul>

<?php echo $HTML->link(
	Router::getRoute('adminScaffold', array('controller' => $controller, 'action' => 'create')),
	__('Neue Benutzergruppe erstellen'),
	array('class' => 'button')
); ?>

<p class="hint">
	<?php echo __('Sie können Benutzer in verschiedene Gruppen stecken um deren Zugriffsrechte zu verändern. Jede Gruppe hat andere Zugriffsrechte zu bestimmten Bereichen.')?>
</p>

<?php if (empty($UserGroups)) { ?>
	<p class="hint">
		<?php echo __('Es wurden noch keine Gruppen angelegt.'); ?>
	</p>
<?php } else { ?>
	<ul id="UserGroups">
		<?php foreach($UserGroups as $UserGroup) { ?>
		<li>
			<?php echo $HTML->link(
				Router::uri('adminScaffoldId', array('controller' => $controller, 'id' => $UserGroup->id, 'action' => 'edit')),
				$UserGroup->get('name')
			);
			?>
		</li>
		<?php } ?>
	</ul>
<?php } ?>