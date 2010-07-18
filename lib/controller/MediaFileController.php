<?php

/**
 * MediaFile Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @since 2009-08-11
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 **/
class MediaFileController extends Controller
{
	public $publicActions = array(
		'download',
		'thumb',
	);
	
	protected $thumbQuality = 95;
	
	protected $MediaFile;
	
	public function beforeAction()
	{
		if (empty($this->params['unique_id'])) {
			return false;
		}
		if (!$this->MediaFile = $this->MediaFile->findByUniqueId($this->params['unique_id'])) {
			return false;
		}
		return parent::beforeAction();
	}
	
	public function download($uniqueId)
	{
		if ($this->MediaFile->behaviors->hasBehavior('HitCount')) {
			$this->MediaFile->hit('downloads');
		}
		$this->redirect(WEBROOT.((string) $this->MediaFile->file()));
	}
	
	public function thumb($uniqueId, $width, $height, $method, $filename)
	{
		// only image can get thumbnails, existing files and valid resize method name
		if (!$this->MediaFile->isImage() || !($ImageFile = $this->MediaFile->file()) || !method_exists($ImageFile, $method)) return false;
				
		$filename = STATIC_DIR.'img/public/'.$uniqueId.'/'.$width.'x'.$height.'/'.$method.'/'.$filename;

		$width = ((int) $width > 0) ? (int) $width : null;
		$height = ((int) $height > 0) ? (int) $height : null;

		// resize Image
		try {
			$ImageFile->$method($width, $height, true, false);
			// apply sharpen filter if available and image is small
			if (function_exists('imageconvolution') && $width < 400 && $height < 400) {
				ephFrame::loadClass('ephFrame.lib.ImageSharpenFilter');
				$sharpenFilter = new ImageSharpenFilter();
				$ImageFile->applyFilter($sharpenFilter);
			}
		} catch(ImageToLargeToLoadException $e) {
			$ImageFile = new Image($width, $height);
			$ImageFile->backgroundColor('ffffe0')->border('e6db55', 1, 0);
			$ImageFile->text(Image::CENTERED, Image::CENTERED, 'image to large to'.LF.'create thumbnail', 'b8ad4c', 1);
		}
		$ImageFile->saveAs($filename, $this->thumbQuality);
		$this->redirect(WEBROOT.$filename);
	}
}