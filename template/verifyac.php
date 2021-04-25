<?php
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token'])){
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['token']); // Set hash variable
                 
    $search = mysql_query("SELECT `email`, `admin`, `token` FROM thanhvien WHERE email='".$email."' AND token ='".$hash."' AND admin='2'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);
                 
    if($match > 0){
        // We have a match, activate the account
        mysql_query("UPDATE `thanhvien` SET `admin`='0' WHERE email='".$email."' AND token='".$hash."' AND admin='2'") or die(mysql_error());
        echo '<script>swal("Kích Hoạt Thành Công Vui Lòng Đăng Nhập" ,"success") </script>';
        echo '<meta http-equiv=refresh content="1; URL=/trangchu.html">';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}
?>