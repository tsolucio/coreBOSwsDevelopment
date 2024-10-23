<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class Session_Controller {

	public static function start() {
		@session_start();
	}

	public static function destroy() {
		@session_destroy();
	}

	public static function setLoginContext($loginModel) {
		$_SESSION['vtbrowser_auth'] = $loginModel;
	}

	public static function getLoginContext() {
		if (self::hasLoginContext()) {
			return $_SESSION['vtbrowser_auth'];
		}
		return false;
	}

	public static function hasLoginContext() {
		return isset($_SESSION['vtbrowser_auth']);
	}
}
?>
