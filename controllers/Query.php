<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class Query_Controller {

	function process($request) {
		$query = $request['q'];
		if(empty($query)) $query = '';

		$escapedQuery = $query;
		echo "
		<form method='POST' action='index.php'>
		<input type='submit' value='ListTypes' name='__submitButton'></br>
		</form>
		<form method='POST' action='index.php' onsubmit='return validateForm(this);'>
			<table cellpadding='0' cellspacing='1'>
				<tr valign=top>
					<td>Query like: select firstname, lastname from Leads;<br/><textarea name='q' rows='5' cols='80'>$escapedQuery</textarea></td>
				</tr>
				<tr>
					<td><input type='submit' value='Execute' name='__submitButton'></td>
				</tr>
			</table>
		</form>";

		if(!empty($query)) {
			$loginModel = Session_Controller::getLoginContext();
			
			$client = new Vtiger_WSClient($loginModel->getURL());
			$login  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());

			if($login) {

				$result = $client->doQuery($query);

				if($result) {
					echo "<table cellpadding='3' cellspacing='0' class='listing'>";

					$columns = $client->getResultColumns($result);
						
					echo "<tr>";
					foreach($columns as $column) {
						echo sprintf("<th nowrap='nowrap'>%s</th>", $column);
					}
					echo "</tr>";
					foreach($result as $row) {
						echo "<tr>";
						foreach($row as $k => $v) {
							if($v === '') $v = '&nbsp;';
							echo sprintf("<td nowrap='nowrap'>%s</td>", $v);
						}
						echo "</tr>";
					}

					echo "</table>";
				} else {
					$lastError = $client->lastError();
					echo "<span class='error'>ERROR: " . $lastError['message'] . "</span>";
				}


			} else {
				echo "<span class='error'>ERROR: Login failure!<span>";
			}
		}

	}
}
?>