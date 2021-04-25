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
    $tt = trim($_POST['teningame']);
    $dt = trim($_POST['sotuong']);
    $dp = trim($_POST['soskin']);
    $ar = trim($_POST['achie']);
    mysql_query("INSERT INTO `acc_store` SET 
        `ingame_name = '".$tt."',
        `username` = '".$tk."',
        `password` = '".$mk."',
        `game_id` = '".$ar."',
        `created_date` = '".date('h:i: sa - Y/m/d')."',
        `owned_champions` = '".$dt."',
        `owned_skins` ='".$dp."'
    ");
    echo '<script>swal("Thêm Acc Thành Công" , "Tài Khoản '.$_POST['taikhoan'].' Đã Được Thêm Vào Hệ Thống","success") </script>';
    echo '<meta http-equiv=refresh content="2; URL=/admin/add_acc.php">';
}
?>
    <div class="pu-main" style="margin-top: 50px;">
        <div class="container">
            <div class="pu-mainbox">
                <div class="pu-shopif">
                    <div class="pu-shopif">
                        <h3 style="text-align: center;">Thêm ACC </h3>
                        <div class="pu-logres">
                            <form action="/admin/add_acc.php" method="POST">
                             <div class="row">
                             <div class="col-lg-6">
                             <div class="pu-logres-ip">
                                Tài Khoản
                                <input type="text" class="form-control" name="taikhoan" value="" placeholder="Tài Khoản">
                              </div>
                              <div class="pu-logres-ip">
                                Mật Khẩu
                                <input type="text" class="form-control" name="password" placeholder="Mật Khẩu" value="">
                              </div>
                              <div class="pu-logres-ip">
                                Tên Ingame
                                <input type="text" class="form-control" name="teningame" placeholder="Tên ingame" value="">
                              </div>
                              <div class="pu-logres-ip">
                                Số giờ chơi
                                <input type="text" class="form-control" name="sogio" placeholder="Số giờ chơi" value="">
                              </div>
                              <div class="pu-logres-ip">
                                Số tướng đã mở
                                <input type="text" class="form-control" name="sotuong" placeholder="Tướng mở (nếu có)" value="0">
                              </div>
                              <div class="pu-logres-ip">
                                Số skín đã mở
                                <input type="text" class="form-control" name="soskin" placeholder="Trang phục đã mở(nếu có)" value="0">
                              </div>
                             </div>
                             <div class="col-lg-6">
                             <div class="pu-logres-ip">
                                Game ID
                                <input type="text" class="form-control" name="achie" placeholder="Thành tựu" value="0">
                              </div>
                              <div class="pu-logres-ip">
                                Rank
                                <input type="text" class="form-control" name="rank" placeholder="Hạng" value="">
                              </div>
                              <div class="pu-logres-ip">
                                Level
                                <input type="text" class="form-control" name="level" placeholder="Cấp" value="0">
                              </div>
                              <div class="pu-logres-ip">
                                Server
                                <input type="text" class="form-control" name="server" placeholder="Server" value="VietNam">
                              </div>
                              <div class="pu-logres-ip">
                                Giá
                                <input type="text" class="form-control" name="gia" placeholder="Giá vnd" value="0">
                              </div>
                             </div>
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