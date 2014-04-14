<?php 

ob_start();

session_start();
if(isset($_SESSION['owner_id'])) {
  $owner_id = $_SESSION['owner_id'];
}

include('config.php');

    $branding_url = mysql_real_escape_string($_POST['branding_url']);
    $organization = mysql_real_escape_string($_POST['organization']);
    $subscription = mysql_real_escape_string($_POST['subscription']);
    $streetaddress = mysql_real_escape_string($_POST['streetaddress']);
    $address2 = mysql_real_escape_string($_POST['address2']);
    $city = mysql_real_escape_string($_POST['city']);
    $state = mysql_real_escape_string($_POST['state']);
    $postalcode = mysql_real_escape_string($_POST['postalcode']);
    $industry = strtoupper(mysql_real_escape_string($_POST['industry']));

    $address = $streetaddress.", ".$address2.", ".$city.", ".$state." ".$postalcode;

        $prepAddr = str_replace(' ','+',$streetaddress.", ".$city.", ".$state." ".$postalcode);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;

    $link = link_generator(10);

    $question_array = "1,2,3,4,5";


if(isset($_POST['submit'])){ 

    $query = "SELECT * FROM business WHERE address='$address'"; 
    $sql = mysql_query($query); 
    $row = mysql_fetch_array($sql); 


    if($row||empty($_POST['organization'])||empty($_POST['subscription'])|| empty($_POST['streetaddress']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['postalcode']) || $owner_id==0){ 
         
        $error = '<div class=\"alert alert-danger\"><p>'; 
        #if(empty($_POST['branding_url'])){ 
        #    $error .= 'Need to upload your logo.<br>'; 
        #} 
        if(empty($_POST['organization'])){ 
            $error .= 'Organization can\'t be empty<br>'; 
        } 
        
        if(empty($_POST['subscription'])){ 
            $error .= 'Choose a subscription plan.<br>'; 
        } 
        
        if(empty($_POST['streetaddress'])){ 
            $error .= 'Please enter a valid address<br>'; 
        } 
        
        if(empty($_POST['city'])){ 
            $error .= 'Please enter a valid address<br>'; 
        
        }if(empty($_POST['state'])){ 
            $error .= 'Please enter a valid state<br>'; 
        }
        
        if(empty($_POST['postalcode'])){ 
            $error .= 'Please enter a valid postal code<br>'; 
        }
        if($owner_id==0){ 
            echo 'This is an invalid session.<br>'; 
            header("Location: login.php"); 
        } 

        if($row){ 
            $error .= 'This location already exists.<br>'; 
        } 

        $error .= '</p></div>';

    } else {  
            

            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            $file = "branding/" . $_FILES["file"]["name"];
            if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 200000) && in_array($extension, $allowedExts)) {
              
                if ($_FILES["file"]["error"] > 0) {
                    die("Return Code: " . $_FILES["file"]["error"] . "<br>");
                } else {

                    if (file_exists("branding/" . $_FILES["file"]["name"])) {
                        $_FILES["file"]["name"] . " already exists. ";
                    } else {
                        move_uploaded_file($_FILES["file"]["tmp_name"], $file);
                    }

                }
            } else {
                die ("Invalid file");
            }


            $query = "INSERT INTO business(business_id, owner_id, link_id, rating, num_users, customer_id, branding_url, organization, connection_id, subscription_plan, address, business_latitude, business_longitude, question_array) VALUES ('', '$owner_id', '', '', '', '', '$file', '$organization', '', '$subscription', '$address', '$lat', '$long', '$question_array')"; 
            $sql = mysql_query($query) or die(mysql_error()." FIRST");

            $sql2 = mysql_query("SELECT * FROM business WHERE address='$address'") or die (mysql_error()." SECOND");
            if(mysql_num_rows($sql2) == 1){ 
                $row = mysql_fetch_array($sql2) or die (mysql_error()." THIRD");
                $business_id = $row['business_id']; 

                $query = "INSERT INTO links(link_id, link, business_id, page_hits, surveys_taken) VALUES ('', '$link', '$business_id', '', '')"; 
                $sql = mysql_query($query) or die(mysql_error()." FOURTH");


                $query = "UPDATE owners SET business_id='$business_id' WHERE owner_id='$owner_id' ";
                $sql = mysql_query($query) or die(mysql_error()." FIFTH"); 


                $query = "INSERT INTO connections(connection_id, business_id, state, city, company_type, industry_type, business_size) VALUES ('', '$business_id','$state', '$city', '', '$industry', '$subscription')"; 
                $sql = mysql_query($query) or die(mysql_error()." SIXTH");

                $sql4 = mysql_query("SELECT * FROM connections WHERE business_id='$business_id'") or die (mysql_error()." SEVENTH");
                if(mysql_num_rows($sql4) == 1){

                    $row = mysql_fetch_array($sql4) or die (mysql_error()." EIGHTH");
                    $connection_id = $row['connection_id'];
                    $query = "UPDATE business SET connection_id='$connection_id' WHERE business_id='$business_id' ";
                    $sql = mysql_query($query) or die(mysql_error()." NINTH");

                }

                $sql3 = mysql_query("SELECT * FROM links WHERE business_id='$business_id'") or die (mysql_error()." TENTH");
                if(mysql_num_rows($sql3) == 1){ 
                    $row = mysql_fetch_array($sql3) or die (mysql_error()." ELEVENTH");
                    $link_id = $row['link_id'];
                    $query = "UPDATE business SET link_id='$link_id' WHERE business_id='$business_id' ";
                    $sql = mysql_query($query) or die(mysql_error()." TWELVETH");
                }

                $sql2 = mysql_query("SELECT * FROM business WHERE address='$address'") or die (mysql_error()." THIRTEENTH");
                if(mysql_num_rows($sql2) == 1){ 
                    $row = mysql_fetch_array($sql2) or die (mysql_error()." FOURTEENTH");

                    header("Location: logout.php");
                    exit; 

                }

        } 
    }
}

if(isset($error)) { 
    echo $error; 
    unset($error); 
} 
?> 

<!DOCTYPE html>
    <head>
        <title>Register Your Business | GetBack</title>
        <?php include ('common.php');?>
    </head>
    <body>
        <form enctype="multipart/form-data" action=" <? echo $_SERVER['PHP_SELF']; ?> " method="post">
            <h4>About Your Company</h4>
            <p>Brand Image:<br /><input name="file" type="file" />
            <p>Organization:<br /><input class="form-control" type="text" name="organization" <? echo 'value="'.$_POST['organization'].'"'; ?> /></p>
            <p>Industry: <input class="form-control" type="text" name="industry" <? echo 'value="'.$_POST['industry'].'"'; ?> /></p>
            
            </br><h4>Your Plan</h4>
            <p>Subscription Plan:<br />
            <p>
                <select class="form-control" id="subscription" name="subscription" <? echo 'value="'.$_POST['subscription'].'"'; ?> />>
                    <option value="personal">Personal</option>
                    <option value="smb">Small to Medium Business</option>
                    <option value="le">Large Enterprise</option>
                </select> 
            </p></p></br>

            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a href="#personal" data-toggle="tab">Personal</a></li>
              <li><a href="#smb" data-toggle="tab">Small to Medium Business</a></li>
              <li><a href="#le" data-toggle="tab">Large Enterprise</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane fade active" id="personal">
                </br><p><b>Personal Plan:</b>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In semper diam augue, vel feugiat lorem sollicitudin bibendum. Suspendisse quis est ut libero facilisis dapibus. Integer mollis lectus id purus tincidunt gravida. Sed tempor mollis libero, id molestie turpis. Mauris congue dolor urna, vitae pellentesque nunc ultrices vitae. Morbi nibh massa, lacinia ac facilisis at, placerat eu velit. Nullam sit amet massa tempus, vulputate lacus id, mattis elit. Mauris sit amet dolor mi. 
                </p>
              </div>

              <div class="tab-pane fade" id="smb">
                </br><p><b>Small/Medium Business Plan:</b> 
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In semper diam augue, vel feugiat lorem sollicitudin bibendum. Suspendisse quis est ut libero facilisis dapibus. Integer mollis lectus id purus tincidunt gravida. Sed tempor mollis libero, id molestie turpis. Mauris congue dolor urna, vitae pellentesque nunc ultrices vitae. Morbi nibh massa, lacinia ac facilisis at, placerat eu velit. Nullam sit amet massa tempus, vulputate lacus id, mattis elit. Mauris sit amet dolor mi. 
                </p>
              </div>

              <div class="tab-pane fade" id="le">
                </br><p><b>Large Enterprise Plan:</b>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In semper diam augue, vel feugiat lorem sollicitudin bibendum. Suspendisse quis est ut libero facilisis dapibus. Integer mollis lectus id purus tincidunt gravida. Sed tempor mollis libero, id molestie turpis. Mauris congue dolor urna, vitae pellentesque nunc ultrices vitae. Morbi nibh massa, lacinia ac facilisis at, placerat eu velit. Nullam sit amet massa tempus, vulputate lacus id, mattis elit. Mauris sit amet dolor mi. 
                </p>
              </div>
            </div>


            <script>
              $(function () {
                $('#myTab a:last').tab('show')
              })
            </script>

            </br><h4>Address: (only US)</h4>
            <p>Street Address: <input class="form-control" type="text" name="streetaddress" <? echo 'value="'.$_POST['streetaddress'].'"'; ?> /></p>
            <p>Address Line 2: <input class="form-control" type="text" name="address2" <? echo 'value="'.$_POST['address2'].'"'; ?> /></p>
            <p>City: <input class="form-control" type="text" name="city" <? echo 'value="'.$_POST['city'].'"'; ?> /></p>
            <p>State (Initals): <input class="form-control" onblur="this.value=this.value.toUpperCase()" type="text" maxlength="2" name="state" <? echo 'value="'.$_POST['state'].'"'; ?> /></p>
            <p>Postal Code: <input class="form-control" type="text" name="postalcode" <? echo 'value="'.$_POST['postalcode'].'"'; ?> /></p>
            

            <p><input class="btn btn-primary" type="submit" name="submit" value="Complete" />&nbsp;&nbsp;<a class="btn btn-primary" href="controlpanel.php">Control Panel</a></p>
        </form>
    </body>
</html>