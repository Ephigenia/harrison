<?php

class_exists('Status') or require dirname(__FILE__).'/Status.php';

/**
 * Differnt Flags for {@link User}
 * 
 * @since 2010-03-14
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @package harrison
 * @subpackage harrison.lib.model
 */
class UserFlag
{
	const BLOCKED = 128;	// blocked users
}

/**
 * Simple User Model
 * 	
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 07.11.2008
 */
class User extends AppModel
{	
	public $data = array(
		'status' => Status::PUBLISHED,
	);
	
	public $belongsTo = array(
		'UserGroup',
	);
	
	public $order = array(
		'User.name ASC',
	);
	
	public $behaviors = array(
		'Timestampable',
		'Flagable',
		'Hitcount',
	);
	
	public $findConditions = array(
		'User.status < 255',
	);
	
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'notEmpty' => true,
				'message' => 'Enter the full name of the user.',
			)
		),
		'password' => array(
			'notEmpty' => array(
				'allowEmpty' => true,
				'notEmpty' => true,
				'message' => 'Please enter a password.',
			),
			'minLength' => array(
				'minLength' => 6,
				'message' => 'The Password you entered is too short, password must have at least %minLength% characters.',
			),
			'maxLength' => array(
				'maxLength' => 32,
				'message' => 'The Password you entered is too long, password can only have up to %minLength% characters.',
			)
		),
		'email' => array(
			 'valid' => array(
				'regexp' => Validator::EMAIL,
				'message' => 'The email you entered is invalid.',
			 )
			,'unique' => array(
				'callback' => 'isUnique',
				'message' => 'The email is allready in use by a registered user, please use an other email.',
			),
		),
	);
	
	public $passwordSalt = SALT;
	
	/**
	 *	Mask password
	 * 	Masticates the passed password with the applications SALT String and MD5
	 * 	and returns the result
	 * 	@param string $password
	 * 	@return string
	 */
	public function maskPassword($password)
	{
		return md5($password.$this->passwordSalt);
	}
	
	/**
	 *	
	 */
	public function beforeInsert()
	{
		// add confirmation code if field exists
		if ($this->hasField('confirmation_code')) {
			$this->set('confirmation_code', md5(time().SALT));
		}
		$this->passwordUnmasked = $this->password;
		$this->password = $this->maskPassword($this->password);
		return parent::beforeInsert();
	}
	
	/**
	 *	Tests if the user is unique
	 * 	@return boolean
	 */
	public function isUnique()
	{
		$findConditions = array('User.email' => DBQuery::quote($this->email));
		if ($this->exists()) {
			$findConditions[] = 'User.id <> '.intval($this->id);
		}
		if ($doubleUser = $this->find($findConditions, null, 0)) {
			return false;
		}
		return true;
	}
}