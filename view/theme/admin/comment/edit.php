<h1><?php echo __('Kommentar editieren') ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminComment'), __('Kommentare')) ?></li>
	<li><?php echo __('Kommentar editieren') ?></li>
</ul>
<?php echo $AdminCommentForm ?>