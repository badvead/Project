<?php
	if(isset($_POST['submit-login'])){ 
		include 'verify.php';
	}

	if(isset($_POST['submit-register'])){ 
		include 'register.php';
	}
?>
<!DOCTYPE html>
	<head>
		<title>Login | GetBack</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include ('common.php');?>
		<link rel="stylesheet" href="css/login.css">
	</head>
	<body>
		<div id="wrapper">
				<div id="login-square">
					<div class="l-block" id="img-block"><img src="img/front_logo.png" id="logo_img"></div>
					<div class="l-block" id="login-block">
						<div id="login-nav">Login</div>
						<div id="register-nav">Sign-Up</div>
						<div id="tab1">
							<div id="login_align">
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									   	<p><input id="username" class="login-form" type="text" name="username" placeholder="Username"></p>
									   	<p><input id="password" class="login-form" type="password" name="password" placeholder="Password"></p>
									   	<p><input class="button" type="submit" name="submit-login" value="Login"></p>
									    <p>&nbsp;&nbsp;Need an account? <a id="go-register">Register</a>.</p>
								</form>
							</div>
						</div>
						<div id="tab2">
							<div id="register-align">
								<form action=" <? echo $_SERVER['PHP_SELF']; ?> " method="post">
						            <p><input class="login-form" placeholder="Username" type="text" name="user_name" <? if(!$row){echo 'value="'.$_POST['user_name'].'"';} ?>/></p>
						            <p><input class="login-form" placeholder="First Name" type="text" name="fname" <? echo 'value="'.$_POST['fname'].'"'; ?> /></p>
						            <p><input class="login-form" placeholder="Last Name" type="text" name="lname" <? echo 'value="'.$_POST['lname'].'"'; ?> /></p>
						            <p><input class="login-form" placeholder="Email" type="text" name="email" pattern="\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b"/></p>
						            <p><input class="login-form" placeholder="Password" id="txtNewPassword" type="password" name="password" /></p>
						            <p><input class="login-form" placeholder="Re-Type Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" type="password" name="re_password" /><div class="registrationFormAlert" id="divCheckPasswordMatch"></div></p>
						            <p><input class="button" type="submit" name="submit-register" value="Sign Up"></p>
						            <p>&nbsp;&nbsp;Already have an account? <a id="go-login">Login</a>.</p>
						        </form>
							</div>
						</div>
					</div>
				</div>
		</div>
	</body>
</html>