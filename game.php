<?php
include_once("config.php");
@$username=$_POST['username'];
//@$username="rezamm1";
@$password=md5(base64_encode($_POST['password']));
//@$password=md5(base64_encode('reza'));
@$mode=$_POST['mode'];
@$time=time();
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}           $i=0;
          $rows=array();
         $result1 = $dblink->query("SELECT `username` FROM `user` where `username` = '$username' and `password`='$password'");
    $row1 = $result1->num_rows;
if($row1==1){
$resultg = $dblink->query("SELECT * FROM `game` where `user_1` = '$username' or `user_2` = '$username' ");

 while( $rowg = $resultg->fetch_array())
 {

     $username1=$rowg['user_1'];
     $username2=$rowg['user_2'];
     $rowsf=$rowg['status'];
     if($username1==$username and $rowsf==3){}else{
     $user_point_1=$rowg['user_point_1'];
    $user_point_2=$rowg['user_point_2'];
     $time=$rowg['time'];
     $times=time()-$time;
      if($times<=60){
       $rows[$i]['time']=$times;
       $rows[$i]['times']="S";
      }
      if($times>60 and $times<=3600){
       $rows[$i]['time']=(floor($times/60));
       $rows[$i]['times']="Min";
      }
      if($times>3600 and $times<=86400){
       $rows[$i]['time']=(floor(($times/60)/60));
       $rows[$i]['times']="H";
      }
      if($times>86400){
      $rows[$i]['time']=(floor((($times/60)/60)/24));
      $rows[$i]['times']="Day";
      if((($times/60)/60)/24 >=2){
        $rows[$i]['time']=(floor((($times/60)/60)/24));
        $rows[$i]['times']="Days";
      }
      }
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
     $rows[$i]['user_point_1']=$username1up;
     $rows[$i]['user_point_2']=$username2up;
  $rows[$i]['winer']=$rowg['winer'];
  $rows[$i]['status']=$rowg['status'];
  $rows[$i]['level']=$rowg['level'];
  $rows[$i]['id']=$rowg['id'];

  $resultr = $dblink->query("SELECT * FROM `user` where `username` = '$username2u' ");
    $rowr = $resultr->fetch_assoc();
        $name=$rowr['displayname'];
    $rows[$i]['userblevel']=$rowr['level'];
    $rows[$i]['userbavatar']=$rowr['avatar'];
    $rows[$i]['userbdisplayname']=$rowr['displayname'];
        if(strlen($name)<=1){
            $rows[$i]['userblevel']=0;
    $rows[$i]['userbavatar']=0;
    $rows[$i]['userbdisplayname']=0;

    }

 $i++;  } 
 }

     }
    echo json_encode($rows);
    header('Content-Type: application/json');
?>