<?
session_start();

$avs_code = $_POST['x_avs_code'];
$order_id = $_POST['x_invoice_num'];

//check AVS code
if($avs_code == "A")
{
$error = "Address (Street) matches, ZIP does not";
}
elseif($avs_code == "B")
{
$error = "Address information not provided for AVS check";
}
elseif($avs_code == "E")
{
$error = "AVS error";
}
elseif($avs_code == "G")
{
$error = "Non-U.S. Card Issuing Bank";
}
elseif($avs_code == "N")
{
$error = "No Match on Address (Street) or ZIP";
}
elseif($avs_code == "P")
{
$error = "AVS not applicable for this transaction";
}
elseif($avs_code == "R")
{
$error = "Retry – System unavailable or timed out";
}
elseif($avs_code == "S")
{
$error = "Service not supported by issuer";
}
elseif($avs_code == "U")
{
$error = "Address information is unavailable";
}
elseif($avs_code == "W")
{
$error = "9 digit ZIP matches, Address (Street) does not";
}
elseif($avs_code == "X")
{
$error = "Address (Street) and 9 digit ZIP match";
}
elseif($avs_code == "Y")
{
$error = "Address (Street) and 5 digit ZIP match";
}
elseif($avs_code == "Z")
{
$error = "5 digit ZIP matches, Address (Street) does not";
}
else
{
$error = "Transaction declined";
}

if($_POST['x_response_code']=="1")
{
//insert data into tb_orders
$order_id = $_POST['x_invoice_num'];
$trans_id = $_POST['x_trans_id'];
$amount = $_POST['x_amount'];
?>
<html>
<body>
<form name="success_form" method="POST" id="success_form" action="http://www.piggyments.com/dev/thankyou_payment.php"> 
<input type="hidden" name="order_id" value="<?=$order_id?>">
<input type="hidden" name="trans_id" value="<?=$trans_id?>">
<input type="hidden" name="amount" value="<?=$amount?>">
</form>
<script type="text/javascript" language="JavaScript">document.getElementById('success_form').submit();</script>
</body>
</html>

<? 
}
elseif($_POST['x_response_code']=="2")
{
$order_id = $_POST['x_invoice_num'];
?>
<html>
<body>
<form name="error_form" method="POST" id="errorform" action="http://www.piggyments.com/dev/declined.php"> 
<input type="hidden" name="error" value="<?=$error?>">
<input type="hidden" name="order_id" value="<?=$order_id?>">
</form>
<script type="text/javascript" language="JavaScript">document.getElementById('errorform').submit();</script>
</body>
</html>
<?
}
else
{
$error = "An error occured during transaction";
?>
<html>
<body>
<form name="error_form" method="POST" id="errorform" action="http://www.piggyments.com/dev/declined.php"> 
<input type="hidden" name="error" value="<?=$error?>">
<input type="hidden" name="order_id" value="<?=$order_id?>">
</form>
<script type="text/javascript" language="JavaScript">document.getElementById('errorform').submit();</script>
</body>
</html>
<? }

?>
