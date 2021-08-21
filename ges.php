<?php
include_once("config.php");
function uniqids(){
   $text='1 2 3 4 5 6 7 8 9 0 q w e r t y u i o p a s d f g h j k l z x c v b n m Q W E R T Y U I O P A S D F G H J K L Z X C V B N M';
 $text= explode(' ',$text);
   $text1=$text[rand(0,61)];
   $text2=$text[rand(0,61)];
   $text3=$text[rand(0,61)];
   $text4=$text[rand(0,61)];
   $text5=$text[rand(0,61)];
   $text13=$text1.$text2.$text3.$text4.$text5;
$uniqids1=md5($text13);
$uniqids2=$text13;
return array($uniqids1,$uniqids2);
}
function usern(){
@$username='Guest'.rand(99999,99999999);
return $username;
}

@$password=md5(base64_encode('kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkjjjjjjjjjjjjjjjjjjjjjjjjifuktdjrydsyhrstrhst'));
$date_singup=time();
$lastseen=time();
 $uniqid=uniqids();
while(true){
$result = $dblink->query("SELECT `uniqid` FROM `user` where `uniqid` = '$uniqid[0]'");
   $row = $result->num_rows;

 if ($row==0){break;}else{$uniqid=uniqids(); }
   }
   @$username=usern();
   while(true){
$result = $dblink->query("SELECT `username` FROM `user` where `username` = '$username'");
   $row = $result->num_rows;

 if ($row==0){break;}else{@$username=usern(); }
   }
         $rand=rand(1,10); 
$dblink->query("INSERT INTO `user` (`phonenumber`, `username`, `password`, `level`, `xp`, `balance`, `date_singup`, `lastseen`, `avatar`, `displayname`, `uniqid` , `uniqiddecode`) VALUES ('0', '$username', '$password', '0', '0', '0', '$date_singup', '$lastseen', '$rand', '$username', '$uniqid[0]', '$uniqid[1]');");
    $err=array();
    $err['succse']='1';
    $err['status']='ok!';
    $err['username']=$username;
     echo json_encode($err);
header('Content-Type: application/json');
?>