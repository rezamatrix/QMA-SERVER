<?php
include_once("config.php");
@$username1=$_POST['username1'];
@$username2=$_POST['username2'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}


    $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username2' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
    $dblink->query("DELETE FROM `friendlist` WHERE `user_id_1` = '$username1' and `user_id_2`='$username2';");
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