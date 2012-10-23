<?php 
	#Insert Code after this line...
	###############################


?>
<?php //include '_manager/google.api/flot_analytics.php' ?>
<?php include '_manager/box_header/base.php' ?>



	<?php startblock('section') ?> 
      <div id="container">
      	<h2>Dashboard Overview</h2>
        <span>Welcome to your Admin Content Manager</span>

        <div class="hr-clear"><!-- Clear Section --></div>

     		<div id="placeholder"> </div>
					<script type="text/javascript">
						$(document).ready(function() {
							//Don't modify this if you don't know what you're doin'.
							var visits = [[01,6539],[02,6677],[03,6160],[04,5563],[05,2964],[06,2973],[07,5080],[08,6078],[09,5927],[10,6177],[11,5640],[12,3237],[13,3454],[14,6035],[15,5992],[16,6416],[17,6345],[18,5620],[19,3184],[20,3039],[21,6410],[22,7698],[23,8224],[24,6764],[25,5492],[26,3116],[27,3163],[28,7660],[29,7230],[30,6450]];
							var views = [[01,16408],[02,16595],[03,15358],[04,13431],[05,7677],[06,7176],[07,13185],[08,14765],[09,14709],[10,15635],[11,15504],[12,8210],[13,9120],[14,14932],[15,14715],[16,16275],[17,15208],[18,14125],[19,8374],[20,8122],[21,14961],[22,18771],[23,20769],[24,17123],[25,14250],[26,8691],[27,9155],[28,18399],[29,17897],[30,16149]];
							//var visits = <?php echo $flot_data_visits; ?>;
							//var views = <?php echo $flot_data_views; ?>;
							
							$('#placeholder').css({
								height: '300px',
								width: '1050px'
							});
							$.plot($('#placeholder'),[
								{ label: 'Visits', data: visits },
								{ label: 'Pageviews', data: views }
							],{
								lines: { show: true },
								points: { show: true },
								grid: { backgroundColor: '#fffaff' }
							});
						});
          </script>
        
        <div class="center smaller" style="margin-bottom:20px;">Google Analytics Page Statistic Overview <br> For The Month Of <?=date('F')?></div>
        
        <div class="col1 home_info">
        	<h3>News and Information</h3>
          <p><strong>Latest News</strong></p>
          <p>Welcome to our new custom built-in Content Management System (CMS) with Open Source PHP web application made by Dog and Rooster Development Team.</p>
          
          <p><strong>Notes from Webmaster</strong></p>
          <p>ACM will accomplish those goals that were important to us:</p>
          <ul>
          	<li>Provide a simple admin system that could give easy access to all users,</li>
            <li>Help users quickly build custom web applications,</li>
            <li>Avoid conflict system due to uncategorized sets of page management to the users,</li>
            <li>Work equally as well for simple marketing websites CMS needs and for more complex applications.</li>
          </ul>
        </div>
        
        <div class="col2 home_news">
        	<h3>Newsletter Information</h3>
          <p>Hello Admin! <br> You have (0) subcriber today.</p>
          
        	<h4>Recent Updates</h4>
          <dl>
          	<dt>By: <strong>Admin</strong></dt>
            <dt class="smaller timeago" title="2010-05-17"> modified time </dt>
            <dd>Update Page Management content.</dd>
            <dt>By: <strong>Webmaster</strong></dt>
            <dt class="smaller timeago" title="2010-05-25"> modified time</dt>
            <dd>Update Admin Content Management system.</dd>
          </dl>
        </div>
      </div>
  <?php endblock() //End of Section ?>



<?php startblock('headercodes') ?> 
<script type="text/javascript" src="_assets/js/jquery.js"></script>
<script type="text/javascript" src="_assets/js/jflot.js"></script>
<script type="text/javascript" src="_assets/js/jmods.js"></script>
<?php endblock() //End of Header Codes ?>

<?php startblock('extracodes') ?> 
<script type="text/javascript" src="_assets/js/cufon.js"></script>
<script type="text/javascript" src="_assets/js/cufon_font.js"></script>
<script type="text/javascript">
	Cufon.replace('h2, h3, h4');
	
	//Time Modified
	jQuery(document).ready(function() {
		jQuery(".timeago").timeago();
	});	
</script>
<?php endblock() //End of Extra Codes ?>
