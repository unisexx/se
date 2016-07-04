<?php foreach($banners as $banner):?>
    <?php if($banner->image):?>
        <a href="<?=$banner->url?>" target="_blank"><img class="side-banner img-fluid" alt="<?php echo $banner->title?>" width="<?=$banner->width?>" height="<?=$banner->height?>" src="<?=$banner->image?>"></a>
    <?php else:?>
        <a href="<?=$banner->url?>" target="_blank"><object width="<?=$banner->width?>" height="<?=$banner->height?>" data="<?=$banner->media?>"></object></a>
    <?php endif;?>
<?php endforeach;?>

<a href="tickers/view/2"><img src="holder.js/220x100?text=โฆษณาตำแหน่งนี้ 200/เดือน \n 220px x 100px คลิก" class="img-fluid"></a>