<ul class="admin">
	<?php
	if ($PermissionCheck->check('AdminUserControlleredit')) {
		echo $HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'edit')), __('Editieren')));
	}
	if ($PermissionCheck->check('AdminUserControllernodes')) {
		echo $HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'nodes')), __('Seiten')));
	}
	if ($PermissionCheck->check('AdminUserControllerlog')) {
		echo $HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'log')), __('Log-Einträge')));
	}
	if ($PermissionCheck->check('AdminUserControllerresendPassword')) {
		echo $HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'resendPassword')), __('Neues Passwort zuschicken')));
	}
	if ($PermissionCheck->check('AdminUserControllerblock')) {
		if (!$User->hasFlag(UserFlag::BLOCKED)) {
			$HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'block')), __('Sperren')));
		} else {
			$HTML->tag('li', $HTML->link($User->adminDetailPageUri(array('action' => 'unblock')), __('Freigeben')));
		}
	}
	if ($PermissionCheck->check('AdminUserControllerdelete')) {
		echo $HTML->tag('li', $HTML->link($User->adminDetailPageUri(
			array('action' => 'delete')),
			__('Löschen'),
			array(
				'class' => 'delete deleteConfirm',
				'title' => __('Wollen Sie den Benutzer <q>:1</q> wirklich löschen?', $User->get('name'))
		)));
	}
	?>
</ul>