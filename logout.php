<?php
// Include configuration file
require_once 'config.php';

// Remove token and user data from the session
unset($_COOKIE['sess']);
unset($_COOKIE['id']);

// Reset OAuth access token
@$gClient->revokeToken();

// Destroy entire session data
session_destroy();

// Redirect to homepage
header("Location: index.php");
exit();
?>