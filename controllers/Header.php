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
	
	function process($request) {
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">';
		echo "<html>
			<head>
				<title>".Header_Controller::$title."</title>
				<script type='text/javascript'>
				function validateForm(form) {
					if(form.q.value == '') return false;
					
					form.__submitButton.value = 'Executing';
					form.__submitButton.disabled = true;
					
					return true;
				}
				</script>".Header_Controller::getHeaderScripts()."
			</head>
				
		<body>".Header_Controller::getMenu()."
		<div class='container'>
			<h2>".Header_Controller::$title."</h2>";
	}
	
	function getHeaderScripts() {
		return '
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>';
	}

	function getMenu() {
		$rdo = '<header role="banner" id="top">
	<nav role="navigation" class="navbar navbar-default" style="margin-bottom: 0;">
	  <div class="navbar-header">
	    <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
	      <span class="sr-only">Toggle navigation</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
        <a href="//corebos.org" class="navbar-brand"><img src="assets/app-logo.png" style="max-height: 50px;top:0;position:absolute;"></a>
	  </div>
	  <!-- /.navbar-header -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
	    <ul class="nav navbar-nav navbar-right">';
		if(Session_Controller::hasLoginContext()) {
			$rdo.= '<li><a href="index.php?action=vql">VQL</a></li>';
			$rdo.= '<li><a href="index.php?action=ListTypes">List Types</a></li>';
			$rdo.= '<li><a href="index.php?action=TestCode">Test Code</a></li>';
			$rdo.= '<li style="margin-left:40px;">&nbsp;</li>';
		}
		$rdo.= '<li><a href="http://corebos.org/page/corebos-documentation" target="_blank">Documentation</a></li>
			<li><a href="http://corebos.org/page/corebos-participate" target="_blank">Participate</a></li>
			<li><a href="http://discussions.corebos.org" target="_blank">Forum</a></li>
			<li><a href="http://corebos.org/blog" target="_blank">Blog</a></li>
			<li><a href="http://corebos.org/page/contact" target="_blank">Contact</a></li>';
		if(Session_Controller::hasLoginContext()) {
			$loginModel = Session_Controller::getLoginContext();
			$rdo.= sprintf("<li><a href='#'><small>Welcome <b>%s</b></small></a></li>", $loginModel->getUsername());
			$rdo.= "<li><a href='index.php?action=Logout'>Logout</a></li>";
		}
		$rdo.= '<li style="margin-left:30px;">&nbsp;</li>
	    </ul>
	  </div>
	  <!-- /.navbar-collapse -->
	</nav>
	<div class="row span12 pull-right small"><a href="http://corebos.org" style="color: #AD0900;margin-right: 40px;">Proud member of the coreBOS Family</a></div>
</header>';
		return $rdo;
	}
}

?>