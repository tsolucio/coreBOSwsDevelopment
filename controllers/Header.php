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
class Header_Controller {

	public static $title = "coreBOS Webservice Development";

	public static function process($request) {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">';
		echo "<html>
			<head>
				<title>".Header_Controller::$title."</title>
				<script type='text/javascript'>
				function validateForm(form) {
					if (form.q.value == '') {
						return false;
					}
					form.__submitButton.value = 'Executing';
					form.__submitButton.disabled = true;
					return true;
				}
				function handleCtrlEnter(event) {
					if (event.ctrlKey && event.key === 'Enter') {
						document.getElementById('queryform').submit();
					}
				}
				</script>".Header_Controller::getHeaderScripts()."
			</head>
		<body>".Header_Controller::getMenu()."
		<div class='container'>
			<h2>".Header_Controller::$title."</h2>";
	}

	public static function getHeaderScripts() {
		return '<script src="assets/jquery.min.js"></script>
<link rel="stylesheet" href="assets/bootstrap.min.css">';
	}

	public static function getMenu() {
		$rdo = '<header role="banner" id="top">
	<nav role="navigation" class="navbar navbar-default" style="margin-bottom: 0;">
	  <div class="navbar-header">
	    <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
	      <span class="sr-only">Toggle navigation</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
        <a href="http://corebos.org" class="navbar-brand"><img src="assets/app-logo.png" style="max-height: 50px;top:0;position:absolute;"></a>
	  </div>
	  <!-- /.navbar-header -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav navbar-right">';
		if (Session_Controller::hasLoginContext()) {
			$rdo.= '<li><a href="index.php?action=vql">Query</a></li>';
			$rdo.= '<li><a href="index.php?action=ListTypes">List Types</a></li>';
			$rdo.= '<li><a href="index.php?action=TestCode">Test Code PHP</a></li>';
			$rdo.= '<li><a href="index.php?action=TestCodeJS">Test Code JS</a></li>';
			$rdo.= '<li style="margin-left:40px;">&nbsp;</li>';
		}
		$rdo.= '<li><a href="http://corebos.org/documentation" target="_blank">Documentation</a></li>
			<li><a href="http://corebos.org/page/get-involved" target="_blank">Participate</a></li>
			<li><a href="http://discussions.corebos.org" target="_blank">Forum</a></li>
			<li><a href="http://www.corebos.org/post/new-version-coreboswsdev" target="_blank">Blog</a></li>
			<li><a href="http://corebos.org/page/contact" target="_blank">Contact</a></li>';
		if (Session_Controller::hasLoginContext()) {
			$loginModel = Session_Controller::getLoginContext();
			$title = 'URL: '.$loginModel->getURL()."          \n";
			$title.= 'User: '.$loginModel->getUsername().' ('.$loginModel->getUserId().")\n";
			$title.= 'Key: '.$loginModel->getAccessKey();
			$rdo.= sprintf("<li><a href='#'><small><abbr title='%s'>Welcome <b>%s</b></abbr></small></a></li>", $title, $loginModel->getUsername());
			$rdo.= "<li><a href='index.php?action=Logout'>Logout</a></li>";
		}
		$rdo.= '<li style="margin-left:30px;">&nbsp;</li>
	    </ul>
	  </div>
	  <!-- /.navbar-collapse -->
	</nav>
	<div class="row span12 pull-right small"><a href="http://corebos.org" style="color: #04579b;margin-right: 40px;">Proud member of the coreBOS Family</a></div>
</header>';
		return $rdo;
	}
}
?>
