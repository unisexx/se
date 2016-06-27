<h2 class="headline">มิวสิกวิดีโอ kpop</h2>

<div class="row">
<?php foreach($mvs as $mv):?>
<div class="col-lg-6">
<div class="media">
  <a class="media-left" href="มิวสิควีดีโอเพลงเกาหลี/<?=$mv->slug?>" target="_blank">
    <img src="http://img.youtube.com/vi/<?=getYouTubeIdFromURL($mv->url)?>/default.jpg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?=$mv->title?></h4>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->