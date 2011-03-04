<tr id="User-<?php echo $User->id; ?>" class="user">
	<td class="name">
		<?php echo $this->element('gravatar', array('User' => $User))?>
		<?php echo $HTML->link($User->adminDetailPageUri(), (string) $User); ?>
	</td>
	<td class="userRole">
		<?php echo $User->UserGroup->get('name'); ?>
	</td>
</tr>