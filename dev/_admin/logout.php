<?
	ob_start();
	session_start();
	session_unset();
	$ROOT_URL = "http://www.piggyments.com/dev/";
	header("Location: $ROOT_URL");
?>