<?
	#Insert Code after this line...
	###############################
	
	
?>
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

	<div class="alert"> Blog Successfully Save! </div>

  <form id="blog_page" action="preview.php" method="post">
    <h3>ACM Blog</h3>
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    <fieldset style="width:1050px;">
      <legend>Blog Panel</legend>
      <ul>
        <li>
          <label for="title">
            <input type="text" id="title" name="title" onClick="if (this.value == 'Blog Title') { this.value = ''; }" onBlur="if (this.value == '') { this.value = 'Blog Title'; }" value="Blog Title">
          </label>
        </li>
        <li>
          <label for="blog.editor">
            <textarea cols="" rows="" id="blog.editor" name="blog.editor"> </textarea>
          </label>
        </li>
        <li>
          <label for="tag">Post Tags</label>
          <input type="text" id="tag" name="tag">
        </li>
        <li>
          <label for="category">Post Category</label>
          <input type="text" id="category" name="category">
        </li>
      </ul>
    </fieldset>
    <ul class="submission">
      <li><button type="submit">Publish Blog</button></li>
      <li><button type="reset">Clear Forms</button></li>
    </ul>
  </form>

<script type="text/javascript" src="http://dogandrooster.net//_mark/html/dnr/_acm/_assets/js/jquery.js"></script>
<script type="text/javascript" src="http://dogandrooster.net//_mark/html/dnr/_acm/_assets/js/cufon.js"></script>
<script type="text/javascript" src="http://dogandrooster.net//_mark/html/dnr/_acm/_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h3');
</script>

</body>
</html>