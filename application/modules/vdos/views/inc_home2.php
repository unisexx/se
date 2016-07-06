<h2 class="headline">ซีรีย์เกาหลีซับไทยออนไลน์</h2>
<a class="more-link" href="vdos">ดูทั้งหมด ></a>
<div class="row">
<?php foreach($vdos as $vdo):?>
<div class="col-lg-6">
<a class="media-left" href="vdos/series_online/ดูซีรีย์เกาหลี-<?=clean_url($vdo->category->name)?>-<?=$vdo->title?>-ซับไทย-ออนไลน์-<?=$vdo->id?>">
<div class="media">
  <div class="media-left">
    <?=thumb($vdo->category->image,120,90,1,$param = NULL)?>
  </div>
  <div class="media-body">
    <h3 class="media-heading"><?=$vdo->category->name?> - <?=$vdo->title?></h3>
  </div>
</div>
</a>
</div>
<?php endforeach;?>
</div><!--/row-->