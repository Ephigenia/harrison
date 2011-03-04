<?php
if (empty($Node)) return false;
if ($Node->published > 0) {
	$nodeTimestamp = $Node->published;
} else {
	$nodeTimestamp = $Node->created;
}
?>
<tr id="Node-<?php echo $Node->id;?>" class="Node<?php
	if ($Node->status == Status::PENDING) echo ' pending';
	if ($Node->status == Status::DRAFT) echo ' draft';
	?>">
	<?php if (empty($showPadding)) { ?>
	<td class="created">
		<span class="time" datetime="<?php echo date('c', $nodeTimestamp); ?>">
			<?php echo strftime('%x %H:%M', $nodeTimestamp)?>
		</span>
		<?php
		if ($Node->status > Status::PUBLISHED) {
			echo '('.Status::$list[$Node->status].')';
		}
		?><br />
		<?php echo $this->element('nodeMenu', array('Node' => $Node)); ?>
	</td>
	<?php } ?>
	<td<?php if (!empty($showPadding)) echo ' style="padding-left: '.(20 * $Node->level).'px"'; ?>>
		<?php
		$nodeName = $Node->getText('headline', null, $Node->get('name'));
		if (empty($nodeName)) {
			$nodeName = __('(kein Name)');
		}
		$nodeName = String::truncate($nodeName, 50, '…', false, true);
		if ($Node->hasFlags(NodeFlag::ALLOW_EDIT) || $Me->user_group_id == 1) {
			echo $HTML->link($Node->adminDetailPageUri('edit'), $nodeName);
		} else {
			echo Sanitizer::html($nodeName);
		}
		?><br />
		<p>
			<?php echo String::truncate(strip_tags($Node->getText('text')), 300, '…'); ?>
		</p>
	</td>
	<?php if (!empty($showPadding)) { ?>
		<td class="created">
			<span class="time" datetime="<?php echo date('c', $nodeTimestamp); ?>">
				<?php echo strftime('%x %H:%M', $nodeTimestamp)?>
			</span>
			<?php
			if ($Node->status > Status::PUBLISHED) {
				echo '('.Status::$list[$Node->status].')';
			}
			?><br />
			<?php echo $this->element('nodeMenu', array('Node' => $Node)); ?>
		</td>
	<?php } ?>
</tr>