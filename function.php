<?php
error_reporting(0);
function curl($param,$headers,$url)
{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_ENCODING, "GZIP,DEFLATE");
		//curl_setopt($ch,CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
}
$Grey   = "\e[1;30m";
$Red    = "\e[0;31m";
$Green  = "\e[0;32m";
$Yellow = "\e[0;33m";
$Blue   = "\e[1;34m";
$Purple = "\e[0;35m";
$Cyan   = "\e[0;36m";
$White  = "\e[0;37m";
function path($method,$headers,$url)
{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_ENCODING, "GZIP,DEFLATE");
		//curl_setopt($ch,CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 1);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
}

function renewBearer()
	{
		$url = "https://open.spotify.com/get_access_token?reason=transport&productType=web_player";
		$method = "GET";
		$headers = array();
		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Accept: */*';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
		$headers[] = 'cookie: sp_dc=AQAZs6q4_oRrF2ta53b_2Q7bQXwjJF-FlxVYOWQ8GYpVrE6skaRwjQYIdz59trwYR7cdNysCVxr-xVlbb1bVef83OVgcBAbp0xRADrK9rGceVBt9Zvr8tzZ-Mnfo-bZoYqzqTz5wVzj7upfi6y11-jisBT7HjE99';
		return path($method,$headers,$url);
	}

function signup($email,$pass)
	{
		$url = "https://spclient.wg.spotify.com/signup/public/v2/account/create";
		$param = '{"account_details":{"birthdate":"1999-06-11","consent_flags":{"eula_agreed":true,"send_email":true,"third_party_email":false},"display_name":"Tutor bot ada di @agathasangkara","email_and_password_identifier":{"email":"'.$email.'","password":"'.$pass.'"},"gender":1},"callback_uri":"https://www.spotify.com/signup/challenge?forward_url=https%3A%2F%2Fwww.spotify.com%2Fid%2Faccount%2Foverview%2F&locale=id","client_info":{"api_key":"a1e486e2729f46d6bb368d6b2bcda326","app_version":"v2","capabilities":[1],"installation_id":"17130553-2c40-400f-8e8a-99027c434d38","platform":"www"},"tracking":{"creation_flow":"","creation_point":"https://www.spotify.com/id/","referrer":"account_hero_free"},"recaptcha_token":"null"}';
		$headers = array();
		$headers[] = 'Content-Length: '.strlen($param);
		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Accept: */*';
		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
		return curl($param,$headers,$url);
	}

function getCSRF()
	{
		$url = "https://accounts.spotify.com/en/login";
		$method = "GET";
		$headers = array();
		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
		$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
		$headers[] = 'Cookie: __Host-device_id=AQASTaFlcfRwTXhko6Y5HZmzSochQ7qB8ghzHLlyBgthfH9Rv8iTUtZ8lf0hHvhQmbGdaN_E8CDrhttjU88OBKO0DzZZE7nTlTM;sp_sso_csrf_token=013acda7193cecfaa271306f303c2b43f45eb6380431363732343535393236303530;__Host-sp_csrf_sid=b7eb719dbaf5cf8c9e5eec8888cc25a813c37db179091fc3d2d324f2d70143bd';
		return path($method,$headers,$url);
	}
	
function authlogin($logintoken,$csrf,$csrfsid)
	{
		$url = "https://www.spotify.com/api/signup/authenticate";
		$param = "splot=$logintoken";
		$headers = array();
		$headers[] = 'Content-Length: '.strlen($param);
		$headers[] = 'X-Csrf-Token: '.$csrf;
		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Accept: */*';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
		$headers[] = 'Cookie: __Host-sp_csrf_sid='.$csrfsid;
		return curl($param,$headers,$url);
	}

function getyuri($id,$berer)
	{
		$url = "https://spclient.wg.spotify.com/user-profile-view/v3/profile/$id";
		$method = "GET";
		$headers = array();
		$headers[] = 'Authorization: Bearer '.$berer;
		return path($method,$headers,$url);
	}

function getAccessToken($token)
	{
		$url = "https://open.spotify.com/get_access_token?reason=transport&productType=web_player";
		$method = "GET";
		$headers = array();
		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; RMX2061) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.186 Mobile Safari/537.36';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Accept: */*';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
		$headers[] = 'cookie: sp_dc='.$token;
		return path($method,$headers,$url);
	}

function getURI($id)
	{
		$url = "https://spclient.wg.spotify.com/user-profile-view/v3/profile/$id";
		$method = "GET";
		$headers = array();
		$headers[] = 'Authorization: Bearer BQAhKvNfuvJbf12DzuoMhMmmZutnzrv0LUZQBpjwWezcTKK9akbTIOk7dCMIFhgz7WteOZS-qcoKBj4VEraXpnH5QiQD_a5ZBHaw2ZpfTVLRqTXE0GEnSnPE4s46aBIe9nGmrRYaPnP85ebbeleQ6o-DTcnxdgrwI0Iv5BjKKsqv3qyPsLKoesGIGLVLLHFinEI';
		return path($method,$headers,$url);
	}


function follow($bearer,$id)
	{
		$url = "https://spclient.wg.spotify.com/socialgraph/v2/following?format=json";
		$param = '{
  "target_uris": [
    "spotify:user:'.$id.'"
  ]
}';
		$headers = array();
		$headers[] = 'Accept-Language: id-ID;q=1, en-US;q=0.5';
		$headers[] = 'User-Agent: Spotify/8.6.4 Android/29 (Oneplus a3010)';
		$headers[] = 'Spotify-App-Version: 8.6.4';
		$headers[] = 'X-Client-Id: 9a8d2f0ce77a4e248bb71fefcb557637';
		$headers[] = 'App-Platform: Android';
		$headers[] = 'Client-Token: AAAQ0G8L3dK1LLmT7RCTYDgzh+veZkj1bFFVZ0ywUaN6pt/N4QhkS8uXTwKJUwqTBdNc6Zh9PqtGKzFTRR7M+j9Uwj3AStLKCtIPKu5aMRz+UqrWw7v+3/qsB0/tgBgKlglhKpDQzRHZCX6k9G+4u0Qw+82nfV6lna4V4pxhVQ6prs7T7IRvbzF9gPS6wC5Tu9eEdHfDHgvtMyThhF/rTzpAsUFi9HU9RBqPcPGQSgCbNKRMxkb1ZYby7v7pc90TS7d1TdLUNVtRjVch06gMGFlYXC6p1dw2VC4HiaehaVYz4sDXNu2RVo8PrZ0g';
		$headers[] = 'Authorization: Bearer '.$bearer;
		$headers[] = 'Content-Type: application/json; charset=UTF-8';
		$headers[] = 'Content-Length: '.strlen($param);
		$headers[] = 'Accept-Encoding: gzip';
		return curl($param,$headers,$url);
	}