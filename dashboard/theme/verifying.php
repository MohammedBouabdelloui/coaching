<?php
include '../../classes/Verification.php';
if(!empty($_GET['email'])){
    $email = $_GET['email'];
    $url = $_GET['url'];
    $user = new Verification();
    $msg = $user->Verification_url($email,$url);
    if($msg === 1){
        echo 'Your email account has been verified';

    }elseif($msg === 0){
        echo 'An error occurred, please try again later';
    }


}else{
    echo 'Please login from the link in your email';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<script>
    window.setTimeout('window.location="http://localhost:3000/coaching/dashboard/theme/sign-in.php"; ',10000);
</script>
</body>
</html>