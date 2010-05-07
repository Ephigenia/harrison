<ul class="admin">
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'edit')), __('Editieren')) ?></li>
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'nodes')), __('Seiten')); ?></li>
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'log')), __('Log-Einträge')); ?></li>
	
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'resendPassword')), __('Neues Passwort zuschicken')) ?></li>
	<?php if (!$User->hasFlag(UserFlag::BLOCKED)) { ?>
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'block')), __('Sperren')) ?></li>
	<?php } else { ?>
	<li><?php echo $HTML->link($User->adminDetailPageUri(array('action' => 'unblock')), __('Freigeben')) ?></li>
	<?php } ?>
	<li><?php echo $HTML->link($User->adminDetailPageUri(
		array('action' => 'delete')),
		__('Löschen'),
		array(
			'class' => 'delete deleteConfirm',
			'title' => __('Wollen Sie den Benutzer :1 wirklich löschen?', $User->get('name'))
		));
	?></li>
</ul>