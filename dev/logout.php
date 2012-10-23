<?
	ob_start();
	session_start();
	session_unset();
	// $ROOT_URL = "http://piggyments.com/dev/";
	$ROOT_URL = "http://localhost/dev/";
	header("Location: $ROOT_URL");
?>