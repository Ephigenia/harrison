<h1><?php echo $pageTitle; ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminNode'), __('Seiten')); ?></li>
	<?php if (!empty($Node)) {
		echo $HTML->tag('li', $HTML->link($Node->adminDetailPageUri(array('action' => 'edit')), Sanitizer::HTML($Node->getText('headline', $Node->name))));	
	} ?>
	<li><?php echo $headline ?></li>
</ul>

<?php echo $AdminNodeForm ?>