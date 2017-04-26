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

	function __construct($url, $username, $accesskey, $withPassword=false) {
		$this->url = $url;
		$this->username = $username;
		$this->accesskey = $accesskey;
		$this->withPassword = $withPassword;
	}
	
	function getURL() {
		return $this->url;
	}
	
	function getUsername() {
		return $this->username;
	}
	
	function getAccessKey() {
		return $this->accesskey;
	}
	
	function getUserId() {
		return $this->userid;
	}
	
	function setUserId($usrid) {
		$this->userid = $usrid;
	}

	function setWithPassword($withPassword) {
		$this->withPassword = $withPassword;
	}

	function getWithPassword() {
		return $this->withPassword;
	}

	function getSessionId() {
		return $this->sessionid;
	}
	
	function setSessionId($sessionid) {
		$this->sessionid = $sessionid;
	}
}
?>