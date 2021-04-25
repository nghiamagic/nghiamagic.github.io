<?php
session_start();
error_reporting(0);
include '../config.php';
include '../template/head.php';
include '../template/navbar.php';
if($data['admin']!='1'){
    echo '<meta http-equiv=refresh content="2; URL=/">';
    echo('<script>swal("STOP", "Bạn Không Có Quyền Truy Cập Trang ADMIN", "error"); </script>');
    exit;
}else{
?>
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Quản Lý Thành Viên</h3>
                        <div class="table-responsive">
<?php
if($_GET[xoa]){
mysql_query("DELETE FROM thanhvien WHERE uid = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Tài Khoản Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
<?php 
if($_GET[sua]){
$mems = mysql_fetch_assoc(mysql_query("SELECT * FROM `thanhvien` WHERE `uid` = '".$_GET['sua']."' LIMIT 1"));
?>
            <div class="pu-mainbox" style="margin-bottom: 30px;">
                <div class="pu-logres">
                    <ul class="pu-logres-tab">
                        <li class="active"><a href="#">Chỉnh Sửa Thành Viên</a></li> 
                    </ul>
                    <form action="" method="POST">
                      <div class="pu-logres-ip">
                          Email
                        <input type="text" class="form-control" name="email" value="<?=$mems['email']?>" placeholder="<?=$mems['email']?>">
                      </div>
                      <div class="pu-logres-ip">
                          Mật Khẩu
                        <input type="text" class="form-control" name="password" placeholder="<?=base64_decode($mems['password'])?>" value="<?=base64_decode($mems['password'])?>">
                      </div>
                      <div class="pu-logres-ip">
                          Tiền
                        <input type="number" class="form-control" name="vnd" placeholder="<?=$mems['vnd']?>" value="<?=$mems['vnd']?>">
                      </div>
                      <div class="pu-logres-ip">
                          Level
                        <input type="number" class="form-control" name="admin" placeholder="<?=$mems['admin']?>" value="<?=$mems['admin']?>">
                      </div>
                      <ul class="pu-logres-ulb clearfix">
                          <li class="pu-logres-btn"><button type="submit" name="sua">Chỉnh Sửa</button></li>
                          <li class="pu-logres-btn"><button><a href="/admin">HỦY BỎ</a></button></li>
                      </ul>
                    </form>
                </div>
            </div>
<?php
if (isset($_POST[sua])) {
mysql_query("UPDATE thanhvien SET `email` = '".$_POST['email']."' WHERE uid = '" . mysql_real_escape_string($_GET[sua]) . "'");
mysql_query("UPDATE thanhvien SET `password` = '".base64_encode($_POST['password'])."' WHERE uid = '" . mysql_real_escape_string($_GET[sua]) . "'");
mysql_query("UPDATE thanhvien SET `vnd` = '".$_POST['vnd']."' WHERE uid = '" . mysql_real_escape_string($_GET[sua]) . "'");
mysql_query("UPDATE thanhvien SET `admin` = '".$_POST['admin']."' WHERE uid = '" . mysql_real_escape_string($_GET[sua]) . "'");
echo '<meta http-equiv=refresh content="0; URL=/admin/thanhvien.php">';
echo'<script>swal("Chỉnh Sửa Thành Công","Tài Khoản '.$_POST['email'].' Đã Được Chỉnh Sửa", "success"); </script>';
}
}
?> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Tên</td>
                                        <td>Email</td>
                                        <td>Tiền</td>
                                        <td>Trạng Thái</td>
                                        <td>Thao Tác</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$tv = mysql_query("SELECT * FROM `thanhvien` WHERE `admin`!='2'");
while($arr = mysql_fetch_assoc($tv)){
?>
                                    <tr>
                                       <td><?=$arr['uid']?></td>
                                       <td><?=$arr['name']?></td>
                                       <td><?=$arr['email']?></td>
                                       <td><?=$arr['vnd']?></td>
                                       <td><span class="label label-<?=($arr['admin']==1) ? 'danger' : 'success' ?>">
                                        <?=($arr['admin']==1) ? 'ADMIN' : 'Thành Viên' ?>
                                        </span></td>
                                       <td><a href="/admin/thanhvien.php?sua=<?=$arr['uid']; ?>" style="color: #fff;">Sửa</a> <br />
                                       <a href="/admin/thanhvien.php?xoa=<?=$arr['uid']; ?>" style="color: #fff;">Xóa</a>
                                       </td>
                                    </tr>
<?php
}
?>
                                </tbody>
                            </table>
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