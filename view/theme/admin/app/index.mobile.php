<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('root'), __('Frontend'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::uri('adminLogout'), __('Logout'), array('class' => 'button flip'));
	?>
</div>
<ul class="rounded">
	<li class="arrow"><?php echo $HTML->link(Router::uri('adminWall'), __('Aktuelles/Wall')); ?></li>
</ul>
<ul class="rounded">
	<li class="arrow">
		<?php echo $HTML->link(Router::url('adminNode'), __('Seiten')); ?>
		<?php if (!empty($NodeTotalCount)) {
			echo $HTML->tag('small', $NodeTotalCount, array('class' => 'counter'));
		}?>
	</li>
	<li class="arrow">
		<?php echo $HTML->link(Router::url('adminBlogPost'), __('Blogeinträge')); ?>
		<?php if (!empty($BlogPostTotalCount)) {
			echo $HTML->tag('small', $BlogPostTotalCount, array('class' => 'counter'));
		}?>
	</li>
	<li class="arrow">
		<?php echo $HTML->link(Router::url('adminComment'), __('Kommentare')); ?>
		<?php if (!empty($CommentTotalCount)) {
			echo $HTML->tag('small', $CommentTotalCount, array('class' => 'counter'));
		}?>
	</li>
	<li class="arrow">
		<?php echo $HTML->link(Router::url('adminMediaFiles'), __('Dateien')); ?>
		<?php if (!empty($MediaFileTotalCount)) {
			echo $HTML->tag('small', $MediaFileTotalCount, array('class' => 'counter'));
		}?>
	</li>
	<li class="arrow">
		<?php echo $HTML->link(Router::url('adminUser'), __('Benutzer')); ?>
		<?php if (!empty($UserTotalCount)) {
			echo $HTML->tag('small', $UserTotalCount, array('class' => 'counter'));
		}?>
	</li>
</ul>
<ul class="rounded">
	<li class="arrow"><?php echo $HTML->link(Router::url('adminMediaFiles'), __('Einstellungen')); ?></li>
</ul>