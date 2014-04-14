<?php

include '../config.php';

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