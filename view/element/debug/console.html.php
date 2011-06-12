<div id="debug-dump">
	<a href="javascript:void(0)" onclick="$(this).parent().find('.body').slideToggle();return false;" class="toggle">Toggle Debug</a>
	<div class="body">
		<h1>Debug</h1>
		<dl>
			<dt>Compile-time</dt>
			<dd><?php echo round((microtime(true) - COMPILE_START) * 1000); ?>ms</dd>
			<dt>Memory-usage</dt>
			<dd><?php echo (memory_get_usage(true) / 1024 / 1024); ?>MB</dd>
			<dt>Version</dt>
			<dd>
				<?php if (file_exists(APP_ROOT.'/VERSION')) {
					echo readfile(APP_ROOT.'/VERSION');
				} else {
					echo 'unknown';
				} ?>
			</dd>
		</dl>
		
		<?php if (isset($_SESSION)) { ?>
		<h1>Session</h1>
		<?php var_export((array) $_SESSION); ?>
		<?php } ?>
		
		<?php if (isset($_COOKIE)) { ?>
		<h1>Cookie</h1>
		<?php var_dump((array)$_COOKIE); ?>
		<?php } ?>
		
		<?php if (isset($SQLLogger)) { ?>
		<h1>Queries</h1>
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