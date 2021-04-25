<?php
session_start();
error_reporting(0);
include '../config.php';
include '../template/head.php';
include '../template/navbar.php';
if($data['admin']!='1'){
    echo '<meta http-equiv=refresh content="2; URL=/">';
    echo('<script>swal("STOP", "Bạn Không Có Quyền Truy Cập Trang ADMIN", "error"); </script>');
}else{
?>
<?php
if(isset($_POST['themacc'])){
    $tk = trim($_POST['taikhoan']);
    $mk = trim($_POST['password']);
    $tt = trim($_POST['trangthai']);
    $dt = trim($_POST['dattruoc']);
    $dp = trim($_POST['doipass']);
    mysql_query("INSERT INTO `baidang` SET 
        `loainick` = 'PUBG',
        `taikhoan` = '".$tk."',
        `matkhau` = '".$mk."',
        `trangthai` = '".$tt."',
        `dattruoc` = '".$dt."',
        `doipass` = '".$dp."',
        `date` = '".date('h:i: sa - Y/m/d')."',
        `hethan` = '',
        `giahan` = '',
        `timedat` = '',
        `nguoidat` = '',
        `nguoidang` = '".$_SESSION[username]."'
    ");
    echo '<script>swal("Thêm Acc Thành Công" , "Tài Khoản '.$_POST['taikhoan'].' Đã Được Thêm Vào Hệ Thống","success") </script>';
    echo '<meta http-equiv=refresh content="2; URL=/admin/add.php">';
}
?>
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Thêm ACC PUBG</h3>
                        <div class="pu-logres">
                            <form action="/admin/add.php" method="POST">
                              <div class="pu-logres-ip">
                                Tài Khoản
                                <input type="text" class="form-control" name="taikhoan" value="" placeholder="Tài Khoản PUBG">
                              </div>
                              <div class="pu-logres-ip">
                                Mật Khẩu
                                <input type="text" class="form-control" name="password" placeholder="Mật Khẩu PUBG" value="">
                              </div>
                              <div class="pu-logres-ip">
                                Trạng Thái (on Là Đang Thuê, off Là Chưa Thuê)
                                <input type="text" class="form-control" name="trangthai" placeholder="on Là Đang Thuê, off Là Chưa Thuê" value="off">
                              </div>
                              <div class="pu-logres-ip">
                                Đặt Trước (on Là Đã Đặt Trước, off Là Chưa Đặt Trước)
                                <input type="text" class="form-control" name="dattruoc" placeholder="on Là Đã Đặt, off Là Chưa Đặt" value="off">
                              </div>
                              <div class="pu-logres-ip">
                                Đổi Password (on Là Đã Đổi Pass, off Là Chưa Đổi)
                                <input type="text" class="form-control" name="doipass" placeholder="on Là Đã Đổi Pass, off Là Chưa Đổi" value="on">
                              </div>
                              <ul class="pu-logres-ulb clearfix">
                                  <li class="pu-logres-btn"><button name="themacc" type="submit">Thêm</button></li>
                                  <li class="pu-logres-btn"><button><a href="/admin">HỦY BỎ</a></button></li>
                              </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
include '../template/foot.php';
?>