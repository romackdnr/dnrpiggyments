<?php
	function useragent() {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		//print $useragent;
		if(strchr($useragent,"MSIE 8")) return 'IE 8';
	}
	if(useragent()=='IE 8') {
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" /> \n";
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" /> \n";
		echo "<meta name=\"robots\" content=\"noindex, nofollow\"> \n";
	} else {
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" /> \n";
		echo "<meta name=\"robots\" content=\"noindex, nofollow\"> \n";
	}
?>
