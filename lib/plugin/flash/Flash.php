<?php

namespace flash;

class Flash
{
	protected $storage;
	
	public static $instance;
	
	public function __construct(\ephFrame\storage\Adaptable $storage = null)
	{
		$this->storage = $storage ?: new \ephFrame\storage\Session();
	}
	
	public function __call($type, Array $args = array())
	{
		if (empty($args)) {
			if (isset($this->storage['Flash.'.$type])) {
				$r = $this->storage['Flash.'.$type];
				unset($this->storage['Flash.'.$type]);
				return $r;
			}
			return false;
		}
		$this->storage['Flash.'.$type] = $args[0];
		return $this;
	}

	public static function __callStatic($type, Array $args = array())
	{
		if (!self::$instance) {
			self::$instance = new Flash();
		}
		return call_user_func_array(array(self::$instance, $type), $args);
	}
}