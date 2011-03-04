<h1><?php echo $pageTitle ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo __('Seiten'); ?></li>
</ul>

<?php if (!empty($Nodes)) { ?>
<table id="NodeTree">
	<tbody>
		<?php foreach($Nodes as $Node) {
			echo $this->element('node', array('Node' => $Node, 'showPadding' => true));
		} ?>
	</tbody>
</table>
<?php } ?>