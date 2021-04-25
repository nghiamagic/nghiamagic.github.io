<?php
session_start();
require('../config.php');
$baidang = mysql_query("SELECT * FROM `baidang` ORDER BY `id` DESC");
while($post = mysql_fetch_assoc($baidang)):
  $hethan = (strtotime($post['hethan']) - strtotime(date("Y-m-d H:i:s")));
  $id = $post['id'];
  $pass = $post['matkhau'];
  $timedat = $post['timedat'];
  $nguoidat = $post['nguoidat'];
  $time = (strtotime($post['hethan']));
    if($timedat == 4){
        $timee = date('Y-m-d H:i:s', strtotime('+4 hour'));
    }elseif($timedat == 10){
        $timee = date('Y-m-d H:i:s', strtotime('+10 hour'));
    }elseif($timedat == 24){
        $timee = date('Y-m-d H:i:s', strtotime('+24 hour'));
    }elseif($timedat == 72){
        $timee = date('Y-m-d H:i:s', strtotime('+72 hour'));
    }elseif($timedat == 168){
        $timee = date('Y-m-d H:i:s', strtotime('+168 hour'));
    }
    if(($nguoidat != NULL) && ($hethan <= 0) && $time != (strtotime("0000-00-00 00:00:00"))){
      mysql_query("UPDATE `baidang` SET `dattruoc`='off', `doipass`='off', `hethan`='".$timee."', `timedat`='', `nguoidat`='' WHERE `nguoidat`='".$nguoidat."' AND `id`='".$id."'");
        mysql_query("UPDATE `lichsuthue` SET `matkhau`='".$pass."' WHERE `idacc`='".$id."'");
        echo 'Thành Công 3 ID: '.$id.'<br>';
    }else{
        echo'K Thành Công 3 ID: '.$id.'<br>';
    }
endwhile;
