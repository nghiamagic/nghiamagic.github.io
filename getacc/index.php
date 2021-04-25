<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('../PHPMailer/src/Exception.php');
require ('../PHPMailer/src/PHPMailer.php');
require ('../PHPMailer/src/SMTP.php');
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
        $hethan = date('Y-m-d H:i:s', strtotime('+4 hour'));
    }elseif($time == 2){
        $vnd = 10000;
        $hethan = date('Y-m-d H:i:s', strtotime('+10 hour'));
    }elseif($time == 3){
        $vnd = 20000;
        $hethan = date('Y-m-d H:i:s', strtotime('+24 hour'));
    }elseif($time == 4){
        $vnd = 50000;
        $hethan = date('Y-m-d H:i:s', strtotime('+72 hour'));
    }elseif($time == 5){
        $vnd = 100000;
        $hethan = date('Y-m-d H:i:s', strtotime('+168 hour'));
    }elseif($time == 6){
        $vnd = 5000;
        $hethan = date('Y-m-d H:i:s', strtotime('+10 hour'));
    }
    }
        $not = mysql_result(mysql_query("SELECT COUNT(*) FROM `baidang` WHERE `id` = '$id'"), 0);
        $query = mysql_fetch_array(mysql_query("SELECT * FROM `baidang` WHERE `id` = '$id'"));
        $lst = mysql_result(mysql_query("SELECT COUNT(*) FROM `lichsuthue` WHERE `idacc` = '$id'"), 0);
        $lstt = mysql_fetch_assoc(mysql_query("SELECT * FROM `lichsuthue` WHERE `idacc` = '$id' AND `uid` = '$uid'"));
        $dem = mysql_num_rows(mysql_query("SELECT * FROM `lichsuthue` WHERE `uid`='".$uid."'"));
        $demm = mysql_num_rows(mysql_query("SELECT * FROM `lichsuthue` WHERE `hethan`='on' AND `uid`='".$uid."'"));
    if(!isset($uid)){
        $arr = array('error' => 1, 'msg' => 'Bạn Cần Phải Đăng Nhập Vào Website Mới Có Thể Thuê ACCOUNT', 'link' => '');
    }elseif($data['admin'] == 2){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Chưa Được Kích Hoạt. Vui Lòng Liên Hệ Admin Để Xác Thực Tài Khoản.', 'link' => '');       
    }elseif(($time <= 0) OR ($time >= 7)){
        $arr = array('error' => 1, 'msg' => 'Vui Lòng Chọn Lại Thời Gian Thuê', 'link' => '');   
    }elseif($not == 0){
       $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG #'.$id.' Không Tồn Tại Trên Hệ Thống', 'link' => '');       
    }elseif($query['trangthai'] == 'off'){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản PUBG #'.$id.' Đã Có Người Thuê', 'link' => '');      
    }elseif(($data['vnd'] < 20000) && ($time == 1)){
       $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Phải Trên 20.000VNĐ Mới Được Thuê Gói 5k. Vui Lòng Nạp Thêm', 'link' => '');      
    }elseif(($data['vnd'] < 50000) && ($time == 6)){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Phải Trên 50.000VNĐ Mới Được Thuê Gói Combo Đêm. Vui Lòng Nạp Thêm', 'link' => '');      
    }elseif(($dem >= 3) && ($demm >= 4)){
        $arr = array('error' => 1, 'msg' => 'Mỗi Tài Khoản Chỉ Được Thuê Cùng Lúc 3 Account. Vui Lòng Sử Dụng Hết Giờ Rồi Thuê Tiếp.', 'link' => '');      
    }elseif($data['vnd'] < $vnd){
        $arr = array('error' => 1, 'msg' => 'Tài Khoản Của Bạn Không Đủ Tiền. Vui Lòng Nạp Thêm', 'link' => '');      
    }elseif(($lst > 0) && ($lstt['uid'] == $uid)){
        $amail = new PHPMailer(true);
        $mail = $data['email'];
        mysql_query("UPDATE `lichsuthue` SET `matkhau` = '".$query['matkhau']."', `hethan`='on', `gia` = '".$vnd."', `date` = '".date("H:i Y-m-d")."' WHERE `idacc` = '".$id."' AND `uid` = '".$uid."'");
        mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` - '".$vnd."' WHERE `uid`='".$uid."'");
        mysql_query("UPDATE `baidang` SET `hethan` = '".$hethan."', `trangthai` = 'off' WHERE `id`='".$id."'");
        try{
            $amail->isSMTP(); // enable SMTP
            $amail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $amail->SMTPAuth = true;  // authentication enabled
            $amail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $amail->Host = 'smtp.gmail.com';
            $amail->Port = 465; 
            $amail->Username = 'nghiasuperat123456@gmail.com';  
            $amail->Password = 'nghiasieu12';           
            $amail->SetFrom('org@org.com');
            $amail->isHTML(true);  
            $amail->Subject = 'Tai khoan thue';
            //$mail->Body = 'Xin Chào: '. $email .' Yêu Cầu Đổi Mật Khẩu Của Bạn Trên WebSite '. $home .' Đã Được Thực Hiện
            //Mật Khẩu Mới Của Bạn Là: '. $rdpw.'          Thank You :* :*' ;
            $amail->Body  = '<!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <title>Test mail</title>
              <style>
              h1{
                  font-size: 80%;
              }
                .wrapper {
                  padding: 20px;
                  color: #444;
                  font-size: 1.3em;
                }
                a {
                  background: #592f80;
                  width: 200px;
                  text-decoration: none;
                  padding: 8px 15px;
                  border-radius: 5px;
                  color: #fff;
                }
              </style>
            </head>
            <body>
              <div class="wrapper">
              <h1>From: noreply@thueacc.com</h1>
              <h3><strong> Cảm Ơn Bạn Đã Thuê Tài Khoản Tại Shop</strong> <h3>
                <p>Tài khoản : <b style=\"color:red\">  '.$query['taikhoan'].'</b></p>
                <p>Mật khẩu  :<b style=\"color:red\">   '.$query['matkhau'].'</b></p>
              </div>
            </body>
            </html>';
            $amail->AddAddress($mail);
            $amail->send();
            //echo '<script>swal("Thuê Thành Công" ,"Tài khoản : '.$query['taikhoan'].'. Vui Lòng Đăng Nhập Gmail Để Xem Mật Khẩu." ,"success") </script>';
            $datamsg = "<span style=\"color:black\"> Tài khoản : <b style=\"color:red\">  ".$query['taikhoan']."</b> Vui Lòng Check Mail :<b style=\"color:red\">   ".$mail."</b>
            <hr style=\" color: red \">";
            $arr = array('error' => 0, 'msg' => $datamsg, 'link' => '');
            echo '<meta http-equiv=refresh content="5; URL=/dangnhap.html">';
            }
            catch (Exception $e) {
                echo '<script>swal("Lỗi", "Không Thể Gửi Được Mail" ,"error") </script>';
                echo ' Mailer Error: ', $amail->ErrorInfo;
            }
    }else{
        $amail = new PHPMailer(true);
        $mail = $data['email'];
        date_default_timezone_set("UTC");
        mysql_query("INSERT INTO `lichsuthue`
            (uid, name, loainick, idacc, taikhoan, matkhau, hethan, gia, date)
        VALUES
            ('".$uid."', '".addslashes($data['name'])."', '".$query['loainick']."', '".$id."', '".$query['taikhoan']."', '".$query['matkhau']."', 'on', '".$vnd."', '".date("H:i Y-m-d", strtotime("now -7 GMT"))."')");
        mysql_query("UPDATE `thanhvien` SET `vnd` = `vnd` - '".$vnd."' WHERE `uid`='".$uid."'");
        mysql_query("UPDATE `baidang` SET `hethan` = '".$hethan."', `trangthai` = 'off' WHERE `id`='".$id."'");
        try{
            $amail->isSMTP(); // enable SMTP
            $amail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $amail->SMTPAuth = true;  // authentication enabled
            $amail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $amail->Host = 'smtp.gmail.com';
            $amail->Port = 465; 
            $amail->Username = 'nghiasuperat123456@gmail.com';  
            $amail->Password = 'nghiasieu12';           
            $amail->SetFrom('org@org.com');
            $amail->isHTML(true);  
            $amail->Subject = 'Tai khoan thue';
            //$mail->Body = 'Xin Chào: '. $email .' Yêu Cầu Đổi Mật Khẩu Của Bạn Trên WebSite '. $home .' Đã Được Thực Hiện
            //Mật Khẩu Mới Của Bạn Là: '. $rdpw.'          Thank You :* :*' ;
            $amail->Body  = '<!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <title>Test mail</title>
              <style>
              h1{
                  font-size: 80%;
              }
                .wrapper {
                  padding: 20px;
                  color: #444;
                  font-size: 1.3em;
                }
                a {
                  background: #592f80;
                  width: 200px;
                  text-decoration: none;
                  padding: 8px 15px;
                  border-radius: 5px;
                  color: #fff;
                }
              </style>
            </head>
            <body>
              <div class="wrapper">
              <h1>From: noreply@thueacc.com</h1>
              <h3><strong> Cảm Ơn Bạn Đã Thuê Tài Khoản Tại Shop</strong> <h3>
                <p>Tài khoản : <b style=\"color:red\">  '.$query['taikhoan'].'</b></p>
                <p>Mật khẩu  :<b style=\"color:red\">   '.$query['matkhau'].'</b></p>
              </div>
            </body>
            </html>';
            $amail->AddAddress($mail);
            $amail->send();
            //echo '<script>swal("Thuê Thành Công" ,"Tài khoản : '.$query['taikhoan'].'. Vui Lòng Đăng Nhập Gmail Để Xem Mật Khẩu." ,"success") </script>';
            $datamsg = "<span style=\"color:black\"> Tài khoản : <b style=\"color:red\">  ".$query['taikhoan']."</b> Vui Lòng Check Mail :<b style=\"color:red\">   ".$mail."</b>
            <hr style=\" color: red \">";
            $arr = array('error' => 0, 'msg' => $datamsg, 'link' => '');
            
            }
            catch (Exception $e) {
                echo '<script>swal("Lỗi", "Không Thể Gửi Được Mail" ,"error") </script>';
                echo ' Mailer Error: ', $amail->ErrorInfo;
            }
    }
        echo json_encode($arr);
?>
