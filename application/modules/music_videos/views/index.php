<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">มิวสิควีดีโอเพลงเกาหลี</li>
</ol>

<h1>มิวสิควีดีโอเพลงเกาหลี</h1>

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

<?php echo $mvs->pagination();?>

</div>