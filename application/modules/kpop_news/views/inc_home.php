<h2 class="headline">ข่าวบันเทิงเกาหลีอัพเดท</h2>

<div class="row">
<?php foreach($news as $new):?>
<div class="col-lg-6">
<a class="media-left" href="ข่าวเกาหลี/<?=$new->slug?>" target="_blank">
<div class="media">
  <div class="media-left">
    <?=get_img_from_detail($new->detail,120,90,1,'alt="'.$new->title.'"')?>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$new->title?></h4>
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