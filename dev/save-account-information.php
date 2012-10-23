<?php
require_once('includes/config.php');
if(!empty($_POST['submit_changes'])) {
	$update_flag = true;
	$_POST = sanitize($_POST);
	$_POST['fldClientPassword'] = $_POST['password'];
	
	unset($_POST['password']);
	unset($_POST['confirm_password']);
	
	$client = $_POST;
	settype($client,'object');

	if(!Client::isUniqueUsername($client->fldClientUsername, $client->fldClientID)) {
		$update_flag = false;
		$_SESSION['errors'][] = "Username is already in use.";
	}

	if(!Client::isUniqueEmail($client->fldClientEmail, $client->fldClientID)) {
		$update_flag = false;
		$_SESSION['errors'][] = "Email Address is already in use.";
	}

	// update only if passed all validations
	if($update_flag) {
		Client::updateClient( $client );
		// change password only when user entered something on the password fields
		if(strlen($client->fldClientPassword) > 0) Client::changePassword($client);
		$_SESSION['message'] = "Sucessfully changed.";
	} else {
		// $_SESSION['message'] = "Unable to save your changes.";
	}
	$_SESSION['update_flag'] = $update_flag;
}

header("Location: account-information.php");
?>