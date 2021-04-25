<script src='elevatezoom-master/jquery-1.8.3.min.js'></script>
	<script src='elevatezoom-master/jquery.elevatezoom.js'></script>
<?php
if(isset($_GET['id']) && $_GET['id']){
    $sql = "SELECT * FROM `acc_store` WHERE `id`='".$_GET['id']."' AND `status` = '0'";
    $acc = mysql_query($sql);
    while($acc_arr = mysql_fetch_assoc($acc)){
       $gameid = $acc_arr['game_id'];   
       $champ = $acc_arr['owned_champions'];
       $skin = $acc_arr['owned_skins'];
    }
    $game = mysql_query("SELECT * FROM `game` WHERE `id` ='".$gameid."' ");
      $game_set = mysql_fetch_assoc($game);
      $gametype = $game_set['id'];
}
?>
<?php
// $d = 'assets/images/';
// foreach (glob($d.'*.{png}',GLOB_BRACE) as $filename){
//     $imag[] =  basename($filename);
// }
 ?>
 <style>
 .image{
    overflow: hidden;
 }
.image img{
    -webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
}
.image:hover img{
    -webkit-transform: scale(1.3);
	transform: scale(1.3);
}
.ui{
    margin-left:11px;
    margin-bottom:11px;
}
/* .nav-tabs>.active>a, .nav-tabs>.active>a:focus,.nav-tabs>p.active>a:hover{
    color:#fff;
    background-color:transparent;
    border:none;
} */
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
    width: 20%;
}
.pu-itbtns span{
    background-color:#000;
    color:#bbb;
    height: 30px;
    width:30px;
    border-radius: 50%;
    display: inline-block;
    line-height: 30px;
}
 </style>
<div class="container">
<div class="pu-bnrow clearfix">
<div class="pu-topca">
<span>  <img style="height:400px;width:100%;" src="<?=$home."/assets/images/".$gametype.".jpg"?>" alt="Card image cap"><span>
</div>
</div>
</div>
<div class="pu-main">
<div class="container">
<ul class="nav nav-tabs">
<li class= "pu-itbtns active"><a data-toggle="tab" href="#home">Home</a></li>
<li class= "pu-itbtns"><a data-toggle="tab" href="#menu1">Tướng <span><?=$champ?></span></a></li>
<li class= "pu-itbtns"><a data-toggle="tab" href="#menu2">Trang phục</a></li>
<li class= "pu-itbtns"><a data-toggle="tab" href="#menu3">Menu 3</a></li>
<li class= "pu-itbtns"><a data-toggle="tab" href="#menu4">Menu 4</a></li>
</ul>
<div class="tab-content">
<div id="home" class="tab-pane fade in active ">
<div class="pu-ftcall">
<p>Hình ảnh trong game</p>
<?php
echo '<div class="image"><img style="padding-left: 80px;" src='.$home.'/assets/images/lmht/'.$gametype.'.jpg alt="Card image cap">
</div>';
?>
</div>
</div>
<div id="menu1" class="tab-pane fade">
<div class="pu-ftcall">
<?php
$d = 'assets/images/lmht/';
for($i=0; $i<$champ;$i++):
foreach (glob($d,GLOB_BRACE) as $filename){
    // print_r($home."/".$filename);
    echo '<div class="ui equal width champion card" style="width:100px;height:100px;float:left;">
<div class="image"><img style="width:100px;height:100px;" src='.$home.'/'.$filename.$gametype.$i.'.png alt="Card image cap">
</div>
</div>';
}
endfor
?>
</div>
</div>
<div id="menu2" class="tab-pane fade">
<div class="pu-ftcall">
<?php
for($i=1; $i<=5;$i++):
foreach (glob($d,GLOB_BRACE) as $filename){
    // print_r($home."/".$filename);
    echo '<div class="ui equal width champion card" style="width:170px;height:115px;float:left;margin-left:15px;">
<div class="image" style="width:170px;height:115px;"><img src='.$home.'/'.$filename.$gametype.$i.'.gif alt="Card image cap">
</div>
</div>';
}
endfor
?>
<!-- <?php
for($e=1; $e<=1;$e++):
foreach (glob($d,GLOB_BRACE) as $filename){
    // print_r($home."/".$filename);
    echo '<div class="ui equal width champion card" style="width:170px;height:115px;float:left;">
<div class="image" style="width:170px;height:115px;"><video preload="" autoplay="" loop="" height="115" width="170px" src='.$home.'/'.$filename.$e.'.mp4></video>
</div>
</div>';
}
endfor
?> -->
<?php
for($a=0; $a<$skin - $i - 1 ;$a++):
foreach (glob($d,GLOB_BRACE) as $filename){
    // print_r($home."/".$filename);
    echo '<div class="ui equal width champion card" style="width:170px;height:115px;float:left;margin-left:15px;">
<img style="width:170px;height:115px;" id="zoom_'.$a.'" src='.$home.'/'.$filename.$gametype.$a.'.jpg alt="Card image cap" data-zoom-image='.$home.'/'.$filename.$gametype.$a.'.jpg>

</div>';
}
endfor
?>
</div>
</div>
<div id="menu3" class="tab-pane fade">
<div class="pu-ftcall">
<h3>Menu 3</h3>
 <!-- <img style="width:170px;height:115px;" id="zoom_01" src="/assets/images/lmht/315.jpg" data-zoom-image="/assets/images/lmht/315.jpg"/>  -->
</div>
</div>
<div id="menu4" class="tab-pane fade">
<div class="pu-ftcall">
<h3>Menu 4</h3>

<strong>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</strong>
</div>
</div>
</div>




<!--modal-->
<div class="modal fade pupop" id="alert-login-fb" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="pu-modal">
    <span class="puic pu-mdclose" data-dismiss="modal"></span>
    <p class="pu-ln3">THÔNG BÁO</p>
    <p class="pu-ln4">Chức năng đăng nhập Facebook đang tạm đóng, bạn vui lòng bấm <a href="/dangky.html">VÀO ĐÂY</a> để đăng ký mới. Nếu tài khoản trong Facebook còn tiền, bạn vui lòng liên hệ Fanpage để được đền bù.</p>
    
<p class="pu-lnbtn pu-itbtns"><a target="_blank" href="http://m.me/Thueaccnet-Cho-Thuê-PUBG-giá-rẻ-uy-tín-305778846564695" title="">FANPAGE</a></p>
</div>
</div>
</div>
<!--modal-->
</div>
</div>
<script>
var video;

for (video = 0; video < 15; video++){$("#zoom_"+video).elevateZoom();}

$(".confirm").on("click", function(){
    $.confirm({
    icon: 'fa fa-spinner fa-spin',
    title: 'Confirm!',
    type: 'blue',
    content: 'Simple confirm!',
    buttons: {
        confirm: function () {
            
            $.alert('Confirmed!');
        },
        
    }
})
});
</script>