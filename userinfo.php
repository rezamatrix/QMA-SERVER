<?php
include_once("config.php");
@$username=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384'; 
}
    $result = $dblink->query("SELECT * FROM `user` where `username` = '$username' AND `password`='$password'");
    $row = $result->fetch_assoc();
       $result2 = $dblink->query("SELECT xp,username FROM `user` ORDER BY `user`.`xp` DESC");
       $i=1;
     while ( $row2 = $result2->fetch_array()){
         if($username==$row2['username']){
          break;
         }else{
              $i++;
         }

     }
    $rows=array() ;
    $rows['level']=$row['level'];
    $rows['xp']=$row['xp'];
    $rows['balance']=$row['balance'];
    $rows['date_singup']=$row['date_singup'];
    $rows['lastseen']=$row['lastseen'];
    $rows['avatar']=$row['avatar'];
    $rows['displayname']=$row['displayname'];
    $rows['uniqiddecodeuis']=$row['uniqiddecode'];
    $rows['chart']=$i;
    $result = $dblink->query("SELECT * FROM `game` where (`status` = '0' or `status` = '1' or `status` = '3') and (`user_1` = '$username' or `user_2` = '$username')");
    $row = $result->num_rows;
     $rows['game']=$row;
  $result1 = $dblink->query("SELECT * FROM friendlist where `user_id_2`='$username' and `status` = '0' LIMIT 100");
     $rowsddd = $result1->num_rows;
          $rows['addf']=$rowsddd;
    echo json_encode($rows);
    header('Content-Type: application/json');
?>