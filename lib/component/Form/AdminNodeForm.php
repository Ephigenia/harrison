<?php 

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Node Text Form
 * 	
 * @subpackage harrison.lib.component.form
 * @package harrison
 * @since 2009-03-09
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class AdminNodeForm extends AdminForm
{
	public function startUp() {
		$this->config = array(
			'NodeText' => array(
				'fields' => array(
					'headline' => array(
						'mandatory' => false,
						'label' => __('Überschrift').':',
					),
					'subline' => array(
						'mandatory' => false,
						'label' => __('Unter-Überschrift (optional)').':',
					),
					'text' => array(
						'mandatory' => false,
						'label' => __('Text/Beschreibung').':',
					),
					'excerpt' => array(
						'mandatory' => false,
						'label' => __('Auszug/Zusammenfassung (optional)').':',
					),
					'keywords' => array(
						'mandatory' => false,
						'label' => __('Stichwörter (SEO)').':',
						'type' => 'text',
					),
					'user_id' => array(
						'type' => 'DropDown',
						'options' => $this->controller->User->listAll('User.name', null, 'User.name ASC'),
						'value' => $this->controller->UserLogin->User->id,
						'label' => __('Autor').':',
					),
				),
			),
			'Node' => array(
				'fields' => array(
					'published' => array(
						'type' => 'Date',
						'label' => __('Datum').':',
						'value' => time(),
					),
					'status' => array(
						'type' => 'DropDown',
						'options' => Status::$list,
						'value' => Status::PUBLISHED,
					),
					'template' => array(
						'type' => 'DropDown',
						'options' => $this->templateNames(),
						'value' => 'view',
					),
			)),
			array(
				'type' => 'checkbox',
				'name' => 'allowRSS',
				'label' => __('In RSS Feed integrieren'),
			),
			array(
				'type' => 'checkbox',
				'name' => 'allowComments',
				'label' => __('Kommentare erlauben'),
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
	
	public function afterConfig()
	{
		if ($this->controller->action == 'create') {
			// fill parent values
			$this->headline->insertBefore($this->newField('DropDown', 'parent')->label(__('Vater-Artikel')));
			if (!empty($this->controller->params['id']) && $ParentNode = $this->controller->Node->findById((int) $this->controller->params['id'])) {
				$this->fieldset->childWithAttribute('name', 'parent')->addOption($ParentNode->id, $ParentNode->get('name'));
			} else {
				foreach($this->controller->Node->tree(null, 0) as $Node) {
					$this->fieldset->childWithAttribute('name', 'parent')->addOption($Node->id, str_repeat('-', $Node->level).$Node->get('name'));
				}
			}
		}
		return parent::afterConfig();
	}
	
	public function toModel(Model $model, $fields = null, $ignore = null)
	{
		if ($model->behaviors->hasBehavior('Flagable')) {
			if ($this->hasField('allowComments')) {
				$model->setFlag(NodeFlag::ALLOW_COMMENTS, $this->allowComments->value());
			}
			if ($this->hasField('allowRSS')) {
				$model->setFlag(NodeFlag::ALLOW_RSS, $this->allowRSS->value());
			}
		}
		return parent::toModel($model, $fields, $ignore);
	}
	
	public function fillModel(Model $model)
	{
		parent::fillModel($model);
		if (!$this->submitted() && $model instanceOf Node) {
			if ($this->hasField('allowComments')) {
				$this->allowComments->checked($model->hasFlag(NodeFlag::ALLOW_COMMENTS));
			}
			if ($this->hasField('allowRSS')) {
				$this->allowRSS->checked($model->hasFlag(NodeFlag::ALLOW_RSS));
			}
			if ($this->hasField('user_id')) {
				$this->user_id->value($model->get('user_id'));
			}
		}
	}
	
	/**
	 *	Return possible template names that can be used by the nodes
	 *	for rendering by listing all files from the node view directory
	 *	
	 * 	@return array(string)
	 */
	public function templateNames()
	{
		$templateNames = new IndexedArray();
		// get correct template directory from appcontroller’s theme
		$r = get_class_vars('AppController');
		if (empty($r['theme'])) {
			$templateDir = VIEW_DIR.'node/';
		} else {
			$templateDir = VIEW_DIR.'theme/'.$r['theme'].'/node/';
		}
		// list files
		$dir = new Dir($templateDir);
		foreach ($dir->read('@\.php$@') as $file) {
			if (!$file->isFile()) continue; // ignore directories
			if (in_array($file->basename(false), array())) continue; // ignore files?
			$templateNames[$file->basename(false)] = $file->basename(false);
		}
		return $templateNames->toArray();
	}
}