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
	public function view($id = null)
	{
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