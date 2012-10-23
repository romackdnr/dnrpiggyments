<?
//This command imports the values from contact.php. Please do not touch.
@import_request_variables("gpc");

//The email address the message will be sent to
//$youremail = "contacto@danielmercado.net";
$youremail = "lauraz@redandwhitemarketing.com";

//The subject of the email you will receive;
$subject = "Formulario desde piggyments.com";

//The page your visitor will be redirected to.
$redirect = "http://piggyments.com/indexs.php";

//Time until the page redirects your visitor (seconds)
$secs = "5";

//This takes all of the information from the form and sorts it out. Please leave as is.
foreach ($_POST as $name => $value) 
{
$thetext=$thetext."$name : $value\n";
}

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Piggyments Marketing, Inc. -Contact</title>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="styless.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="MM_preloadImages('images/over_impresion.png','images/over_mercadotecnia.png','images/over_espectaculares.png','images/over_archivo.png')">
<div id="wrapper">
	<div id="header">
    <div id="lang"><a href="http://piggyments.com/contact.php">View English Version</a></div>
    <div id="menu">
	  <?php require_once('headers.php'); ?></div>
	</div>
		<div id="side-acontacto">
        
        <p class="TitulosSecciones">Gracias por visitar <strong>Piggyments Marketing, Inc.</strong>.<br />
          Nos comunicaremos con usted a la mayor brevedad posible.<br />
<?
//This is where the email is sent using your values from above. Be sure to update this if you change any fields in contact.php
  mail("$youremail", "$subject","$thetext");
?>
        
  </p></div><div id="side-b"><img src="images/bannercontacto.png" alt="Nosotros" />
    </div>
<div id="footer">
	  <?php require_once('footer.php'); ?>
	</div>
</div>
</body>
</html>