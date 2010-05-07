<?php

ephFrame::loadClass('ephFrame.lib.CURL');

/**
 * Simple Tumbl Api integration
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @@since 2009-07-19
 */
class Tumblr extends CURL
{
	protected $email; 
	protected $password;
	
	public $baseURL = 'http://www.tumblr.com/api/';
	
	public $userAgent = 'nms.update / ephFrame';
	
	public function __construct($email, $password = null)
	{
		$this->email = $email;
		$this->password = $password;
		$this->data = array(
			'email' => &$this->email,
			'password' => &$this->password,
		);
		return parent::__construct($this->baseURL);
	}
	
	public function post($type, Array $data = array())
	{
		$this->url = $this->baseURL.'write/';
		// prepare data
		$this->data['type'] = (string) $type;
		$this->data = array_merge($this->data, $data);
		// send request to tumblr
		$resp = new HTTPResponse($this->exec(true, true));
		switch ($resp->header->statusCode) {
			case 201:
				break;
			case 403:
				throw new TumblrLoginException($this, $resp->body);
				break;
			default:
				throw new TumblrPostException($this, $resp->body);
				break;
		}
		return true;
	}
	
	public function repost(BlogPost $blogPost)
	{
		ephFrame::loadClass('app.lib.helper.BlogPostFormater');
		$BlogPostFormater = new BlogPostFormater();
		return $this->post(TumblrPostTypes::LINK, array(
			'url' => $blogPost->detailPageURL(),
			'title' => $blogPost->get('headline'),
			'description' => $BlogPostFormater->format($blogPost->get('text'))
		));
	}
}

class TumblrException extends ComponentException {}
class TumblrLoginException extends TumblrException {}
class TumblrPostException extends TumblrException {}


/**
 * different types of posts defined in the tumblr api
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @@since 2009-07-19
 */
class TumblrPostTypes
{
	const REGULAR = 'regular';	
	const PHOTO = 'photo';
	const QUOTE = 'quote';
	const LINK = 'link';
	const CONVERSATION = 'conversation';
	const VIDEO = 'video';
	const AUDIO = 'audio';	
	
} // END TumblrPostTypes class