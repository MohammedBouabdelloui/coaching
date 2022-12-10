<?php
include 'Connection.php';
class Ctegory{
    
}

$email = "mohammed@kclkjhx.com";
if (!preg_match("/^([a-zA-Z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/", $email)){
    echo 'check your emali';
}
$nim = "0855555555";
$nom = "Mohammed";
trim($nom);
htmlspecialchars($email);
if(preg_match('/^([a-zA-Z]+)/',$nom)){

    print 'chen valede<br>';
}else{
    print 'forma chine invalede';
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
echo 'forma de emaile invalede';
}
if(!preg_match('/^0([67])([0-9]{8})/',$nim)){
    echo 'numero invaled';
}

echo hash("sha1",$nom)."<br>";
echo password_hash($nom, PASSWORD_DEFAULT);
