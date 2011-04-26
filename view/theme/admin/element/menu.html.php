<nav>
	<ul>
		<li>BlogPosts</li>
		<li><?php echo $HTML->link(
			$Router->adminScaffold(array('controller' => 'BlogPost', 'action' => 'index')),
			'Blogeinträge'
		); ?></li>
	</ul>
</nav>