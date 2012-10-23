<?php
if(isset($_GET['msj'])){
	$msn = $_GET['msj'];
	switch($msn){
		case 0: $msj = 'Upload successful<br>'; 	break;
		case 1: $msj = 'Error on the Upload try again later <br>';  break;
		case 2: $msj = 'File to big <br>'; break;
		case 3: $msj = 'Select a file <br>'; break;
	}
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Piggyments Marketing, Inc. | Send File</title>
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
<table width="930" height="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
	<div id="header">
	  <div id="lang"><a href="http://piggyments.com/sendfiles.php">Version en Español</a></div>
	  <div id="menu"><?php include('header.php'); ?></div>
      </div>
    </td></tr>
    <tr><td bgcolor="#FFFFFF" width="928" height="100%" align="center" valign="middle">
<div id="side-acontacto">
      <span><?php echo $msj; ?></span>
      <strong>Send us your file (30 MB Max)</strong>
      	<form method="post"   enctype="multipart/form-data" action="sendfile_a.php">
            <table width="450" border="0" style="font-size:13px;">
		      <tr><td>Name*:</td><td><input type="text" name="nombre" id="nombre" /></td></tr>
		      <tr><td>Company:</td><td><input type="text" name="empresa" id="empresa" /></td></tr>
		      <tr><td>E-mail*:</td><td><input type="text" name="email" id="email" /></td></tr>
		      <tr><td>Message: <br /></td><td><textarea name="mensaje" id="mensaje" cols="30" rows="7"></textarea></td></tr>
		      <tr><td>File*:</td><td><input type="file" name="archivo"  id="archivo" /></td></tr>
		      <tr><td>&nbsp;</td><td><input type="submit" name="submit" id="submit" value="Send" /></td></tr>
	        </table>
            <input name="action" type="hidden" value="upload" />
			<input name="page" type="hidden" value="sendfile" />
	      </form>
		    <p><br /><strong>FILES</strong>
            <br />Recommended files are TIFF, .JPG, .PSD, .AI and .PDF.  We ask that documents be sent in a resolution of 300 dpi for maximum quality.<br />
            Color artwork must be sent in CMYK format and black and  white artwork, in black and white.<br />
            <br />File size must be of a size 30MB or smaller.<br /><br />
			<strong>TURNAROUND<br />
            </strong>You will receive an online proof 1 business day after  you’ve submitted your file. Once it has been approved, please allow 3 to 4 days  of turnaround time.<br />
            <br />For custom graphic artwork, the turnaround time depends  on you. We will make as many changes to your logos and designs as your require  until you are completely satisfied. After you have approved your design, please  allow 3 to 4 days of turnaround time for production.&nbsp;<br />
            <br /><strong>GUARANTEE</strong> 
            <br /> We are sure you will love your end product, whether it  is a design or a print. However, in the event that you should not feel  completely satisfied with your prints, you may return them and receive a full  credit, which you may then use to purchase another print solution*.<br />
            <br />We have high standards of quality and we aim to exceed  our clients’ expectations. For this reason, this guarantee will cover alignment  issues or improper cutting.<br />
			<br />You are fully responsible for insuring there are no  typographical errors or unwanted information. Once you have revised and  approved your online proofs, no changes or cancellations will be accepted.<br />
			<br />Please be aware that there are different warranties for  different products.<br />
			<br />For adhesive vinyl, we do not take responsibility for  paint chipped or damaged due to adhesive vinyl. Please make sure your product  warranty covers any damages that may occur.<br />
			<br />
			*Please be aware that this guarantee only covers any  issues on which Piggyments Marketing, Inc. takes full responsibility, including improper cutting  and lack of color quality. We do not take responsibility for typographical  errors. </p>
</div>
            
<div id="side-b"><img src="images/bannerarchivoe.png" alt="Nosotros" /><br><br>
<span class="direction">825 Kuhn Drive<br>Suite 101<br> Chula Vista,CA 91914<br>phone. (619) 948 5250</span></div>
<div id="footer"><?php include('footer.php'); ?></div>
</td></tr></table>
</div>
</body>
</html>