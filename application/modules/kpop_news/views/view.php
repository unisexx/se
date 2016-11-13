<?php
	// pingbook ลิ้งค์รูปเว็บใหม่
	$search = array('http://www.pingbook.com/archive');
	$replace = array('https://www.pingbook.com/wp-content/uploads');
?>
	
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
        <?if($new->url != ""):?>
        <p><img src="<?=$new->image?>"></p>
        <?endif;?>
        <?=str_replace($search,$replace,preg_replace('#</?a(\s[^>]*)?>#i', '', $new->detail))?>
    </div>
<?// =fanpage_button();?>
<?=facebook_comment();?>
<h2>ข่าวบันเทิงเกาหลีอื่นๆที่น่าสนใจ</h2>

<div class="row">
<?php foreach($ralates as $row):?>
<div class="col-lg-6">
	<div class="media">
	  <a class="media-left" href="ข่าวเกาหลี/<?=$row->slug?>">
	    <?=thumb($row->image,120,90,1,'alt="'.$row->title.'"')?>
	  </a>
	  <div class="media-body">
	    <h4 class="media-heading"><?=$row->title?></h4>
	    <small class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=mysql_to_th($row->created)?></small>
	  </div>
	</div>
</div>
<?php endforeach;?>
</div>

</div>