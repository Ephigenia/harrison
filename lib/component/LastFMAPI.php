<?php

ephFrame::loadClass('ephFrame.lib.CURL');

/**
 * Simple LastFMAPI Example
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-19
 * @package app
 * @subpackage app.lib.component
 */
class LastFMAPI extends CURL
{	
	const PERIOD_OVERALL = 'overall';
	const PERIOD_3MONTHS = '3month';
	const PERIOD_6MONTHS = '6month';
	const PERIOD_12MONTHS = '12month';
	
	protected $apikey;
	protected $user;
	public $url = 'http://ws.audioscrobbler.com/2.0/';
	
	public $userAgent = 'nms.update / ephFrame';
	
	public function __construct($user, $apikey)
	{
		$this->user = $user;
		$this->apikey = $apikey;
		$this->data = array(
			'api_key' => &$this->apikey,
			'user' => &$this->user
		);
		return parent::__construct($this->url);
	}
	
	public function getTopArtists($period = self::PERIOD_OVERALL)
	{
		$this->data['method'] = 'user.gettopartists';
		if (preg_match_all('@<name>([^>]+)</name>@', $this->exec(true), $found)) {
			return $found[1];
		}
		return array();
	}
	
	public function getWeeklyArtists()
	{
		$this->data['method'] = 'user.getWeeklyArtistChart';
		if (preg_match_all('@<name>([^>]+)</name>@', $this->exec(true), $found)) {
			return $found[1];
		}
		return array();
	}
}