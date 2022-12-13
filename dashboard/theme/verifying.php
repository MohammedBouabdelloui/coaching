<?php
include '../../classes/Verification.php';
if(!empty($_GET['email'])){
    $email = $_GET['email'];
    $url = $_GET['url'];
    $user = new Verification();
    $result = $user->Verification_url($email,$url);
    if($result === 1){
        $msg =  'Your email account has been verified';

    }elseif($result === 0){
        $msg = 'An error occurred, please try again later';
    }


}else{
    $msg =  'Please login from the link in your email';
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

<body>
    <!-- Flexbox container for aligning the toasts -->


    <!-- Then put toasts within -->

    <div class="alert alert-info px-2" role="alert">
    <?=$msg ?>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sleek.js"></script>
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
<script>
    window.setTimeout('window.location="http://localhost:3000/coaching/dashboard/theme/sign-in.php"; ',10000);
</script>
</body>
</html>