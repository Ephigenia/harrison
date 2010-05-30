<div class="toolbar">
	<?php
	echo $HTML->link('#', __('back'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<?php if (!empty($Files)) { ?>
	<ul class="edgetoedge images">
	<?php foreach($Files as $MediaFile) { ?>
		<li class="arrow">
			<a href="<?php echo $MediaFile->adminDetailPageUri('edit') ?>">
				<?php echo $this->element('mediaFileThumb', array('MediaFile' => $MediaFile, 'width' => 47, 'height' => 47, 'method' => 'resizeCrop', 'link' => false)); ?>
				<?php echo $MediaFile->getText('title', $MediaFile->filename); ?>
			</a>
		</li>
		<?php
	} ?>
	</ul>
	<?php
}