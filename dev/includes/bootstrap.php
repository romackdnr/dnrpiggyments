<?
global $DB_NAME;
global $DB_HOST;
global $DB_USER;
global $DB_PASS;
global $ROOT_URL;

//$ROOT_URL = "http://www.piggyments.com/dev/";
$ROOT_URL = "http://" . $_SERVER["HTTP_HOST"] . "/dev/";

$DB_NAME = "piggyredcms";
// $DB_HOST = "72.167.154.41";
// $DB_USER = "piggyredcms";
// $DB_PASS = "DBpig21sssGHf";
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";


global $adb;
$adb = new Database;

//get the connection
$connect = Connection::findConnection();
global $table_prefix;
$table_prefix = $connect->fldTablePrefix;

?>
