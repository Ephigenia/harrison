<h1><?php echo String::truncate($BlogPost->get('headline', __('Blogeintrag editieren')), 30, '…'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blogeinträge')) ?></li>
	<li><?php echo __('Blogeintrag editieren'); ?></li>
</ul>
<?php echo $AdminBlogPostForm ?>
