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
	'select nofield from NoModule',
	'select accountname,nofield from Accounts',
	"select accountname,website from Accounts where website like '%vt%'",
	"select firstname, lastname from Contacts where firstname like '%o%' order by firstname desc limit 0,22;",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts where website like '%vt%'",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts where Accounts.website like '%vt%'",
	// IN
	"select accountname,website from Accounts where website in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts where website in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts where Accounts.website in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	// NOT IN
	"select accountname,website from Accounts where website not in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	"select accountname,website,Accounts.accountname,Accounts.website from Accounts where website not in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	"select accountname,website from Accounts where Accounts.website not in ('www.edfggrouplimited.com','www.gooduivtiger.com')",
	//
	"select count(*) from accounts where accountname != null",
	"select count(*) from accounts where accounts.accountname != null",
	"select count(*) from accounts where accountname is not null",
	"select count(*) from accounts where accounts.accountname is not null",
	"select count(*) from accounts where accountname = null",
	"select count(*) from accounts where accounts.accountname = null",
	"select count(*) from accounts where accountname is null",
	"select count(*) from accounts where accounts.accountname is null",
	//
	"select id, account_no, accountname, accounts.accountname from accounts where assigned_user_id      !=20x21199 and cf_938 =      'Activo' limit 0, 10;",
	"select id, account_no, accountname, accounts.accountname from accounts where assigned_user_id=20x21199 and cf_938='Activo' limit 0, 100;",
	"select id, account_no, accountname, accounts.accountname from accounts where Users.id=20x21199 and cf_938='Activo' limit 0, 100;",
	"select id, accountname, Accounts.accountname from Accounts where accountname != 'PK UNA' limit 10",
	"select firstname, lastname,Accounts.accountname,Accounts.website from Contacts where firstname like '%o%' order by firstname desc limit 0,22;",
	"select firstname, lastname,Accounts.accountname,Accounts.website from Contacts where firstname like '%o%' order by firstname asc",
	"select firstname, lastname,Accounts.accountname,Accounts.website from Contacts where firstname like '%o%' limit 0,22;",
	"select firstname, lastname,Accounts.accountname,Accounts.website from Contacts where firstname like '%o%'",
	"select firstname, lastname,Accounts.accountname from Contacts where firstname like '%o%' or firstname like '%e%' or firstname like '%s%'",
	"select firstname, lastname,Accounts.accountname from Contacts where firstname like '%o%' or (firstname like '%e%' and firstname like '%s%')",
	"select potentialname,Accounts.accountname from Potentials",
	"select potentialname,Accounts.accountname,Contacts.lastname from Potentials",
	"select Contacts.firstname,Accounts.accountname,ticket_title from HelpDesk",
	"select * from projecttask where related.project='32x6613'",
	"select * from projecttask where related.project='32x6613' and projecttaskname='tttt'",
	"select * from documents where related.accounts='11x12'",
	"select * from documents where filelocationtype='E' and related.contacts='12x22'",
	"Select * from Documents where (related.Contacts='12x22') AND (filelocationtype LIKE '%I%') LIMIT 5;",
	"select * from modcomments where related.helpdesk='17x114'",
	"select * from modcomments where related.helpdesk='17x114' and commentcontent like 'hdcc%'",
	"select * from products where related.products='14x58'",
	"select * from products where related.contacts='12x22'",
	"select * from products where related.contacts='12x22' and productcategory='Software'",
	"Select * from Products where related.Contacts='12x22' LIMIT 5;",
	"Select * from Products where related.Contacts='12x22' order by productname LIMIT 5;",
	);
	static function process() {
		$loginModel = Session_Controller::getLoginContext();
		$client = new Vtiger_WSClient($loginModel->getURL());
		$login  = $client->doLogin($loginModel->getUsername(), $loginModel->getAccessKey());
		if($login) {
			echo "<div class='alert alert-info'>Many of these queries are specific to the coreBOS application they were created for and will fail on your install. You should just need to tweek the IDs and conditions to get them working.</div>";
			foreach (QueryExamples_Controller::$queries as $query) {
				echo '<b>'.$query.'</b><br>';
				$result = $client->doQuery($query);
				QueryExamples_Controller::showresult($result);
			}
		} else {
			echo "<div class='alert alert-danger'><strong>ERROR:</strong> Login failure!</div>";
		}
	}

	static function showresult($results) {
		if (is_array($results)) {
			echo '<span style="color:green">Query OK</span>&nbsp;RESULTS: '.count($results).'<br>';
		} else {
			echo '<span style="color:red">Query NOK</span><br>';
		}
	}

}
?>