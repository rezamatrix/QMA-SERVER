<?php
include_once("config.php");
@$username=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}
$i=0;
    $result = $dblink->query("SELECT * FROM `user` where `username` = '$username' AND `password`='$password'");
    $row = $result->fetch_assoc();
       $result2 = $dblink->query("SELECT xp,username FROM `user` ORDER BY `user`.`xp` DESC");
       $ii=1;
     while ( $row2 = $result2->fetch_array()){
         if($username==$row2['username']){
          break;
         }else{
              $ii++;
         }

     }
    $rows=array() ;
   $rows[$i]['displayname']=$row['displayname'];
   $rows[$i]['avatar']=$row['avatar'];
   $rows[$i]['xp']=$row['xp'];
   $rows[$i]['level']=$row['level'];
   $rows[$i]['username']=$row['username'];
   $rows[$i]['chart']=$ii;
   $i++;
  $resultu2 = $dblink->query("SELECT uniqiddecode,displayname,avatar,xp,level,username FROM `user` ORDER BY `user`.`xp` DESC LIMIT 10 ");

     while ( $rowu2 = $resultu2->fetch_array())  {
   $rows[$i]['displayname']=$rowu2['displayname'];
   $rows[$i]['avatar']=$rowu2['avatar'];
   $rows[$i]['xp']=$rowu2['xp'];
   $rows[$i]['level']=$rowu2['level'];
   $rows[$i]['username']=$rowu2['username'];

   $rows[$i]['chart']=$i;
   $i++;
  }
    echo json_encode($rows);
    header('Content-Type: application/json');
?>