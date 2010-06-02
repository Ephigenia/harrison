<tr class="BlogPost<?php
	if ($BlogPost->status & Status::PENDING) echo ' pending';
	if ($BlogPost->status & Status::DRAFT) echo ' draft';
	?>">
	<td class="created">
		<abbr title="<?php echo date('c', $BlogPost->published); ?>">
			<?php echo strftime('%x %H:%M', $BlogPost->published)?>
		</abbr>
		<?php
		if ($BlogPost->status != Status::PUBLISHED) {
			echo Status::$list[$BlogPost->status].'<br />';
		}?>
		<?php echo $this->renderElement('blogPostMenu', array('BlogPost' => $BlogPost))?>
	</td>
	<td>
		<?php echo $HTML->link($BlogPost->adminDetailPageUri('edit'), $BlogPost->get('headline', 'BlogPost #'.$BlogPost->id)); ?><br />
		<p>
			<?php echo wordwrap($BlogPost->excerpt(500), 30, LF, true) ?> …
		</p>
		<cite>
			<?php echo $this->renderElement('gravatar', array('User' => $BlogPost->User)); ?>
			<?php echo $HTML->link($BlogPost->User->detailPageUri(), $BlogPost->User->get('name')); ?>
		</cite>
		<?php
		if ($BlogPost->Comments->count() > 0) {
			echo ' '.$HTML->link(
				Router::getRoute('adminCommentBlogPost', array('blogPostId' => $BlogPost->id)),
				__n(':1 Kommentar', ':1 Kommentare', $BlogPost->Comments->count())
			);
		} ?>
	</td>
</tr>