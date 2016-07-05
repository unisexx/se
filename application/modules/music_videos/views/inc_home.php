<h2 class="headline">มิวสิกวิดีโอ kpop</h2>

<div class="row">
<?php foreach($mvs as $mv):?>
<div class="col-lg-6">
<a class="media-left" href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank">
<div class="media">
  <div class="media-left">
    <img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/default.jpg">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$mv->title?></h4>
  </div>
</div>
</a>
</div>
<?php endforeach;?>
</div><!--/row-->