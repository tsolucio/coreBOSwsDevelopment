<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class ListTypes_Controller {

	function process($request) {
		echo "
		<style type='text/css'>
		<!--
		.toolTip {
			position:absolute;
			left:40%;
			/* top:0; */
			display:none;
			/*Making it look pretty*/
			width:200px;
			padding:5px;
			border:1px solid #ffffff;
			background-color:#eeeeee;
			font:10px/12px Arial, Helvetica, sans-serif;
		}
		-->
		</style>
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

		$loginModel = Session_Controller::getLoginContext();
		
		$client = new Vtiger_WSClient($loginModel->getURL());
		$login  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());

		if($login) {

			$modules = $client->doListTypes($query);

			if($modules) {
				echo "<table cellpadding='3' cellspacing='0' class='listing'>";
				echo "<tr><th>Modules</th><th>Can Create</th><th>Can Update</th><th>Can Delete</th><th>Can Retrieve</th><th>Fields</th></tr>";
				$i=0;
				foreach($modules as $module) {
					echo "<tr>";
					$desc=$client->doDescribe($module['name']);
					echo sprintf("<td nowrap='nowrap'>%s</td>", $module['name'].' ('.$desc['idPrefix'].')');
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['createable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['updateable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['deleteable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['retrieveable']);
					echo "<td nowrap='nowrap'>";
					foreach ($desc['fields'] as $field){
					$ttname="tt$i";  $i++;
					$fieldname=$field['label'];
					$fielddesc="<b>$fieldname</b><br>Field: ".$field['name']."<br>Mandatory: ";
					$fielddesc.=($field['name'] ? 'yes' : 'no')."<br>Null: ".($field['nullable'] ? 'yes' : 'no');
					$fielddesc.="<br>Editable: ".($field['editable'] ? 'yes' : 'no')."<br>Default: ".$field['default'];
					$fielddesc.="<br>Type: ".$field['type']['name']."<br>Format: ".$field['type']['format'];
					$addinfo='';
					if (isset($field['type']['refersTo'])) {
						$addinfo='<br>Refers To: ';
						foreach($field['type']['refersTo'] as $capts) $addinfo.="$capts, ";
					}
					if (isset($field['type']['picklistValues'])) {
						$addinfo='<br>Picklist values: ';
						foreach($field['type']['picklistValues'] as $plvs=>$plvn) $addinfo.=$plvn['value'].", ";
						$addinfo.="<br>Default: ".$field['type']['default'];
					}
					$fielddesc.=$addinfo;
					echo "<div onmouseover=\"document.getElementById('$ttname').style.display='block'\" onmouseout=\"document.getElementById('$ttname').style.display='none'\"><div id=\"$ttname\" class=\"toolTip\">$fielddesc</div>$fieldname,&nbsp;</div>";
					}
					echo "</td>";
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
?>