<?php

include("config.php");
//Check connection was successful
  if ($dblink->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }
   @$username =$_POST['username'];

//Fetch 3 rows from actor table
  $result1 = $dblink->query("SELECT * FROM friendlist where `user_id_1`='$username' and `status` != '0' LIMIT 100");
  $result2 = $dblink->query("SELECT * FROM friendlist where  `user_id_2`='$username'ORDER BY `friendlist`.`status` ASC LIMIT 100 ");

//Initialize array variable
  $dbdata = array();

//Fetch into associative array
$i=0;
    while ( $row2 = $result2->fetch_array())  {
        $user2= $row2['user_id_1'];
  $resultu2 = $dblink->query("SELECT uniqiddecode,displayname,avatar,xp,level,username FROM `user` where `username` = '$user2' ");
   $rowu2 = $resultu2->fetch_assoc();
   $dbdata[$i]['uniqiddecode']=$rowu2['uniqiddecode'];
   $dbdata[$i]['displayname']=$rowu2['displayname'];
   $dbdata[$i]['avatar']=$rowu2['avatar'];
   $dbdata[$i]['xp']=$rowu2['xp'];
   $dbdata[$i]['level']=$rowu2['level'];
   $dbdata[$i]['username']=$rowu2['username'];
   $dbdata[$i]['status']=$row2['status'];
   $i++;
  }
  while ( $row1 = $result1->fetch_array())  {
        $user1= $row1['user_id_2'];
  $resultu1 = $dblink->query("SELECT uniqiddecode,displayname,avatar,xp,level,username FROM `user` where `username` = '$user1' ");
   $rowu1 = $resultu1->fetch_assoc();

   $dbdata[$i]['uniqiddecode']=$rowu1['uniqiddecode'];
   $dbdata[$i]['displayname']=$rowu1['displayname'];
   $dbdata[$i]['avatar']=$rowu1['avatar'];
   $dbdata[$i]['xp']=$rowu1['xp'];
   $dbdata[$i]['level']=$rowu1['level'];
   $dbdata[$i]['username']=$rowu1['username'];
   $dbdata[$i]['status']=$row1['status'];

    $i++;
  }


//Print array in JSON format
 echo json_encode($dbdata);
header('Content-Type: application/json');
?>