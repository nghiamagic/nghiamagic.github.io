<div class="container ">
      <div class="pu-mtit">
<?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM game
            WHERE (`name` LIKE '%".$query."%') ");
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
            $sqls = "SELECT * FROM `acc_store` WHERE `game_id`='".$results['id']."' AND `status`='0' ";
            $result = mysql_query($sqls);
             
             while ($record = mysql_fetch_assoc($result))  : 
                
                    $sql = "SELECT * FROM `game` WHERE `id`='".$results['id']."'";
                   
                    $current_game = mysql_query($sql);
                    while($current_game_set = mysql_fetch_assoc($current_game)){
                        $game_name = $current_game_set['name'];
                      }
                
                echo '<div class="pu-item" >
                <div class="pu-itbox">
                <p class="pu-number">#'.$record['id'].'</p>
         <img class="pu-itimg" src="'.$home.'/assets/images/'.$results['id'].'.jpg" alt="Card image cap">
                        <p class="pu-itprice pu-itprirow" style="color:white">Giá :  '.number_format($record["prices"]).' vnđ</p>
                        <p class= "pu-itbtns"><a href="#"
                         data-toggle="modal"
                         data-target="#myModal"
                         data-acc_id="'.$record['id'].'"
                         data-acc_game="'.$game_name.'"
                         data-acc_ingame="'.$record['ingame_name'].'"
                         data-acc_hour="'.$record['played_hours'].'"
                         data-acc_champions="'.$record['owned_champions'].'"
                         data-acc_skins="'.$record['owned_skins'].'"
                         data-acc_achievement="'.$record['achiviement_unlock'].'"
                         data-acc_rank="'.$record['rank'].'"
                         data-acc_level="'.$record['level'].'"
                         data-acc_server="'.$record['server'].'"
                         data-acc_price="'.$record['prices'].'"
                         data-acc_source="'.$home.'/assets/images/'.$results['id'].'.jpg"
                         >Xem chi tiết</a></p>
                    
                    </div>
                  
                </div>';
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            endwhile;}
            mysql_free_result($result);
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</div>
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
      window.location = "http://localhost/detail?id="+acc_id;
 })
 

});
</script>