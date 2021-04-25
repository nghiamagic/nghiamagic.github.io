
<?php
if(!$_SESSION['username']){
if (isset($_POST['dangnhap'])) {
$mail = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$pass = base64_encode($password);
if(!$mail || !$password){
echo '<script>swal("Lỗi", "Vui Lòng Điền Đầy Đủ Email Và Password" ,"error") </script>';
}
if($mail && $pass){
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `thanhvien` WHERE `email`='$mail' AND `password`='$pass'"), 0);
if($check < 1){
echo '<meta http-equiv=refresh content="1; URL=/dangnhap.html">';
echo '<script>swal("Lỗi", "Đăng Nhập Không Thành Công. Sai Email Hoặc Mật Khẩu." ,"error") </script>';
}else{
$res = mysql_fetch_assoc(mysql_query("SELECT * FROM `thanhvien` WHERE `email`='$mail' AND `password`='$pass'"));
$_SESSION['username'] = $res['uid'];
$_SESSION['id'] = $res['uid'];
$_SESSION['admin'] = $res['admin'];
$_SESSION['balance'] = $res['vnd'];
echo '<meta http-equiv=refresh content="1; URL=/trangchu.html">';
echo '<script>swal("Đăng Nhập Thành Công", "Chào Mừng '.$_POST['email'].' Quay Trở Lại." ,"success") </script>';
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
                        <li class="active"><a href="javascript:;" title="">ĐĂNG NHẬP</a></li>
                    </ul>
                    <form class="form-auth-small"  method="POST" action="/dangnhap.html">
                        <div class="pu-logres-ip pu-logres-ipch"> <input name="email" type="email" placeholder="Email đăng nhập"> </div>
                        <div class="pu-logres-ip pu-logres-ipch"> <input type="password" name="password" placeholder="Mật khẩu"> </div>
                        <ul class="pu-logres-ul">
                            <li class="pu-logres-btn"><button name="dangnhap" type="submit">ĐĂNG NHẬP</button></li>
                            <li class="pu-logres-btn"><a type="button" href="/quenmatkhau.html" title="Quên mật khẩu"> Quên mật khẩu?</a></li>
                        </ul>
                    </form>
                    <p class="pu-logres-bot"><a href="#" title="Đăng Nhập Bằng Facebook" data-toggle="modal" data-target="#alert-login-fb"><img src="<?=$home?>/assets/images/dnfb.png" alt=""></a></p>
                </div>
            </div>
            <!--modal-->
            <div class="modal fade pupop" id="alert-login-fb" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="pu-modal">
                        <span class="puic pu-mdclose" data-dismiss="modal"></span>
                        <p class="pu-ln3">THÔNG BÁO</p>
                        <p class="pu-ln4">Chức năng đăng nhập Facebook đang tạm đóng, bạn vui lòng bấm <a href="/dangky.html">VÀO ĐÂY</a> để đăng ký mới. Nếu tài khoản trong Facebook còn tiền, bạn vui lòng liên hệ Fanpage để được đền bù.</p>
                        
            <p class="pu-lnbtn pu-itbtns"><a target="_blank" href="http://m.me/Thueaccnet-Cho-Thuê-PUBG-giá-rẻ-uy-tín-305778846564695" title="">FANPAGE</a></p>
                    </div>
                </div>
            </div>
            <!--modal-->
        </div>
    </div>
<?php
}else{
}
?>