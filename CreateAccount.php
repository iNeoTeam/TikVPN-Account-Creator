<?php
/*
Examples: 

With Favorite Password:
CreateAccount.php?email=example@server.com&password=TikVPN
Without Password:
CreateAccount.php?email=example@server.com
*/
error_reporting(0);
header("content-type: application/json");
$email = $_GET['email'];
$password = $_GET['password'];
function Random($len = 6){
	$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$length = strlen($char); $random = '';
	for($i = 0; $i < $len; $i++){ $random .= $char[rand(0, $length - 1)]; }
	return $random;
}
if($password == null){ $password = Random(); }
$param = array('email' => $email, 'password' => $password);
$headers = array(
	'Content-Type: application/json',
	'login: '.base64_encode(json_encode($param))
);
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, "https://api.ineo-team.ir/tikvpn.php");
curl_setopt($cURL, CURLOPT_POST, 1);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
$RESULT = curl_exec($cURL);
curl_close ($cURL);
echo $RESULT;
?>
