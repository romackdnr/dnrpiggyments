<?php include 'manager/_pi/base.php'; ?>
<?
	$pages = Pages::findPages($_REQUEST['id']);
?>
<?
	$spamwords = "/(sex|beastial|bestial|blowjob|clit|cock|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuck|fuk|fuks|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|kock|kondum|kum|kunilingus|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx|teens|teen|viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|texas|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn|content-type|bcc:|cc:|document.cookie|onclick|onload|alert|href|script|Indy|Blaiz|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";
	if(isset($_POST['submit'])) {
		if (preg_match($spamwords, $_POST['name'])) {
			echo "<div class=alertfiles> Known spam bots and malicious language are not allowed! </div>";
		} else if (preg_match($spamwords, $_POST['comments'])) {
			echo "<div class=alertfiles> Known spam bots and malicious language are not allowed! </div>";
		} else {
			include 'manager/mailform/process.php';
			
			 $_POST = sanitize($_POST);
	      	 $contact = $_POST;
			 settype($contact,'object');
			 Contact::addContact($contact);
		 
		 
			 header("Location: thankyou.html");
		}
	}
?>



	<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/side_panel.php'; ?>
  </aside>
  <article id=frame_box>
  	<hgroup>
      <h1>Contact Us</h1>
      <hr />
    </hgroup>
    
   
          <p><?=$pages->fldPagesDescription?></p>
       

    <form action="" method="post" id=membersform>
      <ul>
        <li>
          <dl>
            <dt>Full Name</dt>
            <dd><input type="text" name="name" value="" size="40" class=":required :only_on_submit"></dd>
          </dl>
          <dl>
            <dt>Email Address</dt>
            <dd><input type="text" name="email" value="" size="40" class=":required :email :only_on_submit"></dd>
          </dl>
          <dl>
            <dt>Address</dt>
            <dd><input type="text" name="address" value="" size="40"></dd>
          </dl>
          <dl>
            <dt>City / State</dt>
            <dd><input type="text" name="city" value="" size="40"></dd>
          </dl>
          <dl>
            <dt>Postal / Zip Code</dt>
            <dd><input type="text" name="zip" value="" size="40"></dd>
          </dl>
          <dl>
            <dt>Phone</dt>
            <dd><input type="text" name="phone" value="" size="40"></dd>
          </dl>
        </li>
      </ul>
  
      <ul>
        <li></li>
        <li>
          <dl>
            <dt>Message / Feedback</dt>
            <dd><textarea cols="" rows="" name="comments" class=":required :only_on_submit"></textarea>
              <small>Maximum 2000 characters</small></dd>
          </dl>
        </li>
      </ul>
  
      <div class="clear"><!-- Clear Section --></div>
      
      <input type="submit" name="submit" value="Submit Information"> &nbsp; <input type="reset" value="Clear Information">      
    </form>
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.js('assets/js/jvalidates.min.js');
head.ready(function() {

  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
