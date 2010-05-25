<!-- BlogPosts -->
<table id="BlogPosts">
	<tbody>
		<?php if (!empty($BlogPosts)) foreach($BlogPosts as $BlogPost) { 
			echo $this->element('blogPost', array('BlogPost' => $BlogPost));
		} ?>
	</tbody>
</table>
