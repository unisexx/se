<div class="row">
	
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="">หน้าแรก</a></li>
  <li><a href="ข่าวเกาหลี">ข่าวบันเทิงเกาหลีอัพเดท</a></li>
  <li class="active"><?=$new->title?></li>
</ol>

<h1><?=$new->title?></h1>
<?=addThis()?>
    <div class="newcontent">
        <?=get_facebook_thumbnail($new->detail)?>
        <?=preg_replace('#</?a(\s[^>]*)?>#i', '', $new->detail)?>
    </div>
<?// =fanpage_button();?>
<?=facebook_comment();?>
<h2>ข่าวบันเทิงเกาหลีอื่นๆที่น่าสนใจ</h2>

<div class="row">
<?php foreach($ralates as $row):?>
<div class="col-lg-6">
	<div class="media">
	  <a class="media-left" href="ข่าวเกาหลี/<?=$row->slug?>">
	    <?=get_img_from_detail($row->detail,120,90,1,'alt="'.$row->title.'"')?>
	  </a>
	  <div class="media-body">
	    <h4 class="media-heading"><?=$row->title?></h4>
	  </div>
	</div>
</div>
<?php endforeach;?>
</div>

</div>