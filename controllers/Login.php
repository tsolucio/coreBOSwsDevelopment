<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class Login_Controller {
	
	function process($request) {
		
		$url = $request['url'];
		$username = $request['username'];
		$accesskey = $request['accesskey'];
		
		if(empty($url)) $url = 'http://en.vtiger.com';
		if(empty($username)) $username = 'admin';
		

		if(!empty($url) && !empty($username) && !empty($accesskey)) {
			$loginModel = new Login_Model($url, $username, $accesskey);
			
			$client = new Vtiger_WSClient($loginModel->getURL());
			$checkLogin  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());
	
			if($checkLogin) {
				Session_Controller::setLoginContext($loginModel);
				header('Location: index.php');
				echo "HERE";
				exit;
				//return;
			}
		}
		
		Header_Controller::process($request);
		echo "
		<form method='POST' action='index.php' onsubmit='this.__submitButton.value=\"Verifying\"; this.__submitButton.disabled=true;'>
		
		<table cellpadding=5 cellspacing=0>
			<tr>
				<td>URL</td>
				<td><input type='text' name='url' value='$url' size=40></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type='text' name='username' value='$username' size=40></td>
			</tr>
			<tr>
				<td>Access key</td>
				<td><input type='password' name='accesskey' value='$accesskey' size=40></td>
			</tr>			
			<tr>
				<td colspan=2><input type='submit' value='Login' name='__submitButton'></td>
			</tr>
					
		</table>		
		
		</form>		
		";
		
		Footer_Controller::process($request);
		
	}
	
}
?>