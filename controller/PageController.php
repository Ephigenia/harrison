<?php

namespace app\controller;

use app\controller\Controller;

/**
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 16.12.2008
 */
class PageController extends Controller
{
	public function view($name = null)
	{
		$this->view->renderer['view'] = new \app\component\view\renderer\Markdown();
		$this->action = $name;
	}
}