<?php 

ob_start();

include('config.php');

    $usr = mysql_real_escape_string($_POST['username']); 
    $pas = hash('sha256', mysql_real_escape_string($_POST['password'])); 
    
    $sql = mysql_query("SELECT * FROM owners WHERE username='$usr' AND password='$pas' LIMIT 1"); 
    
    if(mysql_num_rows($sql) == 1){ 

        $row = mysql_fetch_array($sql); 
        
        session_start(); 
        
        $_SESSION['owner_id'] = $row['owner_id']; 
        $_SESSION['username'] = $row['username']; 
        $_SESSION['fname'] = $row['first_name']; 
        $_SESSION['lname'] = $row['last_name']; 
        $_SESSION['email'] = $row['email']; 
        $_SESSION['business_id'] = $row['business_id']; 

        $owner_id = $_SESSION['owner_id'];
        $business_id = $_SESSION['business_id'];

        if ($business_id != 0){

            $sql = mysql_query("SELECT * FROM business WHERE owner_id='$owner_id' AND business_id='$business_id' LIMIT 1");
            
            if(mysql_num_rows($sql) == 1){
                
                $row = mysql_fetch_array($sql);
                
                $_SESSION['link_id'] = $row['link_id'];
                $_SESSION['rating'] = $row['rating'];
                $_SESSION['num_users'] = $row['num_users'];
                $_SESSION['customer_id'] = $row['customer_id'];
                $_SESSION['branding_url'] = $row['branding_url'];
                $_SESSION['organization'] = $row['organization'];
                $_SESSION['connection_id'] = $row['connection_id'];
                $_SESSION['subscription_plan'] = $row['subscription_plan'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['business_latitude'] = $row['business_latitude'];
                $_SESSION['business_longitude'] = $row['business_longitude'];
                $_SESSION['question_array'] = $row['question_array'];

                $subscription_checker = $_SESSION['subscription_plan'];

                if ($subscription_checker === 'personal'){
                    $_SESSION['subscription_plan'] = "Personal Plan";
                    $_SESSION['business_size'] = "Individually Run";
                } 

                if ($subscription_checker === 'smb'){
                    $_SESSION['subscription_plan'] = "Small to Medium Business Plan";
                    $_SESSION['business_size'] = "Small/Medium Business";
                } 

                if ($subscription_checker === 'le'){
                    $_SESSION['subscription_plan'] = "Large Enterprise Plan";
                    $_SESSION['business_size'] = "Large Corporation or Enterprise";
                }


                $sql = mysql_query("SELECT * FROM connections WHERE business_id='$business_id' LIMIT 1");
                if(mysql_num_rows($sql) == 1){
                    $row = mysql_fetch_array($sql);
                    $_SESSION['industry'] = $row['industry_type'];
                }

                $_SESSION['logged'] = TRUE;

                header("Location: controlpanel.php"); 
                exit;

            } else {
                
                $_SESSION['logged'] = TRUE;
                header("Location: controlpanel.php"); 
                exit;

            }

        } else {
            $_SESSION['logged'] = TRUE;
            header("Location: controlpanel.php"); 
            exit;
        }

    } else { 

        echo "<div class=\"alert alert-danger\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                Sorry you entered an incorrect username or password!
              </div>";

    } 
     
?>