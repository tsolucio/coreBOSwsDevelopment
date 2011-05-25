<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class Header_Controller {

	function process($request) {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">';
		echo "<html>
			<head>
				<title>vtiger Webservice Browser</title>
				<link rel='stylesheet' href='assets/app.css'>
				<script type='text/javascript'>
				function validateForm(form) {
					if(form.q.value == '') return false;
					
					form.__submitButton.value = 'Executing';
					form.__submitButton.disabled = true;
					
					return true;
				}
				</script>
			</head>
				
		<body>
		
		<table cellpadding=0 cellspacing=0>
		<tr valign='top'>
			<td><h1 class='headerName'><a href='index.php'><img border='0' src='assets/applogo.gif'></a></h1></td>
			<td><div class='headerName'><sup><b>Webservice Browser</b></sup><div>
		";	
		
		if(Session_Controller::hasLoginContext()) {
			$loginModel = Session_Controller::getLoginContext();
			echo sprintf("<small>Welcome <b>%s</b> | <a href='index.php?action=Logout'>Logout</a></small>", $loginModel->getUsername());
		}
		
		echo "</td></tr></table>";
	}
}

?>