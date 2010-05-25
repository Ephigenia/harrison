<h1><?php echo Sanitizer::html($Node->getText('headline', $Node->get('name'))); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminNode'), __('Seiten')); ?></li>
	<li><?php echo Sanitizer::html($Node->getText('headline', $Node->get('name'))); ?></li>
</ul>

<?php $JavaScript->link('tabs.js'); $CSS->link('tabs')?>
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
			<?php echo ${'AdminNodeTextForm'.ucfirst($Language->id)}; ?>
		</div>
		<?php } ?>
		<br class="c" />
	</div>
</div>

<h2><?php echo Sanitizer::html(__('Seiten-Informationen & Einstellungen')); ?></h2>
<?php echo $AdminNodeForm; ?>

<h2><?php echo __('Angehangene Dateien'); ?></h2>
<?php if (!isset($Node->MediaFiles[0])) { ?>
	<p class="hint">
		<?php echo __('An diese Seite sind noch keine Dateien angehangen. Manche Templates erlauben das Anzeigen von Dateien.'); ?>
		<?php echo $HTML->link($Node->adminDetailPageUri().'upload/', __('Datei hochladen')) ?>
	</p>
<?php } else { ?>
	<ul class="admin">
		<li><?php echo $HTML->link($Node->adminDetailPageUri().'upload/', __('Datei hochladen')) ?></li>
	</ul><br class="c" />
	<?php foreach($Node->MediaFiles as $File) {
		echo $this->element('mediaFile', array('mediaFileIcon' => $File, 'displayMoveLinks' => true));
	}
} ?>