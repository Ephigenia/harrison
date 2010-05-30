<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::getRoute('adminNodeCreate', array('action' => 'create')), '+', array('class' => 'button')) ?>
	?>
</div>
<ul class="rounded"><?php
foreach($Nodes as $Node) {
	?>
	<li>
		<a href="<?php echo $Node->adminDetailPageUri('edit') ?>">
			<?php echo $Node->get('name'); ?>
		</a>
	</li><?php
	} ?>
</ul>