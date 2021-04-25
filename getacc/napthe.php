<?php
@ob_start();
require_once('../config.php');

if (!isset($_SESSION['username'])){
    echo json_encode(array('title' => "Lỗi", 'status' => 'error', 'msg' => "Bạn Chưa Đăng Nhập. Vui Lòng Đăng Nhập Để Nạp Thẻ"));
    exit();
}
    if($data['admin']==2){
    echo json_encode(array('title' => "Lỗi", 'status' => 'error', 'msg' => "Tài Khoản Của Bạn Chưa Được Kích Hoạt. Vui Lòng Liên Hệ Admin Để Xác Thực Tài Khoản."));
    exit();
    }

include 'GB_API.php';

//Lấy thông tin từ Gamebank tại https://sv.gamebank.vn/user/tich-hop-the-cao
$merchant_id = 45050; // interger
$api_user = "59ae7eb2aa52c"; // string
$api_password = "c563b53a15fb848c3c628dbcdf5a4aea"; // string




// truyen du lieu the

$username = $data['name'];
$card_type = !empty($_POST['card_type_id']) ? addslashes($_POST['card_type_id']) : ""; // interger
$pin = !empty($_POST['pin']) ? addslashes($_POST['pin']) : ""; // string
$seri = !empty($_POST['seri']) ? addslashes($_POST['seri']) : ""; // string
$ma_bao_mat = !empty($_POST['ma_bao_mat']) ? addslashes($_POST['ma_bao_mat']) : "";


$gb_api = new GB_API();
$gb_api->setMerchantId($merchant_id);
$gb_api->setApiUser($api_user);
$gb_api->setApiPassword($api_password);
$gb_api->setPin($pin);
$gb_api->setSeri($seri);
$gb_api->setCardType(intval($card_type));
$gb_api->setNote($username); // ghi chu giao dich ben ban tu sinh
$gb_api->cardCharging();
$code = intval($gb_api->getCode());
$info_card = intval($gb_api->getInfoCard());

//change loại thẻ
if($card_type == 1){
  $loaithe = 'VIETTEL';
}elseif($card_type == 2){
  $loaithe = 'MOBIPHONE';
}elseif($card_type == 2){
  $loaithe = 'MOBIPHONE';
}elseif($card_type == 3){
  $loaithe = 'VINAPHONE';
}elseif($card_type == 4){
  $loaithe = 'GATE';
}elseif($card_type == 5){
  $loaithe = 'VCOIN';
}elseif($card_type == 6){
  $loaithe = 'VIETNAMMOBILE';
}elseif($card_type == 7){
  $loaithe = 'ZING';
}elseif($card_type == 8){
  $loaithe = 'BIT';
}elseif($card_type == 9){
  $loaithe = 'MEGACARD';
}elseif($card_type == 10){
  $loaithe = 'ONCASH';
}

// nap the thanh cong
if($code === 0 && $info_card >= 10000) {
    mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` + '".$info_card."' where `uid`='".$uid."'");
    mysql_query("INSERT INTO `lichsunap`
      (id, name, loaithe, serial, mathe, menhgia, date) 
    VALUES 
      ('".$uid."','".addslashes($data['name'])."','".$loaithe."','".$seri."','".$pin."','".$info_card."','".date("H:i Y-m-d")."')");
  echo json_encode(array('title' => "Nạp Thẻ Thành Công", 'status' => 'info', 'msg' => "Mệnh Giá". $info_card ));

}
else {
   
    echo json_encode(array('title' => "Lỗi", 'status' => 'error', 'msg' =>$gb_api->getMsg()));
}
?>