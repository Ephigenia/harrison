<h1><?php echo __('Kategorie erstellen') ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')); ?></li>
	<li><?php echo __('Kategorie erstellen')?></li>
</ul>
<p class="hint">
	<?php echo __('Kategorien sind dazu gedacht viele Dateien in eine gewisse Ordnung zu bringen. Sie können Dateien jeder Zeit
	in andere Kategorien verschieben.')?>
</p>
<?php echo $AdminFolderForm; ?>