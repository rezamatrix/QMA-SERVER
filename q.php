<?php
include_once("config.php");
@$username=$_POST['username'];
//@$username="rezamm1";
@$password=md5(base64_encode($_POST['password']));
//@$password=md5(base64_encode('reza'));
@$mode=$_POST['mode'];
@$gameid=$_POST['id'];
//@$gameid=10;
@$time=time()+25;


if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}           $i=0;
          $rows=array();
         $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
             $resulta1 = $dblink->query("SELECT * FROM `answer`  where `game_id`='$gameid'   and `time` != 0;");
        $rowa1 = $resulta1->num_rows;

    $result1s = $dblink->query("SELECT * FROM `answer` where `user_id`='$username' and `game_id`='$gameid' and `time`='0' ORDER BY `answer`.`round` ASC ");
    $row1s = $result1s->fetch_assoc();
     $qid=$row1s['question_id'];
     $id=$row1s['id'];
     $round=$row1s['round'];
                      $result1ss = $dblink->query("SELECT `balance` FROM `user` where `username` = '$username'");
    $row1ss = $result1ss->fetch_assoc();
     $resultq = $dblink->query("SELECT * FROM `question` where `id`='$qid' ");
     $rowq = $resultq->fetch_assoc();
     $q=$rowq['ques_tion'];
     $o1=$rowq['option_1'];
     $o2=$rowq['option_2'];
     $o3=$rowq['option_3'];
     $o4=$rowq['option_4'];
     $a=$rowq['answer'];
     $json=array();
     $json['q']=$q;
     $json['o1']=$o1;
     $json['o2']=$o2;
     $json['o3']=$o3;
     $json['o4']=$o4;
     $json['a']=$a;
     $json['r']=$round;
     $json['cr']=$rowa1;
     $json['id']=$id;
     $json['balance']=$row1ss['balance'];

     $dblink->query("UPDATE `answer` SET  `time` = '$time'  WHERE `id` = '$id';");
}
    echo json_encode($json);
    header('Content-Type: application/json');

?>