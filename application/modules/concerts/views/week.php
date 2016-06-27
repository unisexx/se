<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="concerts">คอนเสิร์ตเกาหลี</a></li>
  <li class="active">MBC Music Core <?=end(explode(" ",$category->concert_vid->title))?> - <?=$category->title?></li>
</ol>

<h1>MBC Music Core <?=end(explode(" ",$category->concert_vid->title))?> - <?=$category->title?></h1>


<div class="row">

<div class="col-lg-12">
<div class="media">
  <a class="media-left" href="concerts/watch_all/<?=$category->id?>" target="_blank">
    <?=thumb("http://i3.ytimg.com/sh/6MWdxFRRIpw/showposter.jpg?v=502df764",300,150,1)?>
  </a>
  <div class="media-body">
    <h4 class="media-heading">MBC Music Core <?=end(explode(" ",$category->concert_vid->title))?> - <?=$category->title?></h4>
     <a href="concerts/watch_all/<?=$category->id?>"><div class="btn btn-primary" type="button">ดูทั้งหมด</div></a>
  </div>
</div>
</div>

<?php foreach($vids as $vid):?>
<div class="col-lg-12">
<div class="media">
  <a class="media-left" href="concerts/watch/<?=$vid->slug?>" target="_blank">
    <?=thumb("http://img.youtube.com/vi/".getYouTubeIdFromURL($vid->url)."/0.jpg",124,70,1)?>
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?=$vid->title?></h4>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->

</div>