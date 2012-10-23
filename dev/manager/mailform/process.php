<?php

#####################################
#Begin Sending Email
#####################################
include 'class.phpmailer.php';

$name 			= $_POST['name'];
$email 			= $_POST['email'];
$address 			= $_POST['address'];
$city_state		= $_POST['city'];
$zip	= $_POST['zip'];
$phone	= $_POST['phone'];
$msg1 			= $_POST['comments'];
$msg2 			= stripslashes(strip_tags($msg1));
$messages 	= nl2br($msg2);

$message = '
<!DOCTYPE html>  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">  
<head>  
  <style type="text/css" media="screen">
    * { margin:0; padding:0; }
    body { font-family:Arial, Helvetica, sans-serif; color:#666; margin:10px 0; }
    body p { font-size:11px; margin:0 0 10px; }
    body a { color:#666; text-decoration:none; }
    body a:hover { color:#006ab6; }
    
    #parentframe { position:relative; font-size:13px; width:798px !important; margin:auto; border-collapse:collapse; border-spacing:0; border:solid 1px #999; }
    thead { background:#006ab6; color:#FFF; }
    thead	td { padding:10px; }
    tbody td { vertical-align:top; padding:10px; }
    tfoot { background:#EFEFEF; font-size:11px !important; color:#666; }
    tfoot	td { padding:5px; }
    
    h3 { font:bold 15px Arial; color:#006ab6; border-bottom:solid 1px #CCC; }
    
    #childframe { position:relative; font-size:13px; line-height:18px; margin:0; border-collapse:collapse; border-spacing:0; }
		#childframe .label { width:25%; }
		#childframe .label-inputs { width:60%; }
    #childframe td { padding:0 0 5px; }
	</style>
  <style type="text/css" media="print">
		* { margin:0; padding:0; }
    body { font-family:Arial, Helvetica, sans-serif; color:#666; margin:10px 0; }
		
    #parentframe { font-size:13px; width:100% !important; margin:10px; }
		.label { float:left; width:30%; }
		.label-inputs { float:left; width:70%; }
	</style>
</head>

<body>

  <table id="parentframe" width="75%">
    <thead>
      <tr>
        <td align="left">You have a Mail Information from <strong>'.$name.'</strong>...</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><h3>Red and White Marketing - Contact Us Information</h3></td>
      </tr>
      
      <tr>
        <td>
          <!-- Start Message Content -->
          <table id="childframe" width="100%">
            <tr>
              <td class="label">Full Name</td>
              <td class="label-inputs">'.$name.'</td>
            </tr>
			 <tr>
              <td class="label">Email Address</td>
              <td class="label-inputs">'.$email.'</td>
            </tr>
            <tr>
              <td class="label">Address</td>
              <td class="label-inputs">'.$address.'</td>
            </tr>
           
            <tr>
              <td class="label">City / State</td>
              <td class="label-inputs">'.$city_state.'</td>
            </tr>
            <tr>
              <td class="label">Postal / Zip code</td>
              <td class="label-inputs">'.$zip.'</td>
            </tr>
            <tr>
              <td class="label">Phone</td>
              <td class="label-inputs">'.$phone.'</td>
            </tr>
            <tr>
              <td valign="top" width="25%" class="label">Feedback / Comments</td>
              <td class="label-inputs">'.$messages.'</td>
            </tr>
          </table>
          <!-- End Message Content -->
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td align="right"><small>&copy; 2011. Powered by <a href="http://www.dogandrooster.com" target="_blank">Dog and Rooster, Inc.</a></small></td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
';

$mail = new PHPMailer();
$mail->IsMail(); 

// send via Mail

//origin of sender
$mail->From     = ''.$email.'';

//concat name to fullname
$mail->FromName = ''.$name.'';

//Recipient
//$mail->AddAddress('mark@dogandrooster.com'); 
$mail->AddAddress('test1@dogandrooster.net'); 

$mail->IsHTML(true); // send as HTML

$mail->Subject  =  'Keep in Touch with Red and White Marketing';
$mail->Body     =  $message;
$mail->AltBody  =  $message;

if(!$mail->Send()){
 echo "Message was not sent <p>";
 echo "Mailer Error: " . $mail->ErrorInfo;
 //exit;
}

#####################################
#End of Sending Email
#####################################

echo "<div class=alertfiles> Your information has been sent successfully! <br> Please allow us to review your request and we will get back to you soon... </div>";

?>
