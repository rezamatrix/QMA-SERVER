<?php
include_once("config.php");
@$username=$_POST['username'];
@$usernamse=$_POST['username'];
@$password=md5(base64_encode($_POST['password']));
@$mode=$_POST['mode'];
@$time=time();
if($mode=='ges'){
        @$password='ae8779c0eb1dd5459ba2e1440bf0d384';
}
    $result = $dblink->query("SELECT * FROM `game` where `status` = '0' and `user_1` != '$username'");
    $row = $result->num_rows;

       $rows=array() ;
               $rows['succse']='1';
        $rows['status']='Something went wrong';
          if($row==0){
                                           $result1 = $dblink->query("SELECT * FROM `game` where `status` = '0' and `user_1` = '$username' ORDER BY `id` ASC LIMIT 1");
                $row1 = $result1->fetch_assoc();
        $id= $row1['id'];
                        $rows['succse']='1';
           $rows['status']='room created!';
           $rows['id']=$id;
           $resultu = $dblink->query("SELECT * FROM `game` where `status` = '0' and `user_1` = '$username'");
           $rowu = $resultu->num_rows;
           if($rowu<=0){
                         $dblink->query("INSERT INTO `game` (`user_1`, `user_2`, `time`, `winer`, `status`, `level`, `turn`, `used`, `user_point_1`, `user_point_2`) VALUES ('$username', '', '$time', '', '0', '0', '0', '0', '0', '0');");
           $rows['succse']='1';
           $rows['status']='room creat!';
           $rows['id']=$dblink->insert_id;
           }

                  }

             if($row>0){
                             $result1sa = $dblink->query("SELECT * FROM `game` where `status` = '0' and `user_1` != '$username' ORDER BY `id` ASC LIMIT 1");
                $row1sa = $result1sa->fetch_assoc();
        $idss= $row1sa['id'];
        $dblink->query("UPDATE `game` SET  `status` = '1'  WHERE `id` = '$idss';");
        $dblink->query("UPDATE `game` SET `user_2` = '$usernamse'   WHERE `id` = '$idss';");
        $rows['succse']='1';
        $rows['status']='you are now in game';
         $rows['id']=$idss;
             }

    echo json_encode($rows);
    header('Content-Type: application/json');
?>