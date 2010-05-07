<h1><?php if (isset($Folder)) echo $Folder->get('name'); else echo Sanitizer::html(__('Dateien & Bilder')); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<li><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), Sanitizer::html(__('Dateien & Bilder'))); ?></li>
	<?php if (isset($Folder)) {
		echo $HTML->tag('li', $Folder->get('name'));
	} ?>
</ul>

<?php
if (isset($Folder) && !$Folder->isRoot()) {
	echo $this->renderElement('folderMenu', array('Folder' => $Folder)).'<br />';
}
?>

<?php if (!empty($Folders)) { ?>
<h2><?php echo __('Kategorien'); ?></h2>
<table class="Folders">
	<tbody>
		<?php foreach($Folders as $Folder) { ?>
		<tr>
			<td class="Folder">
				<?php echo $HTML->link($Folder->adminDetailPageUri().'?layout='.@$layout, $Folder->get('name')) ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php }

// list files in this directory
if (empty($Files[0])) {
	if (empty($Folders)) {
		echo $HTML->p('In diesem Ordner sind noch keine Dateien vorhanden.', array('class' => 'hint'));
	}
} else {
	if (!empty($Folders)) {
		echo '<h2>'.__('Dateien & Bilder ohne Kategorie').'</h2>'.LF;
	}
	echo $AdminSearchForm;
 	echo $this->renderElement('pagination');
	echo '<br />';
	foreach($Files as $MediaFile) {
		echo $this->renderElement('mediaFile', array('MediaFile' => $MediaFile));
	}
	echo '<br class="c" />';
 	echo $this->renderElement('pagination');
}

// add js for image adding
if (!empty($layout)) {
	$JavaScript->jQuery("
		$('.mediaFile a').attr('href', 'javascript:void(0))');
		$('.mediaFile').click(function() {
			var img = $(this).find('img');
			window.parent.$('textarea.text').replaceSelection('[[' + basename(img.attr('src')) + ']]');
			window.parent.$('body').data('DialogManager').closeAll();
		});
	");
}