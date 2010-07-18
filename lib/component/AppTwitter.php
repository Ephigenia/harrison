<?php

/**
 * @package harrison
 * @subpackage harrison.lib.component
 * @since 2009-11-15
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class AppTwitter extends Component
{
	private $config = array(
		'username' => false,
		'password' => false,
	);
	
	private $cacheTime = 600;
	
	private $postCount = 10;
	
	public function startUp()
	{
		$this->config = Registry::get('Twitter');
		return parent::startUp();
	}
	
	public function cacheFilename()
	{
		return TMP_DIR.'cache/twitter_'.Sanitizer::filename($this->config['username']).'.json';
	}

	public function beforeRender()
	{
		$cacheFilename = $this->cacheFilename();
		if (!file_exists($cacheFilename)
			|| (file_exists($cacheFilename)
			&& filemtime($cacheFilename) < time() - $this->cacheTime)
			) {
			ephFrame::loadClass('ephFrame.lib.api.Twitter');
			$Twitter = new Twitter($this->config['username'], $this->config['password']);
			$Twitter->timeout = 1;
			try {
				if ($Posts = $Twitter->timeline($this->username, $this->postCount)) {
					$this->controller->set('TwitterPosts', $Posts);
					file_put_contents($cacheFilename, json_encode($Posts));
				}
			} catch (TwitterException $e) { }
		} else {
			$Posts = json_decode(file_get_contents($cacheFilename));
		}
		if (!empty($Posts)) {
			$this->controller->set('TwitterPosts', $Posts);
		}
		return parent::beforeRender();
	}
}