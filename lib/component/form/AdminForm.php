<?PHp

/**
 * Base for all forms used in the admin
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-14
 * @package harrison
 * @subpackage harrison.lib.component.forms
 */
class AdminForm extends AppForm
{
	public function beforeRender()
	{
		// add optional to all non mandatory fields
		foreach($this->fieldset->children() as $FormField) {
			if ($FormField instanceof FormField
				&& !in_array($FormField->type, array('checkbox', 'submit'))
				&& !$FormField->mandatory) {
				$FormField->label .= ' '.__('(optional)');
			}
		}
		return parent::beforeRender();
	}
}