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
    if(isset($_POST['time']) && is_numeric($_POST['time'])) {
    $time = addslashes($_POST['time']);
      if($time == 1){
          $vnd = 5000;
          $time = 4;
      }elseif($time == 2){
          $vnd = 10000;
          $time = 10;
      }elseif($time == 3){
          $vnd = 20000;
          $time = 24;
      }elseif($time == 4){
          $vnd = 50000;
          $time = 72;
      }elseif($time == 5){
          $vnd = 100000;
          $time = 168; 
      }
    }
        $not = mysql_result(mysql_query("SELECT COUNT(*) FROM `baidang` WHERE `id` = '$id'"), 0);
        $query = mysql_fetch_array(mysql_query("SELECT * FROM `baidang` WHERE `id` = '$id'"));
        $lst = mysql_result(mysql_query("SELECT COUNT(*) FROM `lichsuthue` WHERE `idacc` = '$id'"), 0);
        $lstt = mysql_fetch_assoc(mysql_query("SELECT * FROM `lichsuthue` WHERE `idacc` = '$id' AND `uid` = '$uid'"));
        $dem = mysql_num_rows(mysql_query("SELECT * FROM `lichsuthue` WHERE `uid`='".$uid."'"));
        $demm = mysql_num_rows(mysql_query("SELECT * FROM `lichsuthue` WHERE `hethan`='on'"));

    if (!isset($uid)){
        $arr = array('error' => 1, 'msg' => 'Bạn Cần Phải Đăng Nhập Vào Website Mới Có Thể Đặt Trước ACCOUNT', 'link' => '');
    }elseif($data['admin']==2){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Chưa Được Kích Hoạt. Vui Lòng Liên Hệ Admin Để Xác Thực Tài Khoản.', 'link' => '');       
    }elseif($query['dattruoc']=="on"){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG Này Đã Được Người Khác Đặt Trước Rồi :(', 'link' => '');       
    }elseif($not==0){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG Này Không Tồn Tại Trên Hệ Thống', 'link' => '');       
    }elseif(addslashes($_POST['time'] == 6)){
        $arr = array('error' => 1, 'msg' => 'Gói Combo Đêm Không Được Đặt Trước', 'link' => '');   
    }elseif(($time <= 0) OR (addslashes($_POST['time']) >= 6)){
        $arr = array('error' => 1, 'msg' => 'Vui Lòng Chọn Lại Thời Gian Thuê', 'link' => '');   
    }elseif(($data['vnd'] < 20000) && (addslashes($_POST['time']) == 1)){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Phải Trên 20.000VNĐ Mới Được Đặt Trước Gói 5k. Vui Lòng Nạp Thêm', 'link' => '');      
    }elseif(($dem >= 3) && ($demm >= 3)){
        $arr = array('error' => 1, 'msg' => 'Mỗi Tài Khoản Chỉ Được Đặt Trước Cùng Lúc 3 Account. Vui Lòng Hủy Account Đã Đặt Hoặc Sử Dụng Hết Giờ Rồi Thuê Tiếp.', 'link' => '');      
    }elseif($data['vnd'] < $vnd){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Không Đủ Tiền. Vui Lòng Nạp Thêm', 'link' => '');      
    }elseif(($lst > 0) && ($lstt['uid'] == $uid)){
        $arr = array('error' => 0, 'msg' => 'Đặt Trước Thành Công', 'link' => ''); 
        mysql_query("UPDATE `lichsuthue` SET `matkhau` = '', `hethan`='on', `gia` = '".$vnd."', `date` = '".date("H:i Y-m-d")."' WHERE `idacc` = '".$id."' AND `uid` = '".$uid."'");
        mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` - '".$vnd."' WHERE `uid`='".$uid."'");
        mysql_query("UPDATE `baidang` SET `dattruoc` = 'on', `nguoidat` = '".$uid."', `timedat` = '".$time."' where `id`='".$id."'");
    }else{
        $arr = array('error' => 0, 'msg' => '', 'link' => ''); 
        date_default_timezone_set("UTC");
        mysql_query("INSERT INTO `lichsuthue`
            (uid, name, loainick, idacc, taikhoan, hethan, gia, date)
        VALUES
            ('".$uid."', '".addslashes($data['name'])."', '".$query['loainick']."', '".$id."', '".$query['taikhoan']."', 'on', '".$vnd."', '".date("H:i Y-m-d", strtotime("now -7 GMT"))."')");
        mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` - ".$vnd." where `uid`='".$uid."'");
        mysql_query("UPDATE `baidang` SET `dattruoc` = 'on', `nguoidat` = '".$uid."', `timedat` = '".$time."' where `id`='".$id."'");
    }
        echo json_encode($arr);
?>
