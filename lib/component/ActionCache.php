<?php

require_once dirname(__FILE__).'/AppComponent.php';

/**
 * Simplest Action Cache Component
 * 	
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 15.05.2009
 */
class ActionCache extends AppComponent
{
	public $filename = '';
	
	public $components = array(
		'Session',
	);
	
	public $config = array(
		'Node' => array(
			'view' => WEEK,
			'index' => DAY,
			'press' => WEEK,
			'contact' => WEEK,
			'search' => WEEK,
			'sitemap' => WEEK,
		),
		'BlogPost' => array(
			'index' => WEEK,
			'rss' => WEEK,
			'view' => WEEK,
			'search' => WEEK,
		),
		'Comment' => array(
			'rss' => WEEK,
		),
	);
	
	public function clear($controllername = null, $actionName = null)
	{
		$glob = '';
		if ($controllername) {
			$glob = $controllername.'_';
		}
		if ($actionName) {
			$glob .= '*'.$actionName.'_';
		}
		if ($files = glob(CACHE_DIR.'views/'.$glob.'*')) {
			Log::write(Log::VERBOSE, sprintf('%s: clearing cache for "%s"', get_class($this), $glob));
			foreach($files as $filename) {
				unlink($filename);
			}
		}
		return true;
	}
	
	public function beforeAction()
	{
		// clear cache when post data arrives
		if ($this->controller instanceof AdminController) {
			if ($this->controller->request->isPost()) {
				$this->clear();
			}
			return true;
		}
		if ($this->controller->UserLogin->loggedin() || Registry::get('DEBUG') > DEBUG_PRODUCTION) {
			return true;
		}
		if (!isset($this->config[$this->controller->name][$this->controller->action])) {
			return true;
		}
		if ($this->controller->request->isGet()) {
			$ttl = $this->config[$this->controller->name][$this->controller->action];
			$id = $this->controller->name.'_'.$this->controller->layout.'_'.$this->controller->action.'_'.md5($this->controller->action.http_build_query($this->controller->params).I18n::locale());
			$this->filename = CACHE_DIR.'views/'.$id.'.html';
			if (file_exists($this->filename)) {
				// read from cache
				if (filemtime($this->filename) + $ttl > time()) {
					$rendered = file_get_contents($this->filename);
					// replace MD5
					$rendered = preg_replace('@md5" value="[\w\d]+"@', 'md5" value="'.md5($this->controller->request->host.SALT).'"', $rendered);
					$rendered = str_replace('</body>', '<!-- cached '.ephFrame::compileTime().' --></body>', $rendered);
					echo $rendered;
					die();
				}
			}
		}
		return true;
	}
	
	public function afterRender($rendered)
	{
		if (!empty($this->filename)) {
			file_put_contents($this->filename, $rendered);
		}
		return $rendered;
	}	
}