<div class="pu-banner">        
        <div class="container">
            <div class="pu-bnrow clearfix">
                <div class="pu-bncol1">
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                    <video id="myvideo" allowfullscreen="" frameborder="0" height="438" src="/assets/images/PUBG.mp4" width="723" controls autoplay style="max-width: 707px;max-height: 401px;"></video><br /> 
                  </div></div>
                </div>
                <div class="pu-bncol2">
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                            <h4>TIN TỨC</h4>
                            <ul>
                                    <li><a href="/tai-game-pubg-mien-phi-truoc-khi-thue"><label>1.Tải game PUBG miễn phí trước khi thuê!</label></a></li>
                                     <li><a href="chuc-nang-moi-huy-dat-truoc"><label>2.Chức năng mới: Huỷ Đặt Trước</label></a></li>
                                     <li><a href="mo-lai-goi-thue-5k-4h"><label>3.Mở lại gói thuê 5k, 10k</label></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                        <ul>
                        <li><?php include('usersmysql.php'); ?></li>
                        </ul>
                        </div>
                        </div>   
                    
                    <form action="search.php" method="GET">
                    <input style="width:370px;height:43px;" type="text" name="query" />
                    <li class="pu-logres-btn"><button type="submit" value="Search">Tìm kiếm</button></li>
                    </form>
                </div>
            </div>
            <div id="main">
  <div class="container">
    <div id="carousel-simple" class="carousel slide " data-ride="carousel" data-interval="1500">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-simple" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-simple" data-slide-to="1"></li>
        <li data-target="#carousel-simple" data-slide-to="2"></li>
        <li data-target="#carousel-simple" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
        <img  src="<?=$home."/assets/images/1.jpg"?>" width="100%"> 
        </div>
        <div class="item">
        <img  src="<?=$home."/assets/images/2.jpg"?>" width="100%"> 
        </div>
        <div class="item">
        <img  src="<?=$home."/assets/images/3.jpg"?>" width="100%"> 
        </div>
        <div class="item">
        <img  src="<?=$home."/assets/images/4.jpg"?>" width="100%">
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-simple" role="button" data-slide="prev">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </a>
      <a class="right carousel-control" href="#carousel-simple" role="button" data-slide="next">
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</div> 
        </div>
    </div>
     
<div class="container">
<?php
if(!$uid):
?>
<?php
else:
$dangdattruoc = mysql_query("SELECT * FROM `baidang` WHERE `dattruoc`='off' AND `nguoidat`='".$uid."' ORDER BY `date` DESC");
if(mysql_num_rows($dangdattruoc) > 0):
?>
                <div class="pu-mtit">
                    <span><img src="<?=$home?>/assets/images/tit1.png" alt=""></span>
                    <span>Tài Khoản Bạn Đã Đặt Trước</span>
                </div>
                <div class="pu-liprod clearfix">
                <?php
                $baidang = mysql_query("SELECT * FROM `baidang` WHERE `dattruoc`='off' AND `nguoidat`='".$uid."' ORDER BY `date` DESC LIMIT 4");
                while($hieucms = mysql_fetch_assoc($baidang)):
                ?>
                    <div class="pu-item">
                        <div class="pu-itbox">
                            <p class="pu-number"><?=$hieucms['loainick']?>  #<?=$hieucms['id']?></p>
                            <p class="pu-itimg"><img src="<?=$home?>/assets/images/pubg3.jpg" alt=""></p>
                            <div class="pu-itprice pu-itprirow">
                                <span style="color: #fff;">Còn: <label class="clock-list" data-second="<?=(strtotime($hieucms['hethan']) - strtotime(date("Y-m-d H:i:s")));?>"></label></span>
                            </div>
                                <p class="pu-itbtns"><a href="/lichsu-thue.html" title="Nhận Thông Tin ACCOUNT Ngay">Nhận Thông Tin Acc</a></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                <hr class="pu-lshr">
<?php endif; endif; ?>
<?php
$cothethue = mysql_query("SELECT * FROM `baidang` WHERE `trangthai`='on' AND `doipass`='on' ORDER BY `date` DESC");
if(mysql_num_rows($cothethue) > 0):
?>
                <div class="pu-mtit">
                    <span><img src="<?=$home?>/assets/images/tit1.png" alt=""></span>
                    <span>Tài Khoản Có Thể Thuê Ngay</span>
                </div>
                <div class="pu-liprod clearfix">
                <?php
                $baidang = mysql_query("SELECT * FROM `baidang` WHERE `trangthai`='on' AND `doipass`='on' ORDER BY `date` DESC");
                while($hieucms = mysql_fetch_assoc($baidang)):
                ?>
                    <div class="pu-item">
                        <div class="pu-itbox">
                            <p class="pu-number"><?=$hieucms['loainick']?>  #<?=$hieucms['id']?></p>
                            <p class="pu-itimg"><img src="<?=$home?>/assets/images/pubg2.jpg" alt=""></p>
                            <div class="pu-itprice pu-itprirow">
                                <div>
                                    <select class="hour-buy-<?=$hieucms['id'];?>">
                                        <option value="0">Chọn Giờ</option>
                                        <?php
                                        $combo = date('H');
                                        if(($combo >= 21) && ($combo < 24)){
                                        echo'<option value="6">5.000đ/10h Combo 21h-24h</option>';
                                         } 
                                        ?>
                                        <option value="1">5.000đ/4h</option>
                                        <option value="2">10.000đ/10h</option>
                                        <option value="3">20.000đ/24h</option>
                                        <option value="4">50.000đ/72h</option>
                                        <option value="5">100.000đ/168h</option>
                                    </select>
                                </div>
                                <p class="pu-itpnoti">TK Có Thể Thuê</p>
                            </div>
                                
                                <p class="pu-itbtns"><a href="javascript:;" onclick="thue(<?=$hieucms['id']?>);  return false;" title="Có Thể Thuê Ngay">Thuê Ngay</a></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                <hr class="pu-lshr">
<?php endif; ?>
<?php
$dangdoipass = mysql_query("SELECT * FROM `baidang` WHERE `doipass`='off' ORDER BY `date` DESC");
if(mysql_num_rows($dangdoipass) > 0):
?>
                <div class="pu-mtit">
                    <span><img src="<?=$home?>/assets/images/tit3.png" alt=""></span>
                    <span>Tài Khoản Đang Treo Chờ Đổi Password</span>
                </div>
                <div class="pu-liprod clearfix">
                <?php 
                $baidang = mysql_query("SELECT * FROM `baidang` WHERE `doipass`='off' ORDER BY `date` DESC");
                while($hieucms =  mysql_fetch_assoc($baidang)):
                ?>
                    <div class="pu-item">
                        <div class="pu-itbox">
                            <p class="pu-number"><?=$hieucms['loainick']?>  #<?=$hieucms['id']?></p>
                            <p class="pu-itimg"><img src="<?=$home?>/assets/images/pubg1.jpg" alt=""></p>
                            <div class="pu-itprice pu-itprirow">
                                <div>
                                    <select class="hour-buy-<?=$hieucms['id'];?>">
                                        <option value="0">Chọn Giờ</option>
                                        <?php
                                        $combo = date('H');
                                        if(($combo >= 21) && ($combo < 24)){
                                        echo'<option value="6">5.000đ/10h Combo 21h-24h</option>';
                                         } 
                                        ?>
                                        <option value="1">5.000đ/4h</option>
                                        <option value="2">10.000đ/10h</option>
                                        <option value="3">20.000đ/24h</option>
                                        <option value="4">50.000đ/72h</option>
                                        <option value="5">100.000đ/168h</option>
                                    </select>
                                </div>
                                <p class="pu-itpnoti">TK Chờ Đổi Pass</p>
                            </div>
                                <p class="pu-itbtns <?=($hieucms['dattruoc']=='off') ? '' : 'btn-isorder' ?>">
                                    <input type="hidden" name="id" value="<?=$hieucms['id']?>"/>
                                    <a href="javascript:;" onclick="dattruoc(<?=$hieucms['id']?>);  return false;" title="<?=($hieucms['dattruoc']=='off') ? 'Có Thể Đặt Trước' : 'Đã Đặt Trước' ?>">
                                        <?=($hieucms['dattruoc']=='off') ? 'Có Thể Đặt Trước' : 'Đã Đặt Trước' ?> 
                                    </a>
                                </p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                <hr class="pu-lshr">
<?php endif; ?>
<?php
$dangthue = mysql_query("SELECT * FROM `baidang` WHERE `trangthai`='off' AND `doipass`='on' ORDER BY `date` DESC");
if(mysql_num_rows($dangthue) > 0):
?>
                <div class="pu-mtit">
                    <span><img src="<?=$home?>/assets/images/tit2.png" alt=""></span>
                    <span>Tài Khoản Đang Được Thuê</span>
                </div>
                <div class="pu-liprod clearfix">
                <?php
                $baidang = mysql_query("SELECT * FROM `baidang` WHERE `trangthai`='off' AND `doipass`='on' ORDER BY `date` DESC");
                while($hieucms = mysql_fetch_assoc($baidang)):
                ?>
                    <div class="pu-item">
                        <div class="pu-itbox">
                            <p class="pu-number"><?=$hieucms['loainick']?> #<?=$hieucms['id']?></p>
                            <p class="pu-itimg"><img src="<?=$home?>/assets/images/pubg5.jpg" alt=""></p>
                            <div class="pu-itprice pu-itprirow">
                                <div>
                                    <select class="hour-buy-<?=$hieucms['id'];?>">
                                        <option value="0">Chọn Giờ</option>
                                        <?php
                                        $combo = date('H');
                                        if(($combo >= 21) && ($combo < 24)){
                                        echo'<option value="6">5.000đ/10h Combo 21h-24h</option>';
                                         } 
                                        ?>
                                        <option value="1">5.000đ/4h</option>
                                        <option value="2">10.000đ/10h</option>
                                        <option value="3">20.000đ/24h</option>
                                        <option value="4">50.000đ/72h</option>
                                        <option value="5">100.000đ/168h</option>
                                    </select>
                                </div>
                                <p class="pu-itpnoti">
                                <?php $a = (strtotime($hieucms['hethan']) - strtotime(date("Y-m-d H:i:s"))); ?>
                                  <?='Còn: '.gmdate("H:i:s", $a)."(s)" ?></p>
                            </div>
                                <p class="pu-itbtns <?=($hieucms['dattruoc']=='off') ? '' : 'btn-isorder' ?>">
                                    <input type="hidden" name="id" value="<?=$hieucms['id']?>"/>
                                    <a href="javascript:;" onclick="dattruoc(<?=$hieucms['id']?>);  return false;" title="<?=($hieucms['dattruoc']=='off') ? 'Có Thể Đặt Trước' : 'Đã Đặt Trước' ?>">
                                        <?=($hieucms['dattruoc']=='off') ? 'Có Thể Đặt Trước' : 'Đã Đặt Trước' ?> 
                                    </a>
                                </p>
                        </div>
                    </div>
                    
                    
                    
                <?php endwhile; ?>
                </div>
 <?php endif; ?>
            </div>
        </div>
    </div>

</div>