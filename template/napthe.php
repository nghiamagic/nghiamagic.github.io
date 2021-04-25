<?php

if(isset($_POST['napthe'])){
  $sql = "SELECT * FROM `card` WHERE `code`='".$_POST['masothe']."' AND `series`='".$_POST['series']."' AND status='0'";
  $card = mysql_query($sql);
  if (mysql_num_rows($card) == 0) {
    echo '<script>swal("Lỗi", "Sai Mã Số Thẻ Hoặc Series" ,"error") </script>';
  }else{
  while($card_set = mysql_fetch_assoc($card)){
      
    $amount =$card_set['amount'];
    $id =$card_set['id'];
  }
  
$x = mysql_query("SELECT * FROM `thanhvien` WHERE `uid`='".$_SESSION['id']."'");
while($mem = mysql_fetch_assoc($x)){
               
  $balance =$mem['vnd'];
    
}
$newbalance = floatval($balance);
  $newamount = floatval($amount);

$res = $newamount+$newbalance;
$data3 = mysql_fetch_array(mysql_query("SELECT * FROM `card` WHERE `id` = '".$id."'"));
date_default_timezone_set("UTC");
mysql_query("UPDATE `thanhvien` SET `vnd`='".$res."' WHERE `uid`='".$_SESSION['id']."' ");
mysql_query("UPDATE  `card` SET `status`='1'  WHERE `id`='".$id."' ");
mysql_query("INSERT INTO `lichsunap` 
        (`id`, `name`, `loaithe`,`serial`, `mathe`, `menhgia`, `date`)
    VALUES
        ('".$uid."', '".addslashes($data['name'])."', '".addslashes($data3['loaithe'])."', '".$_POST['series']."', '".$_POST['masothe']."', '".addslashes($data3['amount'])."', '".date('h:i:s a - Y/m/d', strtotime("now -7 GMT"))."')");

echo '<script>swal("Nạp thẻ Thành Công" ,"success") </script>';
echo '<meta http-equiv=refresh content="1; URL=/trangchu.html">';
  }
}
?>

<div class="container">
<div class="wrap" style="max-width:500px; margin:auto; padding:100px 30px;">
<form action="/napthe.php" method="POST">
  <div class="form-group">
    <label for="email" style="color:beige;font-size:150%;">Nhập mã số thẻ:</label>
    <div class="pu-logres-ip pu-logres-ipch"><input type="number" min="0" maxlength="8" placeholder="Mã số thẻ"  id="email" name="masothe"></div>
  </div>
  <div class="form-group">
    <label for="pwd" style="color:beige;font-size:150%;">Số series:</label>
    <div class="pu-logres-ip pu-logres-ipch"><input type="number" min="0"  maxlength="8" placeholder="Series"  id="pwd" name="series"></div>
  </div>

  <li class="pu-logres-btn"><button type="submit" id="submit" name="napthe">Nạp</button></li>
</form>
</div>
</div>
