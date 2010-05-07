<h1><?php echo __('Sprache erstellen'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminLanguage'), __('Sprachen')); ?></li>
	<li><?php echo __('Sprache erstellen'); ?></li>
</ul>

<p class="hint">
	<?php echo __('Erstellen Sie hier eine neue Sprache um für diese unter Seiten und Dateibeschreibungen hinzuzufügen.')?>
	<?php echo __('Deaktivierte Sprachen sind für den Besucher Ihrer Website nicht sichtbar oder auswählbar.')?>
</p>
<?php echo $AdminLanguageForm ?>