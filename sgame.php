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
    $err['succse']='1';
    $err['status']='i dont know?!';

$result1 = $dblink->query("SELECT * FROM `answer` WHERE `game_id`='$gameid'");
    $row1 = $result1->num_rows;
    if($row1>1){
         $err=array();
    $err['succse']='1';
    $err['status']='created!';
    }else{

    $result1s = $dblink->query("SELECT * FROM `game` WHERE `id`='$gameid'");
    $row1s = $result1s->fetch_assoc();
    $id= $row1s['id'];
    $user_1=$row1s['user_1'];
    $user_2=$row1s['user_2'];
for ($i=0;$i<15;$i++) {
    $uniqid=newq();
     while(true){
$result = $dblink->query("SELECT `id` FROM `answer` where `id` = '$gameid' and `question_id`='$uniqid';");
   $row = $result->num_rows;

 if ($row==0){break;}  else{$uniqid=newq(); }
   }
$r=$i+1;
    $dblink->query("INSERT INTO `answer` (`user_id`, `game_id`, `question_id`, `round`, `question_number`, `ans`, `status`) VALUES ('$user_1', '$gameid', '$uniqid', '$r', '0', '0', '0');");
    $dblink->query("INSERT INTO `answer` (`user_id`, `game_id`, `question_id`, `round`, `question_number`, `ans`, `status`) VALUES ('$user_2', '$gameid', '$uniqid', '$r', '0', '0', '0');");
}
 $dblink->query("UPDATE `game` SET  `status` = '1'  WHERE `id` = '$gameid';");
 $dblink->query("UPDATE `game` SET   `level`='1'  WHERE `id` = '$gameid';");

    $err=array();
    $err['succse']='2';
    $err['status']='q creat!';
    }
     }
    echo json_encode($err);
    header('Content-Type: application/json');
   function newq(){
       include("config.php");
      $result1s = $dblink->query("SELECT `id` FROM `question` ORDER BY RAND() LIMIT 1 ");
   $row1s = $result1s->fetch_assoc();
   $reza=$row1s['id'] ;
return $reza;
}
?>