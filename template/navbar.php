<div class="pu-header">
    <div class="container">
        <a class="pu-logo" href="/" title=""><img src="https://i.imgur.com/Eokq5gG.png" alt=""></a>
        <span class="pu-imenu"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
        <ul class="pu-menutop">
        <li class="active"><a href="/" title="Trang chủ">Trang chủ</a></li>
        <li class=""><a href="/thue-acc.html" title="">Thuê acc</a></li>
        <li class=""><a href="/hoi-dap" title="">Liên hệ</a></li>
        
        </ul>
        <?php if ($data['admin']==1): ?>
        <div class="pu-hdadmin">
            <div class="dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADMIN PANEL</button>
                <ul class="dropdown-menu">
                    <li><a href="/admin/add_acc.php">Thêm Account bán</a></li>
                    <li><a href="/admin/add.php">Thêm Account cho thuê</a></li>
                    <li><a href="/admin">Quản Lý Account</a></li>
                    <li><a href="/admin/candoipass.php">Account Cần Đổi Pass</a></li>
                    <li><a href="/admin/thanhvien.php">Quản Lý Thành Viên</a></li>
                    <li><a href="/admin/activemem.php">Kích Hoạt Thành Viên</a></li>
                    <li><a href="/admin/lichsunap.php">Lịch Sử Nạp Thẻ</a></li>
                    <li><a href="/admin/thongke.php">Thống kê</a></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
      
        <?php if(!@$uid): ?>
        <ul class="pu-logreg clearfix">
            <li><a class="pu-login" href="/dangky.html" title="">Đăng Ký</a></li>
            <li><a class="pu-regis" href="/dangnhap.html" title="">Đăng nhập</a></li>
        </ul>
        <?php else: ?>
        <div class="pu-hdmoney">
          <div class="dropdown">
            <?=($data['admin']==2) ? 
            '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chưa Kích Hoạt</button>
              <ul class="dropdown-menu">
                  <li><a href="https://www.facebook.com/nghiamagic" target="_blank" title="Liên Hệ ADMIN Kích Hoạt">Liên Hệ ADMIN</a></li>' :
              '<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bạn có: <span>'.number_format($data['vnd'],0, ',', '.').'<sup>đ</sup></span></button>
              <ul class="dropdown-menu">
                  <li><a href="/profile.html" title="Thay đổi mật khẩu">Trang Cá Nhân</a></li>
                  <li><a href="/napthe.php" title="Nạp thẻ">Nạp thẻ</a></li>
                  <li><a href="/lichsu-napthe.html" title="Lịch sử nạp thẻ">Lịch sử nạp thẻ</a></li>
                  <li><a href="/lichsu-thue.html" title="Lịch sử thuê acc">Lịch sử thuê acc</a></li> 
                  <li><a href="/lichsumua.php" title="Lịch sử mua acc">Lịch sử mua acc</a></li>'?>
                  <li><a href="/dangxuat.html" class="alogout" title="Đăng xuất">Đăng xuất</a></li>
              </ul>
          </div>
        </div>
        <?php endif; ?>
    </div>
</div>