<?php

/**
 * 	Menu for Folders
 *
 * 	@author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */

if (empty($Folder)) return false;
?>
<ul class="admin">
	<li><?php echo $HTML->link($Folder->adminDetailPageUri(array('action' => 'edit')), __('Kategorie editieren'))?></li>
	<li><?php echo $HTML->link($Folder->adminDetailPageUri(array('action' => 'upload')), __('Datei hochladen'))?></li>
	<li><?=
		$HTML->link(
			$Folder->adminDetailPageUri(array('action' => 'delete')),
			__('löschen'),
			array(
				'class' => 'delete confirm',
				'title' => __('Die Kategorie <q>:1</q> wirklich löschen? Alle Dateien dieser Kategorie verlieren ihre Zuordnung, werden aber nicht gelöscht.', $Folder->get('name')),
			));
	?></li>
</ul>