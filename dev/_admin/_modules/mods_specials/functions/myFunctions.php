<?php

function checkDomain($host,$ext) {
$host = $host.$ext;
if ($ext == ".tv" || $ext == ".ro" || $ext == ".jp" || $ext == ".ws" || $ext == ".ph" || $ext == ".com.ph" || $ext == ".fm" || $ext == ".vu") {
	$whois = "cwhois1.completewhois.com";
} elseif ($ext == ".be" || $ext == ".de" || $ext == ".dk" || $ext == ".com.ro" || $ext == ".lt" || $ext == ".co.il" || $ext == ".org.il") {
	$whois = "whois.ripe.net";
} elseif ($ext == ".ms" || $ext == ".gs" || $ext == ".vg" || $ext == ".tc") {
	$whois = "whois.adamsnames.tc";
} elseif ($ext == ".com" || $ext == ".net") {
	$whois ="whois.networksolutions.com";
} elseif ($ext == ".net.nz" || $ext == ".org.nz") {
	$whois = "whois.patho.gen.nz";
} elseif ($ext == ".co.uk" || $ext == ".org.uk") {
	$whois = "whois.nic.uk";
} elseif ($ext ==".org") {
	$whois = "whois.publicinterestregistry.net";
} elseif ($ext ==".nl") {
	$whois = "whois.domain-registry.nl";
} elseif ($ext ==".ac") {
	$whois = "whois.nic.ac";
} elseif ($ext ==".st") {
	$whois = "whois.nic.st";
} elseif ($ext ==".co.za") {
	$whois = "whois.frd.ac.za";
} elseif ($ext ==".sh") {
	$whois = "whois.nic.sh";
} elseif ($ext ==".ca") {
	$whois = "whois.cdnnet.ca";
} elseif ($ext ==".info") {
	$whois = "whois.afilias.net";
} elseif ($ext ==".biz") {
	$whois = "whois.pacificroot.com";
} elseif ($ext ==".as") {
	$whois = "whois.nic.as";
} elseif ($ext ==".cc") {
	$whois = "whois.nic.cc";
} elseif ($ext ==".to") {
	$whois = "whois.tonic.to";
} elseif ($ext ==".kz") {
	$whois = "whois.domain.kz";
} elseif ($ext == ".co.nz") {
	$whois = "whois.domainz.net.nz";
}

if (checkdnsrr($host) == 1) {
	return true;	
} else {
	return false;
}
}


function GetSID ($nSize=24) {
		// Randomize
		mt_srand ((double) microtime() * 1000000);
		$sessionIDx="";
		for ($i=1; $i<=$nSize; $i++) {
			// if you wish to add numbers in your string,
			// uncomment the two lines that are commented
			// in the if statement
			$nRandom = mt_rand(1,30);
			if ($nRandom <= 10) {
				// Uppercase letters
				$sessionIDx .= chr(mt_rand(65,90));
		//	} elseif ($nRandom <= 20) {
		//		$sessionID .= mt_rand(0,9);
			} else {
				// Lowercase letters
				$sessionIDx .= chr(mt_rand(97,122));
			}
		}
		return strtolower($sessionIDx);
	}



function checkEmail($email) {
		  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }  
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
	  {
        return false;
      }
    }
  }
  return true;
	}
	
	//Credit card number checking
function IsCCNumberValid($ccNumber, $cardType)
{

if($cardType)
{
   if($cardType == 1){$retval = isMCRD($ccNumber);}
   elseif($cardType == 2){$retval = isVISA($ccNumber);}
   elseif($cardType == 3){$retval = isAMEX($ccNumber);}
   elseif($cardType == 4){$retval = isDCCB($ccNumber);}
   elseif($cardType == 5){$retval = isDISC($ccNumber);}
   elseif($cardType == 6){$retval = isENRT($ccNumber);}
   elseif($cardType == 7){$retval = isJCBC($ccNumber);}
}
else
{
   if(!$retval){$retval = isMCRD($ccNumber);}
   if(!$retval){$retval = isVISA($ccNumber);}
   if(!$retval){$retval = isAMEX($ccNumber);}
   if(!$retval){$retval = isDCCB($ccNumber);}
   if(!$retval){$retval = isDISC($ccNumber);}
   if(!$retval){$retval = isENRT($ccNumber);}
   if(!$retval){$retval = isJCBC($ccNumber);}
}
return $retval;
}

function isMCRD($ccNum)
{
$preFix = substr($ccNum, 0, 2);
if($preFix == 51 || 
   $preFix == 52 || 
   $preFix == 53 || 
   $preFix == 54 || 
   $preFix == 55)
{	
   if(strlen($ccNum) == 16){return  modTen($ccNum);}
}
else
{
   return 0;
}
}

function isVISA($ccNum)
{
$preFix = substr($ccNum, 0, 1);
if($preFix == 4){	
   if(strlen($ccNum) == 13 || strlen($ccNum) == 16){
   return  modTen($ccNum);}}
else
{
   return 0;
}
}

function isAMEX($ccNum)
{
$preFix = substr($ccNum, 0, 2);
if($preFix == 34 || $preFix == 37){	
   if(strlen($ccNum) == 15){
   return  modTen($ccNum);}}
else
{
   return 0;
}
}

function isDCCB($ccNum)
{
$preFix = substr($ccNum, 0, 3);
if($preFix == 300 || 
   $preFix == 301 || 
   $preFix == 302 || 
   $preFix == 303 || 
   $preFix == 304 || 
   $preFix == 305)
{	
   if(strlen($ccNum) == 14){return  modTen($ccNum);}
}
else
{
   return 0;
}
$preFix = substr($ccNum, 0, 2);
if($preFix == 36 || $preFix == 38){	
   if(strlen($ccNum) == 14){
   return  modTen($ccNum);}}
else
{
   return 0;
}
}

function isDISC($ccNum)
{
$preFix = substr($ccNum, 0, 4);
if($preFix == 6011){	
   if(length($ccNum) == 16){
   return  modTen($ccNum);}}
else
{
   return 0;
}
}

function isENRT($ccNum)
{
$preFix = substr($ccNum, 0, 4);
if($preFix == 2014 || $preFix == 2149){	
   if(length($ccNum) == 15){
   return  1;}}
else
{
   return 0;
}
}

function isJCBC($ccNum)
{
$preFix = substr($ccNum, 0, 1);
if($preFix == 3){	
   if(length($ccNum) == 15 || length($ccNum) == 16){
   return  modTen($ccNum);}}
else
{
   return 0;
}
$preFix = substr($ccNum, 0, 4);
if($preFix == 1800 || $preFix == 2131){	
   if(length($ccNum) == 15 || length($ccNum) == 16){
   return  modTen($ccNum);}}
else
{
   return 0;
}
}

function modTen($ccNum)
{
$numLen = strlen($ccNum);
for($x = $numLen; $x > 0; $x-=2){$tot+=substr($ccNum, $x - 1, 1);}
for($x = $numLen - 1; $x > 0; $x-=2)
{
   $y = substr($ccNum, $x - 1, 1) * 2;
   if(strlen($y) == '1'){$tot+=$y;}
   if(strlen($y) == '2'){$tot+=substr($y, 0, 1); $tot+=substr($y, 1, 1); }
}
if(substr($tot, strlen($tot) - 1, 1) == '0'){return 1;}
else{return 0;}
}
//////End check of credit card


	function mailme($to,$subject,$message,$from)
	{
	$to=$to;
	$subject=$subject;
	$message=$message;
	$from=$from;
	mail($to, $subject,
		$message ,
		"To: <$to>\n" .
		"From: <$from>\n" .
		"MIME-Version: 1.0\n" .
		"Content-type: text/html; charset=iso-8859-1");
	}
	
	function imgresize($filename) {
	$filename= $filename;
	$size = getimagesize($filename);
	$height = $size[1];
	$width = $size[0];
	if ($height < 150) {
		$height = 100;
		$percent = ($size[1] / $height);
		$width = ($size[0] / $percent);
	} else if ($width > 150) {
		$width = 150;
		$percent = ($size[0] / $width);
		$height = ($size[1] / $percent);
	}
	$image= imagecreatefromjpeg($filename);
	imagejpeg($image, $filename);
	imagedestroy($image);
	echo $image;
}

?>

<?php
  function addon($prodid,$prodname, $description,$size,$cat,$amount,$groups) {
  	
  		$query ="INSERT INTO products(product_main_id,prod_name,prod_description,size,cat_no,amount,groups) VALUES ('$prodid','$prodname','$description','$size','$cat','$amount','$groups')";
		
		//mysql_select_db($database_cell, $cell);
		$result = mysql_query($query) or die(mysql_error());
  }
?>