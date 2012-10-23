<?php
session_start();
if (!isset($_SESSION['customer_logged']) || ($_SESSION['customer_logged']!= true) || ($_SESSION['customer_ip'] != $_SERVER['REMOTE_ADDR'])) {
    
	$_SESSION = null;
	if (isset($_COOKIE[session_name()])) {
	   setcookie(session_name(), '', time()-42000, '/');
	}
    
	session_destroy();
    //setcookie("cached_url", $_SERVER['REQUEST_URI']);
	header('Location: signin.php');
	exit;
} elseif (time() - $_SESSION['customer_timestamp'] > 60*25) {
	$_SESSION = array();
	session_destroy();
    setcookie("cached_url", $_SERVER['REQUEST_URI']);
	header('Location: signin.php?timeout=1');
	exit;
}

$_SESSION['customer_timestamp']= time();

$currentLoginFirstName=$_SESSION['customer_firstname'];
?>
