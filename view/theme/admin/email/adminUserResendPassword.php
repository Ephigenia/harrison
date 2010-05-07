Hallo <?php echo $User->get('name') ?>,

<?php echo $Me->get('name') ?> hat Ihnen ein neues Passwort für <?php echo AppController::NAME ?> generiert.
Bitte benutzen Sie zum einloggen diese neuen Zugangsdaten:

Email:		<?php echo $User->email.LF ?>
Passwort:	<?php echo $User->password.LF ?>

<?php echo Router::getRoute('adminLogin', null, true).LF ?>

Mit freundlichen Grüßen,
<?php echo $Me->get('name').LF; ?>
<?php echo AppController::NAME ?>