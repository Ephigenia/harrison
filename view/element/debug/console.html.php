<div id="DebugConsole">
	<header onclick="$('#DebugConsole .body').slideToggle();">
		Debug
	</header>
	<div class="body">
		<dl>
			<dd>Compile time (ms)</dd>
			<dt><?php echo round((microtime(true) - COMPILE_START) * 1000, 4); ?></dt>
		</dl>
		<?php if (isset($SQLLogger)) { ?>
		<table class="SQLLog">
			<colgroup>
				<col width="3%">
				<col width="87%">
				<col width="10%">
			</colgroup>
			<thead>
				<tr>
					<th>#</th>
					<th>SQL</th>
					<th>t (ms)</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td><?php echo count($SQLLogger->queries); ?></td>
					<td></td>
					<td><?php
						$totalExecutionTime = array_sum(array_map(create_function('$a','return $a["executionMS"];'), $SQLLogger->queries));
						echo round($totalExecutionTime * 1000, 4);
					?></td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach($SQLLogger->queries as $index => $info) { ?>
				<tr>
					<td><?php echo $index; ?></td>
					<td><pre class="sql"><?php echo wordwrap($info['sql'], 80); ?></pre></td>
					<td><?php echo round($info['executionMS'] * 1000, 4); ?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } ?>
	</div>
</div>