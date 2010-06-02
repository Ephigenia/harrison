<h1><?php echo String::truncate($pageTitle, 30, '…'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blogeinträge')) ?></li>
	<li><?php echo __('Blogeintrag editieren'); ?></li>
</ul>
<?php echo $this->element('blogPostMenu', array('BlogPost' => $BlogPost)); ?>
<br />
<?php echo $AdminBlogPostForm ?>
