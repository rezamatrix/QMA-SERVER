<?php
include_once("config.php");

@$username=$_POST['username'];
@$mode=$_POST['mode'];
@$password=md5(base64_encode($_POST['password']));
@$uq=md5($_POST['uq']);
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}
    $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
    $result = $dblink->query("SELECT * FROM `user` where `uniqid` = '$uq'");
    $row = $result->fetch_assoc();
    $rows=array() ;
    $rows['level']=$row['level'];
    $rows['xp']=$row['xp'];
    $rows['avatar']=$row['avatar'];
    $rows['displayname']=$row['displayname'];
    $rows['username']=$row['username'];
    $username2=$row['username'];
     $username1=$username;
  $aa=0;
  $result1s = $dblink->query("SELECT * FROM friendlist WHERE `user_id_1` = '$username1' and `user_id_2`='$username2' and `status`='1';");
  $row1s = $result1s->num_rows;
  $result2s = $dblink->query("SELECT * FROM friendlist WHERE `user_id_1` = '$username2' and `user_id_2`='$username1' and `status`='1';");
  $row2s = $result2s->num_rows;
  $ss = $row1s+ $row2s;
    $result3s = $dblink->query("SELECT * FROM friendlist WHERE `user_id_1` = '$username1' and `user_id_2`='$username2' and `status`='0';");
  $row3s = $result3s->num_rows;
    if($ss>0){
     $aa=1;
    }
        if($row3s==1){
     $aa=2;
    }
    $rows['status']=$aa;
    echo json_encode($rows);
}
header('Content-Type: application/json');
?>