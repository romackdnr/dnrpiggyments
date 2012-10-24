<?
ob_start();
session_start();

/**
 * Destroy Session Script
 * from http://php.net/manual/en/function.session-destroy.php
 */

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
/**
 * End of Destroy Session Script
 * from http://php.net/manual/en/function.session-destroy.php
 */

$ROOT_URL = "http://piggyments.com/dev/";

// OFFLINE
// $ROOT_URL = "http://localhost/dev/";

header("Location: $ROOT_URL");
?>
