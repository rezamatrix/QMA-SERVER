<?php
include_once("config.php");
@$ans=$_POST['ans'];
@$username=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
@$id=$_POST['id'];
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}


    $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
    $dblink->query("UPDATE `answer` SET `ans` = '$ans' WHERE `id` = '$id';");
    $result1s = $dblink->query("SELECT * FROM `answer`  where `id`='$id' ");
    $row1s = $result1s->fetch_assoc();
     $qid=$row1s['question_id'];
     $gameid=$row1s['game_id'];
     $anss=$row1s['ans'];

     $resultq = $dblink->query("SELECT * FROM `question` where `id`='$qid' ");
     $rowq = $resultq->fetch_assoc();
     $a=$rowq['answer'];
    if($a==$anss){
                $result1s = $dblink->query("SELECT * FROM `game` WHERE `id`='$gameid'");
        $row1s = $result1s->fetch_assoc();
        $user_1=$row1s['user_1'];
        $user_2=$row1s['user_2'];
          if($user_1==$username){
                  @$dblink->query("UPDATE `game` SET `user_point_1` = `user_point_1` + '1'  WHERE `id` = '$gameid' and `user_1`='$username';");


              }

          if($user_2==$username){
                       @$dblink->query("UPDATE `game` SET `user_point_2` = `user_point_2` + '1'  WHERE `id` = '$gameid' and `user_2`='$username';");
          }
    $err=array();
    $err['succse']='1';
    $err['status']='ok!';
    $err['a']=$a;
    $err['b']=$anss;
    } else{
                   $err=array();
    $err['succse']='0';
    $err['status']='ok!';
    }

     echo json_encode($err);

}else{
        $err=array();
    $err['succse']='3';
    $err['status']='wrong!';
     echo json_encode($err);
}
header('Content-Type: application/json');
?>