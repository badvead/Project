<div class=\"tab tactive\" id=\"dashboard\">
	<h4>Dashboard</h4>
  	<p><b>Your Link:</b> <a target=\"_blank\" href=\"survey.php?link=".$_SESSION['link']."\">http://getbackapp.co/".$_SESSION['link']."</a></p>
  	<p><b>Your Plan:</b> ".$_SESSION['subscription_plan']."</p>
  	</br>
  	<p><b>Number of Surveys Accessed:</b> ".$_SESSION['page_hits']." (page hits)</p>
  	<p><b>Redemtion Rate:</b> ".$redemtion."%<p>
</div>

<div class="tab" id="suggestion">
	<h4>Your Suggestions</h4></br>
	<table>
		<tr>
			<td>
  			<b>Overall Rating</b></br>
		  	<div class=\"rating_outer\">
		  		<div class=\"rating_inner\"></div>
		  	</div>&nbsp;&nbsp;&nbsp;<b id=\"ratings\">".$overallrating."%</b></br>			  	
		  	<div id=\"suggestion\"><small>".$overallsuggestion."</small></div>
		</td>
	</tr>
		<td>
  			<b>Staff</b></br>
		  	<div class=\"rating_outer\">
		  		<div class=\"rating_inner\"></div>
		  	</div>&nbsp;&nbsp;&nbsp;<b id=\"ratings\">".$overallrating."%</b></br>			  	
		  	<div id=\"suggestion\"><small>".$overallsuggestion."</small></div>
		</td>
		<td>
  			<b>Aquisitions</b></br>
		  	<div class=\"rating_outer\">
		  		<div class=\"rating_inner\"></div>
		  	</div>&nbsp;&nbsp;&nbsp;<b id=\"ratings\">".$overallrating."%</b></br>			  	
		  	<div id=\"suggestion\"><small>".$overallsuggestion."</small></div>
		</td>
		<td>
  			<b>Facilities</b></br>
		  	<div class=\"rating_outer\">
		  		<div class=\"rating_inner\"></div>
		  	</div>&nbsp;&nbsp;&nbsp;<b id=\"ratings\">".$overallrating."%</b></br>			  	
		  	<div id=\"suggestion\"><small>".$overallsuggestion."</small></div>
		</td>
	</tr>
	</table>
</div>

<div class="tab" id="survey">
	<h4>Your Survey</h4>
  	<table id=\"table-questions\">

  	<tr align=\"middle\" style=\"text-align: center;\">
  		<th>Edit</th>
  		<th>Questions</th>
  		<th>Category</th>
  	</tr>
";

	$length = count($question_array);

	for ($i = 0; $i < $length; $i++) {
  		$question_id = $question_array[$i];

  		$sql = mysql_query("SELECT * FROM questions WHERE question_id='$question_id'") or die (mysql_error()."15");
  		if(mysql_num_rows($sql) == 1){ 

	    	$row = mysql_fetch_array($sql) or die (mysql_error()."16");

		    $question = $row['question'];
    	$category = $row['industry_type'];

	    echo "
	      <tr>
	      	<td><a class=\"btn btn-primary\" style=\"padding: 3px 4px !important; background-color: #ff732d !important; border: 2px solid #ff9868;\">Change</a></td>
	      	<td>&nbsp;&nbsp;<b>".($i+1).".</b> ".$question."&nbsp;&nbsp;</td>
	      	<td><i>".$category."</i></td>
	      </tr>
	      <tr>
	      	<td>&nbsp;&nbsp;</td>&nbsp;&nbsp;<td></td>
	      </tr>
    	";
	  }
	}
echo "</table>	
</div>

<div class="tab" id="company">
	<h4>About Your Company</h4>
  	<table>
  		<tr>
			<td style=\"margin-right:30px; padding-right: 10px;\">
				<p><img class=\"img-thumbnail\" style=\"max-width: 120px;\" src=\"".$_SESSION['branding_url']."\"></p>
			  	<p><b>Your Organization:</b> ".$_SESSION['organization']."</p>
			  	<p><b>Your Location:</b> ".$_SESSION['address']."</p>
			  	<p><b>Business Size:</b> ".$_SESSION['business_size']."</p>
			  	<p><b>Industry:</b> <span style=\"text-transform: capitalize;\">".$_SESSION['industry']."</span></p>
			</td>
			<td>
			  	<p><img class=\"img-thumbnail\" src=\"http://maps.google.com/maps/api/staticmap?center=".$_SESSION['business_latitude'].",".$_SESSION['business_longitude']."&zoom=16&size=300x300&markers=color:blue&sensor=false\" style=\"width: 300px; height: 300px;\" /></p>
			</td>
		</tr>
  	</table>
</div>

<div class="tab" id="account">
	<h4>Account & Settings</h4>
  	<p><b>Your Name:</b> ".$_SESSION['fname']." ".$_SESSION['lname']."</p>
  	<p><b>Your Email:</b> ".$_SESSION['email']."</p>
</div>