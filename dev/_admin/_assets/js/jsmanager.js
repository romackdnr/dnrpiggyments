/*----------------------------------------
Name: jsmanager.js | Version: 3 [xhtml5]
Developed by: Mark Joseph Rivera
Date Created: December 10, 2009
Last Updated: -- --, 2009
Copyright: 2009 @ Dog and Rooster
----------------------------------------*/

$(document).ready(function() {

	//JGrowl Property
	
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	}
	
	function isCheckedById(id) {
		var checked = $("input[@id="+id+"]:checked").length;
		if (checked == 0) {
			return false;
		}	else {
			return true;
		}
	}

	$('#login').click(function(){
		$errorMsg=false;
		
		$username=$('#un').val();
		$password=$('#pw').val();
		
		if($username=="") {
			$.jGrowl("Invalid Username");
			$errorMsg=true;
		}
		if($password=="") {
			$.jGrowl("Invalid Password");
			$errorMsg=true;
		}
		if($errorMsg==true){
			return false;
		} else {
			$('#security_login').submit();
			return true;
		}
	}); //End

	//End of JGrowl
	
});





$(document).ready(function() {

	//Password Recovery
	$("#clickme").click(function () {
		$(".recover").slideToggle("slow");
	});
	

	//Page Tab Links
	$("#tabnav").click(function () {
		$("#modules").slideToggle();
	});


	//Modules
	$(".newsletter").click(function () {
		$("#md_newsletter").animate({ opacity: 'toggle' });
		$("#md_photo, #md_video, #md_others1").hide();
	});
	$(".photo").click(function () {
		$("#md_photo").animate({ opacity: 'toggle' });
		$("#md_newsletter, #md_video, #md_others1").hide();
	});
	$(".video").click(function () {
		$("#md_video").animate({ opacity: 'toggle' });
		$("#md_photo, #md_newsletter, #md_others1").hide();
	});
	$(".others1").click(function () {
		$("#md_others1").animate({ opacity: 'toggle' });
		$("#md_photo, #md_video, #md_newsletter").hide();
	});


	//Elements
	$("#et_btab1").click(function () {
		$("#et_ftab1").fadeIn("normal");
		$("#et_ftab2").hide();
		$("#et_ftab3").hide();
	});
	
	$("#et_btab2").click(function () {
		$("#et_ftab2").fadeIn("normal");
		$("#et_ftab3").hide();
		$("#et_ftab1").hide();
	});

	$("#et_btab3").click(function () {
		$("#et_ftab3").fadeIn("normal");
		$("#et_ftab1").hide();
		$("#et_ftab2").hide();
	});

});























