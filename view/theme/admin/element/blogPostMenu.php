<?php

// Admin-Menu for Blog Posts
if (empty($BlogPost)) return false;
$detailPageUri = $BlogPost->adminDetailPageUri();

?>
<ul class="admin">
	<li>
		<?php echo $HTML->link($BlogPost->detailPageUri(), __('anschauen'), array('target' => '_blank')); ?>
	</li>
	<li>
		<?php echo $HTML->link($detailPageUri.'edit/', __('editieren')); ?>
	</li>
	<li>
		<?php echo $HTML->link(
				$detailPageUri.'delete/',
				__('löschen'),
				array(
					'class' => 'deleteConfirm delete',
					'title' => __('Den Blogeintrag <q>:1</q> wirklich löschen?', $BlogPost->get('headline', 'BlogPost #'.$BlogPost->id))
				)
			); ?>
	</li>
</ul>