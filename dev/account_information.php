<?php include 'manager/_pi/base.php';

$client_id = null;

if(isset($_SESSION['client_id'])) {
  $client_id = $_SESSION['client_id'];    
} else {
  header("Location: index.php");
}

$client = Client::findClient( $client_id );
?>

<? startblock('section') ?>
  <aside>
    <?php include 'manager/includes/account_panel.php'; ?>
  </aside>
  <article id="frame_box">
    <hgroup>
      <h1>My Account</h1>
      <hr />
    </hgroup>

    <div id='error_messages'>
    <? echo (!is_null($message)) ? "<h4>{$message}</h4>" : ''?>
    <? if(isset($_SESSION['update_flag']) && !$_SESSION['update_flag']): ?>
      <? foreach($_SESSION['errors'] as $err): ?>
        <li> <?= $err ?>
      <? endforeach ?>
    <? endif ?>
  </div>

    This is where you can edit your account settings and view your most recent order.

    <form action="save-account-information.php" method="post" id="clientform">
      <ul>
        <li>
          <dl>
            <dt>First Name</dt>
            <dd><input type="text" name="fldClientFirstName" value="<?=$client->fldClientFirstName?>" size="40" class=":required"></dd>
          </dl>
          <dl>
            <dt>Last Name</dt>
            <dd><input type="text" name="fldClientLastname" value="<?=$client->fldClientLastname?>" size="40" class=":required"></dd>
          </dl>
          <dl>
            <dt>E-mail</dt>
            <dd><input type="text" name="fldClientEmail" value="<?=$client->fldClientEmail?>" size="40" class=":required :email"></dd>
          </dl>
          <dl>
            <dt>Username</dt>
            <dd><input type="text" name="fldClientUsername" value="<?=$client->fldClientUsername?>" class=":required :min_size;6" size="40"></dd>
          </dl>
          <dl>
            <dt>Password</dt>
            <dd><input id="password" type="password" name="password" size="12"></dd>
          </dl>
          <dl>
            <dt>Confirm Password</dt>
            <dd><input type="password" name="confirm_password" size="12" class=":same_as;password"></dd>
          </dl>
        </li>
      </ul>
    
      <div class="clear"><!-- Clear Section --></div>
      <input type='hidden' name='fldClientID' value='<?=$client->fldClientID?>'>
      <input type="submit" name="submit_changes" value="Save Changes">
    </form>


  </article>
<? endblock() //end section ?>

<?
// Clean Session
unset($_SESSION['errors']);
unset($_SESSION['message']);
unset($_SESSION['update_flag']);
?>

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