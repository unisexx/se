<h2 class="headline">ซีรีย์เกาหลีซับไทยออนไลน์</h2>

<div class="row">
<?php foreach($vdos as $vdo):?>
<div class="col-lg-6">
<div class="media">
  <a class="media-left" href="vdos/series_online/ดูซีรีย์เกาหลี-<?=clean_url($vdo->category->name)?>-<?=$vdo->title?>-ซับไทย-ออนไลน์-<?=$vdo->id?>" target="_blank">
    <?=thumb($vdo->category->image,120,90,1,$param = NULL)?>
  </a>
  <div class="media-body">
    <h3 class="media-heading"><?=$vdo->category->name?> - <?=$vdo->title?></h3>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->