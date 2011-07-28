<?php

namespace harrison\component;

use
	DoctrineExtensions\Paginate\Paginate
	;

class Paginator
{
	protected $controller;
	
	public $page = 1;
	public $perPage = 10;
	public $pagesTotal = 0;
	public $total = 0;
	
	public $seperator = PHP_EOL;
	
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
		if (!$this->hasPage($page)) {
			return false;
		}
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
		return ((int) $page <= $this->pagesTotal && $page > 0);
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
	
	public function numbers($tag = 'li', $padding = 2, Array $attributes = array()) 
	{
		$pages = array();
		if ($this->page > $padding) {
			$pages = range(1, $padding);
			$pages[] = '…';
		}
		for ($page = ($this->page - $padding); $page < ($this->page + $padding) + 1; $page++) {
			if ($page < 0 && $page > $this->pagesTotal) continue;
			$pages[] = $page;
		}
		if ($this->page < $this->pagesTotal - $padding) {
			$pages[] = '…';
			$pages = array_merge($pages, range($this->pagesTotal - $padding, $this->pagesTotal));
		}
		$tags = array();
		foreach($pages as $page) {
			if (is_numeric($page)) {
				if ($page == $this->page) {
					$a = $attributes + array('class' => 'selected');
				} else {
					$a = $attributes;
				}
				$value = $this->HTML->tag($tag, $this->page($page, $page), $a + array('escape' => false));	
			} else {
				$value = '…';
			}
			$tags[] = $value;
		}
		return implode($tags, $this->seperator);
	}
	
	public function __toString()
	{
		return $this->numbers();
	}
}