Hallo <?php echo $User->get('name') ?>!

<?php echo $Me->get('name') ?> hat einen neuen Benutzer für Sie auf <?php echo AppController::NAME ?> angelegt.
Sie können sich jetzt jederzeit einloggen unter Verwendung folgender Daten:

Email:		<?php echo $User->email.LF ?>
Passwort:	<?php echo $User->passwordUnmasked.LF ?>

<?php echo Router::getRoute('adminLogin', null, true).LF ?>

Mit freundlichen Grüßen,
<?php echo $Me->get('name').LF; ?>
<?php echo AppController::NAME ?>