<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  JPL TSolucio, S.L Open Source
 * The Initial Developer of the Original Code is JPL TSolucio, S.L.
 * Portions created by JPL TSolucio, S.L are Copyright (C) JPL TSolucio, S.L.
 * All Rights Reserved.
 ************************************************************************************/
class ListTypes_Controller {

	static function process($request) {
		$loginModel = Session_Controller::getLoginContext();
		
		$client = new Vtiger_WSClient($loginModel->getURL());
		$login  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());

		if($login) {

			$modules = $client->doListTypes();
			asort($modules);

			if($modules) {
				$modOptions = '';
				foreach($modules as $module) {
					$modOptions.= "<option value='".$module['name']."'>".$module['name']."</option>";
				}
				foreach($modules as $module) {
					echo "<div class='row' id='".$module['name']."' style='vertical-align:bottom;'><span class='span5 pull-left'><h3>".$module['name']."</h3></span>";
					echo "<span class='span1 pull-right' style='margin-left:10px;margin-right:60px;margin-top: 30px;'>";
					echo "<a href='#top'><img src='assets/go_top.png'></a>";
					echo "</span>";
					echo "<span class='span4 pull-right' style='margin-top: 30px;'>";
					echo "<select onchange=\"\$('.modqaselect').val(this.value);document.location='#'+this.value\" class='small modqaselect'>".$modOptions."</select>";
					echo "</span>";
					echo "</div>";
					echo "<table class='table table-striped small table-condensed'>";
					echo "<tr><th>REST ID</th><th>Can Create</th><th>Can Update</th><th>Can Delete</th><th>Can Retrieve</th></tr>";
					echo "<tr>";
					$desc=$client->doDescribe($module['name']);
					if (is_array($desc)) {
					echo sprintf("<td nowrap='nowrap'>%s</td>", $desc['idPrefix'].'x');
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['createable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['updateable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['deleteable']);
					echo sprintf("<td nowrap='nowrap'>%s&nbsp;</td>", $desc['retrieveable']);
					echo "</tr></table>";
					echo "<table class='table table-striped small table-condensed'>";
					echo "<tr><th>Field</th><th>Information</th><th>Block</th><th>Type</th><th width='30%'>Reference/Values</th></tr>";
					foreach ($desc['fields'] as $field){
						$fieldname=$field['label'];
						echo "<tr><td nowrap='nowrap'><b>".$fieldname.'</b><br>'.$field['name'].'</td>';
						echo "<td>";
						$fielddesc="Mandatory: ";
						$fielddesc.=($field['mandatory'] ? 'yes' : 'no')."<br>Null: ".($field['nullable'] ? 'yes' : 'no');
						$fielddesc.="<br>Editable: ".($field['editable'] ? 'yes' : 'no');
						if (isset($field['sequence'])) $fielddesc.="<br>Sequence: ".$field['sequence'];
						echo $fielddesc."</td><td>";
						if (isset($field['block'])) {
							$blockddesc="ID: ".$field['block']['blockid'].'<br>';
							$blockddesc.='Sequence: '.$field['block']['blocksequence'].'<br>';
							$blockddesc.='Label: '.$field['block']['blocklabel'].'<br>';
							$blockddesc.='Name: '.$field['block']['blockname'];
							echo $blockddesc;
						}
						echo "</td><td>";
						$fielddesc="Type: ".$field['type']['name'];
						if (isset($field['typeofdata'])) $fielddesc.="&nbsp;(".$field['typeofdata'].')';
						if (isset($field['uitype'])) $fielddesc.="<br>UIType: ".$field['uitype'];
						if (isset($field['type']['format'])) $fielddesc.="<br>Format: ".$field['type']['format'];
						if (isset($field['default'])) $fielddesc.="<br>Default: ".$field['default'];
						echo $fielddesc.'</td><td>';
						$addinfo='';
						if (isset($field['type']['refersTo'])) {
							foreach($field['type']['refersTo'] as $capts) $addinfo.="$capts, ";
						}
						if (isset($field['type']['picklistValues'])) {
							foreach($field['type']['picklistValues'] as $plvs=>$plvn) $addinfo.=$plvn['value'].", ";
						}
						echo $addinfo.'</td>';
						echo "</tr>";
					}
					}
					echo "</table>";
				}
			} else {
				$lastError = $client->lastError();
				echo "<div class='alert alert-danger'>ERROR: " . $lastError['message'] . "</div>";
			}
		} else {
			echo "<div class='alert alert-danger'>ERROR: Login failure!</div>";
		}
	}

}
?>