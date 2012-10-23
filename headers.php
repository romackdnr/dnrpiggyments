
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

$button['indexs'] = 'menu_up_03.png';
$button['abouts'] = 'menu_up_04.png';
$button['prints'] = 'menu_up_05.png';
$button['marketings'] = 'menu_up_06.png';
$button['spectacularss'] = 'menu_up_07.png';
$button['sendfiles'] = 'menu_up_08.png';
$button['contacts'] = 'menu_up_09.png';

switch($script_name)
{
	case '/indexs.php':
		$button['indexs'] = 'menu_down_03.png';
	break;

	case '/abouts.php':
		$button['abouts'] = 'menu_down_04.png';
	break;

	case '/prints.php':
		$button['prints'] = 'menu_down_05.png';
	break;

	case '/marketings.php':
		$button['marketings'] = 'menu_down_06.png';
	break;

	case '/spectacularss.php':
		$button['spectacularss'] = 'menu_down_07.png';
	break;

	case '/sendfiles.php':
		$button['sendfiles'] = 'menu_down_08.png';
	break;

	case '/contacts.php':
		$button['contacts'] = 'menu_down_09.png';
	break;

	default:
		$button['indexs'] = 'menu_down_03.png';
	break;
}
?>
<body onLoad="MM_preloadImages('images/menu_up_03.png','images/menu_over_03.png','images/menu_down_03.png','images/menu_down_04.png','images/menu_over_04.png','images/menu_down_05.png','images/menu_over_05.png','images/menu_down_06.png','images/menu_over_06.png','images/menu_down_07.png','images/menu_over_07.png','images/menu_down_08.png','images/menu_over_08.png','images/menu_down_09.png','images/menu_over_09.png')">

<a href="indexs.php" target="_top" onClick="MM_nbGroup('down','group1','home','images/menu_down_03.png',1)" onMouseOver="MM_nbGroup('over','home','images/menu_over_03.png','images/menu_down_03.png',1)" onMouseOut="MM_nbGroup('out')"><img src="images/<?php echo $button['indexs'];?>" alt="home" name="home" width="71" height="35" border="0" onload="MM_nbGroup('init','group1','home','images/menu_up_03.png',1)"></a>
<a href="abouts.php" target="_top" onClick="MM_nbGroup('down','group1','about','images/menu_down_04.png',1)" onMouseOver="MM_nbGroup('over','about','images/menu_over_04.png','images/menu_down_04.png',1)" onMouseOut="MM_nbGroup('out')"><img name="about" src="images/<?php echo $button['abouts'];?>" border="0" alt="nosotros" onLoad=""></a>
<a href="prints.php" target="_top" onClick="MM_nbGroup('down','group1','print','images/menu_down_05.png',1)" onMouseOver="MM_nbGroup('over','print','images/menu_over_05.png','images/menu_down_05.png',1)" onMouseOut="MM_nbGroup('out')"><img name="print" src="images/<?php echo $button['prints'];?>" border="0" alt="imprenta" onLoad=""></a>
<a href="marketings.php" target="_top" onClick="MM_nbGroup('down','group1','marketing','images/menu_down_06.png',1)" onMouseOver="MM_nbGroup('over','marketing','images/menu_over_06.png','images/menu_down_06.png',1)" onMouseOut="MM_nbGroup('out')"><img name="marketing" src="images/<?php echo $button['marketings'];?>" border="0" alt="mercadotecnia" onLoad=""></a>
<a href="spectacularss.php" target="_top" onClick="MM_nbGroup('down','group1','spectaculars','images/menu_down_07.png',1)" onMouseOver="MM_nbGroup('over','spectaculars','images/menu_over_07.png','images/menu_down_07.png',1)" onMouseOut="MM_nbGroup('out')"><img name="spectaculars" src="images/<?php echo $button['spectacularss'];?>" border="0" alt="espectaculares" onLoad=""></a>
<a href="sendfiles.php" target="_top" onClick="MM_nbGroup('down','group1','sendfile','images/menu_down_08.png',1)" onMouseOver="MM_nbGroup('over','sendfile','images/menu_over_08.png','images/menu_down_08.png',1)" onMouseOut="MM_nbGroup('out')"><img name="sendfile" src="images/<?php echo $button['sendfiles'];?>" border="0" alt="enviar archivo" onLoad=""></a>
<a href="contacts.php" target="_top" onClick="MM_nbGroup('down','group1','contact','images/menu_down_09.png',1)" onMouseOver="MM_nbGroup('over','contact','images/menu_over_09.png','images/menu_down_09.png',1)" onMouseOut="MM_nbGroup('out')"><img name="contact" src="images/<?php echo $button['contacts'];?>" border="0" alt="contacto" onLoad=""></a> 

