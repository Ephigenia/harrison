<h1><?php echo __('Dateien und Bilder'); ?></h1>
<h2><?php echo __('Kategorien'); ?></h2>
<?php if (!empty($Folders)) { ?>
<table class="Folders">
	<tbody>
		<?php foreach($Folders as $Folder) { ?>
		<tr>
			<td class="Folder">
				<?php echo $HTML->link(Router::getRoute('adminFolderView', array('id' => $Folder->id)), $Folder->get('name')) ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } 

if (!empty($Files)) { ?>
<h2><?php echo Sanitize::html(__('Dateien & Bilder')) ?></h2>
<div class="MediaFiles">
	<?php foreach($Files as $MediaFile) {
		echo $this->renderElement('mediaFile', array('MediaFile' => $MediaFile));
	} ?>
</div>
<?php } ?>