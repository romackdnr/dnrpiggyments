<?php
if(isset($_GET['msj'])){
	$msn = $_GET['msj'];
	switch($msn){
		case 0: $msj = 'Archivo subido con exito <br>'; 	break;
		case 1: $msj = 'Error en la subida intente mas tarde <br>';  break;
		case 2: $msj = 'Archivo muy pesado <br>'; break;
		case 3: $msj = 'Seleccione un archivo <br>'; break;
	}
}

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Piggyments Marketing, Inc. | Envio de Archivos</title>
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
<link href="*.css" rel="stylesheet" type="text/css">
</head>

<body onLoad="MM_preloadImages('images/over_impresion.png','images/over_mercadotecnia.png','images/over_espectaculares.png','images/over_archivo.png')">
<table width="930" height="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
	<div id="header">
	  <div id="lang"><a href="http://piggyments.com/sendfile.php">English Version</a></div>
	  <div id="menu"><?php include('headers.php'); ?></div>
	</div>
    </td></tr>
    <tr><td bgcolor="#FFFFFF" width="928" height="100%" align="center" valign="middle">
		<div id="side-acontacto">
        <span><?php echo $msj; ?></span>
        	<strong>Envianos Tu Archivo (30 MB Max)</strong><br><br>
		<form method="post"   enctype="multipart/form-data" action="sendfile_a.php">
            <table width="450" border="0" style="font-size:13px;">
		      <tr><td>Nombre*:</td><td><input type="text" name="nombre" id="nombre" /></td></tr>
		      <tr><td>Empresa:</td><td><input type="text" name="empresa" id="empresa" /></td></tr>
		      <tr><td>E-mail*:</td><td><input type="text" name="email" id="email" /></td></tr>
		      <tr><td>Mensaje: </td><td><textarea name="mensaje" id="mensaje" cols="30" rows="7"></textarea></td></tr>
		      <tr><td>Archivo*:</td><td><input  type="file" name="archivo" id="archivo" /></td></tr>
		      <tr><td>&nbsp;</td><td><input type="submit" name="submit" id="submit" value="Enviar" /></td></tr>
	        </table>
            <input name="action" type="hidden" value="upload" />
            <input name="page" type="hidden" value="sendfiles" />
	      </form>
  <strong><br />
  ARCHIVOS<br />
  </strong>Los archivos recomendados son .TIFF, .JPG, .PSD, .AI y .PDF. Por favor asegúrese de que los archivos que está entregando estén listos para la impresión. Sugerimos que los documentos tengan una resolución mínima de 300 dpi para garantizar impresiones de máxima calidad. Piggyments Marketing, Inc. no se hace responsable por baja calidad de fotografías. Los gráficos a color favor de enviarlos a color en formato CMYK.<br />
  <br />
    <strong>TIEMPO DE ENTREGA</strong><br />
    Para impresiones de gran formato, recibirá su prueba vía Internet 1 día hábil después de la entrega de su archivo. Revísela y una vez aprobada, favor de esperar de 3 a 4 días de tiempo de entrega. Para diseños gráficos personalizados, el tiempo de entrega depende de usted. Sus diseños se enviarán a producción una vez que usted este 100% satisfecho con su diseño. Se piden 3 ó 4 días hábiles de tiempo de entrega.<br />
    <br />
    <strong>GARANTÍA</strong><br />
    Ofrecemos un servicio de garantía para nuestros servicios de impresión. Esto significa que si usted no está satisfecho con sus impresiones, tiene la opción de devolverlas y se le dará crédito para utilizar en otra impresión*. Tenemos alto estándares de calidad y buscamos rebasar las expectativas de nuestros clientes, por lo que nos hacemos responsables de cualquier impresión mal alineada o mal cortada. Aclaramos que es responsabilidad de usted como cliente, asegurarse de que la prueba de su impresión esté correcta y este lista para enviar a producción. Una vez aprobada la prueba, no se aceptan cambios o cancelaciones. Existen diferentes garantías para diferentes productos.<br />
    <br />
    En el caso de vinilo adhesivo, no nos hacemos responsables en productos dañados a causa de desprender los vinilos, por lo que le pedimos asegurarse de que sus productos estén en condición de recibir estos adhesivos.<br />
    <br />
    *Esta garantía es válida siempre y cuando la falta de calidad se deba a algún problema relacionado a algún descuido por parte de la imprenta. Estos descuidos incluyen cortes o alineamientos incorrectos. No nos hacemos responsables de errores ortográficos.<br />
  </p>
  </div>
            
            <div id="side-b"><img src="images/bannerarchivo.png" alt="Nosotros" /><br><br>
      <span class="direction">825 Kuhn Drive<br>Suite 101<br> Chula Vista,CA 91914<br>
      Tel. (619) 948 5250</span></div>
<div id="footer"><?php include('footers.php'); ?></div>
</td></tr></table>
</body>
</html>