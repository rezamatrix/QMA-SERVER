<?php
include_once("config.php");

@$username=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));


   $result = $dblink->query("SELECT `username`,`password` FROM `user` where `username` = '$username'");
   $row = $result->fetch_assoc();

   if($password==$row['password']){
    $err=array();
    $err['succse']='1';
    $err['status']='ok!';

     echo json_encode($err);

}else{
    $err=array();
    $err['succse']='0';
    $err['status']='Username or password wrong!';
     echo json_encode($err);

}
header('Content-Type: application/json');
?>