// JavaScript Document

tinyMCE.init({
	// General options
	theme : "advanced",
	mode : "exact",
	
	width : "100%",
	height : "200",
	
	apply_source_formatting : true,
	cleanup: true,
	relative_urls : true,
	remove_script_host : true,
	remove_linebreaks : false,
	remove_linebreaks : false,
	
	language : "en",
	elements : "store.editor",
	
	//file_browser_callback : "filebrowser",
	file_browser_callback : "fileBrowserCallBack",
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	// Theme options
	/*
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	*/
	
	theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,insertdate,inserttime,preview,|,fullscreen,code",
	theme_advanced_buttons2 : "",
  theme_advanced_buttons3 : "",
	
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : false,
	theme_advanced_resize_horizontal : false,

	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",
});

function fileBrowserCallBack(field_name, url, type, win) {
	
	$filemanager = "http://dogandrooster.net/_mark/html/dnr/_acm/_manager/tinymce/filemanager/browser.html";
	$connectors  = "http://dogandrooster.net/_mark/html/dnr/_acm/_manager/tinymce/filemanager/connectors/php/connector.php";
	
	var connector = $filemanager + "?Connector=" + $connectors;
	var enableAutoTypeSelection = true;
	
	var cType;
	tinymcpuk_field = field_name;
	tinymcpuk = win;
	
	switch (type) {
		case "image":
			cType = "Image";
			break;
		case "flash":
			cType = "Flash";
			break;
		case "file":
			cType = "File";
			break;
	}
	
	if (enableAutoTypeSelection && cType) {
		connector += "&Type=" + cType;
	}
	
	window.open(connector, "tinymce","modal, width=1024, height=768");
}
