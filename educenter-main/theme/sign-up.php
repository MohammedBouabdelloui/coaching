
<?php

$error = '';
$msg = "";
$add_user = null;
//print_r($_SERVER['SERVER_PROTOCOL']);

if(isset($_POST['sign_up']) || !empty($_GET['email'])){
  if(isset($_POST['sign_up'])){
    include_once '../../classes/Client.php';
    
  
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $Cpassword = htmlspecialchars($_POST['cpassword']);
    if((!preg_match('/^([a-zA-Z]+)/',$username)) || (!filter_var($email,FILTER_VALIDATE_EMAIL))){
      $error .= 'Name first name or email does not respect the terms<br>';
    }
    if($password != $Cpassword){
      $error .='The password and confirmation password must be the same<br>';
    }
    if($error === ''){
      $url_validation = time().$email;
      $url_validation = hash('sha1',$url_validation);
      $password = hash('sha1',$password);
      //echo $url_validation;
      $user = new Client($username,$email,$password,$url_validation);
      $add_user=$user->add_client();
    }
  }
  if(!empty($_GET['email'])){
    include_once '../../classes/Verification.php';
    $email = $_GET['email'];
    $url_validation = time().$email;
    $url_validation = hash('sha1',$url_validation);
    $new_url = new Verification();
    $modify = $new_url->Re_transmitter_url_validation($email,$url_validation);
    //$_GET['email'] = null;
    
  }
    if($add_user === 1 || !empty($_GET['email'])){
      
      
      $path = "http"."://"  . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/coaching/dashboard/theme/verifying.php?url=$url_validation"."&"." email=$email";
      $verification_link = "<a href='$path'>Your account verification link</a>";
      $subject = "Your email verification.";
      $message = "
                        
      Hello  <br>
      Are you ready to gain access to all of the assets we prepared for coaching users?<br>
      First, you must complete your registration by clicking on the link below:<br><br>
      $verification_link
      <br><br>
      This link will verify your email address, and then you’ll officially be a part of our community.<br>
      See you there!<br><br>
      <strong>Best regards, the <u>Coaching</u> team.</strong>
      ";
      $headers = "From: simoboolz@gmail.com \r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      if (mail($email, $subject, $message, $headers)){
        $msg = "Please check your email";
      }else
             $msg = "Please try again, an error occurred";
      
    }elseif($add_user === 0){
      $msg ="There is an account with the same email";
    }
    //$_GET['email'] = 'null';
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/styleLogin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="images/login/wave.png">
	<div class="container">
		<div class="img">
			<img src="images/login/undraw_personal_info_re_ur1n.svg">
		</div>
		<div class="login-content">
			<form action="sign-up.php" method="POST">
				<img src="images/login/undraw_education_f8ru.svg">
				<h2 class="title">Welcome</h2>
           	  <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>
           	  <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>E-mail</h5>
           		   		<input type="text" name="email" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Conferm Password</h5>
           		    	<input name="cpassword" type="password" class="input">
            	   </div>
            	</div>
            	<a href="sign-in.php">Sign in</a>
              <?php
                if($error != ''){

                  echo '<div class="alert alert-danger"  role="alert">'.$error.'</div>';
                }elseif($msg != ''){
                  echo '<div class="alert alert-success" role="alert">'.$msg;
                  if($add_user != 0 || !empty($modify)){

                    echo '<br><a href="sign-up.php?email='.$email.'">Re-transmitter</a></div>';

                  }else echo '</div>';
                }

              ?>
              <span><?= $msg ?></span>
            	<input type="submit" name="sign_up" class="btn" value="Login">
            </form>
        </div>

    </div>
    <script type="text/javascript" src="js/ligin.js"></script>
</body>
</html>