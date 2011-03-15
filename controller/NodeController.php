<?php

namespace app\controller;

use app\controller\Controller;

use app\entities\Node;

/**
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 16.12.2008
 */
class NodeController extends Controller
{
	public function view($id = null)
	{
		$this->view->renderer['view'] = new \app\component\MarkdownRenderer();
		if (isset($this->params['id'])) {
			$Node = $this->entityManager()->find('app\entities\Node', (int) $id);
		} elseif (isset($this->params['uri'])) {
			$query = $this->entityManager()->createQuery('SELECT node FROM app\entities\Node node WHERE node.uri = :uri');
			$query->setParameter('uri', $this->params['uri']);
			$Node = $query->getSingleResult();
		}
		$this->view->data['Node'] = $Node;
		return $Node;
	}
}