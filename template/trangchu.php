  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
.fa-chevron-left,.fa-chevron-right {
    padding-top:300px;
    font-size: 50px;
  }
  </style>
<div class="pu-banner">        
        <div class="container">
            <div class="pu-bnrow clearfix">
                <div class="pu-bncol1">
                    <div class="pu-topca">
                        <div class="pu-topca-box">
                    <video id="myvideo" allowfullscreen="" frameborder="0" height="438" src="/assets/images/ngu1.mp4" width="723" controls autoplay style="max-width: 707px;max-height: 401px;" onended="run();"></video><br /> 
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
                    <br>
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
     
<?php
$game = mysql_query("SELECT * FROM `game`");
?>
<?php while ($game_set = mysql_fetch_assoc($game))  : ?>
    <div class="container ">
      <div class="pu-mtit">
      <span><img style="height = 87px;" src="<?=$home."/assets/images/"."1".$game_set['id'].".png"?>" alt=""></span>
    <span><?= $game_set["name"] ?></span>   
      </div>
    <?php 
    $sqls = "SELECT * FROM `acc_store` WHERE `game_id`='".$game_set['id']."' AND `status`='0' ";
    $result = mysql_query($sqls);
     ?>
    <?php while ($record = mysql_fetch_assoc($result))  : ?>
        <?php 
            $sql = "SELECT * FROM `game` WHERE `id`='".$game_set['id']."'";
           
            $current_game = mysql_query($sql);
            while($current_game_set = mysql_fetch_assoc($current_game)){
                $game_name = $current_game_set['name'];
              }
        ?>
        <div class="pu-item" >
        <div class="pu-itbox">
        <p class="pu-number">#<?=$record['id']?></p>
 <img class="pu-itimg" src="<?=$home."/assets/images/".$game_set['id'].".jpg"?>" alt="Card image cap">
                <p class="pu-itprice pu-itprirow" style="color:white">Giá : <?= number_format($record["prices"]) ?> vnđ</p>
                <p class= "pu-itbtns"><a href="#"
                 data-toggle="modal"
                 data-target="#myModal"
                 data-acc_id="<?php echo $record['id']; ?>"
                 data-acc_game="<?php echo $game_name; ?>"
                 data-acc_ingame="<?php echo $record['ingame_name']; ?>"
                 data-acc_hour="<?php echo $record['played_hours']; ?>"
                 data-acc_champions="<?php echo $record['owned_champions']; ?>"
                 data-acc_skins="<?php echo $record['owned_skins']; ?>"
                 data-acc_achievement="<?php echo $record['achiviement_unlock']; ?>"
                 data-acc_rank="<?php echo $record['rank']; ?>"
                 data-acc_level="<?php echo $record['level']; ?>"
                 data-acc_server="<?php echo $record['server']; ?>"
                 data-acc_price="<?php echo $record['prices']; ?>"
                 data-acc_source="<?=$home."/assets/images/".$game_set['id'].".jpg"?>"
                 >Xem chi tiết</a></p>
            
            </div>
          
        </div>
    <?php  endwhile; ?>
    
    </div>
    
<?php endwhile; ?>
</div>

<?php mysql_free_result($result); ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="pu-itbox">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="game"></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="acc_id" class="acc_id">
        <img src="" alt="" class="cover">
        <p style="color:white"> aaaaaaaaaaaaa</p>
        <p>Tên ingame: <span class="ingame_name"></span></p>
        <p>Số giờ chơi: <span class="played_hours"></span></p>
        <p>Số tướng sở hữu: <span class="champions"></span></p>
        <p>Skin sở hữu: <span class="skins"></span></p>
        <p>Số thành tựu unlocked: <span class="achievement"></span></p>
        <p>Rank: <span class="rank"></span></p>
        <p>Level: <span class="level"></span></p>
        <p>Server: <span class="server"></span></p>
        <p>Giá: <span class="price"></span> :vnd</p>
        <div class="pu-itprice pu-itprirow">
      <p class="pu-itbtns"><a href="#" id="goto">Mua</a></p>
      <p class="pu-itbtns"><a href="#" id="detail">Xem Chi Tiết</a></p>
      <p class="pu-itbtns"> <button type="button" href="#" data-dismiss="modal">Đóng</button></p>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
$('#myModal').on('show.bs.modal', function(e) {

//get data-id attribute of the clicked element
var acc_id = $(e.relatedTarget).data('acc_id');
var acc_game = $(e.relatedTarget).data('acc_game');
var acc_ingame = $(e.relatedTarget).data('acc_ingame');
var acc_hour = $(e.relatedTarget).data('acc_hour');
var acc_champions = $(e.relatedTarget).data('acc_champions');
var acc_skins = $(e.relatedTarget).data('acc_skins');
var acc_achievement = $(e.relatedTarget).data('acc_achievement');
var acc_rank = $(e.relatedTarget).data('acc_rank');
var acc_level = $(e.relatedTarget).data('acc_level');
var acc_server = $(e.relatedTarget).data('acc_server');
var acc_price = $(e.relatedTarget).data('acc_price');
var acc_source = $(e.relatedTarget).data('acc_source');

//populate the textbox
$(e.currentTarget).find($('.ingame_name')).empty();
$(e.currentTarget).find($('.game')).empty();
$(e.currentTarget).find($('.played_hours')).empty();
$(e.currentTarget).find($('.champions')).empty();
$(e.currentTarget).find($('.skins')).empty();
$(e.currentTarget).find($('.achievement')).empty();
$(e.currentTarget).find($('.rank')).empty();
$(e.currentTarget).find($('.level')).empty();
$(e.currentTarget).find($('.server')).empty();
$(e.currentTarget).find($('.price')).empty();
////////////
$(e.currentTarget).find($('.acc_id')).val(acc_id);
$(e.currentTarget).find($('.cover')).attr('src',acc_source);
$(e.currentTarget).find($('.game')).append(acc_game);
$(e.currentTarget).find($('.ingame_name')).append(acc_ingame);
$(e.currentTarget).find($('.played_hours')).append(acc_hour);
$(e.currentTarget).find($('.champions')).append(acc_champions);
$(e.currentTarget).find($('.skins')).append(acc_skins);
$(e.currentTarget).find($('.achievement')).append(acc_achievement);
$(e.currentTarget).find($('.rank')).append(acc_rank);
$(e.currentTarget).find($('.level')).append(acc_level);
$(e.currentTarget).find($('.server')).append(acc_server);
$(e.currentTarget).find($('.price')).append(acc_price);
 
 $('#goto').on('click',function(){
      window.location = "http://localhost/verify?id="+acc_id;
 })
 $('#detail').on('click',function(){
      window.location = "http://localhost:82/detail?id="+acc_id;
 })
 

});
</script>
  <script>
        video_count =1;
         
        video=document.getElementById("myvideo");

        function run(){
            video_count++;
            if (video_count == 5) video_count = 1;
            video.setAttribute("src","http://localhost/assets/images/ngu"+video_count+".mp4");       
            video.play();

       }

    </script>