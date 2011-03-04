<h1><?php echo $pageTitle ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo __('Blogeinträge'); ?></li>
</ul>
<?php if (empty($BlogPosts)) {
	echo $HTML->p(__('Es sind noch keine Blogeinträge vorhanden.'), array('class' => 'hint'));
} else {
	echo $AdminSearchForm;
	echo $this->element('pagination');
	echo $this->element('blogPosts', array('BlogPosts' => $BlogPosts));
	echo $this->element('pagination');
}