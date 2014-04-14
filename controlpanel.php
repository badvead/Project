<?php 

include 'config.php';

session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: login.php"); 
    exit; 
} 

session_start();

if(isset($_SESSION['username'])) {
  $usr = $_SESSION['username'];
}

if(isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

if(isset($_SESSION['question_array'])) {
  $question_unsorted = $_SESSION['question_array'];
}


	$sql = mysql_query("SELECT * FROM owners WHERE username='$usr' AND email='$email' LIMIT 1") or die(mysql_error()); 
	
	if(mysql_num_rows($sql) == 1){
		$row = mysql_fetch_array($sql);
		$owner_id = $row['owner_id'];
		$username = $row['username'];
	    $fname = $row['fname'];
	    $lname = $row['lname'];
	    $email = $row['email'];
	    $business_id = $row['business_id']; 
        $question_array = explode(",",$question_unsorted);
	}

	$sql = mysql_query("SELECT * FROM links WHERE business_id='$business_id' LIMIT 1");
    if(mysql_num_rows($sql) == 1){
        $row = mysql_fetch_array($sql);
        $_SESSION['link'] = $row['link'];
        $_SESSION['page_hits'] = $row['page_hits'];
        $_SESSION['surveys_taken'] = $row['surveys_taken'];
    }

	if($_SESSION['page_hits']==0){
		$_SESSION['page_hits'] = 1;
	}

	$redemtion = round($_SESSION['surveys_taken']/$_SESSION['page_hits']*100, 2);

?>


<!DOCTYPE html>
	<head>
		<title>Control Panel | GetBack</title>
		<?php include ('common.php');?>
		<link rel="stylesheet" href="css/controlpanel.css">
		<script>
			
			var canvas = {};
			var daily = null;
			var hourly = null;
			var age = null;
    		var gender = null;
    		var q1 = null;
    		var q2 = null;
    		var q3 = null;
    		var q4 = null;
    		var q5 = null;

			function startTime() {
				var today=new Date();
				var h=today.getHours();
				if (h>12) {
					h=h-12;
				} else if (h==0) {
					h=12;
				}
				var m=today.getMinutes();
				var s=today.getSeconds();

				h=checkTime(h);
				m=checkTime(m);
				s=checkTime(s);
				document.getElementById('topnav-time').innerHTML=h+":"+m+":"+s;
					t=setTimeout(function(){startTime()},500);
			}

			function checkTime(i) {
				if (i<10) {
				  i="0" + i;
				}
				return i;
			}

			$(document).ready(function(){

				canvas = $('#hourly');
			    resizeCanvas();

			    $(".sidebar_button").on('click',function(){
			    	
			    },function(){
		    		resizeCanvas();
		    		daily.handleResize();
		    		hourly.handleResize();
		    		age.handleResize();
		    		gender.handleResize();
		    		q1.handleResize();
		    		q2.handleResize();
		    		q3.handleResize();
		    		q4.handleResize();
		    		q5.handleResize();
			    });

			    // resize the canvas to fill browser window dynamically
			    window.addEventListener('resize', resizeCanvas, false);

			});
			

			function resizeCanvas() 
			{
	            canvas.width = window.innerWidth;
	            canvas.height = window.innerHeight;

	            /**
	             * Your drawings need to be inside this function otherwise they will be reset when 
	             * you resize the browser window and the canvas goes will be cleared.
	             */
	            drawStuff(); 
		    }
		    

		    function drawStuff() 
		    {
		            // do your drawing stuff here
		    }

		</script>
		<script src="js/Chart.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/funnel.js"></script>
		<script src="js/jquery.knob.js"></script>
	</head>
	<body onload="startTime()">
		<div id="wrapper">
			<div id="sidebar_nav">
				<div id="sb_dashboard" class="sidebar_button active"><span class="glyphicon glyphicon-bullhorn"></span></div>
				<div id="sb_suggestion" class="sidebar_button"><span class="glyphicon glyphicon-stats"></span></div>
				<div id="sb_survey" class="sidebar_button"><span class="glyphicon glyphicon-question-sign"></span></div>
				<div id="sb_custom" class="sidebar_button"><span class="glyphicon glyphicon-list-alt"></span></div>
				<div id="sb_company" class="sidebar_button"><span class="glyphicon glyphicon-briefcase"></span></div>
				<div id="sb_account" class="sidebar_button"><span class="glyphicon glyphicon-user"></span></div>
				<div id="sb_logout"><a href="logout.php"><span class="glyphicon glyphicon-off"></span></a></div>
			</div>
			<div id="body-content">
				<?php

					echo "
						
						<div id=\"body-topnav\">
							<div class=\"topnav-inner\" id=\"topnav-welcome\">Welcome, ".$_SESSION['fname']." ".$_SESSION['lname']."!</div>
							<div class=\"topnav-inner\" id=\"topnav-date\">
								<b><script type=\"text/javascript\">
									var currentTime = new Date();
									var month = currentTime.getMonth() + 1;
									var day = currentTime.getDate();
									var year = currentTime.getFullYear();
									document.write(month + \"/\" + day + \"/\" + year);
								</script></b>
							</div>
							<div class=\"topnav-inner\" id=\"topnav-time\"></div>
							<div class=\"topnav-inner\" id=\"topnav-notification\"><span class=\"glyphicon glyphicon-bell\" style=\"position: relative; top: 3px;\"></span></div>
						</div>

						"; 

					if ($business_id == 0) {

						echo "
						<div class=\"body-padding\">
							<p>You have not registered your business yet.</p>
							<p><a class=\"btn btn-primary\" href=\"registerbusiness.php\">Register</a>&nbsp;&nbsp;<a class=\"btn btn-primary\" href=\"logout.php\">Logout</a></p>
						</div>
						";

					} else {

						echo "<div class=\"body-padding\">";

						

								echo"<div class=\"body-tab tactive\" id=\"dashboard\">

									<h4>Dashboard</h4>
								  	<p><b>Your Link:</b> <a target=\"_blank\" href=\"survey.php?link=".$_SESSION['link']."\">http://getbackapp.co/".$_SESSION['link']."</a></p>
								  	<p><b>Your Plan:</b> ".$_SESSION['subscription_plan']."</p>
								  	</br>
								  	<p><b>Number of Surveys Accessed:</b> ".$_SESSION['page_hits']." (page hits)</p>
								  	<p><b>Redemtion Rate:</b> ".$redemtion."%<p>
								</div>

								<div class=\"body-tab\" id=\"suggestion\">
									<div id=\"suggestionholder\">
										<div class=\"col-lg-8 col-md-8\">
											<h4>Daily</h4></br>
											<div id=\"daily\" class=\"chart\"></div>
										</div>
										<div class=\"col-lg-4 col-md-4\">
											<h4>Hourly</h4></br>
											<div id=\"hourly\" class=\"chart\"></div>
										</div>
										<div class=\"col-lg-6 col-md-6\">
											<h4>Age Distribution</h4></br>
											<div id=\"age\" class=\"chart\"></div>
										</div>
										<div class=\"col-lg-6 col-md-6\">
											<h4>Gender Distribution</h4></br>
											<div id=\"gender\" class=\"chart\"></div>
										</div>";

										echo "<script type=\"text/javascript\">

											$(document).ready(function() {

											
												daily = AmCharts.makeChart(\"daily\", {
											        \"type\": \"serial\",
											    \"theme\": \"none\",
											        \"pathToImages\": \"/lib/3/images/\",
											    \"autoMargins\": false,
											    \"marginLeft\":30,
											    \"marginRight\":8,
											    \"marginTop\":10,
											    \"marginBottom\":26,

											        \"dataProvider\": [";

											        $sql = mysql_query("SELECT MAX(response_date) FROM responses WHERE business_id='$business_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = date('Y-m-d', strtotime($row[0]));

												    	for ($i=0; $i < 7; $i++) { 

												    		$day = date('l', strtotime($maxdate));

												    		$sql = mysql_query("SELECT COUNT(*) FROM customers WHERE user_date='$maxdate' AND business_id='$business_id'");
															if(mysql_num_rows($sql) == 1){ 
														    	$row = mysql_fetch_array($sql);
														    	$numusersa = $row[0];
														    }
														    
														    $datebefore = date('Y-m-d', strtotime($maxdate. ' - 7 days'));
														    $daybefore = date('l', strtotime($datebefore));
												    		
														    $sql = mysql_query("SELECT COUNT(*) FROM customers WHERE user_date='$datebefore' AND business_id='$business_id'");
															if(mysql_num_rows($sql) == 1){ 
														    	$row = mysql_fetch_array($sql);
														    	$numusersb = $row[0];
														    }

												    		echo "{\"day\": \"".$day."\", \"This Week\": ".$numusersa.", \"Last Week\": ".$numusersb."}, ";

												    		$maxdate = date('Y-m-d', strtotime($maxdate. ' - 1 days'));
												    	}
												    	
												    }

											        echo "],
											        \"valueAxes\": [{
											            \"axisAlpha\": 0,
											            \"position\": \"left\"
											        }],
											        \"startDuration\": 1,
											        \"graphs\": [{
											            \"alphaField\": \"alpha\",
											            \"balloonText\": \"<span style='font-size:13px;'>[[title]] on [[category]]: <b>[[value]]</b> [[additional]]</span>\",
											            \"dashLengthField\": \"dashLengthColumn\",
											            \"fillAlphas\": 1,
											            \"title\": \"This Week\",
											            \"type\": \"column\",
											            \"valueField\": \"This Week\"
											        }, {
											            \"balloonText\": \"<span style='font-size:13px;'>[[title]] on [[category]]: <b>[[value]]</b> [[additional]]</span>\",
											            \"bullet\": \"round\",
											            \"dashLengthField\": \"dashLengthLine\",
											            \"lineThickness\": 3,
											      \"bulletSize\": 7,
											      \"bulletBorderAlpha\": 1,
											      \"bulletColor\": \"#FFFFFF\",
											      \"useLineColorForBulletBorder\": true,
											      \"bulletBorderThickness\": 3,
											      \"fillAlphas\": 0,
											      \"lineAlpha\": 1,
											            \"title\": \"Last Week\",
											            \"valueField\": \"Last Week\"
											        }],
											        \"categoryField\": \"day\",
											        \"categoryAxis\": {
											            \"gridPosition\": \"start\",
											      \"axisAlpha\":0,
											      \"tickLength\":0
											        }
											    });";
											

											//--start--//
											$question_id = 5;
											echo "q".$question_id." = AmCharts.makeChart(\"q".$question_id."\", {
											      \"type\": \"serial\",
											      \"theme\": \"none\",
											      \"pathToImages\": \"http://www.amcharts.com/lib/3/images/\",
											      \"dataDateFormat\": \"YYYY-MM-DD HH:NN\",
											      \"dataProvider\": [";

											      	$sql = mysql_query("SELECT MAX(response_date), MIN(response_date) FROM responses WHERE business_id='$business_id' AND question_id='$question_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = $row[0];
												    	$mindate = $row[1];

												    	
												    	$diff = (strtotime($maxdate) - strtotime($mindate))/(3600*24)+1;
												    	
												    	echo "{\"date\": \"2013-11-30\",\"value\": 0.0}";

												    	for ($i = 0; $i < $diff; $i++) {

															$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate'") or die (mysql_error()."20");
												  			$total = mysql_num_rows($sql);
												  			if ($total==0){
												  				$total=1;
												  			}
												  			
												  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate' AND answer='yes'") or die (mysql_error()."21");
												  			$part = mysql_num_rows($sql);

												  			$percent = $part / $total * 5;
												  			$percent = round($percent, 1);
												  			$percent = number_format((float)$percent, 1, '.', '');

												  			echo ", {\"date\": \"".$mindate."\",\"value\": ".$percent."}";
															$mindate = date('Y-m-d', strtotime($mindate. ' + 1 days'));
												    	}

													}

											      echo "],
											      \"valueAxes\": [{
											          \"axisAlpha\": 0,
											          \"guides\": [{
											              \"fillAlpha\": 0.1,
											              \"fillColor\": \"#000000\",
											              \"inside\": true,
											              \"lineAlpha\": 0,
											              \"toValue\": 20,
											              \"value\": 10
											          }],
											          \"position\": \"left\",
											          \"showFirstLabel\": false,
											          \"showLastLabel\": false,
											          \"tickLength\": 0
											      }],
											      \"graphs\": [{
											          \"balloonText\": \"[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>\",
											          \"bullet\": \"round\",
											          \"dashLength\": 3,
											          \"valueField\": \"value\"
											      }],
											      \"chartCursor\": {},
											      \"categoryField\": \"date\",
											      \"categoryAxis\": {
											          \"parseDates\": true,
											          \"axisAlpha\": 0,
											          \"gridAlpha\": 0.1,
											          \"inside\": true,
											          \"minorGridAlpha\": 0.1,
											          \"minorGridEnabled\": true
											      }
											  });";


											//--start--//
											$question_id = 4;
											echo "q".$question_id." = AmCharts.makeChart(\"q".$question_id."\", {
											      \"type\": \"serial\",
											      \"theme\": \"none\",
											      \"pathToImages\": \"http://www.amcharts.com/lib/3/images/\",
											      \"dataDateFormat\": \"YYYY-MM-DD HH:NN\",
											      \"dataProvider\": [";

											      	$sql = mysql_query("SELECT MAX(response_date), MIN(response_date) FROM responses WHERE business_id='$business_id' AND question_id='$question_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = $row[0];
												    	$mindate = $row[1];

												    	
												    	$diff = (strtotime($maxdate) - strtotime($mindate))/(3600*24)+1;
												    	
												    	echo "{\"date\": \"2013-11-30\",\"value\": 0.0}";

												    	for ($i = 0; $i < $diff; $i++) {

															$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate'") or die (mysql_error()."20");
												  			$total = mysql_num_rows($sql);
												  			if ($total==0){
												  				$total=1;
												  			}
												  			
												  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate' AND answer='yes'") or die (mysql_error()."21");
												  			$part = mysql_num_rows($sql);

												  			$percent = $part / $total * 5;
												  			$percent = round($percent, 1);
												  			$percent = number_format((float)$percent, 1, '.', '');

												  			echo ", {\"date\": \"".$mindate."\",\"value\": ".$percent."}";
															$mindate = date('Y-m-d', strtotime($mindate. ' + 1 days'));
												    	}

													}

											      echo "],
											      \"valueAxes\": [{
											          \"axisAlpha\": 0,
											          \"guides\": [{
											              \"fillAlpha\": 0.1,
											              \"fillColor\": \"#000000\",
											              \"inside\": true,
											              \"lineAlpha\": 0,
											              \"toValue\": 20,
											              \"value\": 10
											          }],
											          \"position\": \"left\",
											          \"showFirstLabel\": false,
											          \"showLastLabel\": false,
											          \"tickLength\": 0
											      }],
											      \"graphs\": [{
											          \"balloonText\": \"[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>\",
											          \"bullet\": \"round\",
											          \"dashLength\": 3,
											          \"valueField\": \"value\"
											      }],
											      \"chartCursor\": {},
											      \"categoryField\": \"date\",
											      \"categoryAxis\": {
											          \"parseDates\": true,
											          \"axisAlpha\": 0,
											          \"gridAlpha\": 0.1,
											          \"inside\": true,
											          \"minorGridAlpha\": 0.1,
											          \"minorGridEnabled\": true
											      }
											  });

												
											});
											//--end--//

											";


											//--start--//
											$question_id = 3;
											echo "q".$question_id." = AmCharts.makeChart(\"q".$question_id."\", {
											      \"type\": \"serial\",
											      \"theme\": \"none\",
											      \"pathToImages\": \"http://www.amcharts.com/lib/3/images/\",
											      \"dataDateFormat\": \"YYYY-MM-DD HH:NN\",
											      \"dataProvider\": [";

											      	$sql = mysql_query("SELECT MAX(response_date), MIN(response_date) FROM responses WHERE business_id='$business_id' AND question_id='$question_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = $row[0];
												    	$mindate = $row[1];

												    	
												    	$diff = (strtotime($maxdate) - strtotime($mindate))/(3600*24)+1;
												    	
												    	echo "{\"date\": \"2013-11-30\",\"value\": 0.0}";

												    	for ($i = 0; $i < $diff; $i++) {

															$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate'") or die (mysql_error()."20");
												  			$total = mysql_num_rows($sql);
												  			if ($total==0){
												  				$total=1;
												  			}
												  			
												  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate' AND answer='yes'") or die (mysql_error()."21");
												  			$part = mysql_num_rows($sql);

												  			$percent = $part / $total * 5;
												  			$percent = round($percent, 1);
												  			$percent = number_format((float)$percent, 1, '.', '');

												  			echo ", {\"date\": \"".$mindate."\",\"value\": ".$percent."}";
															$mindate = date('Y-m-d', strtotime($mindate. ' + 1 days'));
												    	}

													}

											      echo "],
											      \"valueAxes\": [{
											          \"axisAlpha\": 0,
											          \"guides\": [{
											              \"fillAlpha\": 0.1,
											              \"fillColor\": \"#000000\",
											              \"inside\": true,
											              \"lineAlpha\": 0,
											              \"toValue\": 20,
											              \"value\": 10
											          }],
											          \"position\": \"left\",
											          \"showFirstLabel\": false,
											          \"showLastLabel\": false,
											          \"tickLength\": 0
											      }],
											      \"graphs\": [{
											          \"balloonText\": \"[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>\",
											          \"bullet\": \"round\",
											          \"dashLength\": 3,
											          \"valueField\": \"value\"
											      }],
											      \"chartCursor\": {},
											      \"categoryField\": \"date\",
											      \"categoryAxis\": {
											          \"parseDates\": true,
											          \"axisAlpha\": 0,
											          \"gridAlpha\": 0.1,
											          \"inside\": true,
											          \"minorGridAlpha\": 0.1,
											          \"minorGridEnabled\": true
											      }
											  });

												";


											//--start--//
											$question_id = 2;
											echo "q".$question_id." = AmCharts.makeChart(\"q".$question_id."\", {
											      \"type\": \"serial\",
											      \"theme\": \"none\",
											      \"pathToImages\": \"http://www.amcharts.com/lib/3/images/\",
											      \"dataDateFormat\": \"YYYY-MM-DD HH:NN\",
											      \"dataProvider\": [";

											      	$sql = mysql_query("SELECT MAX(response_date), MIN(response_date) FROM responses WHERE business_id='$business_id' AND question_id='$question_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = $row[0];
												    	$mindate = $row[1];

												    	
												    	$diff = (strtotime($maxdate) - strtotime($mindate))/(3600*24)+1;
												    	
												    	echo "{\"date\": \"2013-11-30\",\"value\": 0.0}";

												    	for ($i = 0; $i < $diff; $i++) {

															$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate'") or die (mysql_error()."20");
												  			$total = mysql_num_rows($sql);
												  			if ($total==0){
												  				$total=1;
												  			}
												  			
												  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate' AND answer='yes'") or die (mysql_error()."21");
												  			$part = mysql_num_rows($sql);

												  			$percent = $part / $total * 5;
												  			$percent = round($percent, 1);
												  			$percent = number_format((float)$percent, 1, '.', '');

												  			echo ", {\"date\": \"".$mindate."\",\"value\": ".$percent."}";
															$mindate = date('Y-m-d', strtotime($mindate. ' + 1 days'));
												    	}

													}

											      echo "],
											      \"valueAxes\": [{
											          \"axisAlpha\": 0,
											          \"guides\": [{
											              \"fillAlpha\": 0.1,
											              \"fillColor\": \"#000000\",
											              \"inside\": true,
											              \"lineAlpha\": 0,
											              \"toValue\": 20,
											              \"value\": 10
											          }],
											          \"position\": \"left\",
											          \"showFirstLabel\": false,
											          \"showLastLabel\": false,
											          \"tickLength\": 0
											      }],
											      \"graphs\": [{
											          \"balloonText\": \"[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>\",
											          \"bullet\": \"round\",
											          \"dashLength\": 3,
											          \"valueField\": \"value\"
											      }],
											      \"chartCursor\": {},
											      \"categoryField\": \"date\",
											      \"categoryAxis\": {
											          \"parseDates\": true,
											          \"axisAlpha\": 0,
											          \"gridAlpha\": 0.1,
											          \"inside\": true,
											          \"minorGridAlpha\": 0.1,
											          \"minorGridEnabled\": true
											      }
											  });

												";


											//--start--//
											$question_id = 1;
											echo "q".$question_id." = AmCharts.makeChart(\"q".$question_id."\", {
											      \"type\": \"serial\",
											      \"theme\": \"none\",
											      \"pathToImages\": \"http://www.amcharts.com/lib/3/images/\",
											      \"dataDateFormat\": \"YYYY-MM-DD HH:NN\",
											      \"dataProvider\": [";

											      	$sql = mysql_query("SELECT MAX(response_date), MIN(response_date) FROM responses WHERE business_id='$business_id' AND question_id='$question_id'");
													if(mysql_num_rows($sql) == 1){ 
												    	$row = mysql_fetch_array($sql);
												    	$maxdate = $row[0];
												    	$mindate = $row[1];

												    	
												    	$diff = (strtotime($maxdate) - strtotime($mindate))/(3600*24)+1;
												    	
												    	echo "{\"date\": \"2013-11-30\",\"value\": 0.0}";

												    	for ($i = 0; $i < $diff; $i++) {

															$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate'") or die (mysql_error()."20");
												  			$total = mysql_num_rows($sql);
												  			if ($total==0){
												  				$total=1;
												  			}
												  			
												  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$mindate' AND answer='yes'") or die (mysql_error()."21");
												  			$part = mysql_num_rows($sql);

												  			$percent = $part / $total * 5;
												  			$percent = round($percent, 1);
												  			$percent = number_format((float)$percent, 1, '.', '');

												  			echo ", {\"date\": \"".$mindate."\",\"value\": ".$percent."}";
															$mindate = date('Y-m-d', strtotime($mindate. ' + 1 days'));
												    	}

													}

											      echo "],
											      \"valueAxes\": [{
											          \"axisAlpha\": 0,
											          \"guides\": [{
											              \"fillAlpha\": 0.1,
											              \"fillColor\": \"#000000\",
											              \"inside\": true,
											              \"lineAlpha\": 0,
											              \"toValue\": 20,
											              \"value\": 10
											          }],
											          \"position\": \"left\",
											          \"showFirstLabel\": false,
											          \"showLastLabel\": false,
											          \"tickLength\": 0
											      }],
											      \"graphs\": [{
											          \"balloonText\": \"[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>\",
											          \"bullet\": \"round\",
											          \"dashLength\": 3,
											          \"valueField\": \"value\"
											      }],
											      \"chartCursor\": {},
											      \"categoryField\": \"date\",
											      \"categoryAxis\": {
											          \"parseDates\": true,
											          \"axisAlpha\": 0,
											          \"gridAlpha\": 0.1,
											          \"inside\": true,
											          \"minorGridAlpha\": 0.1,
											          \"minorGridEnabled\": true
											      }
											  });
										

											AmCharts.ready(function() {
												var chartData = [{title:\"MALE\",value:70},{title:\"FEMALE\",value:30}];			
												gender = new AmCharts.AmPieChart();
												gender.valueField = \"value\";
												gender.titleField = \"title\";
												gender.dataProvider = chartData;
												gender.invalidateSize();
												gender.write(\"gender\");
											});



										</script>

										<div class=\"col-lg-12 col-md-12\" style=\"text-align: center;\"><h4><u>Question Responses</u></h4></div>
										<div class=\"col-lg-4 col-md-4\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Would you recommend this place?</div>
											<div class=\"modalbody\">
												<div id=\"q1\" class=\"qchart\"></div>
											</div>
										</div>
										<div class=\"col-lg-4 col-md-4\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Were our facilities clean?</div>
											<div class=\"modalbody\">
												<div id=\"q2\" class=\"qchart\"></div>
											</div>
										</div>
										<div class=\"col-lg-4 col-md-4\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Were you able to get what you needed?</div>
											<div class=\"modalbody\">
												<div id=\"q3\" class=\"qchart\"></div>
											</div>
										</div>
										<div class=\"col-lg-4 col-md-4\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Was our staff helpful?</div>
											<div class=\"modalbody\">
												<div id=\"q4\" class=\"qchart\"></div>
											</div>
										</div>
										<div class=\"col-lg-4 col-md-4\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Would you come back?</div>
											<div class=\"modalbody\">
												<div id=\"q5\" class=\"qchart\"></div>
											</div>
										</div>
									</div>
								</div>

								<div class=\"body-tab\" id=\"survey\">
									<div id=\"questionheader\" class=\"col-md-12 col-lg-12\">
										 <div id=\"searchbox\" class=\"input-group\">
									        <input type=\"text\" style=\"height: 46px;\"class=\"form-control\" id=\"searcharea\" placeholder=\"Begin typing your question here...\" name=\"srch-term\" id=\"srch-term\">
									        <div class=\"input-group-btn\">
									          <button class=\"btn btn-default\" style=\"height: 46px;\" type=\"submit\"><span class=\"glyphicon glyphicon-pushpin\"></span></button>
									        </div>
									     </div>
									</div>
								";

									$length = count($question_array);

									$ratings = array();
									$x = 0;

									for ($i = 0; $i < $length; $i++) {
								  		$question_id = $question_array[$i];

								  		$sql = mysql_query("SELECT * FROM questions WHERE question_id='$question_id'") or die (mysql_error()."15");
								  		if(mysql_num_rows($sql) == 1){ 

									    	$row = mysql_fetch_array($sql) or die (mysql_error()."16");

										    $question = $row['question'];
								    		$category = $row['industry_type'];
								    		$frequency = $row['frequency'];
								    		$date_created = date("m-d-Y", strtotime($row['date_created']));

								    		$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id'") or die (mysql_error()."20");
								  			$total = mysql_num_rows($sql);
								  			if ($total==0){
								  				$total=1;
								  			}
								  			
								  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND answer='yes'") or die (mysql_error()."21");
								  			$part = mysql_num_rows($sql);

								  			$percent = round($part / $total * 100, 0);

								  			$ratings[$x] = $percent/100;

								  			$avgarray = array_sum($ratings)/count($ratings) * 5;
								  			$avgarray = round($avgarray, 1);
								  			$avgarray = number_format((float)$avgarray, 1, '.', '');

								  			$x += 1;

									    echo "
									<div class=\"col-sm-6 col-md-4 col-lg-3\">
										<div class=\"questionbox\" style=\"width:100%;\">
											<div class=\"knobrating\">
												<input class=\"knob\" data-width=\"100%\" value=\"".$percent."\" data-thickness=\".2\" data-fgColor=\"#764577\" readonly>
											</div>
											<div class=\"boxheader\">
												<h5>Question ".($i+1)."</h5>
												<i>Posted: ".$date_created."</i></br>
												<b>Category:</b> ".$category."</br>
												<b>Answered #:</b> ".$total."
											</div>
											<div class=\"col-md-12 col-lg-12 boxsplitter\"></div>
											<div class=\"col-md-12 col-lg-12 boxdisplay\">".$question."</div>
											<div class=\"boxrecent\">
												<div class=\"recentrec\">
													<div class=\"col-sm-4 col-md-4 col-lg-4 recdate\">";  
										
													$format = 'M d'; 
													$date = date ( $format ); 
													echo date ( $format, strtotime ( '-0 day' . $date ) );

													$date = date('Y-m-d');

													$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date'") or die (mysql_error()."20");
										  			$total = mysql_num_rows($sql);
										  			if ($total==0){
										  				$total=1;
										  			}
										  			
										  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date' AND answer='yes'") or die (mysql_error()."21");
										  			$part = mysql_num_rows($sql);

										  			$percent = $part / $total * 100;

													echo "</div>
													<div class=\"col-sm-8 col-md-8 col-lg-8 recrate\">
														<div class=\"progress\">
													    	<div class=\"progress-bar\" style=\"width: ".$percent."%;\"></div>
													    </div>
													</div>
												</div>
												<div class=\"recentrec\">
													<div class=\"col-sm-4 col-md-4 col-lg-4 recdate\">";

													$format = 'M d'; 
													$date = date ( $format ); 
													echo date ( $format, strtotime ( '-1 day' . $date ) );

													$format = 'Y-m-d'; 
													$date = date ( $format ); 
													$date = date ( $format, strtotime ( '-1 day' . $date ) );

													$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date'") or die (mysql_error()."20");
										  			$total = mysql_num_rows($sql);
										  			if ($total==0){
										  				$total=1;
										  			}
										  			
										  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date' AND answer='yes'") or die (mysql_error()."21");
										  			$part = mysql_num_rows($sql);

										  			$percent = $part / $total * 100; 

													echo"</div>
													<div class=\"col-sm-8 col-md-8 col-lg-8 recrate\">
														<div class=\"progress\">
													    	<div class=\"progress-bar\" style=\"width: ".$percent."%;\"></div>
													    </div>
													</div>
												</div>
												<div class=\"recentrec\">
													<div class=\"col-sm-4 col-md-4 col-lg-4 recdate\">";

													$format = 'M d'; 
													$date = date ( $format ); 
													echo date ( $format, strtotime ( '-2 day' . $date ) ); 

													$format = 'Y-m-d'; 
													$date = date ( $format ); 
													$date = date ( $format, strtotime ( '-2 day' . $date ) );

													$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date'") or die (mysql_error()."20");
										  			$total = mysql_num_rows($sql);
										  			if ($total==0){
										  				$total=1;
										  			}
										  			
										  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date' AND answer='yes'") or die (mysql_error()."21");
										  			$part = mysql_num_rows($sql);

										  			$percent = $part / $total * 100; 

													echo"</div>
													<div class=\"col-sm-8 col-md-8 col-lg-8 recrate\">
														<div class=\"progress\">
													    	<div class=\"progress-bar\" style=\"width: ".$percent."%;\"></div>
													    </div>
													</div>
												</div>
												<div class=\"recentrec\">
													<div class=\"col-sm-4 col-md-4 col-lg-4 recdate\">";

													$format = 'M d'; 
													$date = date ( $format ); 
													echo date ( $format, strtotime ( '-3 day' . $date ) ); 

													$format = 'Y-m-d'; 
													$date = date ( $format ); 
													$date = date ( $format, strtotime ( '-3 day' . $date ) );

													$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date'") or die (mysql_error()."20");
										  			$total = mysql_num_rows($sql);
										  			if ($total==0){
										  				$total=1;
										  			}
										  			
										  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND response_date='$date' AND answer='yes'") or die (mysql_error()."21");
										  			$part = mysql_num_rows($sql);

										  			$percent = $part / $total * 100; 

													echo"</div>
													<div class=\"col-sm-8 col-md-8 col-lg-8 recrate\">
														<div class=\"progress\">
													    	<div class=\"progress-bar\" style=\"width: ".$percent."%;\"></div>
													    </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								    	";
									  }
									}
								echo "	
								</div>
								<div class=\"body-tab\" id=\"custom\">
									<h4>Survey Customization</h4>
									<div class=\"col-lg-4 col-md-4\">
										<div id=\"question_list\">
											<div class=\"modalheader\"><span class=\"glyphicon glyphicon-question-sign\"></span>&nbsp;Choose your questions</div>
											<div class=\"modalsearch\"><input id=\"searchboxmodal\" type=\"search\" placeholder=\"search...\"></div>";
											$length = count($question_array);

											$ratings = array();
											$x = 0;

											for ($i = 0; $i < $length; $i++) {
										  		$question_id = $question_array[$i];

										  		$sql = mysql_query("SELECT * FROM questions WHERE question_id='$question_id'") or die (mysql_error()."15");
										  		if(mysql_num_rows($sql) == 1){ 

											    	$row = mysql_fetch_array($sql) or die (mysql_error()."16");

												    $question = $row['question'];
										    		$category = $row['industry_type'];
										    		$frequency = $row['frequency'];
										    		$date_created = date("m-d-Y", strtotime($row['date_created']));

										    		$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id'") or die (mysql_error()."20");
										  			$total = mysql_num_rows($sql);
										  			if ($total==0){
										  				$total=1;
										  			}
										  			
										  			$sql = mysql_query("SELECT * FROM responses WHERE question_id='$question_id' AND business_id='$business_id' AND answer='yes'") or die (mysql_error()."21");
										  			$part = mysql_num_rows($sql);

										  			$percent = round($part / $total * 100, 0);

										  			$ratings[$x] = $percent/100;

										  			$avgarray = array_sum($ratings)/count($ratings) * 5;
										  			$avgarray = round($avgarray, 1);
										  			$avgarray = number_format((float)$avgarray, 1, '.', '');

										  			$x += 1;

											    	echo "<div class=\"draggable\">".$question."</div>";
												}
											}
										echo"</div>
									</div>
									<div class=\"col-lg-4 col-md-4 col-sm-6\">
										<div class=\"phone_list\">
											<div class=\"phonetop\">
												<span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;Customize your survey
											</div>
											<div class=\"phonebody\">
												<div class=\"phoneheader\">".$_SESSION['organization']."</div>
											</div>
											<div class=\"phonebottom\">
												<div class=\"homebutton\">
													<div class=\"homesquare\"></div>
												</div>
											</div>
										</div>
									</div>
									<div class=\"col-lg-4 col-md-4 col-sm-6\">
										<div class=\"phone_list\">
											<div class=\"phonetop\">
												<span class=\"glyphicon glyphicon-gift\"></span>&nbsp;Add your coupon
											</div>
											<div class=\"phonebody\">
												<div class=\"phoneheader\">".$_SESSION['organization']."</div>
											</div>
											<div class=\"phonebottom\">
												<div class=\"homebutton\">
													<div class=\"homesquare\"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class=\"body-tab\" id=\"company\">
									<div id=\"coverpicture\" style=\"background-image:url('branding/cover/gb_cover.jpg')\"></div>
									<div class=\"col-lg-12 col-md-12\" id=\"companytray\">
										<img class=\"img-thumbnail company-thumbnail\" style=\"max-height: 120px;\" src=\"".$_SESSION['branding_url']."\">
										<div id=\"traytop\">
											<div id=\"traytitle\">".$_SESSION['organization']."</div>
											<div id=\"stats\" style=\"float:right;\">
												<span><span style=\"color:#c9c9c9;\"class=\"glyphicon glyphicon-tasks statsglyphicon\"></span>&nbsp;&nbsp;".$_SESSION['page_hits']."</span>
												<span><span style=\"color:#F64777;\" class=\"glyphicon glyphicon-heart statsglyphicon\"></span>&nbsp;&nbsp;0</span>
											</div>
										</div>
										<div id=\"traybottom\">
											<div id=\"rating\">".$avgarray."</div>
										</div>
									</div>
									<div class=\"col-md-8 col-lg-8 review\">
										<div id=\"comp_review\">
											<div class=\"comp_header\">REVIEWS</div>
											COMING SOON!
										</div>
									</div>
									<div class=\"col-md-4 col-lg-4 compinfo\">
										<div id=\"comp_about\">
											<div class=\"comp_header\">ABOUT</div>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel interdum nisi. Duis diam neque, lobortis sit amet pharetra vel, cursus id a orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel interdum nisi. Duis diam neque, lobortis sit amet pharetra vel, cursus id a orci.
											</p>	
											<div class=\"col-md-12 col-lg-12 sublink\">
												<span class=\"glyphicon glyphicon-phone-alt\"></span>
												<span class=\"spanlink\">(336) 314-5479</span>
											</div>
											
											<div class=\"col-md-12 col-lg-12 sublink\">
												<span class=\"glyphicon glyphicon-globe\"></span>
												<span class=\"spanlink\"><a href=\"\">www.getbackapp.co</a></span>
											</div>	
										</div>
										<div id=\"comp_map\">
											<img src=\"http://maps.google.com/maps/api/staticmap?center=".$_SESSION['business_latitude'].",".$_SESSION['business_longitude']."&zoom=16&size=300x300&markers=color:blue&sensor=false\" style=\"width: 100%; height: 100%;\" />
											<div class=\"comp_footer\"><p>".$_SESSION['address']."</p></div>
											<div id=\"circle\" style=\"background-image:url('".$_SESSION['branding_url']."')\"></div>
											<div id=\"triangle\"></div>
										</div>
										<div id=\"comp_hours\">
											<p><span style=\"text-align: left;\" class=\"days monday\">Monday</span><span style=\"text-align: right; float: right;\" class=\"hours monday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days tuesday\">Tuesday</span><span style=\"text-align: right; float: right;\" class=\"hours tuesday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days wednesday\">Wednesday</span><span style=\"text-align: right; float: right;\" class=\"hours wednesday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days thursday\">Thursday</span><span style=\"text-align: right; float: right;\" class=\"hours thursday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days friday\">Friday</span><span style=\"text-align: right; float: right;\" class=\"hours friday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days saturday\">Saturday</span><span style=\"text-align: right; float: right;\" class=\"hours saturday\">9:00-17:00</span></p>
											<p><span style=\"text-align: left;\" class=\"days sunday\">Sunday</span><span style=\"text-align: right; float: right;\" class=\"hours sunday\">9:00-17:00</span></p>
										</div>
									</div>
											  	
											  	
								</div>

								<div class=\"body-tab\" id=\"account\">
									<h4>Account & Settings</h4>
								  	<p><b>Your Name:</b> ".$_SESSION['fname']." ".$_SESSION['lname']."</p>
								  	<p><b>Your Email:</b> ".$_SESSION['email']."</p>
								  	<p><b>Industry:</b> <span style=\"text-transform: capitalize;\">".$_SESSION['industry']."</span></p>
								  	<p><b>Business Size:</b> ".$_SESSION['business_size']."</p>
								</div>


							</br>

							</div>
						";

					}

				?>
			</div>
			<div id="activity_bar">
				<div id="activityheader">
					<span class="glyphicon glyphicon-exclamation-sign"></span>
					Activity
				</div>
				<div id="activitynotifications">
				<?php

				$result = mysql_query("SELECT customer_id FROM customers WHERE business_id='$business_id' ORDER BY customer_id DESC LIMIT 10"); 
				$customer_array = array();

				while($row = mysql_fetch_array($result)){
				  $cbid = $row['customer_id'];
				  $sql = mysql_query("SELECT * FROM customers WHERE customer_id='$cbid'") or die(mysql_error(23)); 

				  if(mysql_num_rows($sql) == 1){
						$row = mysql_fetch_array($sql);
						$response_unsorted = $row['response_id'];
				        $response_array = explode(",",$response_unsorted);

				        $length = count($response_array);
				        $number = 0;

				        for ($j = 0; $j < $length; $j++) {
				        	$response_id = $response_array[$j];

				        	$sql = mysql_query("SELECT * FROM responses WHERE response_id='$response_id'") or die (mysql_error()."25");

				        	if(mysql_num_rows($sql) == 1){ 
				        		$row = mysql_fetch_array($sql);
				        		$date_response = date("m/d/Y", strtotime($row['response_date']));
				        		$time_response = date("h:i a", strtotime($row['response_time']));
				        		$answer_counter = $row['answer'];

				        		if($answer_counter=='yes') {
				        			$number++;
				        		}
				        	}
				        }

				        if ($number == 5 || $number == 4){
				        	$color = '#24B600';
				        	$bgcolor = 'rgba(36, 182, 0, 0.09)';
				        } elseif ($number == 3) {
				        	$color = '#FFC637';
				        	$bgcolor = 'rgba(255, 198, 55, 0.17)';
				        } elseif ($number == 2 || $number == 1 || $number == 0) {
				        	$color = '#FF0066';
				        	$bgcolor = 'rgba(255, 0, 102, 0.07)';
				        }



				        $number = number_format((float)$number, 1, '.', '');

				        echo "

				        		<style>
				        			#notifiction_".$response_id.":hover{
				        				background-color: ".$bgcolor.";
				        				transition: all 0.3s ease;
				        			}

				        			.notification_hover{
				        				background-color:#000;
				        				width: 200px;
				        				height: 80px;
				        				position: absolute;
				        				right: 20px;
				        			}

				        			#notifiction_".$response_id.":hover > #hover_".$response_id."{
				        				border: 1px solid #F00;
				        			}

				        		</style>
								<div id=\"notifiction_".$response_id."\" class=\"notification\">
									<div class=\"notification_rating col-xs-4 col-sm-4 col-md-4 col-lg-4\" style=\"color: ".$color."; border-left: 3px solid ".$color.";\">".$number."</div>
									<div class=\"notification_info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
										<p>New Rating!</p>
										<p><b>Time:&nbsp;</b>".$time_response."</p>
										<p><b>Date:&nbsp;</b>".$date_response."</p>
									</div>
								</div>
							";

					}

				}


				?>
				</div>
			</div>
		</div>
	</body>
</html>