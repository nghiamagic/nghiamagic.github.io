<?php
if(!$_SESSION['username']):
    echo '<meta http-equiv=refresh content="2; URL=/dangnhap.html">';
    echo '<script>swal("Lỗi", "Bạn Chưa Đăng Nhập. Không Thể Xem Trang Thông Tin" ,"error") </script>';
elseif($data['admin']==2):
    echo'<script>swal("Có Lỗi Xảy Ra", "Tài Khoản Của Bạn Cần Kích Hoạt Mới Có Thể Xem Lịch Sử Nạp", "error")</script>';
    echo '<meta http-equiv=refresh content="2; URL=/">';
else:
?>
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
<?php
$tv = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`= '".$_SESSION['username']."'");
while($hieucms = mysql_fetch_assoc($tv)){
?>
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Thông Tin Cá Nhân</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Tên</td>
                                        <td>Email</td>
                                        <td>Tiền</td>
                                        <td>Trạng Thái</td>
                                        <td>Hành Động</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <td><?=$hieucms['name']?></td>
                                       <td><?=$hieucms['email']?></td>
                                       <td><?=number_format($hieucms['vnd'],0, ',', '.')?></td>
                                       <td><span class="label label-<?=($hieucms['admin']==1) ? 'danger' : 'success' ?>">
                                          <?=($hieucms['admin']==1) ? 'ADMIN' : 'Thành Viên' ?>
                                        </span></td>
                                        <td><a href="/profile.html?chinhsua=<?=$uid?>" style="color: #fff;"> Chỉnh Sửa</a></td>
                                    </tr>
                                </tbody>
                            </table>
<?php
if($_GET[chinhsua]){
?>
                                <div class="pu-mainbox">
                                    <div class="pu-logres">
                                        <ul class="pu-logres-tab">
                                            <li class="active"><a href="#">Chỉnh Sửa Thông Tin</a></li>
                                        </ul>
                                        <form action="" method="POST">
                                          <div class="pu-logres-ip">
                                            <input type="text" class="form-control" name="name" maxlength="20" value="<?=$hieucms['name']?>" placeholder="<?=$hieucms['name']?>">
                                          </div>
                                          <div class="pu-logres-ip">
                                            <input type="email" class="form-control" name="email" placeholder="<?=$hieucms['email']?>" value="<?=$hieucms['email']?>">
                                          </div>
                                          <ul class="pu-logres-ulb clearfix">
                                              <li class="pu-logres-btn"><button type="submit" name="chinhsua">Chỉnh Sửa</button></li>
                                            <li class="pu-logres-btn"><button><a href="/profile.html">HỦY BỎ</a></button></li>
                                          </ul>
                                            </form>
                                    </div>
                                </div>
<?php
if(isset($_POST[chinhsua])){
$email = trim($_POST['email']);
$name = trim($_POST['name']);
mysql_query("UPDATE `thanhvien` SET `email` = '".$email."' WHERE `uid` = '".$_SESSION['username']."'");
mysql_query("UPDATE `thanhvien` SET `name` = '".$name."' WHERE `uid` = '".$_SESSION['username'] . "'");
echo '<meta http-equiv=refresh content="2; URL=/profile.html">';
echo '<script>swal("Chỉnh Sửa Thành Công", "Thông Tin Tài Khoản <b>'.$_POST['name'].'</b> Đã Được Cập Nhập"); </script>';
}
}
?>
                        </div>
                    </div>
                </div>
            </div>
<br />
<?php
if(isset($_POST['changepassword'])){
$cpass = mysql_real_escape_string($_POST['currentpass']);
$npass = trim($_POST['newpass']);
$rnpass = trim($_POST['renewpass']);
$mhpass = base64_encode($cpass);
$check = mysql_fetch_array(mysql_query("SELECT * FROM `thanhvien` WHERE `uid` = '".$_SESSION['username']."' ")); ;
if(!$cpass){
echo '<script>swal("Lỗi", "Vui Lòng Điền Mật Khẩu Hiện Tại" ,"error") </script>';
}elseif(!$npass){
echo '<script>swal("Lỗi", "Vui Lòng Điền Mật Khẩu Mới" ,"error") </script>';
}elseif(!$rnpass){
echo '<script>swal("Lỗi", "Vui Lòng Điền Nhập Lại Mật Khẩu" ,"error") </script>';
}elseif($mhpass != $check['password']){
echo '<script>swal("Lỗi", "Mật Khẩu Cũ Không Đúng" ,"error") </script>';
}elseif($npass != $rnpass){
echo '<script>swal("Lỗi", "Mật Khẩu Mới Không Giống Nhau" ,"error") </script>';
}elseif($cpass === $npass){
echo '<script>swal("Lỗi", "Mật Khẩu Mới Không Được Giống Với Mật Khẩu Cũ" ,"error") </script>';
}elseif($check['uid'] != $_SESSION['username']){
echo '<script>swal("Lỗi", "Bạn Đang Làm Cái Quái Gì Vậy ???" ,"error") </script';
mysql_query("DELETE FROM `thanhvien` WHERE `uid` = '".$_SESSION['username']."'");
session_unset();
die();
}
$mhnpass = base64_encode($npass);
mysql_query("UPDATE `thanhvien` SET `password`='".$mhnpass."' WHERE `uid` = '".$_SESSION['username']."'");
echo '<meta http-equiv=refresh content="2; URL=/profile.html">';
echo '<script>swal("Đổi Mật Khẩu Thành Công", "Mật Khẩu Đã Được Cập Nhập" ,"success") </script>';
}
?>
                                <!--POST Thay Đổi Mật Khẩu -->
                                <div class="pu-mainbox">
                                    <div class="pu-logres">
                                        <ul class="pu-logres-tab">
                                            <li class="active"><a href="#">ĐỔI MẬT KHẨU</a></li>
                                        </ul>
                                        <form method="POST" action="/profile.html">
                                            <div class="pu-logres-ip pu-logres-ipch"> <input type="password" name="currentpass" placeholder="Mật khẩu Hiện Tại"></div>
                                            <div class="pu-logres-ip pu-logres-ipch"> <input id="inputPassword2" type="password" name="newpass" placeholder="Mật khẩu mới"></div>
                                            <div class="pu-logres-ip pu-logres-ipch"> <input type="password" name="renewpass" placeholder="Nhập lại mật khẩu mới"></div>
                                            <ul class="pu-logres-ulb clearfix">
                                                <li class="pu-logres-btn"><button type="submit" name="changepassword">ĐỔI MẬT KHẨU</button></li>
                                                <li class="pu-logres-btn"><button type="reset">HỦY BỎ</button></li>
                                            </ul>
                                        </form>        
                                    </div>
                                </div>
<?php
}
?>
        </div>
    </div>
<?php
endif;
?>