<h1><?php echo $User->get('name'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?></li>
	<li><?php echo $User->get('name'); ?></li>
</ul>

<?php echo $this->element('userMenu'); ?>

<?php
// blocked message
if ($User->hasFlag(UserFlag::BLOCKED)) { ?>
<p class="hint">
	<?php
		echo __('Der Benutzer :1 ist zur Zeit gesperrt und kann sich nicht einloggen.', $User->get('name')).'<br />';
		echo $HTML->link($User->adminDetailPageUri(array('action' => 'unblock')), __(':1 wieder freischalten', $User->get('name')));
	?>
</p>
<?php } ?>

<?php echo $this->element('gravatar', array('User' => $User, 'size' => 60)); ?>
<dl>
	<dt><?php echo __('Name') ?></dt>
	<dd><?php echo $User->get('name') ?></dd>
	<dt><?php echo __('Gruppe'); ?></dt>
	<dd><?php echo $User->UserGroup->get('name'); ?></dd>
	<dt><?php echo __('Email') ?></dt>
	<dd><?php echo $HTML->email($User->get('email')) ?></dd>
	<dt><?php echo __('Letzter Login') ?></dt>
	<dd><?php
		if ($User->lastlogin) {
			echo Time::timeAgoInWords($User->lastlogin).' ('.strftime('%x %H:%M', $User->lastlogin).')';
		} else {
			echo __('noch nie');
		}
		?>
	</dd>
</dl>