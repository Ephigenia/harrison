<?php if (empty($LogEntries)) return false; ?>
<table>
	<tbody>
	<?php foreach($LogEntries as $LogEntry) { ?>
		<tr>
			<td><?php
				if ($LogEntry->created > strtotime('1 day')) {
					echo __('vor :1', $Time->niceShort($LogEntry->created));
				} else {
					echo strftime('%x', $LogEntry->created);
				}
				?>
			</td>
			<td>
				<?php echo $LogEntry->controller.'/'.$LogEntry->action; ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>