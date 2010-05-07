<!-- CommentsList -->
<table id="<?php echo $elementBaseName; ?>">
	<tbody>
	<?php if (!empty($Comments)) foreach($Comments as $Comment) { ?>
		<tr class="Comment<?php
			if ($Comment->status & Status::PENDING) echo ' pending'
			?>">
			<td class="date">
				<abbr title="<?php echo date('c', $Comment->created); ?>">
					<?php echo strftime('%x %H:%M', $Comment->created); ?>
				</abbr><br />
				<?php echo $this->renderElement('commentMenu', array('Comment' => $Comment))?>
			</td>
			<td class="object">
				<?php
				$gravatar = $this->renderElement('gravatar', array('email' => $Comment->get('email')));
				if ($Comment->User->exists()) {
					$username = $gravatar.' '.$HTML->link($Comment->User->detailPageUri(), $Comment->get('name'));
				} else {
					$username = $gravatar.' '.Sanitizer::html($Comment->get('name'));
				}
				
				?>
				<cite><?php echo $username; ?></cite>
				<?php if ($Comment->hasField('ip') && !$Comment->isEmpty('ip')) { ?>
					<abbr class="ip" title="<?php echo __('IP Adresse des Benutzers.'); ?>">(<?php echo long2ip($Comment->ip) ?>)</abbr>
				<?php } ?>
				<?php echo $HTML->link($Comment->BlogPost->detailPageUri(), $Comment->BlogPost->get('headline', 'BlogPost '.$Comment->BlogPost->id)) ?>
				<p>
					<?php echo wordwrap(String::truncate($Comment->text, 400, '…'), 30, LF, true) ?>
				</p>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>