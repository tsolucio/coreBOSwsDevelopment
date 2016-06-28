<?php
$leadId = '10x4196';
$convert_lead_array = array();
$convert_lead_array['leadId'] = $leadId;
$convert_lead_array['assignedTo'] = $cbUserID;
$convert_lead_array['entities']['Accounts']['create']=true;
//$convert_lead_array['entities']['Accounts']['forcecreate']=true;
$convert_lead_array['entities']['Accounts']['name']='Accounts';
$convert_lead_array['entities']['Accounts']['accountname'] = 'company';
$convert_lead_array['entities']['Accounts']['industry']='Banking';
$convert_lead_array['entities']['Potentials']['create']=true;
$convert_lead_array['entities']['Potentials']['name']='Potentials';
$convert_lead_array['entities']['Potentials']['potentialname']='Sell to Company: converted';
$convert_lead_array['entities']['Potentials']['closingdate']= date("Y-m-d", strtotime("+1 week Saturday"));
$convert_lead_array['entities']['Potentials']['sales_stage']= 'Prospecting';
$convert_lead_array['entities']['Potentials']['amount']= 100;
$convert_lead_array['entities']['Contacts']['create']=true;
$convert_lead_array['entities']['Contacts']['name']='Contacts';
$convert_lead_array['entities']['Contacts']['lastname']='lastname: converted';
$convert_lead_array['entities']['Contacts']['firstname']='firstname: converted';
$convert_lead_array['entities']['Contacts']['email']='email@domain.tld';
$convert_lead_json = json_encode($convert_lead_array);
$response = $cbconn->doInvoke('convertlead', array('element'=>$convert_lead_json));

//check for whether the requested operation was successful or not.
if($response) {
	//operation was successful get the response.
	var_dump($response);
} else {
	echo "Convert failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>