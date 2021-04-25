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
                        <h3 style="text-align: center;">Quản Lý ACC PUBG Cần Đổi Pass</h3>
                        <ul class="pu-logres-ulb clearfix">
                            <li class="pu-logres-btn" style="margin-left: 415px; width: 20%;"><button><a href="/admin/add.php">Thêm Acc PUBG</a></button></li>
                        </ul>
                        <div class="table-responsive">
<?php
if($_GET[xoa]){
mysql_query("DELETE FROM baidang WHERE id = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Tài Khoản Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
<?php 
if($_GET[chinhsua]){
$posts = mysql_fetch_array(mysql_query("SELECT * FROM `baidang` WHERE `id` = '".$_GET['chinhsua']."' LIMIT 1"));
?>
            <div class="pu-mainbox" style="margin-bottom: 30px;">
                <div class="pu-logres">
                    <ul class="pu-logres-tab">
                        <li class="active"><a href="#">Chỉnh Sửa Acc PUBG</a></li> 
                    </ul>
                    <form action="" method="POST">
                      <div class="pu-logres-ip">
                          Tài Khoản
                        <input type="text" class="form-control" name="taikhoan" value="<?=$posts['taikhoan']?>" placeholder="<?=$posts['taikhoan']?>">
                      </div>
                      <div class="pu-logres-ip">
                        Mật Khẩu
                        <input type="text" class="form-control" name="password" placeholder="<?=$posts['matkhau']?>" value="<?=$posts['matkhau']?>">
                      </div>
                      <div class="pu-logres-ip">
                        Trạng Thái (on Là Đang Thuê, off Là Chưa Thuê)
                        <input type="text" class="form-control" name="trangthai" placeholder="<?=$posts['trangthai']?>" value="<?=$posts['trangthai']?>">
                      </div>
                      <div class="pu-logres-ip">
                        Đặt Trước (on Là Đã Đặt Trước, off Là Chưa Đặt Trước)
                        <input type="text" class="form-control" name="dattruoc" placeholder="<?=$posts['dattruoc']?>" value="<?=$posts['dattruoc']?>">
                      </div>
                      <div class="pu-logres-ip">
                        Đổi Password (on Là Đã Đổi Pass, off Là Chưa Đổi)
                        <input type="text" class="form-control" name="doipass" placeholder="<?=$posts['doipass']?>" value="<?=$posts['doipass']?>">
                      </div>
                      <ul class="pu-logres-ulb clearfix">
                          <li class="pu-logres-btn"><button type="submit" name="chinhsua">Chỉnh Sửa</button></li>
                          <li class="pu-logres-btn"><button><a href="/admin/candoipass.php">HỦY BỎ</a></button></li>
                      </ul>
                    </form>
                </div>
            </div>
<?php
if (isset($_POST[chinhsua])) {
mysql_query("UPDATE baidang SET `taikhoan` = '".$_POST[taikhoan]."' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
mysql_query("UPDATE baidang SET `matkhau` = '".$_POST[password]."' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
mysql_query("UPDATE baidang SET `trangthai` = '".$_POST[trangthai]."' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
mysql_query("UPDATE baidang SET `dattruoc` = '".$_POST[dattruoc]."' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
mysql_query("UPDATE baidang SET `doipass` = '".$_POST[doipass]."' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
mysql_query("UPDATE baidang SET `hethan` = '' WHERE id = '" . mysql_real_escape_string($_GET[chinhsua]) . "'");
echo '<meta http-equiv=refresh content="2; URL=/admin/candoipass.php">';
echo'<script>swal("Chỉnh Sửa Thành Công", "Tài Khoản '.$_POST['taikhoan'].' Đã Được Chỉnh Sửa","success"); </script>';
}
}
?> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Tài Khoản</td>
                                        <td>Mật Khẩu</td>
                                        <td>Đang Thuê</td>
                                        <td>Đặt Trước</td>
                                        <td>Trạng Thái</td>
                                        <td>Còn Lại</td>
                                        <td>Thao Tác</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$bd = mysql_query("SELECT * FROM `baidang` WHERE `doipass`='off' ORDER BY `id` DESC");
  while($posts = mysql_fetch_assoc($bd)):
  $time = (strtotime($posts['hethan']));
  $hethan = (strtotime($posts['hethan']) - strtotime(date("Y-m-d H:i:s")));
  $time2 = (strtotime("0000-00-00 00:00:00"));
?>
                                    <tr>
                                       <td><?=$posts['id']?></td>
                                       <td><?=$posts['taikhoan']?></td>
                                       <td><?=$posts['matkhau']?></td>
                                       <td><span class="label label-<?=($posts['trangthai']=='off') ? 'success' : 'danger' ?>">
                                          <?=($posts['trangthai']=='off') ? 'Đã Thuê' : 'Chưa Thuê' ?>
                                        </span></td>
                                       <td><span class="label label-<?=($posts['dattruoc']=='on') ? 'success' : 'danger' ?>">
                                          <?=($posts['dattruoc']=='on') ? 'Đã Đặt Trước' : 'Chưa Đặt Trước' ?>
                                        </span></td>
                                        <td><span class="label label-<?=($posts['doipass']=='on') ? 'success' : 'danger' ?>">
                                          <?=($posts['doipass']=='on') ? 'Đã Đổi Pass' : 'Chưa Đổi Pass' ?>
                                        </span></td>
                                        <td><?=($time != $time2) ? ($hethan <= 0) ? '<label>TK Hết Hạn</label>' : '<label class="clock-list" data-second="'.$hethan.'"></label>' : '<lable>Chưa Sử Dụng</label>' ?></td>
                                       <td><a href="/admin/candoipass.php?chinhsua=<?=$posts['id']; ?>" style="color: #fff;">Sửa</a><br />
                                       <a href="/admin/candoipass.php?xoa=<?=$posts['id']; ?>" style="color: #fff;">Xóa</a>
                                       </td>
                                    </tr>
<?php
endwhile;
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