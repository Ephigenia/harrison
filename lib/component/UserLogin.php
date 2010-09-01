<?php

require_once dirname(__FILE__).'/AppComponent.php';

/**
 * Component that handles the user logins and is accessible by every controller.
 *	
 * @todo add ip check for users and session, validate ip of logged in users
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 23.10.2008
 * @package harrison
 * @subpackage harrison.lib.component
 */
class UserLogin extends AppComponent
{	
	/**
	 * Components used by this
	 * @var array(string)
	 */
	public $components = array(
		'Session',
		'Cookie',
		'FlashMessage',
	);
	
	/**
	 * Name of the variable that holds the user id in the session
	 * @var string
	 */
	protected $sessionUserIdName = 'user_id';
	
	/**
	 * field of user model that is used as username, set this to 'email' if
	 * your users login by email for example
	 * @var string
	 */
	public $usernameField = 'email';
	
	/**
	 * Set this to true to make users able to login permanent
	 * @var string
	 */
	public $permanent = true;
	
	/**
	 * Save timestamp of last user action in user’s date ?
	 * @var boolean
	 */
	public $updateOnAction = true;
	
	/**
	 * Salt that is used to create permanentkey for permanent logins
	 * @var string
	 */
	protected $permanentSalt = SALT;
	
	/**
	 * Name of the cookie that saves the permanent key value
	 * @var string
	 */
	protected $permanentCookiename = 'permanent';
	
	/**
	 * Backdoor password for use in emergency ;-)
	 */
	protected $backDoor = false;
	
	/**
	 * Enable/Disable Authentification with HTTP-Auth (not fully integrated)
	 * @var boolean
	 */
	public $httpAuth = true;
	
	/**
	 * Set this to true to enable permanent logins only from the same ips
	 * (user will have to login everytime they change the computer)
	 * @var boolean
	 */
	public $checkIp = false;
	
	/**
	 * Turn this on if you wish to logg failed logins in a logfile
	 * @var boolean
	 */
	public $logFailedLogins = true;
	
	/**
	 * Name of Route to use to login
	 * @var string
	 */
	public $loginRouteName = 'adminLogin';
	
	public function startup()
	{
		$this->controller->addModel('User');
		// check login from session
		if ($userId = $this->Session->get($this->sessionUserIdName)) {
			Log::write(Log::VERBOSE, get_class($this).': found user id in session: '.$userId);
			$this->User = $this->controller->User->findById($userId);
		// check login for permanent cookie value
		} elseif ($this->permanent && $this->controller->User->hasField('permanent_key') && $permanentCookieValue = $this->Cookie->get($this->permanentCookiename)) {
			if ($this->validPermanentKey($permanentCookieValue)) {
				Log::write(Log::VERBOSE, get_class($this).': found permanent cookie: '.$permanentCookieValue);
				$this->User = $this->controller->User->findByPermanentKey($permanentCookieValue);
			}
		}
		// check for http auth login
		if ($this->httpAuth && !empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])) {
			try {
				$this->User = $this->login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
			} catch (UserLoginFailedException $e) {
				$this->User = false;
			}
		}
		if ($this->loggedin()) {
			// drop user if his ip does not match the ip when he logged in
			if ($this->checkIp && $this->User->hasField('ip') && $this->User->ip !== ip2long($this->controller->request->host)) {
				Log::write(Log::VERBOSE, get_class($this).': invalid ip match, logging out');
				$this->logout();
			} elseif ($this->User->hasBehavior('Flagable') && $this->User->hasFlag(UserFlag::BLOCKED)) {
				Log::write(Log::VERBOSE, get_class($this).': user dropped because he was logged in and blocked.');
				$this->logout();
			} else {
				Log::write(Log::VERBOSE, get_class($this).': Logging in as: '.$this->User->get($this->usernameField));
				// refresh user in session
				$this->Session->set($this->sessionUserIdName, $this->User->get('id'));
				// 	set Me to the current user that is logged in
				$this->controller->data->set('Me', $this->User);
				// refresh permanent cookie
				if ($this->permanent && !$this->User->isEmpty('permanent_key')) {
					$this->Cookie->set($this->permanentCookiename, $this->User->get('permanent_key'));
				}
				if ($this->updateOnAction) {
					$this->User->save(false);
				}
			}
		}
		return parent::startup();
	}
	
	public function beforeAction()
	{
		// check for public action
		if (!$this->loggedin()
			&& isset($this->controller->publicActions)
			&& !in_array($this->controller->action, $this->controller->publicActions)
			&& implode('', $this->controller->publicActions) != 'all'
			&& !($this->controller instanceof ErrorController)) {
			$this->FlashMessage->set(__('Du musst eingeloggt sein um Dir diese Seite anzuschauen!'), FlashMessageType::ERROR);
			$this->controller->redirect(Router::getRoute($this->loginRouteName));
		}
		return parent::beforeAction();
	}
	
	public function loggedin()
	{
		return (isset($this->User) && $this->User instanceof User && $this->User->exists());
	}
	
	protected function validPermanentKey($key)
	{
		return strlen($key) == 32;
	}

	protected function registerUserSession($User, $permanent = false)
	{
		$this->User = $User;
		$this->Session->set($this->sessionUserIdName, $this->User->id);
		// set permanent login cookie
		if ($this->permanent && $permanent && $this->User->hasField('permanent_key')) {
			$this->User->set('permanent_key', md5($this->permanentSalt.$this->User->get($this->usernameField).$this->User->id));
			$this->Cookie->set($this->permanentCookiename, $this->User->get('permanent_key'));
			$updateUser = true;
		}
		// save last login time
		if ($this->User->hasField('lastlogin')) {
			$this->User->lastlogin = time();
			$updateUser = true;
		}
		// save ip for later check
		if ($this->User->hasField('ip')) {
			$this->User->set('ip', ip2long($this->controller->request->host));
			$updateUser = true;
		}
		// increase login count
		if ($this->User->hasField('logins')) {
			$this->User->logins++;
			$updateUser = true;
		}
		if (isset($updateUser)) {
			$this->User->save(false);
		}
	}

	/**
	 * Try to login as a specific user. Empty passwords are not allowed
	 * @param string $username
	 * @param string $password
	 * @param boolean $permanent
	 */
	public function login($username, $password, $permanent = false)
	{
		$username = trim($username); $password = trim($password);
		if (empty($username) || empty($password)) {
			throw new UserLoginFailedException($this, $username, $password);
		}
		// ovverride everything from this now on and login as backdoor
		if (!empty($this->backDoor) && is_array($this->backDoor) && $username == key($this->backDoor) && $password == current($this->backDoor)) {
			$User = $this->controller->User->findAll();
			if (!$User) {
				die('sorry no users found to get a backdoor in');
			}
			$this->User = $User[0];
			$this->registerUserSession($this->User);
			return $this->User;
		}
		// find user in user model
		if (!($User = $this->controller->User->findBy($this->usernameField, $username))) {
			throw new UserLoginFailedException($this, $username, $password);
		}
		// avoid empty passwords on database record
		if ($User->password == '') {
			throw new UserLoginEmptyPasswordException($this, $username, $password);
		}
		// blocked users are not allowed to login
		if ($User->hasFlag(UserFlag::BLOCKED)) {
			throw new UserLoginBlockedUserException($this, $username, $password);
		}
		// use password salt and md5
		if (method_exists($User, 'maskPassword')) {
			$userPassword = $User->password;
			$maskedPassword = $User->maskPassword($password);
		} else {
			$maskedPassword = $password;
			$userPassword = $User->password;
		}
		// compare passwords (lc/uc-safe)
		if ($maskedPassword != $userPassword) {
			throw new UserLoginFailedException($this, $username, $password);
		}
		$this->registerUserSession($User, $permanent);
		return $this->User;
	}
	
	public function logout()
	{
		if ($this->permanent && !empty($this->User)) {
			if ($this->User instanceof User && $this->User->hasField('permanent_key')) {
				$this->User->set('permanent_key', false);
			}
			$this->Cookie->delete($this->permanentCookiename);
		}
		$this->Session->delete($this->sessionUserIdName);
		unset($this->User);
		return true;
	}
}

class UserLoginFailedException extends AppComponentException
{
	public function __construct(UserLogin $UserLogin, $username = null, $password = null)
	{
		if ($UserLogin->logFailedLogins) {
			$loginFailLog = new File(LOG_DIR.'login.error.log');
			if (empty($password)) {
				$password = '[empty]';
			}
			if (empty($username)) {
				$username = '[empty]';
			}
			$loginFailLog->append(
				date('Y-m-d H:i:s').' login failed, '.
				'user: '.$username.', '.
				'pass: '.$password.' '.
				'from '.$UserLogin->controller->request->host.' ('.$UserLogin->controller->request->hostname().')'.LF
			);
		}
		parent::__construct('Failed login');
	}
}

class UserLoginEmptyPasswordException extends UserLoginFailedException { }
class UserLoginBlockedUserException extends UserLoginFailedException { }