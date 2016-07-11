<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">ข่าวบันเทิงเกาหลีอัพเดท</li>
</ol>

<h1>ข่าวบันเทิงเกาหลีอัพเดท</h1>

<div class="row">
<?php foreach($news as $new):?>
<div class="col-lg-6">
<a href="ข่าวเกาหลี/<?=$new->slug?>">
<div class="media">
  <div class="media-left">
    <?=get_img_from_detail($new->detail,120,90,1,'alt="'.$new->title.'"')?>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$new->title?></h4>
    <?=is_today($new->created)?>
  </div>
</div>
</a>
</div>
<?php endforeach;?>
</div><!--/row-->

<?php echo $news->pagination();?>

</div>