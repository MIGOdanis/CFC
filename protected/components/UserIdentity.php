<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_USERNAME_INACTIVE=3;
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find('LOWER(username)=? AND active=1',array(strtolower($this->username)));
		if ($user===null) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} elseif (!$user->validatePassword($this->password)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->setState('nickname', $user->nick_name);
			$this->setState('username', $user->username);
			$this->setState('auth', $this->makeAuth($user->auth));
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function makeAuth($auth)
	{
		$authArray = array();
		$userAuth = explode(",",$auth);

		foreach ($userAuth as $value) {
			$authExplode = explode("/",$value);
			if(!isset($authArray[$authExplode[0]])){
				$authArray[$authExplode[0]] = explode("&",$authExplode[1]);
			}else{
				foreach (explode("&",$authExplode[1]) as $value) {
					array_push($authArray[$authExplode[0]],$value);
				}
			}
			
		}

		return $authArray;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}