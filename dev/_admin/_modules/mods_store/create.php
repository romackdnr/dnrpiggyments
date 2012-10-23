<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="stylesheet" type="text/css" media="screen" href="http://dogandrooster.net/_mark/html/dnr/_acm/_assets/css/core3.css" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="http://dogandrooster.net/_mark/html/dnr/_acm/_assets/css/modules.css" /> 
  <script type="text/javascript" src="http://dogandrooster.net/_mark/html/dnr/_acm/_manager/tinymce/tiny_mce.js"></script>
  <script type="text/javascript" src="js/tiny.mods.js"></script>
</head>

<body>

	<div class="alert"> Product Successfully Save! </div>

  <form id="store_page" action="" method="post">
    <h3>ACM Simple E-Cart</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1065px;">
      <legend>Simple E-Cart Panel</legend>
      <ul>
        <li>
          <label for="title">Product Name</label>
          <input type="text" id="title" name="title">
        </li>
        <li>
          <label for="category">Product Category</label>
          <input type="text" id="category" name="category">
        </li>
        <li>
          <label for="price">Item Price</label>
          <input type="text" id="price" name="price">
        </li>
        <li>
          <label for="cover">Upload Photo Cover <span class="smaller"><em>(Max image size of 2Mb)</em></span></label>
          <input type="file" id="cover" name="cover">
        </li>
        <li>
          <label for="store.editor">Product Description</label>
          <textarea cols="" rows="" id="store.editor" name="store.editor"> </textarea>
        </li>
      </ul>
      
      <fieldset id="preview">
      	<legend>Preview</legend>
        <div class="previewbox">  </div>        
      </fieldset>      
    </fieldset>
    <ul class="submission">
      <li><button type="submit">Publish Item</button></li>
      <li><button type="reset">Clear Forms</button></li>
    </ul>
  </form>

<script type="text/javascript" src="http://dogandrooster.net/_mark/html/dnr/_acm/_assets/js/jquery.js"></script>
<script type="text/javascript" src="http://dogandrooster.net/_mark/html/dnr/_acm/_assets/js/cufon.js"></script>
<script type="text/javascript" src="http://dogandrooster.net/_mark/html/dnr/_acm/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>