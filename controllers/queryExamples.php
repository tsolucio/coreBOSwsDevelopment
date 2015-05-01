<?php
/*************************************************************************************************
 * Copyright 2015 JPL TSolucio, S.L. -- This file is a part of TSOLUCIO coreBOS Customizations.
 * Licensed under the vtiger CRM Public License Version 1.1 (the "License"); you may not use this
 * file except in compliance with the License. You can redistribute it and/or modify it
 * under the terms of the License. JPL TSolucio, S.L. reserves all rights not expressly
 * granted by the License. coreBOS distributed by JPL TSolucio S.L. is distributed in
 * the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Unless required by
 * applicable law or agreed to in writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT ANY WARRANTIES OR CONDITIONS OF ANY KIND,
 * either express or implied. See the License for the specific language governing
 * permissions and limitations under the License. You may obtain a copy of the License
 * at <http://corebos.org/documentation/doku.php?id=en:devel:vpl11>
 *************************************************************************************************
 *  Author       : JPL TSolucio, S. L.
 *************************************************************************************************/
class QueryExamples_Controller {

	public static $queries = array(
	'select accountname from Accounts',
	
	);
	static function process() {
		$loginModel = Session_Controller::getLoginContext();
		$client = new Vtiger_WSClient($loginModel->getURL());
		$login  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());
		if($login) {
			foreach (QueryExamples_Controller::$queries as $query) {
				echo '<b>'.$query.'</b><br>';
				$result = $client->doQuery($query);
				QueryExamples_Controller::showresult($result);
			}
		} else {
			echo "<div class='alert alert-danger'><strong>ERROR:</strong> Login failure!<div>";
		}
	}

	static function showresult($ok=true) {
		if ($ok) {
			echo '<span style="color:green">Query OK</span><br>';
		} else {
			echo '<span style="color:red">Query NOK</span><br>';
		}
	}

}
?>