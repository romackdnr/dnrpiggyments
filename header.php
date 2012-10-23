
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_nbGroup(event, grpName) { //v6.0
  var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])? args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) {
      img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr)
      for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}
//-->
</script>

<?php
$script_name = $_SERVER['SCRIPT_NAME'];

$button['index'] = 'emenu_up_03.png';
$button['about'] = 'emenu_up_04.png';
$button['print'] = 'emenu_up_05.png';
$button['marketing'] = 'emenu_up_06.png';
$button['spectaculars'] = 'emenu_up_07.png';
$button['sendfile'] = 'emenu_up_08.png';
$button['contact'] = 'emenu_up_09.png';

switch($script_name)
{
	case '/index.php':
		$button['index'] = 'emenu_down_03.png';
	break;

	case '/about.php':
		$button['about'] = 'emenu_down_04.png';
	break;

	case '/print.php':
		$button['print'] = 'emenu_down_05.png';
	break;

	case '/marketing.php':
		$button['marketing'] = 'emenu_down_06.png';
	break;

	case '/spectaculars.php':
		$button['spectaculars'] = 'emenu_down_07.png';
	break;

	case '/sendfile.php':
		$button['sendfile'] = 'emenu_down_08.png';
	break;

	case '/contact.php':
		$button['contact'] = 'emenu_down_09.png';
	break;

	default:
		$button['index'] = 'emenu_down_03.png';
	break;
}
?>
<link href="styless.css" rel="stylesheet" type="text/css">
<body onLoad="MM_preloadImages('images/emenu_over_03.png','images/emenu_down_03.png','images/emenu_down_04.png','images/emenu_over_04.png','images/emenu_down_05.png','images/emenu_over_05.png','images/emenu_down_06.png','images/emenu_over_06.png','images/emenu_down_07.png','images/emenu_over_07.png','images/emenu_down_08.png','images/emenu_over_08.png','images/emenu_down_09.png','images/emenu_over_09.png','images/emenu_up_03.png')">

<a href="index.php" target="_top" onClick="MM_nbGroup('down','group1','home','images/emenu_down_03.png',1)" onMouseOver="MM_nbGroup('over','home','images/emenu_over_03.png','images/emenu_down_03.png',1)" onMouseOut="MM_nbGroup('out')"><img src="images/<?php echo $button['index'];?>" alt="home" name="home" border="0" onload="MM_nbGroup('init','group1','home','images/emenu_up_03.png',1)"></a>
<a href="about.php" target="_top" onClick="MM_nbGroup('down','group1','about','images/emenu_down_04.png',1)" onMouseOver="MM_nbGroup('over','about','images/emenu_over_04.png','images/emenu_down_04.png',1)" onMouseOut="MM_nbGroup('out')"><img name="about" src="images/<?php echo $button['about'];?>" border="0" alt="nosotros" onLoad=""></a>
<a href="print.php" target="_top" onClick="MM_nbGroup('down','group1','print','images/emenu_down_05.png',1)" onMouseOver="MM_nbGroup('over','print','images/emenu_over_05.png','images/emenu_down_05.png',1)" onMouseOut="MM_nbGroup('out')"><img name="print" src="images/<?php echo $button['print'];?>" border="0" alt="imprenta" onLoad=""></a>
<a href="marketing.php" target="_top" onClick="MM_nbGroup('down','group1','marketing','images/emenu_down_06.png',1)" onMouseOver="MM_nbGroup('over','marketing','images/emenu_over_06.png','images/emenu_down_06.png',1)" onMouseOut="MM_nbGroup('out')"><img name="marketing" src="images/<?php echo $button['marketing'];?>" border="0" alt="mercadotecnia" onLoad=""></a>
<a href="spectaculars.php" target="_top" onClick="MM_nbGroup('down','group1','spectaculars','images/emenu_down_07.png',1)" onMouseOver="MM_nbGroup('over','spectaculars','images/emenu_over_07.png','images/emenu_down_07.png',1)" onMouseOut="MM_nbGroup('out')"><img name="spectaculars" src="images/<?php echo $button['spectaculars'];?>" border="0" alt="espectaculares" onLoad=""></a>
<a href="sendfile.php" target="_top" onClick="MM_nbGroup('down','group1','sendfile','images/emenu_down_08.png',1)" onMouseOver="MM_nbGroup('over','sendfile','images/emenu_over_08.png','images/emenu_down_08.png',1)" onMouseOut="MM_nbGroup('out')"><img name="sendfile" src="images/<?php echo $button['sendfile'];?>" border="0" alt="enviar archivo" onLoad=""></a>
<a href="contact.php" target="_top" onClick="MM_nbGroup('down','group1','contact','images/emenu_down_09.png',1)" onMouseOver="MM_nbGroup('over','contact','images/emenu_over_09.png','images/emenu_down_09.png',1)" onMouseOut="MM_nbGroup('out')"><img name="contact" src="images/<?php echo $button['contact'];?>" border="0" alt="contacto" onLoad=""></a> 

