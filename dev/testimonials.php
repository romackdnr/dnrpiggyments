<?php include 'manager/_pi/base.php'; ?>





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
      <h1>Customer Testimonails</h1>
      <hr />
    </hgroup>

    <blockquote id=testimonials>
      <dl>
        <dt>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis lacinia sapien, interdum tempus dui tincidunt eget. Donec ac enim vitae risus porta lacinia at volutpat tortor.</dt>
        <dd>-- Jack Jung</dd>
      </dl>
      
      <dl>
        <dt>Suspendisse in diam eros, eget dapibus tortor. Duis nec felis est, vitae adipiscing libero. Phasellus et nisi libero, a pulvinar orci.</dt>
        <dd>-- Angela Melfi</dd>
      </dl>
      
      <dl>
        <dt>Mauris ligula nibh, adipiscing quis fermentum suscipit, hendrerit at justo. Praesent et urna sit amet enim placerat iaculis ut vitae neque. Cras id eros justo, vitae aliquam massa. Donec venenatis aliquam eros, eget fermentum quam iaculis tincidunt. Nunc lorem ante, vestibulum sed convallis at, pharetra facilisis justo.</dt>
        <dd>-- James Bond</dd>
      </dl>
      
      <dl>
        <dt>Nullam pulvinar, tortor nec semper adipiscing, lorem nibh viverra magna, sed lacinia magna dui sed neque. Suspendisse in nibh arcu. Maecenas vulputate, diam ac pellentesque mollis, diam leo elementum sapien, et tempus velit nunc ut augue. Nam at consequat purus. Praesent lacinia, risus nec auctor gravida, lacus ante scelerisque lorem, non ultricies sapien ligula eu dolor. Morbi felis lacus, tincidunt at tempor nec, facilisis sed metus. Donec pretium vestibulum ligula, at suscipit nulla placerat vel.</dt>
        <dd>-- Tony Falcon</dd>
      </dl>
      
      <dl>
        <dt>Etiam fringilla lectus sit amet libero sagittis at elementum nisi sodales. Aliquam erat volutpat. Fusce et mauris est, et lacinia libero.</dt>
        <dd>-- John Doe</dd>
      </dl>
      
      <dl>
        <dt>Vivamus nec erat eu nunc posuere aliquam. Duis et velit ut ligula rhoncus euismod eu a ipsum. Proin congue dolor at augue ultricies a consectetur risus aliquet.</dt>
        <dd>-- Jane Doe</dd>
      </dl>
    </blockquote>      
  </article>
	<? endblock() //end section ?>





<? startblock('headercodes') ?>
<? endblock() //end headercodes ?>

<? startblock('extracodes') ?>
head.ready(function() {

  $('.parentmenu').click(function() {
    $('.childmenu').slideToggle();
  });

});
<? endblock() //end extracodes ?>
