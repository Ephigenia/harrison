<?php

/**
 * Lightbox Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-08-27
 */
class LightboxController extends AppController 
{
	public $publicActions = array(
		'all',
	);
	
	public $uses = array(
		'Node',
	);
	
	public function add($modelName, $id)
	{
		if ($Model = $this->{$modelName}->findById($id)) {
			$this->Lightbox->add($Model);
		}
		$this->redirect($this->referer('/'));
	}

	public function remove($modelName, $id)
	{
		if ($Model = $this->{$modelName}->findById($id)) {
			$this->Lightbox->delete($Model);
		}
		$this->redirect($this->referer('/'));
	}

	public function delete($id = null)
	{
		$this->Lightbox->destroy();
		$this->redirect($this->referer('/'));
	}
	
	public function clear()
	{
		return $this->delete();
	}
}