<?php 

ob_start();

include('config.php');

    $username = mysql_real_escape_string($_POST['user_name']);
    $password = hash('sha256', mysql_real_escape_string($_POST['password']));
    $fname = mysql_real_escape_string($_POST['fname']);
    $lname = mysql_real_escape_string($_POST['lname']);
    $email = mysql_real_escape_string($_POST['email']);

if(isset($_POST['submit-register'])){ 

    $query = "SELECT * FROM owners WHERE username='$username' OR email='$email'"; 
    $sql = mysql_query($query); 
    $row = mysql_fetch_array($sql); 


    if($row||empty($_POST['user_name'])|| empty($_POST['fname'])||empty($_POST['lname'])|| empty($_POST['email'])||empty($_POST['password'])|| empty($_POST['re_password'])||$_POST['password']!=$_POST['re_password']){ 
         
        $error = '<div class=\"alert alert-danger\"><p>'; 
        if(empty($_POST['user_name'])){ 
            $error .= 'User Name can\'t be empty<br>'; 
        } 
        if(empty($_POST['fname'])){ 
            $error .= 'First Name can\'t be empty<br>'; 
        } 
        if(empty($_POST['lname'])){ 
            $error .= 'Last Name can\'t be empty<br>'; 
        } 
        if(empty($_POST['email'])){ 
            $error .= 'Email can\'t be empty<br>'; 
        } 
        if(empty($_POST['password'])){ 
            $error .= 'Password can\'t be empty<br>'; 
        } 
        if(empty($_POST['re_password'])){ 
            $error .= 'You must re-type your password<br>'; 
        } 
        if($_POST['password']!=$_POST['re_password']){ 
            $error .= 'Passwords don\'t match<br>'; 
        } 
        if($row){ 
            $error .= 'Username or Email already exists<br>'; 
        } 
        $error .= '</p></div>';

    } else {  

            $query = "INSERT INTO owners(owner_id, username, password, first_name, last_name, email, business_id)VALUES('', '$username', '$password', '$fname', '$lname', '$email', '')"; 
            $sql = mysql_query($query) or die(mysql_error()); 

            header("Location: login.php"); 
            exit; 
    } 
} 

if(isset($error)) { 
    echo $error; 
    unset($error); 
} 
?> 