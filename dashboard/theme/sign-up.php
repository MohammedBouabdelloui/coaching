<?php
include '../../classes/Client.php';
$error = '';
$msg = "";
print_r($_SERVER['SERVER_PROTOCOL']);
if(isset($_POST['sign'])){
  $name = trim(htmlspecialchars($_POST['name']));
  $first_name = trim(htmlspecialchars($_POST['first_name']));
  $email = trim(htmlspecialchars($_POST['email']));
  $password = htmlspecialchars($_POST['password']);
  $Cpassword = htmlspecialchars($_POST['cpassword']);
  if((!preg_match('/^([a-zA-Z]+)/',$name)) || (!preg_match('/^([a-zA-Z]+)/',$first_name)) || (!filter_var($email,FILTER_VALIDATE_EMAIL))){
    $error .= 'Name first name or email does not respect the terms<br>';
  }
  if($password != $Cpassword){
    $error .='The password and confirmation password must be the same<br>';
  }
  if($error === ''){
    $url_validation = time().$email.rand(4 , 999);
    $url_validation = hash('sha1',$url_validation);
    $password = hash('sha1',$password);
    echo $url_validation;
    $user = new Client($name,$first_name,$email,$password,$url_validation);
    $add_user=$user->add_client();
    if($add_user === 1){
      
      $path = $_SERVER['SERVER_PROTOCOL'] . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/coaching/dashbord/theme/verifying.php";
      $verification_link = "<a href='$path'?email=$email ,url=$url_validation>Your account verification link</a>";
      $subject = "Your email verification.";
      $message = "
                        
      Hello $name <br>
      Are you ready to gain access to all of the assets we prepared for coaching users?<br>
      First, you must complete your registration by clicking on the link below:<br><br>
      $verification_link
      <br><br>
      This link will verify your email address, and then you’ll officially be a part of our community.<br>
      See you there!<br><br>
      <strong>Best regards, the <u>Welfare</u> team.</strong>
      ";
      $headers = "From: simoboolz@gmail.com \r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      mail($email, $subject, $message, $headers);


      $msg = "Please check your email";
    }elseif($add_user === 0){
      $msg ="There is an account with the same email";
    }
  }
}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <title>Sign Up - Sleek Admin Dashboard Template</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />

    <!-- FAVICON -->
    <link href="assets/img/favicon.png" rel="shortcut icon" />

    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="assets/plugins/nprogress/nprogress.js"></script>
  </head>

  <body class="" id="body">
    <div class="container d-flex align-items-center justify-content-center vh-100">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="/index.html">
                  <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                      <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                      <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                  </svg>

                  <span class="brand-name">Sleek Dashboard</span>
                </a>
              </div>
            </div>

            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Sign Up</h4>

              <form action="sign-up.php" method="POST">
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" id="name" name='name' aria-describedby="nameHelp" placeholder="Name">
                  </div>
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" id="first_name" name='first_name' aria-describedby="nameHelp" placeholder="first name">
                  </div>
                  
                  <div class="form-group col-md-12 mb-4">
                    <input type="email" class="form-control input-lg" id="email" name='email' aria-describedby="emailHelp" placeholder="Username">
                  </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name='password' id="password" placeholder="Password">
                  </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name='cpassword' id="cpassword" placeholder="Confirm Password">
                  </div>

                  <div class="col-md-12">
                    <div class="d-inline-block mr-3">
                      <label class="control control-checkbox">
                        <input type="checkbox" />
                        <div class="control-indicator"></div>
                        I Agree the terms and conditions
                      </label>
                    </div>

                    <button type="submit" name="sign" class="btn btn-lg btn-primary btn-block mb-4">Sign Up</button>

                    <p>Already have an account?
                      <a class="text-blue" href="sign-in.html">Sign in</a>
                    </p>
                  </div>
              <?php
                if($error != ''){

                  echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                }elseif($msg != ''){
                  echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
                }

              ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- <script type="module">
      import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

      const el = document.createElement('pwa-update');
      document.body.appendChild(el);
    </script> -->

    <!-- Javascript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sleek.js"></script>
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
</body>
</html>
