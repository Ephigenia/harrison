<h1>Fehler 404 - Seite nicht gefunden</h1>
<p>
	Die aufgerufene Seite ist leider nicht mehr auffindbar. Bitte überprüfe die URL
	und probier es noch mal wenn du willst.<br />
	<br />
	Die beste Möglichkeit schnell weiter zu lesen ist allerdings auf die
	<a href="<?php echo $Router->root->uri(); ?>">Homepage</a> zurück zu
	gehen.<br />
	<br />
	Viel Spass weiterhin!
</p>
<pre>
	<?php echo $Exception->getMessage(); ?>
	<?php throw $Exception; ?>
</pre>