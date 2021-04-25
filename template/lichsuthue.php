<?php
if(!$uid):
    echo'<script>swal("Có Lỗi Xảy Ra", "Bạn Cần Phải Đăng Nhập Mới Có Thể Xem Lịch Sử Thuê ACCOUNT", "error")</script>';
    echo '<meta http-equiv=refresh content="1; URL=/dangnhap.html">';
elseif($data['admin']==2):
    echo'<script>swal("Có Lỗi Xảy Ra", "Tài Khoản Của Bạn Cần Kích Hoạt Mới Có Thể Xem Lịch Sử Thuê", "error")</script>';
    echo '<meta http-equiv=refresh content="2; URL=/">';
else:
?>
    <div class="pu-main" style="margin-top: 40px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3><center>LỊCH SỬ THUÊ ACCOUNT PUBG</center></h3>
                        <div class="table-responsive">
<?php 
if($_GET[giahan]){
  $giahan = mysql_fetch_assoc(mysql_query("SELECT * FROM `lichsuthue` WHERE `id`='".mysql_real_escape_string($_GET[giahan])."'"));
  $id = $giahan['idacc'];
?>
            <div class="pu-mainbox" style="margin-bottom: 30px;">
                <div class="pu-logres">
                    <ul class="pu-logres-tab">
                        <li class="active"><a href="#">Gia Hạn TK PUBG #<?=$id?> </a></li> 
                    </ul>
                    <form action="" method="POST">
                      <div class="pu-logres-ip">
                          <div class="form-group">
                             <select class="form-control" name="time">
                                  <option value="0">Chọn Giờ Thêm</option>
                                  <option value="1">5.000đ/4h</option>
                                  <option value="2">10.000đ/10h</option>
                                  <option value="3">20.000đ/24h</option>
                                  <option value="4">50.000đ/72h</option>
                                  <option value="5">100.000đ/168h</option>
                              </select>
                          </div>
                      </div>
                      <ul class="pu-logres-ulb clearfix">
                          <li class="pu-logres-btn"><button type="submit" name="giahan">Gia Hạn</button></li>
                          <li class="pu-logres-btn"><button><a href="/lichsu-thue.html">HỦY BỎ</a></button></li>
                      </ul>
                    </form>
                </div>
            </div>
<?php
  if(isset($_POST[giahan])) {
    $bd = mysql_fetch_assoc(mysql_query("SELECT * FROM `baidang` WHERE `id`='".$id."'"));
    $hethan = (strtotime($bd['hethan']) - strtotime(date("Y-m-d H:i:s")));
     $time = addslashes($_POST['time']);
      if($time == 1){
          $vnd = 5000;
      }elseif($time == 2){
          $vnd = 10000;
      }elseif($time == 3){
          $vnd = 20000;
      }elseif($time == 4){
          $vnd = 50000;
      }elseif($time == 5){
          $vnd = 100000;
      }
    if(($hethan <= 0)){
      echo'<script>swal("Lỗi","Tài Khoản Của Bạn Đã Hết Hạn Không Thể Gia Hạn", "error"); </script>';
    }elseif(($_POST['time'] <= 0) OR ($_POST['time'] >= 6)){
      echo'<script>swal("Lỗi","Vui Lòng Chọn Lại Thời Gian Gia Hạn", "error"); </script>';
    }elseif($data['vnd'] < $vnd){
      echo'<script>swal("Lỗi","Tài Khoản Của Bạn Không Đủ Để Gia Hạn", "error"); </script>';
    }else{
      mysql_query("UPDATE `thanhvien` SET `vnd`=`vnd` - '".$vnd."' WHERE `uid`='".$uid."'");
      mysql_query("UPDATE `baidang` SET `giahan`='".$_POST['time']."' WHERE `id`='".$id."'");
      echo '<meta http-equiv=refresh content="0; URL=/lichsu-thue.html">';
      echo'<script>swal("Gia Hạn Thành Công","Tài Khoản Của Bạn Đã Được Gia Hạn", "success"); </script>';
    }
  }
}
?> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>                                  
                                        <td>ID ACC</td>
                                        <td>THỜI GIAN THUÊ</td>
                                        <td>THỜI GIAN CÒN</td>
                                        <td>TÀI KHOẢN</td>
                                        <td>MẬT KHẨU</td>
                                        <td>THAO TÁC</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$lmt = mysql_query("SELECT * FROM `lichsuthue` WHERE `uid` = '".$uid."' ORDER BY date DESC");
if (mysql_num_rows($lmt) == 0):
?>
<tr><td colspan="6" class="text-center"><p>Bạn Chưa Thuê ACCOUNT PUBG Nào Tại Website</p></td></tr>
<?php else: 
while ($history = mysql_fetch_assoc($lmt)):
$id = $history['idacc'];
$post = mysql_fetch_assoc(mysql_query("SELECT * FROM `baidang` WHERE `id`='".$id."'"));
?>
                                    <tr>                            
                                        <td>
                                        <?=$history['id']?>
                                        </td>
                                        <td>
                                        <?=$history['idacc']?>
                                        </td>
                                        <td>
                                        <?=$history['date']?>
                                        </td>
                                        <td>
                                        <?php $a = (strtotime($post['hethan']) - strtotime(date("Y-m-d H:i:s"))); ?>
                                        <?=($a <= 0) ? '<label> TK Đã Hết Hạn</label>' : 'Còn: '.gmdate("H:i:s", $a)." (s)" ?>
                                        </td>
                                        <td>
                                        <?=$history['taikhoan']?>
                                        </td>
                                        <td>
                                        <?=($history['matkhau']!=NULL) ? ($a <= 0) ? 'TK Đã Hết Hạn' : ''.md5($history['matkhau']).'' : 'TK Đang Sử Dụng' ?>
                                        </td>
                                        <td>
                                        <input type="hidden" name="id" value="<?=$history['idacc']?>"/>
                                        <p class="pu-itbtns" style="padding: initial;margin-bottom: auto;">
                                        <?=($history['matkhau']==NULL) ? '<a href="javascript:;" onclick="huydattruoc('.$history['idacc'].');  return false;" style="margin-left: 12px;width: 85%;background: url(../assets/images/btn1-l.png) no-repeat left top;" title="Hủy Đặt Trước">Hủy Đặt Trước</a>' : 
                                        '<a href="/lichsu-thue.html?giahan='.$history['id'].'" style="margin-left: 12px;width: 85%;background: url(../assets/images/btn1-l.png) no-repeat left top;" title="Gia Hạn">Gia Hạn</a>' ?>
                                        </p>
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
<?php
endif;
?>