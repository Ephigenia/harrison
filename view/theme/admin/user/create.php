<h1><?php echo __('Benutzer erstellen'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home'))?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')); ?></li>
	<li><?php echo __('Benutzer erstellen'); ?></li>
</ul>

<p class="hint">
	<?php echo __('Wenn Sie kein Passwort für den neuen Benutzer angeben wird ein Passwort erzeugt.')?>
</p>
<?php if (!empty($errorEmail)) { ?>
<p class="error">
	<?php echo __('Der Benutzer konnte nicht erstellt werden!')?><br />
	<?php echo __('Es ist ein Fehler beim Versenden der Email aufgetreten. Bitte versuchen Sie es später erneut.'); ?><br />
	<?php echo __('Sollte dieser Fehler dauerhaft auftreten wenden Sie sich bitte an den System-Administrator.')?>
</p>
<?php } ?>

<?php echo $AdminUserForm ?>