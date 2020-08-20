<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class Login_Model {
	private $url;
	private $username;
	private $accesskey;
	private $userid;
	private $sessionid;
	private $withPassword=false;

	public function __construct($url, $username, $accesskey, $withPassword = false) {
		$this->url = $url;
		$this->username = $username;
		$this->accesskey = $accesskey;
		$this->withPassword = $withPassword;
	}

	public function getURL() {
		return $this->url;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getAccessKey() {
		return $this->accesskey;
	}

	public function getUserId() {
		return $this->userid;
	}

	public function setUserId($usrid) {
		$this->userid = $usrid;
	}

	public function setWithPassword($withPassword) {
		$this->withPassword = $withPassword;
	}

	public function getWithPassword() {
		return $this->withPassword;
	}

	public function getSessionId() {
		return $this->sessionid;
	}

	public function setSessionId($sessionid) {
		$this->sessionid = $sessionid;
	}
}
?>