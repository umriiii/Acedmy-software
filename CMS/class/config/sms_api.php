<?php 

$url = "https://lifetimesms.com/plain";

$parameters = array(
	"api_token" => "2e71fc85b6076e6ae7c3d3294e4da8c969a81d6901",
    "api_secret" => "2e71fc85b6076e6ae7c3d3294e4da8c969a81d6901",
    "to" => $stu_ph_no,
    "from" => "Vision Clg",
    "type" => "unicode",
    "message" => $sms
                );

$ch = curl_init();
$timeout  =  30;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
$response = curl_exec($ch);
curl_close($ch);

echo $response ;










 ?>