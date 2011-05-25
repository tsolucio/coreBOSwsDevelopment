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

	function __construct($url, $username, $accesskey) {
		$this->url = $url;
		$this->username = $username;
		$this->accesskey = $accesskey;
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
	
}
?>