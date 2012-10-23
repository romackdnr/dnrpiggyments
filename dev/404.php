<?php
	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER['PHP_SELF']);
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF'])."/";
		}
		return $pageURL;
	}
	$root = curPageURL(); //record root url.
	$site = "";
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
 <meta charset="utf-8">
 <meta name="author" content="">
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,chrome=1">
 
 <style>
	body { background:#EEE; font:normal 13px Arial; color:#555; }
	#error-box { position:relative; background:rgba(255,255,255,.50); width:760px; height:200px; margin:10% auto; border:solid 1px #CCC; }
	#error-box { background:#FFF\9; }
	#error-box { -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px; }
	blockquote { position:absolute; top:5px; right:0; width:475px; padding-left:25px; border-left:solid 1px #999; }
	blockquote { *top:20px; }
	blockquote a { position:relative; font-weight:bold; color:#666; text-decoration:none; width:100%; padding-bottom:1px; border-bottom:solid 1px #666; }
 </style>

 <title>...Error: Page note found</title>
</head>

<body>

  <div id="error-box">
  
  	<div class=dnr_logo><img src="<?=$root;?>dev/assets/images/.dnr_logo.jpg" width="153" height="90" alt="Dog and Rooster, Inc."></div>
    <blockquote>
      <h3>Error: Page not found</h3>
      <p>We apologize for the inconvenience, but the page you attempted to access does not exist in our system.</p>
      <p>The page may have been moved, or it could have been mistyped. If the issue persists please send us a message on <a href="mailto:info@dogandrooster.net">info@dogandrooster.net</a>.</p>
      <p><a href="<?=$root;?>dev/">&laquo; Return to <?=$site?> homepage</a></p>
    </blockquote>
  
  </div>

</body>
</html>