<tr id="Node-<?php echo $Node->id;?>" class="Node<?php
	if ($Node->status == Status::PENDING) echo ' pending';
	if ($Node->status == Status::DRAFT) echo ' draft';
	?>">
	<td style="padding-left: <?php echo $Node->level * 20 ?>px;">
		<?php
		$nodeName = $Node->NodeTextDe->get('headline', $Node->get('name'));
		$nodeName = String::truncate($nodeName, 50, '…', true, true);
		if ($Node->hasFlags(NodeFlag::ALLOW_EDIT) || $Me->user_group_id == 1) {
			echo $HTML->link($Node->adminDetailPageUri(array('action' => 'edit')), $nodeName);
		} else {
			echo Sanitizer::html($nodeName);
		}
		?><br />
		<p>
			<?php echo String::truncate(strip_tags($Node->getText('text')), 300, '…'); ?>
		</p>
	</td>
	<td class="created" style="width: 200px;">
		<?php
		if ($Node->published > 0) {
			$nodeTimestamp = $Node->published;
		} else {
			$nodeTimestamp = $Node->created;
		}
		?>
		<span class="time" datetime="<?php echo date('c', $nodeTimestamp); ?>">
			<?php echo strftime('%x %H:%M', $nodeTimestamp)?>
		</span>
		<?php
		if ($Node->status > Status::PUBLISHED) {
			echo '<br />('.Status::$list[$Node->status].')';
		}
		?><br />
		<?php echo $this->renderElement('nodeMenu', array('Node' => $Node)); ?>
	</td>
</tr>