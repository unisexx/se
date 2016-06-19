<div class="row">

<ol class="breadcrumb">
  <li><a href="home">Home</a></li>
  <li class="active">ข่าวบันเทิงเกาหลีอัพเดท</li>
</ol>

<h1>ข่าวบันเทิงเกาหลีอัพเดท</h1>

<div class="row">
<?php foreach($news as $new):?>
<div class="col-lg-6">
<div class="media">
  <a class="media-left" href="ข่าวเกาหลี/<?=$new->slug?>" target="_blank">
    <?=get_img_from_detail($new->detail,120,90,1,'alt="'.$new->title.'"')?>
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?=$new->title?></h4>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->

<?php echo $news->pagination();?>

</div>