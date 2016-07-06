<h2 class="headline">มิวสิกวิดีโอ kpop</h2>
<a class="more-link" href="มิวสิควีดีโอเพลงเกาหลี">ดูทั้งหมด ></a>
<div class="row">
<?php foreach($mvs as $mv):?>
<div class="col-lg-6">
<a class="media-left" href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>">
<div class="media">
  <div class="media-left">
    <img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/default.jpg">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$mv->title?></h4>
    <small class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=mysql_to_th($mv->created)?></small>
  </div>
</div>
</a>
</div>
<?php endforeach;?>
</div><!--/row-->