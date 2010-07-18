<?php 

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Blog Post form
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 14.04.2009
 */
class AdminBlogPostForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			'BlogPost' => array(
				'fields' => array(
					'headline' => array(
						'label' => __('Titel'),
						'mandatory' => true
					),
					'uri' => array(
						'label' => __('URI'),
						'mandatory' => false,
					),
					'text' => array(
						'label' => false,
					),
					'tags' => array(
						'mandatory' => false,
						'type' => 'textarea',
						'rows' => 2,
						'label' => __('Tags (SEO'),
					),
					'status' => array(
						'type' => 'DropDown',
						'options' => Status::$list,
						'value' => Status::PUBLISHED,
					),
					'language_id' => array(
						'type' => 'DropDown',
						'label' => __('Sprache'),
						'options' => $this->controller->Language->listAll('name', null, 'name ASC'),
					),
					'user_id' => array(
						'type' => 'DropDown',
						'label' => __('Autor'),
						'options' => $this->controller->User->listAll('User.name', null, 'User.name ASC'),
						'value' => $this->controller->UserLogin->User->id,
					),
					'published' => array(
						'type' => 'DateTime',
						'label' => __('Veröffentlichungsdatum'),
					),
				),
			),
			array(
				'name' => 'allowComments',
				'type' => 'checkbox',
				'label' => __('Kommentare erlauben'),
				'checked' => 'checked',
			),
			array(
				'name' => 'sticky',
				'type' => 'checkbox',
				'label' => 	__('Eintrag oben halten (sticky)'),
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern')
			),
		);
		return parent::startUp();
	}
	
	public function toModel(Model $model, $fields = null, $ignore = null)
	{
		if ($model->behaviors->hasBehavior('Flagable')) {
			if ($this->hasField('allowComments')) {
				$model->setFlag(BlogPostFlag::ALLOW_COMMENTS, $this->allowComments->value());
			}
			if ($this->hasField('sticky')) {
				$model->setFlag(BlogPostFlag::FLAG_STICKY, $this->sticky->value());
			}
		}
		// saving tags
		$this->Tags = new IndexedArray();
		$tags = array_filter(array_unique(preg_split('/\s+/i', $this->tags->value())));
		foreach($tags as $tag) {
			$Tag = new Tag(array(
				'name' => $tag,
				'model' => DBQuery::quote($model->name),
			));
			$Tag->set('BlogPostTag', array('model' => DBQuery::quote($model->name)));
			$model->Tags[] = $Tag;
		}
		return parent::toModel($model, $fields, $ignore);
	}
	
	public function fillModel(Model $model)
	{
		parent::fillModel($model);
		if (!$this->submitted() && $model) {
			$this->allowComments->checked($model->hasFlag(BlogPostFlag::ALLOW_COMMENTS));
			$this->sticky->checked($model->hasFlag(BlogPostFlag::FLAG_STICKY));
			// tags
			if (!empty($model->Tags)) {
				$tags = new IndexedArray();
				foreach($model->Tags as $Tag) {
					$tags[] = $Tag->get('name');
				}
				$this->tags->value($tags->implode(' '));
			}
		}
	}	
}