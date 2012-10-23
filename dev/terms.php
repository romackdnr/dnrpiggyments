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
      <h1>Terms and Conditions</h1>
      <hr />
    </hgroup>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi luctus. Duis lobortis. Nulla nec velit. Mauris pulvinar erat non massa. Suspendisse tortor turpis, porta nec, tempus vitae, iaculis semper, pede.</p>
    <p>Nunc et risus. Etiam a nibh. Phasellus dignissim metus eget nisi.</p>
    
    <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi luctus. Duis lobortis. Nulla nec velit.</strong></p>
    <p>Vivamus tortor nisl, lobortis in, faucibus et, tempus at, dui. Nunc risus. Proin scelerisque augue. Nam ullamcorper. Phasellus id massa. Pellentesque nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc augue. Aenean sed justo non leo vehicula laoreet. Praesent ipsum libero, auctor ac, tempus nec, tempor nec, justo.</p>
    <p>Maecenas ullamcorper, odio vel tempus egestas, dui orci faucibus orci, sit amet aliquet lectus dolor et quam. Pellentesque consequat luctus purus. Nunc et risus. Etiam a nibh. Phasellus dignissim metus eget nisi. Vestibulum sapien dolor, aliquet nec, porta ac, malesuada a, libero. Praesent feugiat purus eget est. Nulla facilisi. Vestibulum tincidunt sapien eu velit. Mauris purus. Maecenas eget mauris eu orci accumsan feugiat. Pellentesque eget velit. Nunc tincidunt.</p>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi luctus. Duis lobortis. Nulla nec velit. Mauris pulvinar erat non massa. Suspendisse tortor turpis, porta nec, tempus vitae, iaculis semper, pede. Cras vel libero id lectus rhoncus porta. Suspendisse convallis felis ac enim. Vivamus tortor nisl, lobortis in, faucibus et, tempus at, dui. Nunc risus. Proin scelerisque augue. Nam ullamcorper</p>
    
    <p><strong>Maecenas ullamcorper, odio vel tempus egestas, dui orci faucibus orci, sit amet aliquet lectus dolor et quam. Pellentesque consequat luctus purus.</strong></p>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi luctus. Duis lobortis. Nulla nec velit. Mauris pulvinar erat non massa. Suspendisse tortor turpis, porta nec, tempus vitae, iaculis semper, pede. Cras vel libero id lectus rhoncus porta.</p>
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
