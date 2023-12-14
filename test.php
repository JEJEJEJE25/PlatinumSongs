<?php
require_once ('core/controller.class.php');
require_once ('config.php');

if(isset($_GET["code"])){
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);

}else{
    header("Location:index.php");
    exit();
}
if(isset($token["error"])!= "invalid grant"){
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    
    //inser data
    $Controller = new Controller;
    echo $Controller-> insert_data(array(
        'firstname' => $userData['givenName'],
        'lastname' => $userData['familyName'],
        'email' => $userData['email'],
        'avatar' => $userData['picture'],
        
        
    ));
    // echo "<ptre>";
    // var_dump($token);
    // echo "</ptre>";
    
}else{
    header("Location:index.php");
    exit();
}
?>