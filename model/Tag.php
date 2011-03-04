<?php

/**
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-04-10
 */
class Tag extends AppModel
{
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		),
	);
	
	public function beforeInsert()
	{
		if (!$this->isEmpty('name') && $tag = $this->findByName($this->get('name'))) {
			$this->set('id', $tag->id);
			return false;
		}
		return parent::beforeInsert();
	}
}