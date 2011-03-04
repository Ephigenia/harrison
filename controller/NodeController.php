<?php

/**
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 16.12.2008
 */
class NodeController extends AppController
{	
	public $uses = array(
		'Node',
		'MediaFile',
		'Folder',
	);

	public $Node;
	
	public $components = array(
		'SEOKeywords',
	);
	
	public $helpers = array(
		'NodeTextFormater',
		'MarkDown',
		'Text',
		'Sanitizer',
	);
	
	public $publicActions = array(
		 'all',
	);
	
	public function beforeAction()
	{
		// find all nodes if logged in @todo add PermissionCheck to this
		if (isset($this->Node) && $this->UserLogin->loggedin()) {
			$this->Node->findConditions = array();
		}
		return parent::beforeAction();
	}
	
	/**
	 * Node Index Action
	 * @return void
	 */
	public function index()
	{
		$this->Node->unbind('MediaFile');
		// node root points
		$nodeNames = array(
			'Footer' => 'FooterNodes',
			'Hauptmenü' => 'MainMenuNodes',
		);
		foreach($nodeNames as $nodeName => $viewVar) {
			$Node = $this->Node->findByName($nodeName);
			if ($Children = $Node->tree(null, 1)) {
				$this->data->set($viewVar, $Children);
			}
		}
		return true;
	}
	
	public function view($idOrNodeName = null)
	{
		if (!$this->Node = $this->Node->findNode(coalesce($idOrNodeName, @$this->params['name'], @$this->params['id']))) {
			return false;
		}
		$this->data->set('Node', $this->Node);
		// add pagetitle and keywords to metatags
		$this->data->set('pageTitle', $this->Node->getText('headline'). ' - '.AppController::NAME);
		if ($tags = $this->Node->getText('tags')) {
			$this->AppMetaTags->keywords->prependFromArray(preg_split('/[\s]+/i', $tags));
		}
		// check if node has any children
		if ($this->Node->level == 2) {
			$this->Node->unbind('MediaFile');
			$this->Node->bind('FirstImage', 'hasOne', array('class' => 'MediaImage'));
		}
		// find children of the node
		if ($this->Node->hasChildren() && $ChildNodes = $this->Node->tree(0, 0)) {
			$this->data->set('ChildNodes', $ChildNodes);
		}
		// custom template
		if (!$this->Node->isEmpty('template')) {
			if ($this->Node->get('template') != 'view') {
				return $this->action($this->Node->get('template'), $this->params);
			} else {
				if ($SubMenu = $this->Node->findByName('Projects')) {
					$this->data->set('SubMenu', $SubMenu->tree(1,0));
				}
			}
		}
		return true;
	}
}