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
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Quản Lý Kích Hoạt Thành Viên Mới</h3>
                        <div class="table-responsive">
<?php
if($_GET[xoa]){
    mysql_query("DELETE FROM thanhvien WHERE uid = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Tài Khoản Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
<?php
if($_GET[active]){
    mysql_query("UPDATE `thanhvien` SET `admin`='0' WHERE `uid` = '".mysql_real_escape_string($_GET[active])."' ");
    echo '<script>swal("Kích Hoạt Thành Công","Tài Khoản '.$_GET[active].' Đã Được Kích Hoạt","success")</script>';
}
?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Tên</td>
                                        <td>Email</td>
                                        <td>Trạng Thái</td>
                                        <td>Thời Gian Đăng Ký</td>
                                        <td>Thao Tác</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$tv = mysql_query("SELECT * FROM `thanhvien` WHERE `admin`='2'");
while($mems = mysql_fetch_assoc($tv)){
?>
                                    <tr>
                                       <td><?=$mems['uid']?></td>
                                       <td><?=$mems['name']?></td>
                                       <td><?=$mems['email']?></td>
                                       <td><span class="label label-danger">Chưa Kích Hoạt</span></td>
                                        <td><?=$mems['date']?></td>
                                       <td><a href="/admin/activemem.php?active=<?=$mems['uid']; ?>" style="color: #fff;">Kích Hoạt</a><br />
                                       <a href="/admin/activemem.php?xoa=<?=$mems['uid']; ?>" style="color: #fff;">Xóa</a>
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