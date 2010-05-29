<?php
if (!empty($Form->errors)) {
	echo $HTML->tag('div', implode('<br />', $Form->errors, array('class' => 'info error')));
}
echo $Form->renderOpenTag();
	?>
    <ul class="rounded"><?php
	foreach($Form->fieldset->children() as $Field) {
		if ($Field->type == 'submit') {
			$SubmitField = $Field;
			continue;
		}
		if ($Field->type == 'checkbox') {
			$Field->attributes['title'] = $Field->label;
		} else {
			$Field->attributes['placeholder'] = $Field->label;
		}
		$Field->label = false;
		?>
		<li>
			<?php echo $Field->render(); ?>
		</li>
		<?php
	} ?>
	</ul>
	<?php
	if (!empty($SubmitField)) {
		$SubmitField->attributes->class .= ' whiteButton';
		echo $SubmitField;
	}
	?>
<?php echo $Form->renderCloseTag(); ?>