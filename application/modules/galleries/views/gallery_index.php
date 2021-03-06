<div class="galleries">
	<div class="header-bar">
		<h1>ภาพกิจกรรม</h1>
	</div>
	<div id="boxphoto" class="corner" style="padding-bottom:10px;">
		<ul class="gallery">
			<?php foreach ($categories as $category):?>
			<li>
				<a href="galleries/view/<?php echo $category->id?>"><span class="clip_image"></span><?php echo thumb($category->gallery->order_by("id","random")->get()->image,170,120,0,"alt='image' title='$category->name'");?></a>
                <div class="txtgallery"><?php echo $category->name?></span></div>
                <div class="qtyphoto">
                	<?php if($category->gallery->result_count() == "1"):?>
					(1 image)
					<?php else:?>
					(<?php echo $category->gallery->result_count()?> images)
					<?php endif;?>
				</div>
			</li>
			<?php echo alternator('','','<div class="clear"></div>') ?></php>
			<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
	
	<div class="header-bar">
		<h1>วิดิทัศน์</h1>
	</div>
	<div id="boxphoto" class="corner" style="padding-bottom:10px;">
		<ul class="gallery">
			<?php foreach ($vdo_categories as $vdo_category):?>
			<li>
				<a href="galleries/vdo/<?php echo $vdo_category->id?>"><span class="clip_image"></span><?php echo thumb($vdo_category->vdo->order_by("id","random")->get()->cover_pic,170,120,0,"alt='image' title='$vdo_category->name'");?></a>
                <div class="txtgallery"><?php echo $vdo_category->name?></span></div>
                <div class="qtyphoto">
                	<?php if($vdo_category->vdo->result_count() == "1"):?>
					(1 video)
					<?php else:?>
					(<?php echo $vdo_category->vdo->result_count()?> videos)
					<?php endif;?>
				</div>
			</li>
			<?php echo alternator('','','<div class="clear"></div>') ?></php>
			<?php endforeach;?>
		</ul>
		<div class="clear"></div>
	</div>
</div>