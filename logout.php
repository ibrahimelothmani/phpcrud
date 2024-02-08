<?php

session_start();

$_SESSION = array();

session_destroy();

header('Location: authenticator.php');
exit;
?>