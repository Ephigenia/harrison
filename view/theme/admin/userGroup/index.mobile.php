<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<ul class="rounded">
<?php foreach($UserGroups as $UserGroup) { ?>
	<li>
		<a href="<?php echo $UserGroup->adminDetailPageUri('edit') ?>">
			<?php echo $UserGroup->get('name'); ?>
		</a>
	</li>
<?php } ?>
</ul>