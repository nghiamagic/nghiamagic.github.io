<!-- Cron Database Không Chỉnh Sửa -->
<?php
$baidang = mysql_query("SELECT * FROM `baidang` ORDER BY `id` DESC");
while($hieucms = mysql_fetch_assoc($baidang)):
  $hethan = (strtotime($hieucms['hethan']) - strtotime(date("Y-m-d H:i:s")));
  $id = $hieucms['id'];
  $pass = $hieucms['matkhau'];
  $timedat = $hieucms['timedat'];
  $nguoidat = $hieucms['nguoidat'];
  $time = (strtotime($hieucms['hethan']));
	$tgh = $hieucms['hethan'];
	$timegh = $hieucms['giahan'];
    if($timedat == 4){
        $timee = date('Y-m-d H:i:s', strtotime('+4 hour'));
    }elseif($timedat == 10){
        $timee = date('Y-m-d H:i:s', strtotime('+10 hour'));
    }elseif($timedat == 24){
        $timee = date('Y-m-d H:i:s', strtotime('+24 hour'));
    }elseif($timedat == 72){
        $timee = date('Y-m-d H:i:s', strtotime('+72 hour'));
    }elseif($timedat == 168){
        $timee = date('Y-m-d H:i:s', strtotime('+168 hour'));
    }
		if($timegh == 1){
        $times = date('Y-m-d H:i:s', strtotime(''.$tgh.' +4 hour'));
    }elseif($timegh == 2){
        $times = date('Y-m-d H:i:s', strtotime(''.$tgh.' +10 hour'));
    }elseif($timegh == 3){
        $times = date('Y-m-d H:i:s', strtotime(''.$tgh.' +24 hour'));
    }elseif($timegh == 4){
        $times = date('Y-m-d H:i:s', strtotime(''.$tgh.' +72 hour'));
    }elseif($timegh == 5){
        $times = date('Y-m-d H:i:s', strtotime(''.$tgh.' +168 hour'));
    }
    if(($hethan <= 0) && ($nguoidat == NULL)){
      mysql_query("UPDATE `baidang` SET `trangthai`='on' WHERE `id`='".$id."'");
    }
    if($time != (strtotime("0000-00-00 00:00:00")) && ($nguoidat == NULL) && ($hethan <= 0)){
      mysql_query("UPDATE `baidang` SET `doipass`='off' WHERE `id`='".$id."'");
			mysql_query("UPDATE `baidang` SET `hethan`='' WHERE `id`='".$id."'");
			mysql_query("UPDATE `lichsuthue` SET `hethan`='off' WHERE `idacc`='".$id."'");
    }
    if(($nguoidat != NULL) && ($hethan <= 0) && $time != (strtotime("0000-00-00 00:00:00"))){
      mysql_query("UPDATE `baidang` SET `dattruoc`='off', `doipass`='off', `hethan`='".$timee."', `timedat`='', `nguoidat`='' WHERE `nguoidat`='".$nguoidat."' AND `id`='".$id."'");
      mysql_query("UPDATE `lichsuthue` SET `matkhau`='".$pass."' WHERE `idacc`='".$id."'");
			mysql_query("UPDATE `lichsuthue` SET `hethan`='on' WHERE `idacc`='".$id."'");
    }
		if($timegh != NULL){
			mysql_query("UPDATE `baidang` SET `hethan`='".$times."', `giahan`='' WHERE `id`='".$id."'");
		}
endwhile;
?>
<div class="pu-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-xs-12">
                <div class="pu-ftadd">
                    <p><b>Địa chỉ: Ha Noi</b></p>
										<p><b>© 2017, Copyright by Nghia - Shop Tài Khoản game Giá Rẻ</b></p>
										<div class="pu-ftcall">
											<p><a href="tel:0941.622.622" title="0941.622.622"><i class="puic pi-call">&nbsp;</i> 0941.622.622</a></p>
										<p>Thời gian làm việc: <strong>7h-22h</strong> tất cả các ngày trong tuần</p>
										</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <ul class="pu-ftcout">
                    <li><b>Khách Online : </b><strong class="vistor-total"><?=getAmungStats("pso6skkd2c");?></strong></li>
                    
                    <li><b>Thành Viên Online : </b><strong class="vistor-total"><?=getAmungStats("tctu6kjc1u");?></strong></li>
										
<?php $anthien = mysql_result(mysql_query("SELECT COUNT(*) FROM `thanhvien` LIMIT 1"), 0); ?>
                    <li><b>Tổng Số Thành Viên : </b><strong><?=$anthien?></strong></li>
                </ul>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="pu-ftshare">
                    <p><b>Liên kết chia sẻ</b></p>
                    <ul>
                        <li><a href="javascript:;" title=""><i class="puic pi-fb"></i></a></li>
                        <li><a href="javascript:;" title=""><i class="puic pi-tw"></i></a></li>
                        <li><a href="javascript:;" title=""><i class="puic pi-gg"></i></a></li>
                        <li><a href="javascript:;" title=""><i class="puic pi-yt"></i></a></li>
                        <li><a href="javascript:;" title=""><i class="puic pi-sk"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="<?=$home?>/assets/Scripts/jquery.countdown.min.js"></script>
    <script src="<?=$home?>/assets/js/index.js"></script>
    <script type="text/javascript">
    (function () {
        var options = {
            facebook: "310191469616830", // Facebook page ID
            company_logo_url: "https://i.imgur.com/EGCsqy3.jpg", // URL of company logo (png, jpg, gif)
            greeting_message: "Chào mừng bạn đến với website Thueacc.net\nBạn cần hỗ trợ gì không ạ ? Nhắn tin cho mình nhé !", // Text of greeting message
            call_to_action: "Nếu bạn cần hỗ trợ hãy chat với tôi", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
                    <div style="display:none;">
                        <?php if (@uid): ?>
                        <script id="_wauisv">var _wau = _wau || []; _wau.push(["dynamic", "tctu6kjc1u", "isv", "c4302bffffff", "small"]);</script><script async src="//waust.at/d.js"></script>
                        <? else:?>
                        <script id="_waulfz">var _wau = _wau || []; _wau.push(["dynamic", "pso6skkd2c", "lfz", "c4302bffffff", "small"]);</script><script async src="//waust.at/d.js"></script>
                        <?php endif;?>
                    </div>
</body>
</html>