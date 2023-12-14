<?php
require_once ('core/controller.class.php');
require_once ('config.php');

if(isset($_GET)["code"]){
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);

}else{
    header("Location:index.php");
    exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_ne->get();

echo "<ptre>";
var_dump($userData);
echo "</ptre>";
?>