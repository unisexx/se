<div class="row">
	
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="home">หน้าแรก</a></li>
  <li><a href="concerts">คอนเสิร์ตเกาหลี</a> <span class="divider">/</span></li>
    <li><a href="concerts/week/<?=$vid->concert_category->id?>">MBC Music Core <?=end(explode(" ",$vid->title))?> -  <?=$vid->concert_category->title?></a> <span class="divider">/</span></li>
    <li class="active"><?=$vid->title?></li>
</ol>

<h1><?=$vid->title?></h1>
<?=addThis()?>
    <div class="newcontent">
        <?=get_vdo($vid->vdo_script)?>
    </div>
<?//=fanpage_button();?>
<?=facebook_comment();?>

</div>