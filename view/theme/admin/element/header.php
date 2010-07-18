<div id="header">
	<span class="fl">
		<?php echo $HTML->link(Router::getRoute('root'), __('← zurück'), array('class' => 'button', 'title' => __('Den Admin verlassen und zur Website wechseln')))?>
		<?php echo $HTML->link(Router::getRoute('admin'), Sanitizer::HTML(__('Administration :1', String::truncate(AppController::NAME, 40, '…')))); ?>
	</span>
	<span class="fr">
		<?php echo	__('Eingeloggt als: :1 :2',
				$HTML->link($Me->adminDetailPageUri(), $Me->get('name')),
				$HTML->link(Router::getRoute('adminLogout'), __('logout'), array('class' => 'button'))
			);
		?>
	</span>
</div>