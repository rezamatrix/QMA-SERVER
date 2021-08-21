<?php
include_once("config.php");
@$username=$_POST['username'];
//@$username="rezamm1";
@$password=md5(base64_encode($_POST['password']));
//@$password=md5(base64_encode('reza'));
@$mode=$_POST['mode'];
@$gameid=$_POST['id'];
//@$gameid=10;
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
        $id= $row1s['id'];
        $user_1=$row1s['user_1'];
        $user_2=$row1s['user_2'];
        $username1u='';
        $username2u='';
          if($user_1==$username){
              $username1u=$user_1;
              $username2u=$user_2;

              }

          if($user_2==$username){
          $username1u=$user_2;
          $username2u=$user_1;

          }
        $resulta1 = $dblink->query("SELECT * FROM `answer`  where `game_id`='$id'  and `user_id`='$username1u' and `time` != 0;");
        $rowa1 = $resulta1->num_rows;
        $resulta2 = $dblink->query("SELECT * FROM `answer`  where `game_id`='$id'  and `user_id`='$username2u' and `time` != 0;");
        $rowa2 = $resulta2->num_rows;
        if($rowa1 <3){
        $err['succse']='1';
        $err['status']='next or co!';
        }
        if($rowa1==3 and $rowa2<3){
        $err['succse']='0';
        $err['status']='next or co!';
        }
        if($rowa1 >=3 and $rowa1 <6){
        $err['succse']='1';
        $err['status']='next or co!';
        }
        if($rowa1==6 and $rowa2<6){
        $err['succse']='0';
        $err['status']='next or co!';
        }
        if($rowa1 >=6 and $rowa1 <9){
        $err['succse']='1';
        $err['status']='next or co!';
        }
        if($rowa1==9 and $rowa2<9){
        $err['succse']='0';
        $err['status']='next or co!';
        }
        if($rowa1 >=9 and $rowa1 <12){
        $err['succse']='1';
        $err['status']='next or co!';
        }
        if($rowa1==12 and $rowa2<12){
        $err['succse']='0';
        $err['status']='next or co!';
        }
        if($rowa1 >=12 and $rowa1 <15){
        $err['succse']='1';
        $err['status']='next or co!';
        }
        if($rowa1 ==15){
        $err['succse']='0';
        $err['status']='next or co!';
        }
     }
    echo json_encode($err);
    header('Content-Type: application/json');

?>