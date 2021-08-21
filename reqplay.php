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
    @$time=time();
    $resultg = $dblink->query("SELECT * FROM `game` where `user_1` = '$username2' and `user_2` = '$username1' and (`status`='0' or `status`='1' or `status`='3')");
          $rowg = $resultg->num_rows;
          if($rowg<=0){
$dblink->query("INSERT INTO `game` (`user_1`, `user_2`, `time`, `winer`, `status`, `level`, `turn`, `used`, `user_point_1`, `user_point_2`) VALUES ('$username2', '$username1', '$time', '', '3', '0', '0', '0', '0', '0');");
$err=array();
    $err['succse']='1';
    $err['status']='ok!';
     echo json_encode($err);
  } else{
        $err=array();
    $err['succse']='0';
    $err['status']='wrong!';
     echo json_encode($err);
}
}else{
        $err=array();
    $err['succse']='0';
    $err['status']='wrong!';
     echo json_encode($err);
}
header('Content-Type: application/json');
?>