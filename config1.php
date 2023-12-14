<?php
require_once ('google-api/vendor/autoload.php');
$gClient = new Google_Client();
$gClient->setClientId("702568126790-j6h6dh1j7rne6210lidrjv8lbaqontuh.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("PlatinumSongs Login");
$gClient->setRedirectUri("http://localhost/YoutubeAPI/test.php");
$gClient->addScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");


$login_url = $gClient->createAuthUrl();
?>