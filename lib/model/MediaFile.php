<?php

class_exists('Image') or loadClass('ephFrame.lib.Image');
class_exists('I18n') or loadClass('ephFrame.lib.component.I18n');

/**
 * Media File class
 * 	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 04.12.2008
 * @package harrison
 * @subpackage harrison.lib.model
 */
class MediaFile extends AppModel
{	
	const FLAG_SHARPEN = 2;
	const FLAG_CUSTOM1 = 128;
	const FLAG_CUSTOM2 = 255;
	
	public $order = array(
		'position ASC',
		'created DESC',
	);
	
	public $belongsTo = array(
		'Node',
		'User',
		'Folder',
	);

	public $behaviors = array(
		'Timestampable',
		'Positionable',
		'Flagable',
		'HitCount',
	);
	
	public $uses = array(
		'Language',
	);
	
	public $path = 'img/upload/';
	
	public function afterConstruct()
	{
		foreach($this->Language->findAll() as $Language) {
			$modelName = 'Text'.ucFirst($Language->id);
			$this->bind($modelName, 'hasOne', array(
				'class' => 'MediaText',
				'foreignKey' => 'media_file_id',
				'dependent' => true,
				'conditions' => array(
					$modelName.'.language_id' => DBQuery::quote($Language->id),
				),
			));
			$this->{$modelName}->language_id = $Language->id;
		}
		return parent::afterConstruct();
	}
	
	public function getText($varname, $default = null)
	{
		$languageId = I18n::locale();
		$languageModelName = 'Text'.ucFirst(substr($languageId, 0, 2));
		if (!isset($this->$languageModelName)) {
			$languageModelName = 'TextDe';
		}
		if ($this->$languageModelName instanceof Model && $this->$languageModelName->hasField($varname)) {
			return coalesce($this->$languageModelName->get($varname), $default, $this->TextDe->get($varname));
		}
	}
	
	public function addFile(File $file, $filename = null)
	{
		// sanitize filename
		if (!$filename = Sanitizer::filename($filename)) {
			$filename = String::random(8);
		}
		$realFile = new File($filename);
		// if file type is known, set new extension
		$newFilename = $realFile->basename(false).'.'.$realFile->extension();
		// store files in flat hirarchy
		$file = $file->move(new Dir(STATIC_DIR.$this->path), $newFilename, true);
		$this->fromArray(array(
			'filename' => $file->basename(),
			'mime_type'	=> $file->mimeType(),
		));
		return $this;
	}
	
	public function replace(File $file, $filename = null)
	{
		$this->deleteFiles();
		$this->addFile($file, $filename);
		return true;
	}
	
	public function isImage()
	{
		return (in_array($this->mime_type, array('image/jpg', 'image/png', 'image/gif')));
	}
	
	public function file()
	{
		if (!file_exists($this->filename())) return false;
		if ($this->isImage()) {
			$this->file = new Image($this->filename());
		} else {
			$this->file = new File($this->filename());
		}
		return $this->file;
	}
	
	protected function generateUniqueId($length = 8)
	{
		return substr(md5($this->filename.SALT), 0, $length);
		// return substr(md5(String::random(16)), 0, $length);
	}
	
	/**
	 * Returns the original file’s filename with path
	 * @return string 
	 */
	public function filename()
	{
		return STATIC_DIR.$this->path.$this->filename;
	}
	
	public function beforeSave()
	{
		// uniqueID
		if ($this->hasField('unique_id')) {
			$this->set('unique_id', $this->generateUniqueId());
		}
		// normalize url
		if (!$this->isEmpty('url')) {
			$this->url = String::prepend(trim($this->url, '/'), 'http://', true);
		}
		// add file information to db
		if ($file = $this->file()) {
			$additionalInfo = array(
				'filename' => $file->basename(),
				'mime_type'	=> $file->mimeType(),
				'filesize' => $file->size(),
			);
			// some more infos about image files
			if ($this->isImage()) {
				$additionalInfo = array_merge($additionalInfo, array(
				 	'width'	=> $file->width(),
					'height' => $file->height(),
					'use_model' => 'MediaImage',
				));
			}
			$this->fromArray($additionalInfo);
		}
		return parent::beforeSave();
	}
	
	public function afterDelete()
	{
		$this->deleteFiles();
		return parent::afterDelete();
	}
	
	public function deleteFiles()
	{
		// delete possibly cached files in image cache
		$publicCacheDir = new Dir(STATIC_DIR.'img/public/'.$this->unique_id);
		if ($publicCacheDir->exists()) $publicCacheDir->delete();
		// delete source file
		@unlink($this->filename());
		return true;
	}
}