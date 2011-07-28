<?php

namespace harrison\model;

use 
	Doctrine\ORM\EntityRepository,
	Doctrine\ORM\Query\Expr\Comparison
	;

class Repository extends EntityRepository
{
	public function createQueryBuilder($alias)
	{
		$query = parent::createQueryBuilder($alias);
		$i = 0;
		if (is_array($this->conditions)) foreach($this->conditions as $index => $condition) {
			$i++;
			if (is_string($index)) {
				$paramName = 'param_'.$i;
				$value = $condition;
				$field = $index;
				if (!is_string($value)) {
					$query->andWhere(new Comparison($field, '=', $value));
				} else {
					$query->setParameter($paramName, $value);
					$query->andWhere(new Comparison($field, '=', ':'.$paramName));
				}
			} else {
				$query->andWhere($condition);
			}
		}
		if (is_array($this->order)) foreach($this->order as $index => $order) {
			if (is_string($index)) {
				$query->addOrderBy($index, $order);
			} else {
				if (!is_array($order)) $order = array($order);
				call_user_func_array(array($query, 'addOrderBy'), $order);
			}
		}
		return $query;
	}
}