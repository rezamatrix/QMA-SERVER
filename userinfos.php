<?php
include_once("config.php");
@$username=$_POST['username'];


    $result = $dblink->query("SELECT * FROM `user` where `username` = '$username' ");
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
    $rows['uniqiddecode']=$row['uniqiddecode'];
    $rows['chart']=$i;
    echo json_encode($rows);
    header('Content-Type: application/json');
?>