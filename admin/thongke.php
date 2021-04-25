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
     mysql_query("DELETE FROM lichsumua WHERE id = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Lịch Sử Mua Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
<style>
.pu-itprirow {
    width: 80%;
    margin-left: 100px;
}
.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
     background-color: transparent;
     border: none;
     }
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: white;
    background-color:transparent;
    border: none;
    border-bottom-color: transparent;
}
.nav li{
    padding: 15px 8px;
    display: table;
    width: 40%;
}
.nav {
  padding-left:150px ;
}
</style>
<div class="pu-main" style="margin-top: 40px;">
    <div class="container" style="width:1300px;" >
        <div class="pu-mainbox" style="width:1300px;">
            <div class="pu-shopif">
                <div class="pu-shopif">
                    <h3><center>LỊCH SỬ GIAO DỊCH TRÊN WEBSITE</center></h3>
                    <ul class="nav nav-tabs">

<li class= "pu-itbtns active"><a data-toggle="tab" href="#menu2">Danh sách mua</a></li>
<li class= "pu-itbtns"><a data-toggle="tab" href="#menu1">Danh sách thuê</a></li>

</ul>
<div class="tab-content">
<div id="menu2" class="tab-pane fade in active">
<div class="pu-ftcall"style="width:1200px;">
<h3><center>LỊCH SỬ MUA ACCOUNT TRÊN WEBSITE</center></h3>
<div class="table-responsive">
                    <table class="table" id="table">
                            <thead>
                                <tr>
                                <td>STT</td>
                                <td>ID </td>
                                <td>TÊN</td>
                                <td>EMAIL</td>
                                <td>LOẠI GAME</td>                              
                                <td>TÀI KHOẢN</td>
                                <td>MẬT KHẨU</td>
                                <td>Giá</td>
                                <td>THỜI GIAN MUA</td>
                                <td>THAO TÁC</td>
                                </tr>
                            </thead>
                                <tbody>
<?php
$lmt = mysql_query("SELECT * FROM `lichsumua` ORDER BY date DESC");

if (mysql_num_rows($lmt) == 0):
?>

<tr><td colspan="9" class="text-center"><p> <center>Chưa Có Người Dùng Mua ACCOUNT Nào Tại Website</center></p></td></tr>
<?php else: 
while ($history = mysql_fetch_assoc($lmt)):
    $email = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`= '".$history['uid']."' ORDER BY date DESC");
    while($email1 = mysql_fetch_assoc($email)){
        $useremail = $email1['email'];
      }
?>

<tr>                            
<td>
<?=$history['id']?>
</td>
<td>
<?=$history['uid']?>
</td>
<td>
<?=$history['name']?>
</td>
<td>
<?=$useremail?>
</td>
<td>
<?=$history['loainick']?>
</td>
<td>
<?=$history['taikhoan']?>
</td>
<td>
<?=$history['matkhau'] ?>
</td>
<td>
<?=$history['gia'] ?>
</td>
<td>
<?=$history['date'] ?>
</td>
<td>
<a href="/admin/thongke.php?xoa=<?=$history['id']; ?>" style="color: #fff;font-size:120%;">Xóa</a>
</td>
</tr>
<?php 
endwhile;
endif; 
?>
</tbody>
</table>
</div>
</div>
</div>
<div id="menu1" class="tab-pane fade ">
<div class="pu-ftcall" style="width:1200px;">
<h3><center>LỊCH SỬ THUÊ ACCOUNT TRÊN WEBSITE</center></h3>
<div class="table-responsive">
                    <table class="table" id="table">
                            <thead>
                                <tr>
                                <td>STT</td>
                                <td>ID ACC</td>
                                <td>TÊN</td> 
                                <td>EMAIL</td>
                                <td>LOẠI GAME</td>                              
                                <td>TÀI KHOẢN</td>
                                <td>MẬT KHẨU</td>
                                <td>Giá</td>
                                <td>THỜI GIAN THUÊ</td>
                                <td>THAO TÁC</td>
                                </tr>
                            </thead>
                                <tbody>
<?php
$lmt1 = mysql_query("SELECT * FROM `lichsuthue` WHERE `uid` = '".$uid."' ORDER BY date DESC");

if (mysql_num_rows($lmt1) == 0):
?>
<tr><td colspan="9" class="text-center"><p> <center>Chưa Có Người Dùng Thuê ACCOUNT Nào Tại Website</center></p></td></tr>
<?php else: 
while ($history1 = mysql_fetch_assoc($lmt1)):
    $email = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`= '".$history['uid']."' ORDER BY date DESC");
    while($email1 = mysql_fetch_assoc($email)){
        $useremail = $email1['email'];
      }
?>
<tr>                            
<td>
<?=$history1['id']?>
</td>
<td>
<?=$history1['idacc']?>
</td>
<td>
<?=$history1['name']?>
</td>
<td>
<?=$useremail?>
</td>
<td>
<?=$history1['loainick']?>
</td>
<td>
<?=$history1['taikhoan']?>
</td>
<td>
<?=$history1['matkhau'] ?>
</td>
<td>
<?=$history1['gia'] ?>
</td>
<td>
<?=$history1['date'] ?>
</td>
<td>
<a href="/admin/thongke.php?xoa=<?=$history1['id']; ?>" style="color: #fff;font-size:120%;">Xóa</a>
</td>
</tr>
<?php 
endwhile;
endif; 
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="pu-mainbox"style="width:1300px;">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Thống Kê Giao Dịch</h3>
                        <div class="table-responsive"style="width:1200px;overflow-x:hidden;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>ID ACC</td>
                                        <td>Tên</td>
                                        <td>Email</td>
                                        <td>SỐ TK Mua</td>
                                        <td>SỐ TK Thuê</td>
                                        <td>Tổng tiền </td>
                                        <td>THAO TÁC</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$dem = mysql_num_rows(mysql_query("SELECT * FROM `lichsumua` WHERE `uid`='".$uid."'"));
$demm = mysql_num_rows(mysql_query("SELECT * FROM `lichsuthue` WHERE `uid`='".$uid."'"));
$lmt = mysql_query("SELECT * FROM `lichsumua`  ORDER BY date DESC");
$sql1 = mysql_query("SELECT SUM(gia) as total FROM `lichsumua` WHERE `uid` = '".$uid."' ");
$row1 = mysql_fetch_array($sql1);
$sum = $row1['total'];
$sql2 = mysql_query("SELECT SUM(gia) as total FROM `lichsuthue` WHERE `uid` = '".$uid."' ");
$row2 = mysql_fetch_array($sql2);
$sum2 = $row2['total'];
$newbalance = floatval($sum);
$newbalance2 = floatval($sum2);

    while ($history = mysql_fetch_assoc($lmt)):
        $email = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`= '".$history['uid']."' ORDER BY date DESC");
        while($email1 = mysql_fetch_assoc($email)){
            $useremail = $email1['email'];
            $aic = $email1['uid'];
          }
    ?>
                                    <tr>
                                    <td>
                                    <?php 
 echo $history['id'];
                                        ?>
                                        </td>
                                        <td>
                                        <?=$history['uid']?>
                                        </td>
                                        <td>
                                        <?=$history['name']?>
                                        </td>
                                        <td>
                                        <?=$useremail?>
                                        </td>
                                        <td><?=$dem?></td>
                                       <td><?=$demm?></td>
                                       <td><?php
                                       echo $newbalance + $newbalance2;
                                       ?></td>
                                       <td>
<a href="/admin/thongke.php?xoa=<?=$history['id']; ?>" style="color: #fff;font-size:120%;">Xóa</a>
</td>
                                    </tr><?php endwhile;?>
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
<script id="_wau4se">var _wau = _wau || []; _wau.push(["tab", "1ekpljvcuj", "4se", "left-middle"]);</script><script async src="//waust.at/t.js"></script>