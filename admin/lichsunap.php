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
if($_GET[xoa]){
     mysql_query("DELETE FROM lichsunap WHERE uid = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Lịch Sử Nạp Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Lịch Sử Nạp Trên Website</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>ID</td>
                                        <td>Tên</td>
                                        <td>EMAIL</td>
                                        <td>Loại Thẻ</td>
                                        <td>Serial</td>
                                        <td>Mã Thẻ</td>
                                        <td>Mệnh Giá</td>
                                        <td>Thời Gian Nạp</td>
                                        <td>Thao Tác</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$tv = mysql_query("SELECT * FROM `lichsunap` ORDER BY uid DESC");

while($historys = mysql_fetch_assoc($tv)){
    $email = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`= '".$historys['id']."' ORDER BY date DESC");
    while($email1 = mysql_fetch_assoc($email)){
        $useremail = $email1['email'];
      }
?>
                                    <tr>
                                       <td><?=$historys['uid']?></td>
                                       <td><?=$historys['id']?></td>
                                       <td><?=$historys['name']?></td>
                                       <td><?=$useremail?></td>
                                       <td><?=$historys['loaithe']?></td>
                                       <td><?=$historys['serial']?></td>
                                       <td><?=$historys['mathe']?></td>
                                       <td><?=$historys['menhgia']?></td>
                                       <td><?=$historys['date']?></td>
                                       <td><a href="/admin/lichsunap.php?xoa=<?=$historys['uid']; ?>" style="color: #fff;">Xóa</a> </td>
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