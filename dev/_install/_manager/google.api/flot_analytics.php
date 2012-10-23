<?php
/*----------------------------------------
Name: PHP JFlot (jQuery Flot Charts)
Developed by: Dog and Rooster Team
Date Created: -- --, 2010
Last Updated: -- --, 2010
Copyright: 2010 @ Dog and Rooster
----------------------------------------*/

	// include the Google Analytics PHP class
	include "ga/gapi.class.php";
	
	try {
		// create an instance of the GoogleAnalytics class using your own Google {email} and {password}
		$ga = new GoogleAnalytics('youraccount@gmail.com','password');
	
		// set the Google Analytics profile you want to access - format is 'ga:123456';
		$ga->setProfile('ga:1234567');
	
		// set the date range we want for the report - format is YYYY-MM-DD
		$month = date("m");
		$ga->setDateRange('2010-'.$month.'-01','2010-'.$month.'-31');
	
		// get the report for date, showing pageviews and visits
		$report = $ga->getReport( array('dimensions'=>('ga:date'), 'metrics'=>('ga:visits,ga:pageviews')) );
		
		// view all Arrays
		//print "<pre>";
		//print_r($report);
		//print "</pre>";
		
		// set to JFlot Chart panel
		if(count($report)) {
			foreach($report as $key => $reports) {
				if (list($inner_key, $inner_val) = each($reports)) {
					$visit = $inner_val;
				}
				$page_views = each( $reports ); 		
				$views = implode(array_values($page_views),","); 		
				$pageviews =  $views[0]; 
				$count=$count+1;
				
				$flot_datas_visits[] = '['.$count.','.$visit.']';
				$flot_datas_views[] = '['.$count.','.$pageviews.']';
			}
			
			$flot_data_visits = '['.implode(',',$flot_datas_visits).']';
			$flot_data_views = '['.implode(',',$flot_datas_views).']';
			
			//echo $flot_data_visits .'<br>';
			//echo $flot_data_views;
		}
	} catch (Exception $e) { 
		print 'Error: ' . $e->getMessage();
	}

?>