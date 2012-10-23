<?

global $ROOT_URL;


global $DB_NAME;
global $DB_HOST;
global $DB_USER;
global $DB_PASS;

$DB_NAME = "dnradmin";
$DB_HOST = "dnradmin.db.3506263.hostedresource.com";
$DB_USER = "dnradmin";
$DB_PASS = "DSAre96FGdd";

require_once('../classes/Database.php');
require_once('../classes/Connection.php');

global $adb;
$adb = new Database;

//get the connection
$connect = Connection::findConnection();
global $table_prefix;
$table_prefix = $connect->fldTablePrefix;
?>
