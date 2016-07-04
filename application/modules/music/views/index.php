<div class="row">

<ol class="breadcrumb">
  <li><a href="home">หน้าแรก</a></li>
  <li class="active">เพลงเกาหลี</li>
</ol>

<h1>เพลงเกาหลี</h1>

<div class="row">
<?php foreach($rs as $music):?>
<div class="col-lg-6">
<div class="media">
  <a class="media-left" href="music/view/<?=$music->slug?>/<?=$music->id?>" target="_blank">
    <?=get_img_from_detail($music->detail,120,120,1,'alt="'.$music->title.'"')?>
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?=$music->title?></h4>
  </div>
</div>
</div>
<?php endforeach;?>
</div><!--/row-->

<?php echo $rs->pagination();?>

</div>