<tr class="mediaFile">
	<td class="created">
		<abbr title="<?php echo date('c', $MediaFile->created); ?>">
			<?php echo strftime('%x %H:%M', $MediaFile->created); ?>
		</abbr><br />
		<?php echo $this->element('mediaFileMenu', array('MediaFile' => $MediaFile)); ?>
	</td>
	<td>
		<div class="fl">
			<?php echo $this->element('mediaFileThumb', array('MediaFile' => $MediaFile, 'width' => '120', 'height' => '80')); ?>
		</div>
		<dl class="fl">
			<dt><?php echo __('Dateiname'); ?></dt>
			<dd><a href="<?php echo $MediaFile->adminDetailPageUri(array('action' => 'edit')) ?>" title="<?php echo __('Datei editieren') ?>">
				<?php echo $MediaFile->getText('title', $MediaFile->filename); ?>
				</a>
			</dd>
			<?php if ($MediaFile instanceof MediaImage) { ?>
			<dt><?php echo __('Abmessungen'); ?></dt>
			<dd><?php echo sprintf('%dx%dpx', $MediaFile->width, $MediaFile->height); ?></dd>
			<?php } ?>
			<dt><?php echo __('Dateigröße'); ?></dt>
			<dd><?php
				if ($MediaFile->file()) {
					$fileSize = $MediaFile->file()->size(2, true);
				} else {
					$fileSize = 'NaN';
				}
				echo $fileSize;
			?></dd>
		</dl>
	</td>
</tr>