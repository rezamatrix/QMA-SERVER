<?php
include_once("config.php");
@$username=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
@$gameid=$_POST['id'];
/*@$gameid=10;
@$password=md5(base64_encode('reza'));
@$username="rezamm1";*/
    $rows=array() ;
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}
       $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
    $result1 = $dblink->query("SELECT * FROM `game` where `id` = '$gameid' ");
    $row1 = $result1->fetch_assoc();
    $username1=$row1['user_1'];
    $username2=$row1['user_2'];
    $winer=$row1['winer'];
    $status=$row1['status'];
    $level=$row1['level'];
    $user_point_1=$row1['user_point_1'];
    $user_point_2=$row1['user_point_2'];
     $rows['winer']=$winer;
     $rows['status']=$status;
     $rows['level']=$level;

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
     $rows['user_point_1']=$username1up;
     $rows['user_point_2']=$username2up;
    $result = $dblink->query("SELECT * FROM `user` where `username` = '$username1u' ");
    $row = $result->fetch_assoc();
    $rows['useralevel']=$row['level'];
    $rows['useraavatar']=$row['avatar'];
    $rows['useradisplayname']=$row['displayname'];
    $resultr = $dblink->query("SELECT * FROM `user` where `username` = '$username2u' ");
    $rowr = $resultr->fetch_assoc();
         $name=$rowr['displayname'];

    $rows['userblevel']=$rowr['level'];
    $rows['userbavatar']=$rowr['avatar'];
    $rows['userbdisplayname']=$rowr['displayname'];
    if(strlen($name)<=1){
            $rows['userblevel']=0;
    $rows['userbavatar']=0;
    $rows['userbdisplayname']=0;


    }

        $resulta1 = $dblink->query("SELECT * FROM `answer`  where `game_id`='$gameid'  and `user_id`='$username1u' and `time` != 0;");
        $rowa1 = $resulta1->num_rows;
        $resulta2 = $dblink->query("SELECT * FROM `answer`  where `game_id`='$gameid'  and `user_id`='$username2u' and `time` != 0;");
        $rowa2 = $resulta2->num_rows;
             $rows['cr1']=$rowa1;
             $rows['cr2']=$rowa2;
           $result1s = $dblink->query("SELECT * FROM `answer` where `user_id`='$username1u' and `game_id`='$gameid' and `time`!='0' ORDER BY `answer`.`round` ASC ");

        $rows['usera1']=0;
        $rows['usera2']=0;
        $rows['usera3']=0;
        $rows['usera4']=0;
        $rows['usera5']=0;
        $rows['usera6']=0;
        $rows['usera7']=0;
        $rows['usera8']=0;
        $rows['usera9']=0;
        $rows['usera10']=0;
        $rows['usera11']=0;
        $rows['usera12']=0;
        $rows['usera13']=0;
        $rows['usera14']=0;
        $rows['usera15']=0;
        $rows['userb1']=0;
        $rows['userb2']=0;
        $rows['userb3']=0;
        $rows['userb4']=0;
        $rows['userb5']=0;
        $rows['userb6']=0;
        $rows['userb7']=0;
        $rows['userb8']=0;
        $rows['userb9']=0;
        $rows['userb10']=0;
        $rows['userb11']=0;
        $rows['userb12']=0;
        $rows['userb13']=0;
        $rows['userb14']=0;
        $rows['userb15']=0;
    while($row1s = $result1s->fetch_array()){
      $qid= $row1s['question_id'];
  $anss=$row1s['ans'];
      $resultq = $dblink->query("SELECT * FROM `question` where `id`='$qid' ");
     $rowq = $resultq->fetch_assoc();
     $a=$rowq['answer'];
 $r= $row1s['round'];
        if($anss!=$a){
     $rows['usera'.$r]=1;
    }elseif($a==$anss){$rows['usera'.$r]=2;}

   }
    $result1ss = $dblink->query("SELECT * FROM `answer` where `user_id`='$username2u' and `game_id`='$gameid' and `time`!='0' ORDER BY `answer`.`round` ASC ");

        while($row1ss = $result1ss->fetch_array()){
    $rs= $row1ss['round'];
    $qid= $row1ss['question_id'];
  $anss=$row1ss['ans'];
    $resultq = $dblink->query("SELECT * FROM `question` where `id`='$qid' ");
     $rowq = $resultq->fetch_assoc();
     $a=$rowq['answer'];
     if($anss!=$a){
     $rows['userb'.$rs]=1;
    }elseif($a==$anss){$rows['userb'.$rs]=2;}  }
    echo json_encode($rows);
    header('Content-Type: application/json');
    }
?>