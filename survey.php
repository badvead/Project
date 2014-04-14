<?php
  
  include 'config.php';

  $tz_states = array (
    'America/Anchorage'=>array('AK'),
    'America/Boise'=>array('ID'),
    'America/Chicago'=>array('AL', 'AR', 'IL', 'IA', 'KS', 'LA', 'MN', 'MS', 'MO', 'NE', 'OK', 'SD', 'TN', 'TX', 'WI'),
    'America/Denver'=>array('CO', 'MT', 'NM', 'UT', 'WY'),
    'America/Detroit'=>array('MI'),
    'America/Indiana/Indianapolis'=>array('IN'),
    'America/Kentucky/Louisville'=>array('KY'),
    'America/Los_Angeles'=>array('CA', 'NV', 'OR', 'WA'),
    'America/New_York'=>array('CT', 'DE', 'FL', 'GA', 'ME', 'MD', 'MA', 'NH', 'NJ', 'NY', 'NC', 'OH', 'PA', 'RI', 'SC', 'VT', 'VA', 'DC', 'WV'),
    'America/North_Dakota/Center'=>array('ND'),
    'America/Phoenix'=>array('AZ'),
    'Pacific/Honolulu'=>array('HI'),
);

  if( $_GET["link"])
  {
     $link = $_GET["link"];

      $sql = mysql_query("SELECT * FROM links WHERE link='$link'") or die (mysql_error()."1");
      if(mysql_num_rows($sql) == 1){ 

        $row = mysql_fetch_array($sql) or die (mysql_error()."2");

        $link_id = $row['link_id'];
        $page_hits = $row['page_hits'];
        $surveys_taken = $row['surveys_taken'];

        $page_hits++;

        $query = "UPDATE links SET page_hits='$page_hits' WHERE link='$link' ";
        $sql = mysql_query($query) or die(mysql_error());


        $sql = mysql_query("SELECT * FROM business WHERE link_id='$link_id'") or die (mysql_error()."3");
        if(mysql_num_rows($sql) == 1){ 

          $row = mysql_fetch_array($sql) or die (mysql_error()."4");

          $business_id = $row['business_id'];
          $organization = $row['organization'];
          $address = $row['address'];
          $branding_url = $row['branding_url'];
          $question_unsorted = $row['question_array'];
          $question_array = explode(",",$question_unsorted);

          $survey_URL = $_SERVER['PHP_SELF']."?link=".$link;

          if(isset($_POST['submit'])){

            $surveys_taken++;

            $query = "UPDATE links SET surveys_taken='$surveys_taken' WHERE link='$link' ";
            $sql = mysql_query($query) or die(mysql_error()."5"); 

            $timezone = date_default_timezone_get();

            date_default_timezone_set('$timezone');
            $date = date('Y-m-d');
            $time = date('h:i:s a');

            $user_latitude = $_POST['latitude'];
            $user_longitude = $_POST['longitude'];

            $query = "INSERT INTO customers(customer_id, business_id, user_latitude, user_longitude, user_date, user_time, response_id) VALUES ('', '$business_id', '$user_latitude', '$user_longitude', '$date', '$time', '')"; 
            $sql = mysql_query($query) or die(mysql_error()."6");

            $sql = mysql_query("SELECT * FROM customers WHERE user_latitude='$user_latitude' AND user_longitude='$user_longitude' AND user_date='$date' AND user_time='$time'") or die (mysql_error()." 7");
            if(mysql_num_rows($sql) == 1){ 
              $row = mysql_fetch_array($sql) or die (mysql_error()."19");
              $customer_id = $row['customer_id'];
            }

            $length = count($question_array);

            $response_id = "";

            for ($i = 0; $i < $length; $i++) {
              
              $question_id = $question_array[$i];

              $sql = mysql_query("SELECT * FROM questions WHERE question_id='$question_id'") or die (mysql_error()."8");
              if(mysql_num_rows($sql) == 1){ 

                $row = mysql_fetch_array($sql) or die (mysql_error()."9");
                $frequency = $row['frequency'];

                $frequency++;

                $response = mysql_real_escape_string($_POST[$question_id]);

                $query = "UPDATE questions SET frequency='$frequency' WHERE question_id='$question_id'";
                $sql = mysql_query($query) or die(mysql_error()."10");

                $query = "INSERT INTO responses(response_id, question_id, customer_id, business_id, answer, response_date, response_time) VALUES ('','$question_id', '', '$business_id', '$response', '$date', '$time')"; 
                $sql = mysql_query($query) or die(mysql_error()."14");

                $query = "UPDATE responses SET customer_id='$customer_id' WHERE response_date='$date' AND response_time='$time' AND question_id='$question_id'";
                $sql = mysql_query($query) or die(mysql_error()."13");   

                $sql = mysql_query("SELECT * FROM responses WHERE response_date='$date' AND response_time='$time' AND question_id='$question_id'") or die (mysql_error()."8");
                if(mysql_num_rows($sql) == 1){ 

                  $row = mysql_fetch_array($sql) or die (mysql_error()."106"); 
                  $response_id = $row['response_id'];
                }    

              }

              if($i == 0) {
                $response_array = $response_id;
              } else {
                $response_array= $response_array.",".$response_id;
              }             

            }
            $query = "UPDATE customers SET response_id='$response_array' WHERE user_latitude='$user_latitude' AND user_longitude='$user_longitude' AND user_date='$date' AND user_time='$time'";
            $sql = mysql_query($query) or die(mysql_error()."128");

            echo "

            <!DOCTYPE html>
              <html>
                <head>
                  <?php include ('common.php');?>
                  <title>Survey for <?php echo $organization; ?> | GetBack</title>
                  <meta name=\"viewport\" content=\"width=device-width, user-scalable=no\">
                  <style>
                      body{
                        margin: 0px;
                        background-color: #29c6bc;
                        min-height: 100% !important;
                      }  

                      #thankswrapper{
                        height: 100%;
                        width: 100%;
                      }
                  </style>
                </head>
                <body>  
                    <div id=\"thankswrapper\">
                      Thanks for completeing our survey!</br>
                    <b>COUPON GOES HERE.</b>
                  </div>
                </body>
              </html>
              ";
            die ();
          }

        }

      }

  }


?>

<!DOCTYPE html>
<html>
  <head>
    <?php include ('common.php');?>

    <title>Survey for <?php echo $organization; ?> | GetBack</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <style type="text/css">

      html, body{
        height: 100%;
        width: 100%;
      }

      .draggable{
        height: 20%;
        width: 100%;
        border-bottom: 1px solid #e9e9e9;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        font-family: 'Lato', sans-serif !important;
        position: relative;
      }

      .phoneheader{
        width: 100%;
        height: 48px;
        border-bottom: 1px solid #c9c9c9;
        text-align: center;
        line-height: 48px;
        font-size: 25px;
        font-family: 'Roboto Slab', serif;
        text-shadow: 1px 1px 0px #000;
        background-color: #2F323A;
        color: #FFF;
      }

      #wrapper{
        height: 100%;
        width: 100%;
      }

      .drag_container{
        height: calc(100% - 48px);
        width: 100%;
      }

      .surveysubmit{
        height: 300px;
        width: 100%;
        background-color: #393;
        position: absolute;
        top: 48px;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        z-index: 999;
        border: none;
        background-color: #26d3c8;
        display: none;
      }

    </style>
  </head>
  <body>  
    <div id="wrapper">

      <script type="text/javascript">
        var survey_value = 0;
      </script>
      <?php 
      echo "
          <div class=\"phoneheader\">".$organization."</div>
          <form class=\"drag_container\" action=\"".$survey_URL."\" method=\"post\">
            <input type='hidden' name='__token_timestamp__' value='1397198354'>
            <input type='hidden' name='__token_val__' value='49500290a560b967867fca9a70fe8cb9'>
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

                  <div class=\"draggable\">


                  <div class=\"form_data\" id=\"".$x."\">
                    <label id=\"yes\" class=\"survey_response\">
                      <input class=\"target\" type=\"radio\" name=\"".$question_id."\" value=\"yes\"/>yes
                    </label>

                    <label id=\"no\" class=\"survey_response\">
                      <input class=\"target\" type=\"radio\" name=\"".$question_id."\" value=\"no\"/>no
                    </label>
                  </div>

                  <script type=\"text/javascript\">
                    $('input:radio[name=\"".$question_id."\"]').change(

                      function(){

                        var v = ".$x.";

                          if ($(this).val() == 'yes') {
                              $('#".$x."').fadeOut();
                              v++;
                              $('#'+ v).fadeIn();
                          }
                          else {
                              $('#".$x."').fadeOut();
                              v++;
                              $('#'+ v).fadeIn();
                          }

                        if (v == 6){
                          $('.surveysubmit').show();
                          $('.surveysubmit').animate({'margin-top': '0px'}, 1000);
                        }

                      });
                  </script>
      

                  <div class=\"survey_question\">".$question."</div>

                  </div>

                  ";
              }
            }

      echo "</form>";

    ?>

    <input class="surveysubmit" type="submit" name="submit" value="Give Feedback" />
    </form>
    </div>
  </body>
</html>