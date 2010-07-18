<?php

/**
 * Lightbox Component
 *
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-08-27
 */
class Lightbox extends Component implements Countable
{
	public $components = array(
		'Cookie',
	);
	
	public $data = array();
	
	protected $cookieVarname = 'lightbox';
	
	public function startup()
	{
		if ($data = $this->Cookie->read($this->cookieVarname)) {
			$this->data = $data;
		}
		return parent::startup();
	}
	
	public function beforeRender()
	{
		$this->controller->data->set('Lightbox', $this);
		return parent::beforeRender();
	}
	
	public function exists($model, $id = null)
	{
		if ($model instanceof Model) {
			$id = $model->id;
			$model = $model->name;
		}
		if (!isset($this->data[$model])) return false;
		if (!is_array($this->data[$model]));
		return in_array($id, $this->data[$model]);
	}
	
	public function add($model, $id = null)
	{
		if ($model instanceof Model) {
			$id = $model->id;
			$model = $model->name;
		}
		if (!$this->exists($model, $id)) {
			$this->data[$model][] = $id;
		}
		$this->Cookie->write($this->cookieVarname, $this->data);
		return true;
	}
	
	public function remove(Model $Model)
	{
		return $this->delete($Model);
	}
	
	public function delete(Model $Model)
	{
		if (!$this->exists($Model)) return false;
		foreach($this->data[$Model->name] as $index => $value) {
			if ($Model->id == $value) unset($this->data[$Model->name][$index]);
		}
		$this->Cookie->write($this->cookieVarname, $this->data);
		return true;
	}
	
	public function count()
	{
		return count($this->data);
	}
	
	public function destroy()
	{
		$this->Cookie->delete($this->cookieVarname);
		return true;
	}
}