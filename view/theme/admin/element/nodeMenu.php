<?php

// Admin Menu for Nodes
if (empty($Node)) return false;

$detailPageUri = $Node->adminDetailPageUri();
	
?>
<ul class="admin">
	<?php
	
	// view link
	if ($Node->get('name') !== 'root' && $Node->hasFlag(NodeFlag::ALLOW_EDIT) || $Me->user_group_id == 1) { 
		echo '<li>'.$HTML->link($Node->detailPageUri(), __('view'), array('target' => '_blank')).'</li>'.LF;
	}
	
	// edit link
	if ($Node->flags & NodeFlag::ALLOW_EDIT || $Me->user_group_id == 1) {
		echo '<li>'.$HTML->link($Node->adminDetailPageUri(array('action' => 'edit')), __('editieren')).'</li>'.LF;
	}
	
	// re-order node tree
	echo '<li>'.$HTML->link($Node->adminDetailPageUri(array('action' => 'move')).'/'.NestedSetBehavior::MOVE_UP.'/', '↑', array('class' => 'up')).'</li>'.LF;
	echo '<li>'.$HTML->link($Node->adminDetailPageUri(array('action' => 'move')).'/'.NestedSetBehavior::MOVE_DOWN.'/', '↓', array('class' => 'down')).'</li>'.LF;
	
	// add childnode
	if ($Node->flags & NodeFlag::ALLOW_CHILDREN || $Me->user_group_id == 1) {
		echo '<li>'.$HTML->link($Node->adminDetailPageUri(array('action' => 'create')), __('Unterseite hinzufügen')).'</li>'.LF;
	}
	
	// delete Node
	if ($Node->flags & NodeFlag::ALLOW_DELETE || $Me->user_group_id == 1) {
		echo '<li>'.$HTML->link($Node->adminDetailPageUri(array('action' => 'delete')), __('löschen'), array('class' => 'deleteConfirm delete',
			'title' => 'Seite „'.$Node->getText('headline').'“ und alle Unterartikel wirklich löschen?'
		)).'</li>';
	}
	
	?>
</ul>
