<div class="pu-banner">        
        <div class="container">
            <div class="pu-bnrow clearfix">
                <div class="pu-bncol1">
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                    <iframe allowfullscreen="" frameborder="0" height="438" src="https://www.youtube.com/embed/4-D1BsNH248" width="723" style="max-width: 707px;max-height: 401px;"></iframe><br /> 
                  </div></div>
                </div>
                <div class="pu-bncol2">
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                            <h4>TIN TỨC</h4>
                            <ul>
                                    <li><a href="/tin-tuc/chuc-nang-moi-huy-dat-truoc"><label>1.Tải game PUBG miễn phí trước khi thuê!</label></a></li>
                                    
                                     <li><a href="/tin-tuc/chuc-nang-moi-huy-dat-truoc"><label>2.Chức năng mới: Huỷ Đặt Trước</label></a></li>
                                     
                                      <li><a href="/tin-tuc/chuc-nang-moi-huy-dat-truoc"><label>3.Mở lại gói thuê 5k/4h</label></a></li>
                            </ul>
                        </div>
                    </div><br>
                   <ul class="pu-formca clearfix">
                  <div class="pu-topca">
                        <div class="pu-topca-box">
                        
                        <h4>NẠP THẺ</h4><center> <span style="color: white">Khuyến khích nạp bằng thẻ Gate hoặc MegaCard</span></center></div></div>
                        <li><div>
                            <input type="text" class="form-control card-code" name="pin" placeholder="Nhập mã thẻ">
                        </div></li>
                        <li><div>
                            <input type="text" class="form-control card-serial" name="seri" placeholder="Nhập serial">
                        </div></li>
                        <li><div>
                            <select class="form-control" name="card_type_id">
                                    <option value="">Chọn loại thẻ</option>
                                    <option value="1">Viettel</option>
                                    <option value="2">Mobiphone</option>
                                    <option value="3">Vinaphone</option>
                                    <option value="9">Megacard</option> 
                                    <option value="4">Gate - FPT</option>
                                    <option value="5">VTC - Vcoin</option>
                            </select>
                        </div></li>
                        <li><div>
                            <button id="paycard" class="hieucms pu-frca-btn btn-charing" data-loading-text="Đang nạp thẻ..."> 
                                Nạp thẻ 
                            </button>
                        </div></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if (isset($_POST['quenmatkhau'])){
$email = mysql_real_escape_string($_POST['email']);
if(!$email){
echo '<script>swal("Lỗi", "Vui Lòng Điền Email" ,"error") </script>';
}
if($email){
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `thanhvien` WHERE `email`='$email'"), 0);
if($check < 1){
echo '<meta http-equiv=refresh content="1; URL=/quenmatkhau.html">';
echo '<script>swal("Lỗi", "Email Không Tồn Tại Trong Hệ Thống" ,"error") </script>';
}else{
    $mail = new PHPMailer(true);
    $rdpw = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCD EFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
mysql_query("UPDATE `thanhvien` SET `password`='".base64_encode($rdpw)."' WHERE `email`='".$email."'");
    try{
        $mail->isSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465; 
    $mail->Username = 'nghiasuperat123456@gmail.com';  
    $mail->Password = 'nghiasieu12';           
    $mail->SetFrom('org@org.com');
    $mail->isHTML(true);  
    $mail->Subject = 'Reset Lai Mat Khau Thanh Cong';
    //$mail->Body = 'Xin Chào: '. $email .' Yêu Cầu Đổi Mật Khẩu Của Bạn Trên WebSite '. $home .' Đã Được Thực Hiện
    //Mật Khẩu Mới Của Bạn Là: '. $rdpw.'          Thank You :* :*' ;
    $mail->Body  = '<!DOCTYPE html>
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
        <p>Yêu Cầu Đổi Mật Khẩu Của Bạn Trên WebSite <a href="http://localhost/dangnhap.html">Home</a> Đã Được Thực Hiện </p>
        <p>Mật Khẩu Mới Của Bạn Là: '. $rdpw.'          Thank You :* :* ;</p>
      </div>
    </body>

    </html>';

    $mail->AddAddress($email);
    $mail->send();
echo '<meta http-equiv=refresh content="1; URL=/dangnhap.html">';
echo '<script>swal("Reset Mật Khẩu Thành Công", "Vui Lòng Đăng Nhập Vào Gmail Để Nhận Mật Khẩu Mới." ,"success") </script>';
    }
    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
}
}
?>
    <div class="pu-main">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-logres">
                    <ul class="pu-logres-tab">
                        <li><a href="/dangky.html" title="">ĐĂNG KÝ</a></li>
                        <li><a href="/dangnhap.html" title="">ĐĂNG NHẬP</a></li>
                        <li class="active"><a href="javascript:;" title="">QUÊN MẬT KHẨU</a></li>
                    </ul>
                    <form class="form-auth-small"  method="POST" action="/quenmatkhau.html">
                        <div class="pu-logres-ip pu-logres-ipch"> <input name="email" type="email" placeholder="Email đăng nhập"> </div>
                        <ul class="pu-logres-ul">
                            <li class="pu-logres-btn"><button name="quenmatkhau" type="submit">Chấp Nhận</button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>