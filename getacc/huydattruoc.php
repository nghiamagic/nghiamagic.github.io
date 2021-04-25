<?php 
error_reporting(0);
ini_set('display_errors', 0);
session_start();
require('../config.php');
    if(isset($_POST['id']) && is_numeric($_POST['id']))
    {
    $id = addslashes($_POST['id']); // lấy id
    }else{
        exit;
    }
    $a = mysql_fetch_assoc(mysql_query("SELECT * FROM `lichsuthue` WHERE `idacc` = '$id'"));
    $vnd = $a['gia'];
    if($vnd == 5000){
        $tru = $vnd - ($vnd*30/100);
    }elseif($vnd == 10000){
        $tru = $vnd - ($vnd*30/100);
    }elseif($vnd == 20000){
        $tru = $vnd - ($vnd*30/100);
    }elseif($vnd == 35000){
        $tru = $vnd - ($vnd*30/100);
    }elseif($vnd == 50000){
        $tru = $vnd - ($vnd*30/100);
    }elseif($vnd == 100000){
        $tru = $vnd - ($vnd*30/100);
    }
    $not = mysql_result(mysql_query("SELECT COUNT(*) FROM `baidang` WHERE `id` = '$id'"), 0);
    $query = mysql_fetch_array(mysql_query("SELECT * FROM `baidang` WHERE `id` = '$id'"));
    $huy = mysql_result(mysql_query("SELECT COUNT(*) FROM `lichsuthue` WHERE `idacc` = '$id' AND `uid`='$uid' AND `matkhau`=''"), 0);
    if (!isset($uid)){
    $arr = array('error' => 1, 'msg' => 'Bạn Cần Phải Đăng Nhập Vào Website Mới Có Thể Hủy Đặt Trước ACCOUNT', 'link' => '/dangnhap.html');
    }elseif($data['admin']==2){
    $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Chưa Được Kích Hoạt. Vui Lòng Liên Hệ Admin Để Xác Thực Tài Khoản.', 'link' => '');       
    }elseif($not == 0){
    $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG Này Không Tồn Tại Trên Hệ Thống', 'link' => '');       
    }elseif($huy == 0){
    $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG Này Không Tồn Tại Trên Hệ Thống', 'link' => '');       
    }else{
    $arr = array('error' => 0, 'msg' => '', 'link' => '/lichsu-thue.html');
    mysql_query("UPDATE `baidang` SET `dattruoc` = 'off', `nguoidat`='',`timedat`='' WHERE `id`='".$id."'");
    mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` + ".floor($tru)." WHERE `uid`='".$uid."'");
    mysql_query("DELETE FROM `lichsuthue` WHERE `idacc`='".$id."' AND `uid`='".$uid."' AND `matkhau`=''");
    }
    echo json_encode($arr); 
?>
