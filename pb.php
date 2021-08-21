<?php
include_once("config.php");
@$username=$_POST['username'];

@$password=md5(base64_encode($_POST['password']));

@$mode=$_POST['mode'];
@$gameid=$_POST['id'];

@$time=time();
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}           $i=0;
          $rows=array();
         $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){

        $err=array();
        $result1s = $dblink->query("SELECT * FROM `game` WHERE `id`='$gameid'");
        $row1s = $result1s->fetch_assoc();
    $username1=$row1s['user_1'];
    $username2=$row1s['user_2'];
    $user_point_1=$row1s['user_point_1'];
    $user_point_2=$row1s['user_point_2'];
     $username1u='';
     $username2u='';
     $username1up='';
     $username2up='';
          if($username1==$username){
              $username1u=$username1;
              $username2u=$username2;
              $username1up=$user_point_1;
              $username2up=$user_point_2;
              }

          if($username2==$username){
          $username1u=$username2;
          $username2u=$username1;
          $username1up=$user_point_2;
          $username2up=$user_point_1;
          }


                 $result1s = $dblink->query("SELECT `balance` FROM `user` where `username` = '$username'");
    $row1s = $result1s->fetch_assoc();

    $err['p1']=$username1up;
    $err['p2']=$username2up;
    $err['balance']=$row1s['balance'];

}


    echo json_encode($err);
    header('Content-Type: application/json');

?>