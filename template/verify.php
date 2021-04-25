
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if($_SESSION['id']){
if(isset($_GET['id']) && $_GET['id']){
  $sql = "SELECT * FROM `acc_store` WHERE `id`='".$_GET['id']."' AND `status` = '0'";
    
  // $sqls = "SELECT * FROM `acc_store` WHERE `game_id`='".$game_set['id']."' AND `status`='1' ";
  // $record = mysql_fetch_assoc($result);
  // $result = mysql_query($sqls);
  $acc = mysql_query($sql);
  while($acc_arr = mysql_fetch_assoc($acc)){
     $price = $acc_arr['prices'];  
     $username = $acc_arr['username'];
     $password = $acc_arr['password'];
     $gameid = $acc_arr['game_id'];   
  }
  $game = mysql_query("SELECT * FROM `game` WHERE `id` ='".$gameid."' ");
    $game_set = mysql_fetch_assoc($game);
    $gametype = $game_set['name'];
  $s = "SELECT * FROM `thanhvien` WHERE `uid`='".$_SESSION['id']."'";
     $x = mysql_query($s);
     while($mem = mysql_fetch_assoc($x)){
       $balance = $mem['vnd'];
       $email  = $mem['email'];
      
   }
  
  try {
    $newbalance = floatval($balance);
    $adidas = floatval($price);
  } catch (Throwable $th) {
    throw $th;
  }
  if($adidas > $newbalance){
    echo '<script>swal("Thông báo", "Tài khoản không đủ số dư để thanh toán." ,"error") </script>';
  }
  else{
    $amail = new PHPMailer(true);
    $newbalance = $newbalance - $adidas;
    mysql_query("UPDATE `thanhvien` SET `vnd`='".$newbalance."' WHERE `uid`='".$_SESSION['id']."'");
    mysql_query("UPDATE `acc_store` SET `status`='1' WHERE `id`='".$_GET['id']."'");
    $message = " Tên đăng nhập : '".$username."' , Mật khẩu : '".$password."'";
    
    //Doan nay de gui mail ma` t chua lam` xong
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
      $amail->Subject = 'Link Kich Hoat';
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
        <p>Tài khoản : <b style=\"color:red\">  '.$username.'</b></p>
        <p>Mật khẩu  :<b style=\"color:red\">   '.$password.'</b></p>
        </div>
      </body>
      </html>';
      $amail->AddAddress($email);
      $amail->send();
    }
    catch (Exception $e) {
        echo '<script>swal("Lỗi", "Không Thể Gửi Được Mail" ,"error") </script>';
        echo ' Mailer Error: ', $amail->ErrorInfo;
    }
    date_default_timezone_set("UTC");
    mysql_query("INSERT INTO `lichsumua` 
        (`uid`, `name`, `loainick`, `taikhoan`, `matkhau`, `gia`, `date`)
    VALUES
        ('".$uid."', '".addslashes($data['name'])."', '".$gametype."', '".$username."', '".$password."', '".$price."', '".date('h:i:s a - Y/m/d', strtotime("now -7 GMT"))."')");
   // mail($email,"Mua tài khoản tại shop acc nghiasieu",$mess);
    echo '<script>swal("Thông báo"," mua thành công vui lòng check mail  " ,"success") </script>';
    echo '<meta http-equiv=refresh content="3; URL=/trangchu.html">';
  }
}

}else{
echo '<script>swal("Thông báo", "Vui lòng Đăng Nhập để thực hiện mua tài khoản." ,"error") </script>';
echo '<meta http-equiv=refresh content="1; URL=/dangnhap.html">';


}

