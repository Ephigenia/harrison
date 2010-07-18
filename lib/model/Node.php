<?php

class_exists('Status') or require dirname(__FILE__).'/Status.php';

/**
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-02-27
 */
class NodeFlag
{	
	const ALLOW_CHILDREN 	= 32;
	const ALLOW_EDIT 		= 64;
	const ALLOW_DELETE 		= 128;
	const ALLOW_IMAGES 		= 256;
	
	const ALLOW_COMMENTS	= 512;
	const ALLOW_RSS			= 1024;
	
	public static $list = array(
		self::ALLOW_CHILDREN => 'allow children',
		self::ALLOW_EDIT => 'allow edit',
		self::ALLOW_DELETE => 'allow delete',
		self::ALLOW_IMAGES => 'allow image upload',	
	);
}

/**
 * Content Node Model
 *	
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 25.01.2009
 * @subpackage harrison.lib.model
 * @package harrison
 */
class Node extends AppModel
{
	public $behaviors = array(
		'Timestampable',
		'NestedSet',
		'Flagable',
	);

	public $findConditions = array(
		'Node.status' => Status::PUBLISHED,
	);
	
	public $belongsTo = array(
		'User',
	);
	
	public $hasMany = array(
		'MediaFile' => array(
			'dependent' => true,
		),
	);
	
	/**
	 * default node creation data
	 * @var array(string)
	 */
	public $data = array(
		'flags' => 480,
		'status' => Status::DRAFT,
		'template' => 'view',
	);
	
	public $uses = array(
		'Language',
	);
	
	public function afterConstruct()
	{
		foreach($this->Language->findAll() as $Language) {
			$modelName = 'NodeText'.ucFirst($Language->id);
			$this->bind($modelName, 'hasOne', array(
				'class' => 'NodeText',
				'dependent' => true,
				'conditions' => array(
					$modelName.'.language_id' => DBQuery::quote($Language->id),
				),
			));
			$this->{$modelName}->language_id = $Language->id;
		}
		return parent::afterConstruct();
	}
	
	public function beforeSave()
	{
		if (isset($this->Parent) && $this->Parent->exists()) {
			$this->parent_id = $this->Parent->id;
		}
		return parent::beforeSave();
	}
	
	/**
	 * Return uri to this node’s detail page
	 * 	
	 * @param string $languageId
	 * @return string
	 */
	public function detailPageUri(Array $params = array())
	{
		if (!$this->exists()) return false;
		$languageId = I18n::locale();
		$params = array(
			'languageId' => $languageId,
			'id' => $this->id,
			'uri' => $this->getText('uri', $languageId),
		);
		return Router::url('nodeView', $params);
	}
	
	/**
	 * Return a text from the appropriate NodeText[languageId] model
	 * or a $default value.
	 * 
	 * In a view you can echo headlines or names of the node like this:
	 * <code>
	 * echo $Node->getText('headline', $Node->get('name'));
	 * </code>
	 * @param string $varname
	 * @param string $languageId
	 * @param string|boolean $default
	 * @return stirng
	 */
	public function getText($varname, $languageId = null, $default = null)
	{
		$languageId = coalesce(@$languageId, I18n::locale());
		$languageModelName = 'NodeText'.ucFirst(substr($languageId, 0, 2));
		if (!isset($this->{$languageModelName})) {
			$languageModelName = 'NodeText'.ucfirst(substr(Registry::get('I18n.language'), 0, 2));
		}
		if ($this->{$languageModelName} instanceof Model && $this->{$languageModelName}->hasField($varname)) {
			return coalesce($this->{$languageModelName}->get($varname), $default, false);
		}
		return $default;
	}
	
	/**
	 * Tries to find a node by the passed $idOrNodeName
	 *	
	 * @param integer|string $idOrNodeName
	 * @return Node|boolean
	 */
	public function findNode($idOrNodeName, $languageId = null)
	{
		$this->depth = 1;
		$languageId = coalesce(@$languageId, I18n::locale());
		if (is_int($idOrNodeName)) {
			$conditions = array('id' => $idOrNodeName);
		} else {
			$conditions = array('NodeText'.ucfirst(substr($languageId, 0, 2)).'.uri' => DBQuery::quote($idOrNodeName));
		}
		return $this->find($conditions);
	}
}