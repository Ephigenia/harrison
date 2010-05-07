<h1><?php echo __('Seiten') ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo __('Seiten'); ?></li>
</ul>

<?php if (!empty($Nodes)) { ?>
<table id="NodeTree">
	<tbody>
		<?php foreach($Nodes as $Node) {
			echo $this->renderElement('nodeEntry', array('Node' => $Node));
		} ?>
	</tbody>
</table>
<?php } ?>