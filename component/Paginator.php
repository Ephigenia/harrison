<?php

namespace app\component;

use DoctrineExtensions\Paginate\Paginate;

class Paginator
{
	protected $controller;
	
	public $page = 1;
	public $perPage = 10;
	public $pagesTotal = 0;
	public $total = 0;
	
	public $url;
	
	public function __construct(\ephFrame\core\Controller $controller)
	{
		$this->controller = $controller;
		$this->HTML = new \ephFrame\view\helper\HTML();
	}
	
	public function paginate($query)
	{
		$this->total = Paginate::getTotalQueryResults($query->getQuery());
		$this->pagesTotal = ceil($this->total / $this->perPage);
		$query = Paginate::getPaginateQuery($query->getQuery(), $offset = ($this->page - 1) * $this->perPage, $this->perPage);
		return $query->getResult();
	}
	
	public function page($page, $label = null, Array $attributes = array()) 
	{
		if (!$this->hasPage($page)) return false;
		return $this->HTML->link(
			$this->url($page),
			@$label ?: $page,
			$attributes
		);
	}
	
	public function url($page, Array $params = array())
	{
		return $this->url->uri(array(
			'page' => $page,
			'perPage' => $this->perPage,
			) + $this->controller->params + $params);
	}
	
	public function current($label = null, Array $attributes = array())
	{
		return $this->page($this->page, $label, $attributes);
	}
	
	public function hasPage($page) 
	{
		return ((int) $page <= $this->pagesTotal);
	}
	
	public function first($label = null, Array $attributes = array()) 
	{
		return $this->page(1, $label, $attributes);
	}
	
	public function last($label = null, Array $attributes = array())
	{
		return $this->page($this->pagesTotal, $label, $attributes);
	}
	
	public function hasPrevious() 
	{
		return ($this->page > 1);
	}
	
	public function previous($label = null, Array $attributes = array()) 
	{
		return $this->page($this->page - 1 or 1, $label, $attributes);
	}

	public function hasNext() 
	{
		return $this->hasPage($this->page + 1);
	}
	
	public function next($label = null, Array $attributes = array()) 
	{
		return $this->page($this->page + 1, $label, $attributes);
	}
	
	public function numbers($tag = 'li', Array $attributes = array(), $padding = 2) 
	{
		$numbers = array();
		for ($i = 1; $i <= $this->pagesTotal; $i++) {
			if (
				$i == $this->page - $padding - 1 ||
				$i == $this->page + $padding + 1
				) {
				$numbers[] = $this->HTML->tag($tag, '…');
				continue;
			}
			if (!(
				$i >= ($this->page - $padding) && $i <= ($this->page + $padding)
				|| $i < $padding + 1
				|| $i > $this->pagesTotal - $padding
				)) {
				continue;
			}
			$a = $attributes;
			if ($i == $this->page) {
				$a['class'] = 'current';
			}
			$numbers[] = $this->HTML->tag($tag, $this->page($i, $i, $a));
		}
		return implode(PHP_EOL, $numbers);
	}
	
	public function __toString()
	{
		return $this->numbers();
	}
}