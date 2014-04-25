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
class Login_Controller {
	
	function process($request) {
		
		$url = $request['url'];
		$username = $request['username'];
		$accesskey = $request['accesskey'];
		
		if(empty($url)) $url = 'http://localhost/';
		if(empty($username)) $username = 'admin';
		

		if(!empty($url) && !empty($username) && !empty($accesskey)) {
			$loginModel = new Login_Model($url, $username, $accesskey);
			
			$client = new Vtiger_WSClient($loginModel->getURL());
			$checkLogin  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());
	
			if($checkLogin) {
				Session_Controller::setLoginContext($loginModel);
				header('Location: index.php');
				exit;
				//return;
			}
		}
		
		Header_Controller::process($request);
		?>
		<form method='POST' action='index.php' onsubmit='this.__submitButton.value=\"Verifying\"; this.__submitButton.disabled=true;'>
		<div class='form-group'>
			<label for='url'>URL</label>
			<input type='text' name='url' value='<?php echo $url; ?>' size=40 class='form-control'>
		</div>
		<div class='form-group'>
			<label for='username'>Username</label>
			<input type='text' name='username' value='<?php echo $username; ?>' size=40 class='form-control'>
		</div>
		<div class='form-group'>
			<label for='accesskey'>Access key</label>
			<input type='text' name='accesskey' value='<?php echo $accesskey; ?>' size=40 class='form-control'>
		</div>
		<div class='form-group'>
			<input class='btn btn-primary btn-large' type='submit' value='Login &raquo;' name='__submitButton'>
		</div>
		</form>
<?php
		Footer_Controller::process($request);
	}
	
}
?>