<?php
//KNTL
include('function.php');
echo "$Green
 __             _ _               
/ _\_ __   ___ | | | _____      __
\ \| '_ \ / _ \| | |/ _ \ \ /\ / /
_\ \ |_) | (_) | | | (_) \ V  V / "."$White AIO Spotify"."$Green
\__/ .__/ \___/|_|_|\___/ \_/\_/  
   |_|                            \n\n";



input:
echo "\n$Cyan Link Profile : ";
$xi = trim(fgets(STDIN));
if(preg_match('/open.spotify.com/i',$xi)){
	$str = explode('user/',$xi)[1];
	$id = explode('?',$str)[0];
	} else if($xi==null){
	echo "$Red Can't be empty\n";
	goto input;
	}

uri:
$getid = getURI($id);
list($head,$param) = explode("\r\n\r\n",$getid,2);
if(preg_match('/name/i',$param)){
	$b = json_decode($param, true);
	$username = $b['name'];
	$followers = $b['followers_count'];
	goto cp;
	} else if(preg_match('/expired/i',$param)){
	echo "\n$Green Renew Acces Token expired ";
	goto renew;
	}

renew:
$ren = renewBearer();
list($head,$param) = explode("\r\n\r\n",$ren,2);
if(preg_match('/authfailed/i',$param)){
	echo "\n$Red ▶ Cookie Browser expired ";
	die;
	}
$xx = json_decode($param, true);
$berer = $xx['accessToken'];
$gett = getyuri($id,$berer);
list($head,$param) = explode("\r\n\r\n",$gett,2);
if(preg_match('/name/i',$param)){
	$b = json_decode($param, true);
	$username = $b['name'];
	$followers = $b['followers_count'];
	echo "\n$White  ▶ Profile $username Followers $followers\n\n"."$Green Ready Boost Followers ";
	goto cp;
	} else if(preg_match('/expired/i',$param)){
	echo "\n$Green ▶ Renew Acces Token ";
	goto renew;
	}
if($param==null){
	echo "\n$Red ▶ Wrong Url Profile\n\n";
	goto input;
	}

cp:
while(1){
reg:
$email = "agathaaaa+".substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8)."@proton.me";
$pass = "Agathasangkara";
$reg = signup($email,$pass);
list($head,$param) = explode("\r\n\r\n",$reg,2);
$json = json_decode($param, true);
if(preg_match('/success/i',$param)){
	$logintoken = $json['success']['login_token'];
	} else if(preg_match('/error/i',$param)){
	echo "\n$Red ▶ Rate Limited, Airplane Mode "; die;
	}
$get = getCSRF();
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $get, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
$csrf = $cookies['sp_sso_csrf_token'];
$csrfsid = $cookies['__Host-sp_csrf_sid'];
$login = authlogin($logintoken,$csrf,$csrfsid);
list($head,$param) = explode("\r\n\r\n",$login,2);
$per = explode('set-cookie: sp_dc=',$login)[1];
$token = explode(';',$per)[0];
if($token==null){
	goto reg;
	}
$getbearer = getAccessToken($token);
list($head,$param) = explode("\r\n\r\n",$getbearer,2);
$x = json_decode($param, true);
$bearer = $x['accessToken'];
$gas = follow($bearer,$id);
list($head,$param) = explode("\r\n\r\n",$gas,2);
if(preg_match('/200/i',$param)){
	echo "\n$White  ▶ Followed $username ";
	$info = '{"email":"'.$email.'","password":"'.$pass.'","sp_dc":"'.$token.'"}';
	file_put_contents('account.txt', "$info\n", FILE_APPEND);
	}
if($param == null){
	echo "\n$Red ▶ Clienttoken Expiring ";
	die;
	}
}