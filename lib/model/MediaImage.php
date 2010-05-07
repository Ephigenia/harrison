<?php

class_exists('MediaFile') or require dirname(__FILE__).'/MediaFile.php';

/**
 * Media File (Image) class
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class MediaImage extends MediaFile
{	
	public $name = 'MediaFile';
	
	public function src($width = null, $height = null, $method = 'resize')
	{
		if (!$this->exists()) return false;
		if (empty($width)) {
			$width = 'auto';
		}
		if (empty($height)) {
			$height = 'auto';
		}
		return WEBROOT.'static/img/public/'.$this->unique_id.'/'.$width.'x'.$height.'/'.$method.'/'.$this->filename;
	}
	
	public function listCachedFiles()
	{
		$searchPattern = CACHE_DIR.substr($this->filename, 0, -4).'*';
		return glob($searchPattern);
	}
	
	public function deleteFiles()
	{
		// delete cached files
		foreach($this->listCachedFiles() as $cachedFilename) {
			@unlink($cachedFilename);
		}
		return parent::deleteFiles();
	}
}