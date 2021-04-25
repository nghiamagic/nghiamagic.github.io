<?php
if(!$uid):
    echo'<script>swal("Có Lỗi Xảy Ra", "Bạn Cần Phải Đăng Nhập Mới Có Thể Xem Lịch Sử Nạp", "error")</script>';
    echo '<meta http-equiv=refresh content="1; URL=/dangnhap.html">';
elseif($data['admin']==2):
    echo'<script>swal("Có Lỗi Xảy Ra", "Tài Khoản Của Bạn Cần Kích Hoạt Mới Có Thể Xem Lịch Sử Nạp", "error")</script>';
    echo '<meta http-equiv=refresh content="2; URL=/">';
else:
?>
<?php
if($_GET[xoa]){
    // mysql_query("DELETE FROM lichsunap WHERE uid = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Lịch Sử Nạp Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
    <div class="pu-main" style="margin-top: 40px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3><center>LỊCH SỬ NẠP THẺ</center></h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>NGÀY NẠP</td>
                                        <td>LOẠI THẺ</td>
                                        <td>SỐ SERIAL</td>
                                        <td>SỐ TIỀN</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$lsn = mysql_query("SELECT * FROM `lichsunap` WHERE `id`='".$uid."' ORDER BY uid DESC");
if(mysql_num_rows($lsn) == 0):
?>
<tr><td colspan="5" class="text-center"><p>Bạn Chưa Nạp Thẻ Nào Tại Website</p></td></tr>
<?php else:
while($hieucms = mysql_fetch_assoc($lsn)):
?>
                                    <tr>
                                        <td>
                                        <?=$hieucms['uid']?>
                                        </td>
                                        <td>
                                        <?=$hieucms['date']?>
                                        </td>
                                        <td>
                                        <?=$hieucms['loaithe']?>
                                        </td>
                                        <td>
                                        <?=$hieucms['serial']?>
                                        </td>
                                        <td>
                                        <?=$hieucms['menhgia']?>
                                        </td>
                                        <td>
                                       <!-- <a href="lichsunap.php?xoa=<?=$hieucms['uid']; ?>" style="color: #fff;">Xóa</a> -->
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
