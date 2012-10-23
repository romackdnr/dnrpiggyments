<?php
phpinfo();

$subject = "Your password at www.dogandrooster.com"; 
$message = "Hi, we have reset your password. 
 
New Password: $random_password 
 
http://www.domaincom/admin/login-form.php
Once logged in you can change your password 
 
Thanks! 
Site admin 
 
This is an automated response, please do not reply!"; 
 
mail('romack@dogandrooster.com', $subject, $message, 
	"From: DogAndRooster.com Webmaster<webmaster@dogandrooster.com>\n 
    X-Mailer: PHP/" . phpversion()); 
?>