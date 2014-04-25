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
class Footer_Controller {

	function process($request) {
		echo "</div>";  // close container div
		echo "<br><small><p>&nbsp;&nbsp;Copyright &copy; 2010-" .date('Y') . " <a href='http://www.corebos.org'>coreBOS</a>, Copyright &copy; 2009-2010 <a href='http://www.vtiger.com'>www.vtiger.com</a><p></small>";
		echo "</body></html>";
	}
}

?>