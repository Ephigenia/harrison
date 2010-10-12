<h1><?php echo __('Seiten'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?></li>
	<li><?php echo $HTML->link($User->adminDetailPageUri(), $User->get('name')); ?></li>
	<li><?php echo __('Seiten'); ?></li>
</ul>
<?php echo $this->element('userMenu', array('User' => $User)); ?>

<p class="hint">
	<?php echo __('Hier sind alle Seiten zu sehen die von :1 angelegt wurden', $User->get('name')); ?>
</p>

<?php if (!empty($Nodes)) { ?>
<table id="NodeTree">
	<tbody>
		<?php
		foreach($Nodes as $Node) {
			echo $this->element('node', array('Node' => $Node));
		} ?>
	</tbody>
</table>
<?php } ?>