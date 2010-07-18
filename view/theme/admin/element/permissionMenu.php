<ul class="admin">
	<li><?php echo $HTML->link($Permission->adminDetailPageUri(array('action' => 'edit')), __('Editieren')) ?></li>
	<li><?php echo $HTML->link($Permission->adminDetailPageUri(
		array('action' => 'delete')),
		__('Löschen'),
		array(
			'class' => 'delete confirm',
			'title' => __('Wollen Sie das Zugriffsrecht mit dem Namen <q>:1</q> wirklich löschen?', $Permission->get('name'))
		));
	?></li>
</ul>