<?php require_once 'php_inheritance.php' ?>
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
	<?php include '_manager/box_header/emulator.php'; ?>
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <title> Welcome to Dog and Rooster Admin Control Panel </title>
  <!--[if IE]>
    <script src="_assets/js/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="screen" href="_assets/css/core2.css" />
  <?php emptyblock('headercodes') ?>
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
</head>

<body onLoad="javascript:alternatecolor('alter_rows');">
<div id="wrapper">
	
	<!-- /Template Start Here -->
  <figure>
  	<header>
    	<h1 title="Welcome to Dog and Rooster Admin Panel"><!-- Dog and Rooster Logo --></h1>
      <strong>Welcome Administrator!</strong>
      
      <nav id="menunav1">
      	<div id="menu">
        	<ul class="panel1">
          	<li><a href="overview.php"></a></li>
          </ul>
        	<ul class="panel2">
          	<li><a href="settings.php"></a></li>
          </ul>
        	<ul class="panel3">
          	<li><a href="index.php"></a></li>
          </ul>
        </div>
      </nav>
      <nav id="menunav2">
      	<ul>
        	<li><a href="overview.php">Overview</a></li>
          <li><a href="page.php">Page Management</a></li>
          <li><a href="modules.php">Modules</a></li>
          <li><a href="elements.php?id=blank">Elements</a></li>
          <li><a href="help.php">Help</a></li>
        </ul>
      </nav>
    </header>
    
    
    <section>
    	<div class="stop"></div>
      <!-- /Inter-Section Start Block -->

			<?php emptyblock('section') ?>
      
      <!-- /Inter-Section End Block -->
			<div class="sbottom"></div>
    </section>  
  
  
  </figure>
	<!-- /Template End Here -->

  <footer>
    <small>Copyright 2010. Dog and Rooster, Inc.</small>
  </footer>

<!--#extracodes#-->
<?php emptyblock('extracodes') ?>
<!--#extracodes#-->
</div>
<?php include '_manager/box_header/ie6update.php'; ?>
</body>
</html>
