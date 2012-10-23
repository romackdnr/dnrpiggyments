<?php include 'manager/_pi/base.php'; ?>

<?
$mail_status = null;
if(isset($_POST['email']))
{
  // retrieve password by username
  $email = $_POST['email'];
  $client = Client::findClientByEmail($email);

  $subject = "Your password at www.piggyments.com"; 
  $message = "Hi,

  Your Password: {$client->fldClientPassword}

  http://www.piggyments.com/dev/login.html
  Once logged in you can change your password 

  Thanks! 
  Site admin 

  This is an automated response, please do not reply!"; 

  if(!$client) {
    $mail_status = "Invalid email address.";
  } else {
    $mail_status = (mail($email, $subject, $message, 
      "From: Piggyments.com <noreply@piggyments.com>\n 
      X-Mailer: PHP/" . phpversion()))
      ?  
      $mail_status = "Please check your inbox, <b>{$email}</b> to retrieve your password."
      :
      $mail_status = "Failed to send the email, please try again later.";
  }
}
?>

	<? startblock('section') ?>
  <aside>
    <h2>Our Products</h2>
    <menu>
      <li><a href="#">Business Cards</a></li>
      <li class=parentmenu>Marketing Collateral
        <ul class=childmenu>
          <li><a href="#">Letterhead</a></li>
          <li><a href="#">Brochures</a></li>
          <li><a href="#">Flyers</a></li>
          <li><a href="#">Postcards</a></li>
          <li><a href="#">Calendars</a></li>
          <li><a href="#">Catalogs</a></li>
          <li><a href="#">Menus</a></li>
          <li><a href="#">Manuals</a></li>
          <li><a href="#">Newsletters</a></li>
          <li><a href="#">Booklets</a></li>
          <li class=lstmenu><a href="#">Presentations</a></li>
        </ul>      
      </li>
      <li><a href="#">Signage</a></li>
      <li><a href="#">Vehicle Wraps</a></li>
      <li><a href="#">Channel Letters</a></li>
      <li><a href="#">Copies &amp; Scanning</a></li>
    </menu>

    <h2>Follow Us</h2>
    <ul class=socialnetwork>
    	<li><a href="#"><img src="assets/images/social-facebook.png" width="24" height="24" alt="Facebook"> Become a Fan</a></li>
      <li><a href="#"><img src="assets/images/social-twitter.png" width="24" height="24" align="Twitter"> Follow us on Twitter</a></li>
    </ul>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Forgot Username or Password?</h1>
      <hr />
    </hgroup>

    <? if(!is_null($mail_status)): ?>
    <div>
      <b><?= $mail_status ?></b>
      <br />
    </div>
    <? endif ?>

    <div class='account_info col1'>
      <form action="forgot-password.html" method="post">
        <p>Please enter your email below and we'll send you a username / password.</p>
        <p>
          <label>Emaill Address *</label> <br>
          <input type="text" name="email" class=":required :email" size="50">
        </p>
        <p><input type="submit" name="send_msg" value="Remind Password"></p>
      </form>
    </div>
  </article>
	<? endblock() //end section ?>

<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.ready(function() {

  $('.childmenu').hide();
  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
