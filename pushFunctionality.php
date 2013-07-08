<?php

function sendPushNotification($AppID, $RestApiKey, $AlertMessage, $Badge) 
{
	$url = 'https://api.parse.com/1/push';
	$data = array(
	    'channel' => '',
	    'expiry' => 1451606400,
	    'data' => array(
	        'alert' => $AlertMessage,
	        'badge' => $Badge,
	    ),
	);

	if (get_option('simpar_enableSound') == 'true') {
		$data['data']['sound'] = "";
	}

	$_data = json_encode($data);
	$headers = array(
	    'X-Parse-Application-Id: ' . $AppID,
	    'X-Parse-REST-API-Key: ' . $RestApiKey,
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($_data),
	);

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($curl);
	
	return $result;
}

?>