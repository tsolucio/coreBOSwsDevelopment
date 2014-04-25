<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * Portions created by TSolucio are Copyright (C) TSolucio.
 * All Rights Reserved.
 ************************************************************************************/
include_once 'models/Login.php';
include_once 'controllers/Session.php';
include_once 'vtwsclib/Vtiger/WSClient.php';

Session_Controller::start();

header('Content-type: text/html; charset=utf8');

include_once 'controllers/Header.php';
include_once 'controllers/Footer.php';

if(Session_Controller::hasLoginContext()) {
	switch ($_REQUEST['action']) {
		case 'Logout':
			include_once 'controllers/Logout.php';
			Logout_Controller::process($_REQUEST);
			Footer_Controller::process($_REQUEST);
			break;
		case 'ListTypes':
			Header_Controller::process($_REQUEST);
			include_once 'controllers/ListTypes.php';
			ListTypes_Controller::process($_REQUEST);
			Footer_Controller::process($_REQUEST);
			break;
		case 'TestCode':
			Header_Controller::process($_REQUEST);
			include_once 'controllers/TestCode.php';
			TestCode_Controller::process($_REQUEST);
			Footer_Controller::process($_REQUEST);
			break;
		case 'execCode':
			include_once 'controllers/TestCode.php';
			TestCode_Controller::doExecCode();
			break;
		case 'VQL':
		default:
			Header_Controller::process($_REQUEST);
			include_once 'controllers/Query.php';
			Query_Controller::process($_REQUEST);
			Footer_Controller::process($_REQUEST);
			break;
	}
} else {
	include_once 'controllers/Login.php';
	Login_Controller::process($_REQUEST);
}

?>
