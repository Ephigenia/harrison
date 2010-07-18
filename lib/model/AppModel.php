<?php

/**
 * ephFrame: <http://code.marceleichner.de/project/ephFrame/>
 * Copyright 2007+, Ephigenia M. Eichner, Kopernikusstr. 8, 10245 Berlin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright 2007+, Ephigenia M. Eichner
 * @link http://code.marceleichner.de/projects/ephFrame/
 * @filesource
 */

ephFrame::loadClass('ephFrame.lib.model.Model');

/**
 * The AppModel should be the parent class for every model used in the
 * application. So you can include basic methods that should be accessible
 * from every model in the application
 *
 * @package harrison
 * @subpackage harrison.lib.model
 */
class AppModel extends Model
{
	/**
	 *	Uses the router and the name of the model to return a detail page
	 *	uri that leads to the detail page of of a model entry
	 *	@param array(string) $additionalParams
	 *	@return string
	 */
	public function adminDetailPageUri($additionalParams = array())
	{
		if (!is_array($additionalParams)) {
			$additionalParams = array('action' => $additionalParams);
		}
		$params = array_merge(array('action' => '', 'id' => $this->id, 'controller' => $this->name), $additionalParams);
		$uri = Router::getRoute('admin'.String::ucFirst($this->name).'Id', $params);
		if (empty($uri)) {
			$uri = Router::getRoute('adminScaffoldId', $params);
		}
		return $uri;
	}
}