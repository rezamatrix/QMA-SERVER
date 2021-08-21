<?php
include_once("config.php");
@$dis=$_POST['av'];
@$username2=$_POST['username2'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}


    $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username2' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
    $dblink->query("UPDATE `user` SET `balance` = `balance`+'$dis' WHERE `username` = '$username2';");
    $err=array();
    $err['succse']='1';
    $err['status']='ok!';
     echo json_encode($err);

}else{
        $err=array();
    $err['succse']='0';
    $err['status']='wrong!';
     echo json_encode($err);
}
header('Content-Type: application/json');
?>