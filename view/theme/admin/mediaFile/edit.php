<h1><?php echo $pageTitle; ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')) ?></li>
	<?php if ($MediaFile->Folder->exists()) {
		echo '<li>'.$HTML->link($MediaFile->Folder->adminDetailPageUri(), __($MediaFile->Folder->get('name'))).'</li>';
	}?>
	<li><?php echo $MediaFile->get('name', $MediaFile->getText('title', $MediaFile->filename)); ?></li>
</ul>

<?php
// image thumbnail
if ($MediaFile->isImage() && $MediaFile->file()) {
	echo '<div class="thumb">';
	echo $HTML->link(WEBROOT.$MediaFile->filename(), $HTML->image($MediaFile->src(320, 240, 'resize')), array('title' => __('Klicken um Originalauflösung zu sehen.')));	
	echo '</div>'.LF;
} else {
	echo $this->renderElement('mediaFile', array('mediaFile' => $MediaFile)).'<br class="c" />';
} ?>

<h2>Datei</h2>
<p class="hint">
	<?php echo __('Ersetzen Sie mit dem Upload-Formular diese Datei durch eine andere oder wählen Sie eine neue Kategorie aus um diese Datei
	in diese zu schieben.')?>
</p>
<?php echo $AdminMediaFileForm ?>

<h2><?php echo Sanitizer::html(__('Beschreibung & Titel')) ?></h2>
<p class="hint">
	<?php echo __('Folgende Angaben sind optional und werden nur auf bestimmten Seiten oder gar nicht ausgegeben (Abhängig vom ausgewähltem Template).'); ?>
	<?php echo __('Vergessen sie nicht nach jeder Änderung die sie speichern möchten <strong>Speichern</strong> zu drücken!')?>
</p>
<div class="tabs">
	<ul>
		<?php foreach($Languages as $Language) { ?>
		<li><?php echo $HTML->link('#', $Language->get('name'), array('class' => $Language->id)); ?>
		<?php } ?>
		<li><a href="javascript:void(0)" class="all"><?php echo __('Vergleichend') ?></a></li>
	</ul>
	<div class="tabList">
		<?php foreach($Languages as $Language) { ?>
		<div class="tab <?php echo $Language->id; ?>">
			<?php echo ${'AdminMediaTextForm'.String::ucfirst($Language->id)}; ?>
		</div>
		<?php } ?>
		<br class="c" />
	</div>
</div>