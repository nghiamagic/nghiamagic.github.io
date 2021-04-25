
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if(isset($_POST['dangky'])){
$name = trim($_POST['name']);
$mail = trim($_POST['email']);
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `thanhvien` WHERE `email`='$mail'"), 0);
         //Kiểm tra xem IP có phải là từ Share Internet  
		if (!empty($_SERVER['HTTP_CLIENT_IP']))     
		  {  
			$ip = $_SERVER['HTTP_CLIENT_IP'];  
		  }  
		//Kiểm tra xem IP có phải là từ Proxy  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
		  {  
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		  }  
		//Kiểm tra xem IP có phải là từ Remote Address  
		else  
		  {  
			$ip = $_SERVER['REMOTE_ADDR'];  
		  }
	    //Block IP
$ipcheck = mysql_query ("SELECT * FROM `thanhvien` WHERE `ip` = '$ip'");
if(mysql_num_rows($ipcheck) > 3){
echo '<script>swal("Lỗi", "Để Tránh Tình Trạng Spam. Hệ Thống Chỉ Cho Phép 1 IP Đăng Ký Tối Đa 3 Tài Khoản" ,"error") </script>';
}else if(!$mail || !$password){
echo '<script>swal("Lỗi", "Vui Lòng Điền Đầy Đủ Email Và Password" ,"error") </script>';
}else if($check > 0){
echo '<script>swal("Lỗi", "Email Đã Tồn Tại. Vui Lòng Sử Dụng Email Khác" ,"error") </script>';
}elseif($password != $repassword){
echo '<script>swal("Lỗi", "Mật Khẩu Không Giống Nhau. Vui Lòng Nhập Lại " ,"error") </script>';
}else{
$pass = base64_encode($password);
$hash = md5( rand(0,1000) );
$amail = new PHPMailer(true);
date_default_timezone_set("UTC");
mysql_query("INSERT INTO `thanhvien` 
        (`name`, `email`, `password`, `vnd`, `admin`, `token`, `date`, `ip`) 
    VALUES
        ('".$name."', '".$mail."', '".$pass."', '0', '2','".$hash."', '".date('h:i: sa - Y/m/d', strtotime("now -7 GMT"))."', '".$ip."')
");
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
        <p>Vui Lòng Nhấn Vào Link Để Kích Hoạt Tài Khoản: <a href="http://localhost/verifyac.php?email='.$mail.'&token='.$hash.'">Home</a></p>
      </div>
    </body>
    </html>';
    $amail->AddAddress($mail);
    $amail->send();
    echo '<script>swal("Đăng Ký Thành Công" ,"Chào Mừng '.$_POST['email'].' Đến Với WebSite Thuê Acc PUBG. Vui Lòng Đăng Nhập Gmail Để Xác Nhận Kích Hoạt Tài Khoản." ,"success") </script>';
echo '<meta http-equiv=refresh content="5; URL=/dangnhap.html">';

    }
    catch (Exception $e) {
        echo '<script>swal("Lỗi", "Không Thể Gửi Được Mail" ,"error") </script>';
        echo ' Mailer Error: ', $amail->ErrorInfo;
    }
}
}
?>
    <div class="pu-main">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-logres">
                    <ul class="pu-logres-tab">
                        <li class="active"><a href="javascript:;" title="">ĐĂNG KÝ</a></li>
                        <li><a href="/dangnhap.html" title="">ĐĂNG NHẬP</a></li>
                    </ul>
                    <form method="POST" action="/dangky.html">
                        <div class="pu-logres-ip pu-logres-ipch"> <input type="text" name="name" maxlength="20" placeholder="Họ tên"> </div>
                        <div class="pu-logres-ip pu-logres-ipch"> <input type="email" name="email" placeholder="Email đăng nhập"> </div>
                        <div class="pu-logres-ip pu-logres-ipch"> <input id="register-password" type="password" maxlength="20" name="password" placeholder="Mật khẩu"> </div>
                        <div class="pu-logres-ip pu-logres-ipch"> <input type="password" name="repassword" maxlength="20" placeholder="Nhập lại mật khẩu"> </div>
                        
                        <ul class="pu-logres-ulb clearfix">
                            <li class="pu-logres-btn"><button name="dangky" type="submit">ĐĂNG KÝ</button></li>
                            <li class="pu-logres-btn"><button type="reset">HỦY BỎ</button></li>
                        </ul>
                    </form>        
                </div>
            </div>
        </div>
    </div>