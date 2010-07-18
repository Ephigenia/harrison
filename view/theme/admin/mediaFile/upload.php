<h1><?php echo __('Datei hochladen'); ?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<?php
	// upload into a folder aka category
	if (isset($Folder)) {
		echo $HTML->tag('li', $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')));
		echo $HTML->tag('li', $HTML->link($Folder->adminDetailPageUri(), $Folder->get('name')));
	// upload into a node
	} elseif (isset($Node)) {
		echo $HTML->tag('li', $HTML->link(Router::getRoute('adminNode'), __('Seiten')));
		echo $HTML->tag('li', $HTML->link(
			$Node->adminDetailPageUri(array('action' => 'edit')),
			String::truncate($Node->getText('headline', $Node->get('name')), 40, '…')
		));
	} else {
		echo $HTML->tag('li', $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien & Bilder')));
	}
	?>
	<li><?php echo __('Datei hochladen'); ?></li>
</ul>

<p class="hint">
	<?php echo __('Bitte beachten Sie beim Hochladen von Bildern, dasss diese nicht größer als <em>1024x1024 Pixel</em> sein sollten.'); ?>
	<?php if ($maxUploadFileSize = PHPINI::get('upload_max_filesize')) {
		echo __('Generell dürfen Dateien die hochgeladen werden sollen nicht größer als <em>:1</em> sein.', File::sizeHumanized($maxUploadFileSize));
	} ?>
</p>

<?php echo $AdminMediaFileForm; ?>

<?php
$CSS->addFile('uploadify');
$JavaScript->jQuery(<<<EOT
	// uploadify script
	$.getScript($('base').attr('href') + '../static/theme/admin/js/jquery.uploadify.v2.1.0.min.js', function() {
		$('#AdminMediaFileForm').parent().append('<div id="uploadify"></div>');
		$('#uploadify').uploadify({
			auto: true,
			cancelImg: false,
			multi: true,
			fileDataName: 'file',
			method: 'POST',
			uploader: $('base').attr('href') + '../static/theme/admin/swf/uploadify.swf',
			script: document.location.href + '?uploadify=1',
			scriptData: {
				'{$Session->name()}': '{$Session->id()}',
				'folder_id' : ''
			},
			'onAllComplete': function(event, data) {
				document.location.href = '$redirectUrl';
			},
			'onError': function(event, queueID, fileObj) {
				alert('an error occured');
			},
			'onInit': function() {
				$('#file, #AdminMediaFileForm input[type=submit]').hide();
				$('#AdminMediaFileForm').css('margin-bottom', '10px');
			}
		});
		
		// update folder id if changed
		$('select.folder_id').change(function() {
			$('#uploadify').uploadifySettings('scriptData', { 'folder_id': $(this).val() });
		});
	});
EOT
);