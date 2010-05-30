<?php

/**
 * Wall Component
 * 
 * Simple Component that can be used to create facebook-like walls. It reads
 * from multiple models and orders the results by creation/published dates.
 * 
 * <code>
 * // example read from blogPosts and Comment
 * $WallItems = $this->Wall->read(array($this->BlogPost, $this->Comment));
 * </code>
 * 
 * @package harrison
 * @subpackage harrison.lib.component
 * @since 2010-05-24
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class Wall extends AppComponent
{
	public function read(Array $models = array())
	{
		$orderFields = array(
			'lastlogin', 'published', 'created',
		);
		$WallItems = array();
		foreach($models as $Model) {
			// determine field model data should be ordered by
			$order = array();
			foreach($orderFields as $fieldname) {
				if (!$Model->hasField($fieldname)) continue;
				$timeField = $fieldname;
				$order[$timeField] = DBQuery::ORDER_DESC;
			}
			if (empty($timeField)) continue;
			// read items and add them with ordered time index to return array
			$Model->order = array();
			$Items = $Model->findAll(null, $order, 0, 10, 1);
			if ($Items) foreach ($Items as $Item) {
				$WallItems[$Item->get($timeField)] = $Item;
			}
		}
		ksort($WallItems);
		$WallItems = array_reverse($WallItems);
		$WallItems = array_slice($WallItems, 0, 20);
		return $WallItems;
	}
}