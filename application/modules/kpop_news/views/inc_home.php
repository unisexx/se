<h2 class="headline">ข่าวบันเทิงเกาหลีอัพเดท</h2>
<a class="more-link" href="ข่าวเกาหลี">ดูทั้งหมด ></a>
<div class="row">
<?php foreach($news as $new):?>
<div class="col-lg-6">
<a class="media-left" href="ข่าวเกาหลี/<?=$new->slug?>">
<div class="media">
  <div class="media-left">
    <?=get_img_from_detail($new->detail,120,90,1,'alt="'.$new->title.'"')?>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$new->title?></h4>
    <small class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=mysql_to_th($new->created)?></small>
  </div>
</div>
</a>
</div>
<?php endforeach;?>
</div><!--/row-->

<!-- <div class="row">
	<?php foreach($news as $new):?>
		<div class="col-lg-4">
			<a href="ข่าวเกาหลี/<?=$new->slug?>" target="_blank">
			  <?=get_img_from_detail($new->detail,265,180,1,'alt="'.$new->title.'"')?>
		      <h3><?=$new->title?></h3>
		    </a>
	    </div>
	<?php endforeach;?>
</div> -->