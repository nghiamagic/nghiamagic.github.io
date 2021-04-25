<?php
if($_GET[xoa]){
    // mysql_query("DELETE FROM lichsunap WHERE uid = '".mysql_real_escape_string($_GET[xoa])."' ");
    echo '<script>swal("Xóa Thành Công","Lịch Sử Mua Đã Bị Xóa Khỏi Hệ Thống","success")</script>';
}
?>
<div class="pu-main" style="margin-top: 40px;">
    <div class="container">
        <div class="pu-mainbox">
            <div class="pu-shopif">
                <div class="pu-shopif">
                    <h3><center>LỊCH SỬ MUA ACCOUNT</center></h3>
                <div class="table-responsive">
                    <table class="table" id="table">
                            <thead>
                                <tr>
                                <td>STT</td>                                  
                                <td>THỜI GIAN MUA</td>
                                <td>TÀI KHOẢN</td>
                                <td>MẬT KHẨU</td>
                                <td>THAO TÁC</td>
                                </tr>
                            </thead>
                                <tbody>
<?php
$lmt = mysql_query("SELECT * FROM `lichsumua` WHERE `uid` = '".$uid."' ORDER BY date DESC");

if (mysql_num_rows($lmt) == 0):
?>

<tr><td colspan="6" class="text-center"><p>Bạn Chưa Mua ACCOUNT PUBG Nào Tại Website</p></td></tr>
<?php else: 
while ($history = mysql_fetch_assoc($lmt)):
//$post = mysql_fetch_assoc(mysql_query("SELECT * FROM `acc_store` WHERE `id`='".$_GET['id']."' AND `status`='1' "));
?>

<tr>                            
<td>
<?=$history['id']?>
</td>
<td>
<?=$history['date']?>
</td>
<td>
<?=$history['taikhoan']?>
</td>
<td>
<?=$history['matkhau'] ?>
</td>
<td>
Xóa
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
<script>
    
            var index, table = document.getElementById('table');
            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].cells[4].onclick = function()
                {
                    var c = confirm("do you want to delete this row");
                    if(c === true)
                    {
                        index = this.parentElement.rowIndex;
                        table.deleteRow(index);
                    }
                    
                    //console.log(index);
                };
                
            }
    
        </script>